<?php

namespace App\Http\Controllers\Web;

use App\WebModel\Category;
use App\WebModel\Store;
use App\Http\Controllers\Controller;
use App\WebModel\Site;
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

            foreach ($data['catsWithChilds'] as $category) :
                if ($category['category_stores_count']) $data['eligibleCategories']++;
            endforeach;

            $data['popularStores'] = Cache::remember(
                "CategoryListingPage__PopularStores__{$siteid}",
                21600,
                function () use ($siteid) {
                    return Store::select(
                        'id',
                        'name'
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
                        'title'
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
            $data['pageCss'] = 'categories-inner';
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
