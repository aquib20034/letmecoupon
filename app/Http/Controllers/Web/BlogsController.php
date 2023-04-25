<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\WebModel\Category;
use App\WebModel\Page;
use App\WebModel\Blog;


use App\Author;
use App\Store;
use App\SiteSetting;
use App\WebModel\Slug;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;
use App\WebModel\Site;
use App\WebModel\Review;
use Illuminate\Support\Facades\Cache;

class BlogsController extends Controller
{
    public function index()
    {
        try {
            $data = [];
            $data['pageCss'] = "blogs";
            $siteid = config('app.siteid');

            Cache::forget("BlogListingPage__CategoryList__{$siteid}");
            $data['list'] = Cache::remember(
                "BlogListingPage__CategoryList__{$siteid}",
                86400,
                function () use ($siteid) {
                    return Category::select(
                        'id',
                        'title',
                        'cat_blog_image'
                    )
                    ->CustomWhereBasedData($siteid)
                    ->has('blogs')
                    ->orderBy('title')
                    ->get()
                    ->toArray();
                }
            );

            Cache::forget("Blog_authors_{$siteid}");
            $data['blog_authors'] = Cache::remember(
                "Blog_authors_{$siteid}",
                86400,
                function () use ($siteid) {
                    return Author::select(
                        'authors.id',
                        'first_name',
                        'last_name'
                    )
                    ->join('blogs','blogs.author_id','=','authors.id')
                    ->groupBy('authors.id')
                    ->orderBy('authors.id','ASC')
                    ->get()
                    ->toArray();
                }
            );

            Cache::forget("popular_reviews_{$siteid}");
            $data['popular_reviews'] = Cache::remember(
                "popular_reviews_{$siteid}",
                86400,
                function () use ($siteid) {
                    return Review::select(
                        'id',
                        'title',
                        'review_image',
                        'created_at',
                        'author_id'
                    )
                    ->with('author:id,first_name,last_name')
                    ->where('popular', 1)
                    ->CustomWhereBasedData($siteid)
                    ->with(['categories' => function ($query) {
                        $query
                            ->select(
                                'id',
                                'title',
                                'slug'
                            );
                    }])
                    ->orderBy('id','ASC')
                    ->get()
                    ->take(3)
                    ->toArray();
                }
            );

            // echo "<pre>"; print_r($data['popular_reviews']); exit();
            $data['filter'] = 0;
            if (!empty($_GET['category'])) {
                $data['filter'] = 1;
                $category = $_GET['category'];
                // $categoryData = Category::find($category);
                // $data['category_title'] = $categoryData->title;

                Cache::forget("blogs_{$siteid}__{$category}");
                $data['category_data'] = Cache::remember(
                    "blogs_{$siteid}__{$category}",
                    21600,
                    function () use ($siteid, $category) {
                        return Category::select(
                            'id',
                            'title',
                            'short_description',
                            'cat_blog_image'
                        )
                        ->CustomWhereBasedData($siteid)
                        ->whereHas('slugs', function ($query) use ($category, $siteid) {
                            $query
                                ->where('slug', $category)
                                ->where('site_id', $siteid);
                        })
                        ->with(['blogs' => function ($query) use ($siteid) {
                            $query
                                ->orderBy('id', 'DESC')
                                // ->take(3)
                                ->CustomWhereBasedData($siteid);
                        }])
                        ->first();
                    }
                );

    //   echo "<pre>";
    //         print_r($data['blogs']);
    //         exit();


                // $data['popular_blogs'] = $categoryData->blogs()->select(
                //     'id',
                //     'title',
                //     'blog_image',
                //     'created_at',
                //     'author_id'
                // )
                // ->with('author:id,first_name,last_name')
                // ->with(['categories' => function ($query) {
                //     $query
                //         ->select(
                //             'id',
                //             'title',
                //             'slug'
                //         );
                // }])
                // ->CustomWhereBasedData($siteid)
                // ->where('popular', 1)
                // ->orderBy('blogs.id', 'DESC')
                // ->take(4)
                // ->get()
                // ->toArray();
            }else{
                Cache::forget("Popular_blogs__{$siteid}");
                $data['popular_blogs'] = Cache::remember(
                    "Popular_blogs__{$siteid}",
                    21600,
                    function () use ($siteid) {
                        return Blog::select(
                            'id',
                            'title',
                            'blog_image',
                            'created_at',
                            'author_id'
                        )
                        ->with('author:id,first_name,last_name')
                        ->with(['categories' => function ($query) use ($siteid) {
                            $query
                                ->select(
                                    'id',
                                    'title',
                                    'slug'
                                )
                                ->CustomWhereBasedData($siteid);
                        }])
                        ->CustomWhereBasedData($siteid)
                        ->where('popular', 1)
                        ->orderBy('blogs.id', 'DESC')
                        ->take(4)
                        ->get()
                        ->toArray();
                    }
                );

                Cache::forget("Recent_blogs__{$siteid}");
                $data['recent_blogs'] = Cache::remember(
                    "Recent_blogs__{$siteid}",
                    21600,
                    function () use ($siteid) {
                        return Blog::select(
                            'id',
                            'title',
                            'blog_image',
                            'created_at',
                            'author_id'
                        )
                        ->with('author:id,first_name,last_name')
                        ->with(['categories' => function ($query) use ($siteid) {
                            $query
                                ->select(
                                    'id',
                                    'title',
                                    'slug'
                                )
                                ->CustomWhereBasedData($siteid);
                        }])

                        ->CustomWhereBasedData($siteid)
                        ->orderBy('blogs.id', 'DESC')
                        ->take(12)
                        ->get()
                        ->toArray();
                    }
                );
            }

            $page = Cache::remember(
                "BlogListingPage__CurrentPage__{$siteid}",
                21600,
                function () use ($siteid) {
                    return Page::where(
                        'title',
                        'blog-listing'
                    )
                    ->CustomWhereBasedDataForMetaInfo($siteid)
                    ->first();
                }
            );

            if (isset($page)) {
                $data['meta'] = [
                    'title' => $page->meta_title ?? '',
                    'description' => $page->meta_description ?? ''
                ];
            }



            return view(
                'web.blog.index'
            )
                ->with($data);
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function detail()
    {
        $data = [];
        try {
            $siteid = config('app.siteid');
            $pageid = PAGE_ID;
            $data['pageCss'] = "blog-inner";


            $data['list'] = Cache::remember(
                "BlogDetailPage__CategoryList__{$siteid}",
                21600,
                function () use ($siteid) {
                    return Category::select(
                        'id',
                        'title',
                        'category_image'
                    )
                        ->CustomWhereBasedData($siteid)
                        ->with(['blogs' => function ($query) use ($siteid) {
                            $query
                                ->CustomWhereBasedData($siteid);
                        }])
                        ->orderBy('title')
                        ->get()
                        ->toArray();
                }
            );

            // $data['popularCategory'] = Cache::remember(
            //     "BlogDetailPage__PopularCategories__{$siteid}",
            //     21600,
            //     function () use ($siteid) {
            //         return Blog::select(
            //             'id',
            //             'title',
            //             'blog_image'
            //         )
            //             ->CustomWhereBasedData($siteid)
            //             ->with(['categories' => function ($query) {
            //                 $query
            //                     ->select(['id', 'title', 'slug']);
            //             }])
            //             ->take(10)
            //             ->where('popular', 1)
            //             ->get()
            //             ->toArray();
            //     }
            // );

            // $data['trendingBlogs'] = Cache::remember(
            //     "BlogDetailPage__TrendingCategories__{$siteid}",
            //     21600,
            //     function () use ($siteid) {
            //         return Blog::select(
            //             'id',
            //             'title',
            //             'created_at',
            //             'user_id',
            //             'blog_image'
            //         )
            //             ->CustomWhereBasedData($siteid)
            //             ->where(function ($query) {
            //                 return $query
            //                     ->where('trending', 1)
            //                     ->orWhere('view', '>', 0);
            //             })
            //             ->take(10)
            //             ->get()
            //             ->toArray();
            //     }
            // );

            Cache::forget("BlogDetailPage__LatestBlogs__{$siteid}");
            $data['latestBlog'] = Cache::remember(
                "BlogDetailPage__LatestBlogs__{$siteid}",
                21600,
                function () use ($siteid) {
                    return Blog::select(
                        'id',
                        'title',
                        'blog_image',
                        'created_at',
                        'author_id'
                        )
                        ->with('author:id,first_name,last_name')
                        ->CustomWhereBasedData($siteid)
                        ->with(['categories' => function ($query) use ($siteid) {
                            $query
                                ->select(
                                    'id',
                                    'title',
                                    'slug'
                                )
                                ->CustomWhereBasedData($siteid);
                        }])
                        ->orderBy('id', 'desc')
                        ->take(3)
                        ->get()
                        ->toArray();
                }
            );

            

            //  exit();

            // $data['blogWithCategory'] = Cache::remember(
            //     "BlogDetailPage__BlogWithCategory__{$siteid}",
            //     21600,
            //     function () use ($siteid) {
            //         return Blog::select(
            //             'id',
            //             'title',
            //             'blog_image'
            //         )
            //             ->CustomWhereBasedData($siteid)
            //             ->with(['categories' => function ($query) {
            //                 $query
            //                     ->select('title');
            //             }])
            //             ->take(3)
            //             ->get()
            //             ->toArray();
            //     }
            // );

            //Cache::forget("BlogDetailPage__BlogDetail__{$siteid}__{$pageid}");
            $detail = Cache::remember(
                "BlogDetailPage__BlogDetail__{$siteid}__{$pageid}",
                21600,
                function () use ($siteid, $pageid) {
                    return Blog::select(
                        'id',
                        'title',
                        'long_description',
                        'blog_image',
                        'updated_at',
                        'author_id'
                        )
                        ->with('author:id,first_name,last_name,image,short_description')
                        ->CustomWhereBasedData($siteid)
                        ->with('tags')
                        ->with(['categories' => function ($query) use ($siteid) {
                            $query
                                ->select(
                                    'id',
                                    'title',
                                    'slug'
                                )
                                ->CustomWhereBasedData($siteid);
                        }])
                        ->with('user')
                        ->where('id', $pageid)
                        ->first();
                }
            );

            if ($detail) $data['detail'] = $detail->toArray();
            else abort(404);




            //  echo "<pre>"; print_r($data['detail']);

            // $data['popularStoresFromCategory'] = Cache::remember(
            //     "BlogDetailPage__PopularStoresFromCategory__{$siteid}__{$pageid}",
            //     21600,
            //     function () use ($siteid, $pageid) {
            //         return Category::select(
            //             'id',
            //             'title',
            //             'meta_title',
            //             'meta_description',
            //             'long_description',
            //             'category_banner_image'
            //         )
            //             ->with(['categoryStores' => function ($query) use ($siteid) {
            //                 $query->select(
            //                     'id',
            //                     'name',
            //                     'store_image'
            //                 )
            //                     ->where('popular', 1)
            //                     ->CustomWhereBasedData($siteid);
            //             }])
            //             ->CustomWhereBasedData($siteid)
            //             ->where('id', $pageid)
            //             ->first();
            //     }
            // );

            // $data['relatedBlog']  = [];

            // if (isset($detail['categories'])) {
            //     $ids = [];

            //     foreach ($detail['categories'] as $_ => $item) :
            //         $ids[] = $item['id'];
            //     endforeach;

            //     $data['relatedBlog'] = Cache::remember(
            //         "BlogDetailPage__RelatedBlogs__{$siteid}__{$pageid}",
            //         21600,
            //         function () use ($siteid, $ids) {
            //             Blog::select(
            //                 'id',
            //                 'title',
            //                 'blog_image'
            //             )
            //                 ->CustomWhereBasedData($siteid)
            //                 ->whereHas('categories', function ($query) use ($ids) {
            //                     $query
            //                         ->whereIn('id', $ids);
            //                 })
            //                 ->take(3)
            //                 ->get()
            //                 ->toArray();
            //         }
            //     );
            // }

            $data['relatedStores'] = Cache::remember(
                "BlogDetailPage__RelatedStores__{$siteid}__{$pageid}",
                21600,
                function () use ($siteid, $pageid) {
                    return Blog::select(
                        'id',
                        'title'
                    )
                        ->with('categories')
                        ->with('store_details')
                        ->CustomWhereBasedData($siteid)
                        ->where('id', $pageid)
                        ->first();
                }
            );

            $data['meta'] = [
                'title' => isset($data['detail']['meta_title'])
                    ? $data['detail']['meta_title']
                    : '',
                'description' => isset($data['detail']['meta_description'])
                    ? $data['detail']['meta_description']
                    : ''
            ];

           
            return view(
                'web.blog.detail'
            )
            ->with($data)
            ->withShortcodes();
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function categoryBlogs()
    {

        $siteid = config('app.siteid');
        $data['pageCss'] = "blog";

        $data['blogCategory'] = Category::select('id', 'title', 'slug')->CustomWhereBasedData($siteid)->take(10)->get()->toArray();

        $categoryBlogs = Category::select('id', 'title', 'short_description', 'meta_title', 'meta_description')->CustomWhereBasedData($siteid)->with(['blogs' => function ($q1) use ($siteid) {
            $q1->with(['slugs', 'user', 'categories'])->CustomWhereBasedData($siteid);
        }])->where('slug', BLOG_CATEGORY_LINK)->first();

        $data['trendingBlogs'] = Blog::select('id', 'title', 'created_at', 'blog_image')->with('user:id,name')->CustomWhereBasedData($siteid)->with(['categories' => function ($categoryQuery) {
            $categoryQuery->select(['id', 'title', 'slug']);
        }])->orderBy('sort', 'asc')->take(4)->where('view', '>', 0)->get()->toArray();

        if (empty($categoryBlogs)) {
            abort(404);
        }

        $data['categoryblogs'] = $categoryBlogs->toArray();

        $meta['title'] = $data['categoryblogs'] ? $data['categoryblogs']['meta_title'] : '';
        $meta['description'] = $data['categoryblogs'] ? $data['categoryblogs']['meta_description'] : '';
        $data['meta'] = $meta;

        return view('web.blog.blog_category')->with($data);
    }

    public function blogCategories()
    {
        $data = [];
        try {
            $siteid = config('app.siteid');
            $data['pageCss'] = 'categories';

            $data['popular'] = Category::select('id', 'title')->CustomWhereBasedData($siteid)->where('popular', 1)->orderBy('title')->limit(8)->get()->toArray();

            // $data['blogCategory'] = Category::select('id','title','slug','category_image')->with(['blogs'=> function($q1) use ($siteid){
            //         $q1->select('id','title')->with(['slugs'])->where('featured',1)->orWhere('popular',1)->orWhere('trending',1)->CustomWhereBasedData($siteid);
            //     }])->CustomWhereBasedData($siteid)->get()->toArray();
            // $data['blogCategory'] = Category::select('id', 'title', 'slug', 'category_image')->CustomWhereBasedData($siteid)->whereNull('parent_id')->with('children')->get()->toArray();

            // $data['popularStores']      = Store::select('id', 'name')->CustomWhereBasedData($siteid)->where('popular', 1)->take(10)->get()->toArray();

            // $data['featuredStores']     = Store::select('id', 'name', 'store_image')->CustomWhereBasedData($siteid)->where('featured', 1)->take(12)->get()->toArray();

            // $data['popularCategories']  = Category::select('id', 'title')->CustomWhereBasedData($siteid)->where('popular', 1)->take(10)->get()->toArray();

            
            Cache::forget("BlogListingPage__CategoryList__{$siteid}");
            $data['categories'] = Cache::remember(
                "BlogListingPage__CategoryList__{$siteid}",
                86400,
                function () use ($siteid) {
                    return Category::select(
                        'id',
                        'title',
                        'category_image'
                    )
                    ->CustomWhereBasedData($siteid)
                    ->has('blogs')
                    ->orderBy('title')
                    ->get()
                    ->toArray();
                }
            );



            return view('web.blog.blog_category_listing')->with($data);
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function load_data(Request $request)
    {
        $siteid = config('app.siteid');
        if ($request->ajax()) {
            if ($request['data_id'] > 0) {
                $output = '';
                $last_id = '';
                $category_id = $request['category_id'];
                $data = Blog::CustomWhereBasedData($siteid)->where('id', '>', $request['data_id'])->orderBy('id', 'ASC')->limit(2)->get()->toArray();

                if (!empty($data)) {
                    foreach ($data as $record) {
                        $url = config("app.app_path") . "/" . $record['slugs']['slug'];
                        $image = '';
                        if (isset($record['blog_image']) || !empty($record['blog_image'])) :
                            $image = $record['blog_image'];
                        else :
                            $image = config("app.app_image") . '/build/images/blog/imagePlaceHolder336.png';
                        endif;
                        $output .= '
                  <div class="col-1 standard-post horizontal" >
                      <div class="inner">
                          <div class="post-image">
                              <a href="' . $url . '" class="image">
                                  <img src="' . $image . '" alt="">
                              </a>
                          </div>
                          <div class="post-details">
                              <a href="javascript:;">
                                  <div class="category-details">
                                      <div class="category-tags">
                                          <span >' . $record["title"] . '</span>
                                      </div>
                                  </div>
                                  <div class="post-title">
                                      <h2>' . $record["short_description"] . '</h2>
                                  </div>
                              </a>
                          </div>
                          <span class="btm-line"></span>
                      </div>
                  </div>
                  ';
                        $last_id = $record['id'];
                    }

                    $output .= '
             <div id="load_more">
              <button type="button" name="load_more_button" class="blgLoadMore form-control " blog-category-id="' . $category_id . '" data-id="' . $last_id . '" id="load_more_button">Load More</button>
             </div>
           ';

                    echo $output;
                } else {

                    $output .= '
             <div id="load_more">
              <button type="button" name="load_more_button" class="blgLoadMore form-control">No More Blogs</button>
             </div>
           ';

                    echo $output;
                }
            } else {
            }
        }
    }

    public function blogAuthor($id)
    {

        // echo $id; exit();
        $data = [];
        $siteid = config('app.siteid');
        $data['pageCss'] = "author";
        $author = Author::where('id', $id)->with(['author_type','languages'])->first();
        if ($author) $user_id = $author->id;
        else abort(404);
        // $data['list'] = Category::CustomWhereBasedData($siteid)->with('blogs.slugs')->orderBy('title')->get()->toArray();
        
        // echo 
        // exit();
        $data['author'] = $author;
        $data['author']['blogs_count'] = Blog::where('author_id',$author->id)->count();
        // $data['list'] = Category::select('id', 'title', 'category_image')->CustomWhereBasedData($siteid)->with('blogs.slugs')->with(['blogs' => function ($blogCustomWhereBasedDataQuery) use ($siteid) {
        //     $blogCustomWhereBasedDataQuery->select('id', 'title')->CustomWhereBasedData($siteid);
        // }])->orderBy('title')->get()->toArray();

        $data['author_blogs'] = Blog::select(
            'id',
            'title',
            'blog_image',
            'created_at',
            'author_id'
        )
        ->with('author:id,first_name,last_name')
        
        ->with(['categories' => function ($query) use ($siteid) {
            $query
                ->select(
                    'id',
                    'title',
                    'slug'
                )
                ->CustomWhereBasedData($siteid);
        }])
        ->CustomWhereBasedData($siteid)
        ->orderBy('id', 'DESC')
        ->where('author_id', $user_id)
        ->get()
        ->toArray();

        // echo "<pre>"; print_r($data['author']);
        // exit();
        return view('web.blog.author')->with($data);
    }

    public function authorLoadMoreData(Request $request)
    {
        $siteid = config('app.siteid');
        if ($request->ajax()) {
            if ($request['data_id'] > 0) {

                $output = '';
                $last_id = '';

                $data = Blog::CustomWhereBasedData($siteid)->where('id', '<', $request['data_id'])->with('categories')->orderBy('id', 'DESC')->take(3)->get()->toArray();

                if (!empty($data)) {
                    foreach ($data as $blog) {
                        $url = config("app.app_path") . "/" . $blog['slugs']['slug'];
                        $image = '';
                        if (isset($blog['blog_image']) || !empty($blog['blog_image'])) :
                            $image = $blog['blog_image'];
                        else :
                            $image = config("app.app_image") . '/build/images/blog/imagePlaceHolder336.png';
                        endif;
                        $blogImage = $blog['categories'][0]['category_image'];
                        $blogCategoryTitle = $blog['categories'][0]['title'];
                        $blogTitle = "";

                        $postTitle = substr($blog['title'], 0, 68);
                        $postTitleLength = strlen($blog['title']);

                        if ($postTitleLength > 68) {
                            $blogTitle = $postTitle . " ... ";
                        } else {
                            $blogTitle = $blog['title'];
                        }

                        $output .= '
                  <div class="col-3 standard-post">
                    <div class="inner">
                        <div class="post-image">
                            <a href="' . $url . '" class="image">
                                <img src="' . $image . '" alt="">
                            </a>
                        </div>
                        <div class="post-details">
                            <a href="' . $url . '">
                                <div class="category-details">
                                    <span class="cat-icon">
                                        <img src="' . $blogImage . '" data-src="' . $blogImage . '">
                                    </span>
                                    <div class="category-title">
                                        <span>' . $blogCategoryTitle . '</span>
                                    </div>
                                </div>
                                <div class="post-title">
                                    <h2>' . $blogTitle . '</h2>
                                </div>
                            </a>
                            <span class="btm-line"></span>
                        </div>
                    </div>
                </div>
                  ';
                        $last_id = $blog['id'];
                    }

                    $output .= '
             <div id="load_more" style="width: 100%;">
              <button type="button" id="blog_load_more_button" blog-author-id="1" data-id="' . $last_id . '" class="blgLoadMore">LOAD MORE</button>
            </div>
           ';

                    echo $output;
                } else {

                    $output .= '
             <div id="load_more" style="width: 100%;">
              <button type="button" name="blog_load_more_button" class="blgLoadMore form-control">No More Blogs</button>
             </div>
           ';

                    echo $output;
                }
            } else {
            }
        }
    }
}
