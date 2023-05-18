<?php

namespace App\Http\Controllers\Web;

use App\WebModel\Category;
use App\WebModel\Store;
use App\WebModel\Blog;
use App\WebModel\Review;
use App\Http\Controllers\Controller;
use App\WebModel\Site;
use App\WebModel\ProductCategory;
use App\Traits\MetaWriterTrait;
use Carbon\Carbon;
use App\WebModel\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoriesController extends Controller
{

    use MetaWriterTrait;

    public function index()
    {
        $data = [];
        try {
            $data['pageCss'] = 'categories';

            $siteid = config('app.siteid');

            $data['eligibleCategories'] = 0;

            Cache::forget("CategoryListingPage__CategoryList__{$siteid}");
            if (request()->has('view_all')) {
                // dd("if");
                $data['catsWithChilds'] = Cache::remember(
                    "CategoryListingPage__CategoryList__{$siteid}",
                    21600,
                    function () use ($siteid) {
                        return Category::select(
                            'id',
                            'title',
                            'category_image'
                        )
                            ->CustomWhereBasedData($siteid)
                            ->whereNull('parent_id')
                            ->with('children')
                            ->withCount('categoryStores')
                            ->get()
                            ->toArray();
                    }
                );

            }else{
                // dd("else");
                $data['catsWithChilds'] = Cache::remember(
                    "CategoryListingPage__CategoryList__{$siteid}",
                    21600,
                    function () use ($siteid) {
                        return Category::select(
                            'id',
                            'title',
                            'category_image'
                        )
                            ->CustomWhereBasedData($siteid)
                            ->whereNull('parent_id')
                            ->with('children')
                            ->withCount('categoryStores')
                            ->take(12)
                            ->get()
                            ->toArray();
                    }
                );

            }

            

            foreach ($data['catsWithChilds'] as $category) :
                if ($category['category_stores_count']) $data['eligibleCategories']++;
            endforeach;

            $data['popularStores'] = Cache::remember(
                "CategoryListingPage__PopularStores__{$siteid}",
                21600,
                function () use ($siteid) {
                    return Store::select(
                        'id',
                        'name',
                        'store_image'
                    )
                        ->CustomWhereBasedData($siteid)
                        ->where('popular', 1)
                        ->take(10)
                        ->get()
                        ->toArray();
                }
            );

            $data['featuredStores'] = Cache::remember(
                "CategoryListingPage__FeaturedStores__{$siteid}",
                21600,
                function () use ($siteid) {
                    return Store::select(
                        'id',
                        'name',
                        'store_image'
                    )
                        ->CustomWhereBasedData($siteid)
                        ->where('featured', 1)
                        ->take(12)
                        ->get()
                        ->toArray();
                }
            );

            $data['popularCategories'] = Cache::remember(
                "CategoryListingPage__PopularCategories__{$siteid}",
                21600,
                function () use ($siteid) {
                    return Category::select(
                        'id',
                        'title',
                        'category_image'
                    )
                        ->CustomWhereBasedData($siteid)
                        ->whereNull('parent_id')
                        ->where('popular', 1)
                        ->withCount('categoryStores')
                        ->take(10)
                        ->get()
                        ->toArray();
                }
            );

            $page = Cache::remember(
                "CategoryListingPage__CurrentPage__{$siteid}",
                21600,
                function () use ($siteid) {
                    return Page::where(
                        'title',
                        'category-listing'
                    )
                        ->CustomWhereBasedDataForMetaInfo($siteid)
                        ->first();
                }
            );

            if (isset($page)) :
                $data['meta'] = [
                    'title' => $page->meta_title ?? '',
                    'description' => $page->meta_description ?? ''
                ];
            endif;

            $data['trendingBlog'] = Cache::remember(
                "CategoryListingPage__TrendingBlogs__{$siteid}",
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
                        ->CustomWhereBasedData($siteid)
                        ->where(function ($query) {
                            return $query
                                ->where('trending', 1)
                                ->orWhere('view', '>', 0);
                        })
                        ->orderBy('trending', 'desc')
                        ->take(4)
                        ->get()
                        ->toArray();
                }
            );


            $data['popularBlogs'] = Cache::remember(
                "CategoryListingPage__PopularBlogs__{$siteid}",
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
                        ->CustomWhereBasedData($siteid)
                        ->where('popular', 1)
                        ->orderBy('trending', 'desc')
                        ->take(10)
                        ->get()
                        ->toArray();
                }
            );

            //Cache::forget("ReviewListingPage__PopularReviews__{$siteid}");
            $data['popularReview'] = Cache::remember(
                "ReviewListingPage__PopularReviews__{$siteid}",
                3600,
                function () use ($siteid) {
                    return Review::select(
                        'id',
                        'title',
                        'review_image',
                        'created_at',
                        'user_id'
                    )
                    ->with('user:id,name')
                    ->with(['categories' => function ($query) {
                        $query
                            ->select(
                                'id',
                                'title',
                                'slug'
                            );
                    }])
                    ->where('reviews.popular',1)
                    ->CustomWhereBasedData($siteid)
                    ->orderBy('reviews.id', 'DESC')
                    ->take(6)
                    ->get()
                    ->toArray();
                }
            );
            //dd($data['popularReview']);
            return view('web.category.index')->with($data);
        } catch (\Exception $e) {
            dd($e);
            abort(404);
        }
    }

    public function detail()
    {
        try {
            $data = [];
            $data['pageCss'] = 'category-inner';
            $siteid = config('app.siteid');
            $pageid = PAGE_ID;
            $dt = Carbon::now();
            $date = $dt->toDateString();

            $data['detail'] = Cache::remember(
                "CategoryDetailPage__Detail__{$siteid}__{$pageid}",
                21600,
                function () use ($siteid, $pageid) {
                    return Category::select(
                        'id',
                        'title',
                        'meta_title',
                        'meta_description',
                        'long_description',
                        'category_banner_image'
                    )
                        ->with(['categoryStores' => function ($query) use ($siteid) {
                            $query
                                ->select(
                                    'id',
                                    'name',
                                    'store_image'
                                )
                                ->CustomWhereBasedData($siteid);
                        }])
                        ->CustomWhereBasedData($siteid)
                        ->with(['mostPopularStores' => function ($query) use ($siteid) {
                            $query->select(
                                'id',
                                'name',
                                'store_image'
                            )
                                ->with('slugs')
                                ->orderBy('id', 'ASC')
                                ->CustomWhereBasedData($siteid)
                                ->take(6);
                        }])
                        ->where('id', $pageid)
                        ->first();
                }
            );

            if ($data['detail'] == null) {
                abort(404);
            }

            $data['featuredCategories'] = Cache::remember(
                "CategoryDetailPage__FeaturedCategories__{$siteid}__{$pageid}",
                21600,
                function () use ($siteid, $pageid) {
                    return Category::select(
                        'id',
                        'title'
                    )
                        ->with('children')
                        ->CustomWhereBasedData($siteid)
                        ->where('id', $pageid)
                        ->first()
                        ->toArray();
                }
            );

            $data['featuredStoresFromCategory'] = Cache::remember(
                "CategoryDetailPage__FeaturedStores__{$siteid}__{$pageid}",
                21600,
                function () use ($siteid, $pageid, $date) {
                    return Category::select(
                        'id',
                        'title',
                        'meta_title',
                        'meta_description',
                        'long_description',
                        'category_banner_image'
                    )
                        ->with(['categoryStores' => function ($query) use ($siteid, $date) {
                            $query
                                ->select(
                                    'id',
                                    'name',
                                    'store_image'
                                )
                                ->where('featured', 1)
                                ->with(['storeCoupons' => function ($query) use ($siteid, $date) {
                                    $query
                                        ->where(function ($query) use ($date) {
                                            return $query
                                                ->where('date_expiry', '>=', $date)
                                                ->orWhere('on_going', 1);
                                        })
                                        ->CustomWhereBasedData($siteid);
                                }])
                                ->CustomWhereBasedData($siteid);
                        }])
                        ->CustomWhereBasedData($siteid)
                        ->where('id', $pageid)
                        ->first();
                }
            );

            $data['popularStoresFromCategory'] = Cache::remember(
                "CategoryDetailPage__PopularStores__{$siteid}__{$pageid}",
                21600,
                function () use ($siteid, $pageid) {
                    return Category::select(
                        'id',
                        'title',
                        'meta_title',
                        'meta_description',
                        'long_description',
                        'category_banner_image'
                    )
                        ->with(['categoryStores' => function ($query) use ($siteid) {
                            $query
                                ->select(
                                    'id',
                                    'name',
                                    'store_image'
                                )
                                ->where('popular', 1)
                                ->CustomWhereBasedData($siteid);
                        }])
                        ->CustomWhereBasedData($siteid)
                        ->where('id', $pageid)
                        ->first();
                }
            );
            
            $data['categoryStores'] = Cache::remember(
                "HomePage__CategoryStores__{$siteid}__{$pageid}",
                21600,
                function () use ($siteid, $pageid) {
                    return Category::select(
                        'id',
                        'title',
                        'meta_title',
                        'meta_description',
                        'long_description',
                        'category_banner_image'
                    )
                    ->with(['categoryStores' => function ($query) use ($siteid) {
                        $query
                            ->select(
                                'id',
                                'name',
                                'store_image'
                            )
                            ->CustomWhereBasedData($siteid);
                    }])
                    ->CustomWhereBasedData($siteid)
                    ->where('id', $pageid)
                    ->take(4)
                    ->get()
                    ->toArray();
                }
            );
           
            $data['popularStores'] = Cache::remember(
                "HomePage__PopularStores__{$siteid}",
                21600,
                function () use ($siteid) {
                    return Store::select(
                        'id',
                        'name',
                        'store_image'
                    )
                        ->CustomWhereBasedData($siteid)
                        ->where('popular', 1)
                        ->take(10)
                        ->get()
                        ->toArray();
                }
            );


            $data['trendingBlog'] = Cache::remember(
                "CategoryListingPage__TrendingBlogs__{$siteid}",
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
                        ->CustomWhereBasedData($siteid)
                        ->where(function ($query) {
                            return $query
                                ->where('trending', 1)
                                ->orWhere('view', '>', 0);
                        })
                        ->orderBy('trending', 'desc')
                        ->take(4)
                        ->get()
                        ->toArray();
                }
            );

            $data['popularBlogs'] = Cache::remember(
                "CategoryListingPage__PopularBlogs__{$siteid}",
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
                        ->CustomWhereBasedData($siteid)
                        ->where('popular', 1)
                        ->orderBy('trending', 'desc')
                        ->take(10)
                        ->get()
                        ->toArray();
                }
            );

            //Cache::forget("ReviewListingPage__PopularReviews__{$siteid}");
            $data['popularReview'] = Cache::remember(
                "ReviewListingPage__PopularReviews__{$siteid}",
                3600,
                function () use ($siteid) {
                    return Review::select(
                        'id',
                        'title',
                        'review_image',
                        'created_at',
                        'user_id'
                    )
                    ->with('user:id,name')
                    ->with(['categories' => function ($query) {
                        $query
                            ->select(
                                'id',
                                'title',
                                'slug'
                            );
                    }])
                    ->where('reviews.popular',1)
                    ->CustomWhereBasedData($siteid)
                    ->orderBy('reviews.id', 'DESC')
                    ->take(6)
                    ->get()
                    ->toArray();
                }
            );

            //Cache::forget("CategoryDetailPage__PopularProducts__{$siteid}");
            $data['popularProducts'] = Cache::remember(
                "CategoryDetailPage__PopularProducts__{$siteid}",
                21600,
                function () use ($siteid) {
                    return ProductCategory::select('id','name','slug','product_category_image')
                    ->CustomWhereBasedData($siteid)
                    ->where('popular', 1)
                    ->take(10)
                    ->get()
                    ->toArray();
                    
                }
            );
            //dd($data['popularProducts']);

            $metaTemplates = $this->getMetaTemplates($siteid);

            $data['headingOne'] = $this
                ->writeMetaFromTemplate(
                    $metaTemplates['category_page_title_template'],
                    $data['detail']['title'],
                    $metaTemplates['country_code'],
                    $metaTemplates['primary_keyword'],
                    $metaTemplates['secondary_keyword']
                );

            $data['meta'] = [
                'title' => $this
                    ->writeMetaFromTemplate(
                        $metaTemplates['category_meta_title_template'],
                        $data['detail']['title'],
                        $metaTemplates['country_code'],
                        $metaTemplates['primary_keyword'],
                        $metaTemplates['secondary_keyword']
                    ) ?? $data['detail']['meta_title'],
                'description' => $this
                    ->writeMetaFromTemplate(
                        $metaTemplates['category_meta_description_template'],
                        $data['detail']['title'],
                        $metaTemplates['country_code'],
                        $metaTemplates['primary_keyword'],
                        $metaTemplates['secondary_keyword']
                    ) ?? $data['detail']['meta_description']
            ];

            return view('web.category.detail')->with($data);
        } catch (\Exception $e) {
            dd($e->getMessage());
            abort(404);
        }
    }

    public function getCategoryName(Request $request)
    {
        try {
            $id = $request->cat_id;
            $cat_name = Category::where('id', $id)->first();
            if ($cat_name) {
                return $cat_name['slug'] . "/";
            } else {
                return false;
            }
        } catch (\Exception $e) {
            abort(404);
        }
    }
}
