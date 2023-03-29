<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\WebModel\Store;
use App\WebModel\Blog;
use App\WebModel\Category;
use App\WebModel\Coupon;
use App\Traits\MetaWriterTrait;
use App\Http\Controllers\Controller;
use App\WebModel\Page;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class StoresController extends Controller
{
    use MetaWriterTrait;

    private $store_model = null;

    public function __construct()
    {
        $this->store_model = new Store();
    }
    public function index(Request $request)
    {
        try {
            $data = [];

            $data['pageCss'] = 'all-store';

            $siteid = config('app.siteid');

            if ($request->Input('q')) {
                $queryTerm = $request->Input('q');

                $data['list'] = Cache::remember(
                    "StoreListingPage__StoreList__{$siteid}__{$queryTerm}",
                    3600,
                    function () use ($siteid, $queryTerm) {
                        return $this
                            ->store_model
                            ->getAllStores($siteid, $queryTerm);
                    }
                );
            } else {
                $data['list'] = Cache::remember(
                    "StoreListingPage__StoreList__{$siteid}",
                    3600,
                    function () use ($siteid) {
                        return $this
                            ->store_model
                            ->getAllStores($siteid);
                    }
                );
            }

            $data['popular'] = Cache::remember(
                "StoreListingPage__PopularStores__{$siteid}",
                3600,
                function () use ($siteid) {
                    return $this
                        ->store_model
                        ->getPopularStores($siteid);
                }
            );

            $page = Cache::remember(
                "StoreListingPage__CurrentPage__{$siteid}",
                21600,
                function () use ($siteid) {
                    return Page::where('title', 'store-listing')
                        ->CustomWhereBasedDataForMetaInfo($siteid)
                        ->first();
                }
            );

            $data['meta'] = [
                'title' => $page->meta_title ?? '',
                'description' => $page->meta_description ?? ''
            ];

            return view('web.store.index')->with($data);
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function detail()
    {
        $data = [];
        try {
            $data['pageCss'] = 'store';

            $siteid = config('app.siteid');

            $dt = Carbon::now();

            $date = $dt->toDateString();

            $pageid = PAGE_ID;

            $data['detail'] = Cache::remember(
                "StoreDetailPage__StoreDetail__{$siteid}__{$pageid}__{$date}",
                3600,
                function () use ($siteid, $pageid, $date) {
                    return Store::with(
                        ['storeCoupons', 'storesAddspaceStores']
                    )
                        ->CustomWhereBasedData($siteid)
                        ->with(['storeCoupons' => function ($s) use ($date, $siteid) {
                            $s
                                ->where(function ($q) use ($date) {
                                    return $q
                                        ->where('date_expiry', '>=', $date)
                                        ->orWhere('on_going', 1);
                                })
                                ->orderBy('sort', 'ASC')
                                ->CustomWhereBasedData($siteid);
                        }])
                        ->with(
                            ['categories.categoryStores' => function ($related) use ($pageid) {
                                $related
                                    ->select('id', 'name')
                                    ->where('id', '!=', $pageid)
                                    ->with('slugs')
                                    ->take(14);
                            }]
                        )
                        ->with('categories')
                        ->CustomWhereBasedData($siteid)
                        ->where('id', $pageid)
                        ->first();
                }
            );

            if ($data['detail']) $data['detail'] = $data['detail']->toArray();
            else abort(404);

            $data['popularStores'] = Cache::remember(
                "StoreDetailPage__PopularStores__{$siteid}",
                21600,
                function () use ($siteid) {
                    return Store::select('id', 'name')
                        ->CustomWhereBasedData($siteid)
                        ->where('popular', 1)
                        ->orderBy('id', 'desc')
                        ->take(10)
                        ->get()
                        ->toArray();
                }
            );

            $data['featuredStores'] = Cache::remember(
                "StoreDetailPage__FeaturedStores__{$siteid}",
                21600,
                function () use ($siteid) {
                    return Store::select('id', 'name', 'store_image')
                        ->CustomWhereBasedData($siteid)
                        ->where('featured', 1)
                        ->take(12)
                        ->get()
                        ->toArray();
                }
            );

            $data['popularCategories'] = Cache::remember(
                "StoreDetailPage__PopularCategories__{$siteid}",
                21600,
                function () use ($siteid) {
                    return Category::select('id', 'title')
                        ->CustomWhereBasedData($siteid)
                        ->where('popular', 1)
                        ->get()
                        ->toArray();
                }
            );

            $metaTemplates = $this
                ->getMetaTemplates($siteid);

            $data['meta'] = [
                'title' => $this->writeMetaFromTemplate(
                    $metaTemplates['store_meta_title_template'],
                    $data['detail']['name'],
                    $metaTemplates['country_code'],
                    $metaTemplates['primary_keyword'],
                    $metaTemplates['secondary_keyword']
                )
                    ?? $data['detail']['meta_title'],
                'description' => $this->writeMetaFromTemplate(
                    $metaTemplates['store_meta_description_template'],
                    $data['detail']['name'],
                    $metaTemplates['country_code'],
                    $metaTemplates['primary_keyword'],
                    $metaTemplates['secondary_keyword']
                )
                    ?? $data['detail']['meta_description']
            ];

            return view('web.store.detail')->with($data);
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function search(Request $request)
    {
        $data = [];
        try {
            $_search_keyword = $request->search;
            $siteid = config('app.siteid');
            if (!empty($_search_keyword)) {
                $stores = Store::where('name', 'LIKE', '%' . $_search_keyword . '%')->CustomWhereBasedData($siteid)->limit(20)->get();
                if (count($stores) > 0) {
                    foreach ($stores as $k => $v) {
                        $data[$k]['name'] = html_entity_decode($v->name);
                        $data[$k]['url'] = config('app.app_path') . '/' . $v->slugs->slug;
                    }
                    return ($data);
                } else {
                    return $data;
                }
            } else {
                return 0;
            }
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function searchBlog(Request $request)
    {
        $data = [];
        try {
            $_search_keyword = $request->search;
            $siteid = config('app.siteid');
            $blogs = Blog::where('title', 'LIKE', '%' . $_search_keyword . '%')->CustomWhereBasedData($siteid)->get();

            if ($blogs) {
                foreach ($blogs as $k => $v) {
                    $data[$k]['title'] =  htmlentities($v->title);
                    $data[$k]['url'] = config('app.app_path') . '/' . $v['slugs']['slug'];
                }
                return ($data);
            } else {
                return 0;
            }
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function clickoutAPI(Request $request)
    {

        if (!isset($request->data_id)) return redirect('/404');

        $offerId = decrypt($request->data_id);
        $offer = Coupon::where('id', $offerId)->first();
        $callClickoutAPI = false;
        $affiliateUrl = '';

        if (!isset($offer) || !$offer) return redirect('/404');

        if (empty($offer->affiliate_url) && empty($offer->store->affiliate_url)) :
            $affiliateUrl = $offer->store->store_url;
        elseif (!empty($offer->affiliate_url)) :
            $affiliateUrl = $offer->affiliate_url;
            $callClickoutAPI = true;
        else :
            $affiliateUrl = $offer->store->affiliate_url;
            $callClickoutAPI = true;
        endif;

        $affiliateUrl = html_entity_decode($affiliateUrl);

        if (!$callClickoutAPI) return addhttps($affiliateUrl);

        try {
            $httpClient = new \GuzzleHttp\Client(['base_url' => 'https://api.wecantrack.com']);

            $clientResponse = $httpClient->request(
                'POST',
                'api/v1/clickout',
                [
                    'headers' => [
                        'Content-Type'  => 'application/json',
                        'X-API-Key'     => config("app.WECANTRACK_API_KEY", "ee51d6a5-2e41-47ea-9a9b-0d6d468bb573")
                        /**
                         * @todo Remove default API and add field to CMS to add API key dynamically
                         * @author Syed Mohammed Hassan <hassan@8thloop.com>
                         **/
                    ],
                    'json' => [
                        'affiliate_url'     =>  rawurlencode($affiliateUrl),
                        'clickout_url'      =>  !empty($_SERVER['HTTP_REFERER']) ? rawurlencode($_SERVER['HTTP_REFERER']) : null,
                        '_ga'               =>  !empty($_COOKIE['_ga']) ? $_COOKIE['_ga'] : null,
                        '_wctrck'           =>  !empty($_COOKIE['_wctrck']) ? $_COOKIE['_wctrck'] : null
                    ],
                    'timeout' => 2
                ]
            );

            $clientResponse = json_decode($clientResponse->getBody()->getContents(), true);

            if (isset($clientResponse['error']) && !empty($clientResponse['error'])) :
                throw new \Exception($clientResponse['error']);
            endif;

            if ($clientResponse['affiliate_url']) :
                return addhttps(rawurldecode($clientResponse['affiliate_url']));
            endif;

            return addhttps($affiliateUrl);
        } catch (\Exception $ERROR) {
            throw new \Exception($ERROR->getMessage());
        }
    }
}
