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

class ReviewsController extends Controller
{
    public function index()
    {
        $data = [];
        try{
            $siteid     = config('app.siteid');
                  
            $data['pageCss'] = 'reviews';

            //Cache::forget("ReviewListingPage__Lists__{$siteid}");
            // $data['list'] = Cache::remember(
            //     "ReviewListingPage__Lists__{$siteid}",
            //     21600,
            //     function () use ($siteid) {
            //         return Category::select(
            //             'id',
            //             'title',
            //             'cat_blog_image'
            //         )
            //         ->CustomWhereBasedData($siteid)
            //         ->has('reviews')
            //         ->orderBy('title')
            //         ->get()
            //         ->toArray();
            //     }
            // );

            //Cache::forget("ReviewListingPage__CategoryLists__{$siteid}");
            $data['categoryLists'] = Cache::remember(
                "ReviewListingPage__CategoryLists__{$siteid}",
                21600,
                function () use ($siteid) {
                    return Category::select(
                            'id',
                            'title',
                            'cat_blog_image'
                        )
                        ->CustomWhereBasedData($siteid)
                        ->has('reviews')
                        //->take(3)
                        ->orderBy('title')
                        ->get()
                        ->toArray();
                }
            );
            
            //Cache::forget("ReviewListingPage__AuthorLists__{$siteid}");
            $data['authorLists'] = Cache::remember(
                "ReviewListingPage__AuthorLists__{$siteid}",
                21600,
                function () use ($siteid) {
                    return Author::select(
                        'authors.id',
                        'first_name',
                        'last_name'
                    )
                    ->join('reviews','reviews.author_id','=','authors.id')
                    ->groupBy('authors.id')
                    ->orderBy('authors.id','ASC')
                    ->get()
                    ->toArray();
                }
            );
            
            //Cache::forget("ReviewListingPage__LatestReviews__{$siteid}");
            $data['latestReviews'] = Cache::remember(
                "ReviewListingPage__LatestReviews__{$siteid}",
                21600,
                function () use ($siteid) {
                    return Review::select(
                        'id',
                        'title',
                        'created_at',
                        'user_id',
                        'review_image'
                    )
                    ->with(['categories' => function ($query) {
                        $query
                            ->select(
                                'id',
                                'title',
                                'slug'
                            );
                    }])
                    ->with('user:id,name')
                    ->with('author:id,first_name,last_name')
                    ->CustomWhereBasedData($siteid)
                    ->orderBy('id', 'DESC')
                    ->take(12)
                    ->get()
                    ->toArray();
                }
            );

            //Cache::forget("ReviewListingPage__PopularReviews__{$siteid}");
            $data['popularReviews'] = Cache::remember(
                "ReviewListingPage__PopularReviews__{$siteid}",
                21600,
                function () use ($siteid) {
                    return Review::select(
                            'id',
                            'title',
                            'created_at',
                            'user_id',
                            'review_image'
                        )
                       ->with(['categories' => function ($query) {
                            $query
                                ->select(
                                    'id',
                                    'title',
                                    'slug'
                                );
                        }])
                        ->with('user:id,name')
                        ->with('author:id,first_name,last_name')
                        ->where('popular', 1)
                        ->CustomWhereBasedData($siteid)
                        ->orderBy('id', 'DESC')
                        ->take(4)
                        ->get()
                        ->toArray();

                   
                }
            );

            //Cache::forget("ReviewListingPage__PopularBlogs__{$siteid}");
            $data['popularBlogs'] = Cache::remember(
                "ReviewListingPage__PopularBlogs__{$siteid}",
                21600,
                function () use ($siteid) {
                    return Blog::select(
                            'id',
                            'title',
                            'created_at',
                            'user_id',
                            'blog_image'
                        )
                       ->with(['categories' => function ($query) {
                            $query
                                ->select(
                                    'id',
                                    'title',
                                    'slug'
                                );
                        }])
                        ->with('user:id,name')
                        ->with('author:id,first_name,last_name')
                        ->where('popular', 1)
                        ->CustomWhereBasedData($siteid)
                        ->orderBy('id', 'DESC')
                        ->take(3)
                        ->get()
                        ->toArray();

                   
                }
            );

            $data['filter'] = 0;
            if (!empty($_GET['category'])) {
                $data['filter'] = 1;
                $category = $_GET['category'];

                // $categoryData = Category::find($category);
                // $data['category_title'] = $categoryData->title;

                Cache::forget("reviews_{$siteid}__{$category}");
                $data['category_data'] = Cache::remember(
                    "reviews_{$siteid}__{$category}",
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

                        // un-comment it 
                        ->with(['reviews' => function ($query) use ($siteid) {
                            $query
                                ->orderBy('id', 'DESC')
                                // ->take(3)
                                ->CustomWhereBasedData($siteid);
                        }])
                        ->first();
                    }
                );
            }else{
                //Cache::forget("Popular_reviews__{$siteid}");
                $data['popular_reviews'] = Cache::remember(
                    "Popular_reviews__{$siteid}",
                    21600,
                    function () use ($siteid) {
                        return Review::select(
                            'id',
                            'title',
                            'review_image',
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
                        ->orderBy('reviews.id', 'DESC')
                        ->take(4)
                        ->get()
                        ->toArray();
                    }
                );
                Cache::forget("Recent_reviews__{$siteid}");
                $data['recent_reviews'] = Cache::remember(
                    "Recent_reviews__{$siteid}",
                    21600,
                    function () use ($siteid) {
                        return Review::select(
                            'id',
                            'title',
                            'review_image',
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
                        ->orderBy('reviews.id', 'DESC')
                        ->take(12)
                        ->get()
                        ->toArray();
                    }
                );
            }

            //Cache::forget("ReviewListingPage__CurrentPage__{$siteid}");
            $page = Cache::remember(
                "ReviewListingPage__CurrentPage__{$siteid}",
                21600,
                function () use ($siteid) {
                    return Page::where(
                        'title',
                        'meta_title',
                        'meta_description'
                    )
                    // ->CustomWhereBasedDataForMetaInfo($siteid)
                    ->first();
                }
            );
         
            if (isset($page)) {
                $data['meta'] = [
                    'title' => $page->meta_title ?? '',
                    'description' => $page->meta_description ?? ''
                ];
            }

            return view('web.review.index')->with($data);
        }catch (\Exception $e) {
            abort(404);
        }
    }

    public function detail()
    {
        $data = [];
        try{
            $siteid     = config('app.siteid');
            $data['pageCss'] = 'review-inner';
            
            $pageid     = PAGE_ID;

            $data['categoryLists'] = Cache::remember(
                "ReviewDetailPage__CategoryLists__{$siteid}",
                21600,
                function () use ($siteid) {
                    return Category::select(
                            'id',
                            'title',
                        )
                        ->CustomWhereBasedData($siteid)
                        ->take(3)
                        ->get()
                        ->toArray();
                }
            );

            $data['authorLists'] = Cache::remember(
                "ReviewDetailPage__AuthorLists__{$siteid}",
                21600,
                function () use ($siteid) {
                    return Author::select(
                            'id',
                            'first_name',
                        )
                        ->take(3)
                        ->get()
                        ->toArray();
                }
            );

            $data['relatedStores'] = Cache::remember(
                "ReviewDetailPage__RelatedStores__{$siteid}__{$pageid}",
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

            Cache::forget("ReviewListingPage__PopularReviews__{$siteid}");
            $data['popularReviews'] = Cache::remember(
                "ReviewListingPage__PopularReviews__{$siteid}",
                21600,
                function () use ($siteid) {
                    return Review::select(
                            'id',
                            'title',
                            'created_at',
                            'user_id',
                            'review_image'
                        )
                       ->with(['categories' => function ($query) {
                            $query
                                ->select(
                                    'id',
                                    'title',
                                    'slug'
                                );
                        }])
                        ->with('user:id,name')
                        ->with('author:id,first_name,last_name')
                        ->where('popular', 1)
                        ->CustomWhereBasedData($siteid)
                        ->orderBy('id', 'DESC')
                        ->take(4)
                        ->get()
                        ->toArray();

                   
                }
            );

            $detail = Cache::remember(
                "ReviewDetailPage__ReviewDetail__{$siteid}__{$pageid}",
                21600,
                function () use ($siteid, $pageid) {
                    return Review::select(
                        'id',
                        'title',
                        'review_image',
                        'updated_at',
                        'author_id',
                        'long_description'
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
            
            $page = Cache::remember(
                "ReviewListingPage__CurrentPage__{$siteid}",
                21600,
                function () use ($siteid) {
                    return Page::where(
                        'title',
                        'meta_title',
                        'meta_description'
                    )
                        // ->CustomWhereBasedDataForMetaInfo($siteid)
                        ->first();
                }
            );
         
            if (isset($page)) {
                $data['meta'] = [
                    'title' => $page->meta_title ?? '',
                    'description' => $page->meta_description ?? ''
                ];
            }
            
            return view('web.review.detail')->with($data);

        }catch (\Exception $e) {
            abort(404);
        }
    }

    public function reviewCategories()
    {
        $data = [];
        try {
            $siteid = config('app.siteid');
            $data['pageCss'] = 'categories';

            $data['popular'] = Category::select('id', 'title')->CustomWhereBasedData($siteid)->where('popular', 1)->orderBy('title')->limit(8)->get()->toArray();

            Cache::forget("ReviewListingPage__CategoryList__{$siteid}");
            $data['categories'] = Cache::remember(
                "ReviewListingPage__CategoryList__{$siteid}",
                86400,
                function () use ($siteid) {
                    return Category::select(
                        'id',
                        'title',
                        'category_image'
                    )
                    ->CustomWhereBasedData($siteid)
                    ->has('reviews')
                    ->orderBy('title')
                    ->get()
                    ->toArray();
                }
            );



            return view('web.review.review_category_listing')->with($data);
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function reviewAuthor($id)
    {
        $data = [];
        $siteid = config('app.siteid');
        $data['pageCss'] = "author";
        $author = Author::where('id', $id)->with(['author_type','languages'])->first();
        if ($author) $user_id = $author->id;
        else abort(404);
        
        $data['author'] = $author;
        $data['author']['review_count'] = Review::where('author_id',$author->id)->count();
        // $data['list'] = Category::select('id', 'title', 'category_image')->CustomWhereBasedData($siteid)->with('blogs.slugs')->with(['blogs' => function ($blogCustomWhereBasedDataQuery) use ($siteid) {
        //     $blogCustomWhereBasedDataQuery->select('id', 'title')->CustomWhereBasedData($siteid);
        // }])->orderBy('title')->get()->toArray();

        $data['author_reviews'] = Review::select(
            'id',
            'title',
            'review_image',
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

    
        //  echo "<pre>"; print_r($data['author_reviews']); 
        // exit();
        return view('web.review.author')->with($data);
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
