<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\WebModel\Coupon;
use App\WebModel\Store;
use App\WebModel\Banner;
use App\WebModel\Site;
use App\Store as ASTORE;
use App\Category as ACategory;
use App\Blog as ABlog;
use App\Banner as ABanner;
use App\Blog;
use App\WebModel\WebsiteSetting;
use App\Traits\CouponCardTrait;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Jenssegers\Agent\Agent as Agent;

class HomeController extends Controller
{
    use CouponCardTrait;

    public function index()
    {
        $data = [];

        try {
            $agent = new Agent();

            if ($agent->isMobile()) {
                $limit['common'] = 6;
                $limit['banner'] = 3;
                $limit['categories'] = 5;
            } else {
                $limit['common'] = 6;
                $limit['banner'] = 4;
                $limit['categories'] = 10;
            }

            $siteid = config('app.siteid');
            $dt = Carbon::now();
            $lastWeek = Carbon::now()->subDays(7);
            $date = $dt->toDateString();
            $data['pageCss'] = 'home';

            $couponCardStyle = Cache::remember(
                "Sitewide__CouponCardStylePrimary__{$siteid}",
                86400,
                function () {
                    return WebsiteSetting::select('coupon_card_style_primary')
                        ->first()
                        ->toArray()['coupon_card_style_primary'];
                }
            );

            $data['banners'] = Cache::remember(
                "HomePage__Banners__{$siteid}",
                21600,
                function () use ($siteid) {
                    return Banner::select(
                        'id',
                        'title',
                        'button_text',
                        'link',
                        'banner_image'
                    )
                        ->CustomWhereBasedData($siteid)
                        ->orderBy('sort', 'asc')
                        ->get()
                        ->toArray();
                }
            );

            $data['trendingCoupons'] = Cache::remember(
                "HomePage__TrendingCoupons__{$siteid}__{$couponCardStyle}",
                21600,
                function () use ($date, $siteid, $couponCardStyle) {
                    return Coupon::select(
                        ...$this->getQueryColumns($couponCardStyle)
                    )
                        ->with('store.slugs')
                        ->with('store.categories')
                        ->where('popular', 1)
                        ->where('verified', 1)
                        ->where('publish', 1)
                        ->where(function ($q) use ($date) {
                            return $q
                                ->where('date_expiry', '>=', $date)
                                ->orWhere('on_going', 1);
                        })
                        ->orderBy('id', 'desc')
                        ->CustomWhereBasedData($siteid)
                        ->take(5)
                        ->get()
                        ->toArray();
                }
            );

            //Feature Coupons
            $data['topPopularCoupons'] = Cache::remember(
                "HomePage__TopPopularCoupons__{$siteid}__{$couponCardStyle}",
                21600,
                function () use ($date, $siteid, $couponCardStyle, $limit) {
                    return Coupon::select(
                        ...$this->getQueryColumns($couponCardStyle)
                    )
                        ->CustomWhereBasedData($siteid)
                        ->with('store.slugs')
                        ->where('featured', 1)
                        ->where(function ($q) use ($date) {
                            return $q
                                ->where('date_expiry', '>=', $date)
                                ->orWhere('on_going', 1);
                        })
                        ->orderBy('sort', 'asc')
                        ->limit($limit['common'])
                        ->get()
                        ->toArray();
                }
            );

            $data['recommendedCoupons'] = Cache::remember(
                "HomePage__RecommendedCoupons__{$siteid}__{$couponCardStyle}",
                21600,
                function () use ($date, $siteid, $couponCardStyle, $limit) {
                    return Coupon::select(
                        ...$this->getQueryColumns($couponCardStyle)
                    )
                        ->CustomWhereBasedData($siteid)
                        ->with('store.slugs')
                        ->where('recommended', 1)->where(function ($q) use ($date) {
                            return $q->where('date_expiry', '>=', $date)->orWhere('on_going', 1);
                        })
                        ->orderBy('sort', 'desc')
                        ->limit($limit['common'])
                        ->get()
                        ->toArray();
                }
            );

            $data['featuredStores'] = Cache::remember(
                "HomePage__FeaturedStores__{$siteid}",
                21600,
                function () use ($siteid) {
                    return Store::select(
                        'id',
                        'name',
                        'store_image'
                    )
                        ->CustomWhereBasedData($siteid)
                        ->where('featured', 1)
                        ->orderBy('name', 'asc')
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
                        'name'
                    )
                        ->CustomWhereBasedData($siteid)
                        ->where('popular', 1)
                        ->orderBy('id', 'desc')
                        ->limit(30)
                        ->get()
                        ->toArray();
                }
            );

            $data['totalCoupons'] = Cache::remember(
                "HomePage__TotalCouponCount__{$siteid}",
                21600,
                function () use ($date, $siteid) {
                    return Coupon::where(function ($q) use ($date) {
                        return $q
                            ->where('date_expiry', '>=', $date)
                            ->orWhere('on_going', 1);
                    })
                        ->CustomWhereBasedData($siteid)
                        ->get()
                        ->count();
                }
            );

            $data['topStores'] = Cache::remember(
                "HomePage__TopStores__{$siteid}",
                21600,
                function () use ($siteid) {
                    return Store::select(
                        'id',
                        'name'
                    )
                        ->CustomWhereBasedData($siteid)
                        ->where('popular', 1)
                        ->orderBy('id', 'desc')
                        ->take(15)
                        ->get()
                        ->toArray();
                }
            );

            $data['couponsAdded'] = Cache::remember(
                "HomePage__CouponsAddedCount__{$siteid}",
                21600,
                function () use ($lastWeek, $siteid) {
                    return Coupon::where('created_at', '>=', $lastWeek)
                        ->orwhere('updated_at', '>=', $lastWeek)
                        ->CustomWhereBasedData($siteid)
                        ->get()
                        ->count();
                }
            );

            return response()->view('web.home.index', $data);
        } catch (\Exception $e) {
            dd($e);
            abort(404);
        }
    }

    //
    public function stores()
    {
        $data = [];
        try{
            $data['pageCss'] = 'stores';
            return view('web.home.stores')->with($data)->withShortcodes();
        }catch (\Exception $e) {
            abort(404);
        }
    }

    public function categories()
    {
        $data = [];
        try{
            $data['pageCss'] = 'categories';
            return view('web.home.categories')->with($data);
        }catch (\Exception $e) {
            abort(404);
        }
    }

    public function blogs()
    {
        $data = [];
        try{
            $data['pageCss'] = 'blogs';
            return view('web.home.blogs')->with($data);
        }catch (\Exception $e) {
            abort(404);
        }
    }

    public function reviews()
    {
        $data = [];
        try{
            $data['pageCss'] = 'reviews';
            return view('web.home.reviews')->with($data);
        }catch (\Exception $e) {
            abort(404);
        }
    }
    //

    public function _404()
    {
        $data = [];
        try {
            $agent = new Agent();

            $siteid = config('app.siteid');
            $dt = Carbon::now();

            $data['pageCss'] = 'error';

            if ($agent->isMobile()) {
                $limit['common'] = 4;
                $limit['banner'] = 3;
                $limit['categories'] = 5;
            } else {
                $limit['common'] = 8;
                $limit['banner'] = 4;
                $limit['categories'] = 10;
            }
            $date = $dt->toDateString();

            $query = Coupon::select('id', 'store_id', 'description', 'title', 'date_expiry', 'on_going', 'viewed', 'code', 'featured', 'exclusive', 'verified', 'popular', 'affiliate_url', 'recommended', 'free_shipping')->CustomWhereBasedData($siteid);

            $query = $query->where(function ($q) {
                $q->orwhere('featured', 1)->orwhere('popular', 1)->orwhere('recommended', 1);
            });

            $data['topPopularCoupons'] = Coupon::select('id', 'title', 'description', 'date_expiry', 'on_going', 'viewed', 'code', 'featured', 'exclusive', 'verified', 'popular', 'affiliate_url', 'store_id', 'coupon_image', 'custom_image_title')
                ->CustomWhereBasedData($siteid)->with('store.slugs')
                ->where('featured', 1)->where(function ($q) use ($date) {
                    return $q->where('date_expiry', '>=', $date)->orWhere('on_going', 1);
                })->orderBy('sort', 'asc')->limit($limit['common'])->get()->toArray();

            return view('web.home.index')->with($data);
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function network_verify()
    {
        $data = [];
        try {
            $siteid = config('app.siteid');
            $site = Site::select('id', 'country_code')->where('id', $siteid)->first();

            if ($site->country_code === 'de') {
                $data = '';

                return view('web.home.network')->with($data);
            } else {
                abort(404);
            }
        } catch (\Exception $e) {

            abort(404);
        }
    }

    public function getStores(Request $request)
    {
        $limit = $request->limit ?? 1;
        $offset = $request->offset;
        $target = $request->target;

        if ($target == 'store') {
            $store = ASTORE::select('id', 'name')->limit($limit)->offset($offset)->get()->toArray();
            foreach ($store as $storeItem) :
                $path = [];
                $img = $storeItem['image'] ? $storeItem['image']['url'] : '';

                $imagePath = str_replace('https://.s3.amazonaws.com/', 'https://lmcstaging.s3.us-west-2.amazonaws.com/', $img);
                $imagePath = str_replace('http://localhost/', 'https://lmcstaging.s3.us-west-2.amazonaws.com/', $imagePath);
                $imagePath = str_replace('http://lmc-new.local/', 'https://lmcstaging.s3.us-west-2.amazonaws.com/', $imagePath);
                $imagePath = str_replace('//lmc.ssmdataserver.com/', 'https://lmcstaging.s3.us-west-2.amazonaws.com/', $imagePath);
                $imagePath = str_replace('', 'https://lmcstaging.s3.us-west-2.amazonaws.com/', $imagePath);
                // dd($imagePath);
                // dd($img);
                if (!empty($img)) {
                    $path['store_image'] = $imagePath;
                } else {
                    $path['store_image'] = Null;
                }


                ASTORE::where('id', $storeItem['id'])->update($path);
                echo 'Updated : ' . $storeItem['name'] . '<br>';
                echo 'path : ' . $path['store_image'] . '<br><br>';
            endforeach;
        }

        if ($target == 'category') {
            $store = ACategory::select('id', 'title')->limit($limit)->offset($offset)->get()->toArray();
            foreach ($store as $storeItem) :
                $path = [];
                $img = $storeItem['icon'] ? $storeItem['icon']['url'] : '';

                $imagePath = str_replace('https://.s3.amazonaws.com/', 'https://lmcstaging.s3.us-west-2.amazonaws.com/', $img);
                $imagePath = str_replace('http://localhost/', 'https://lmcstaging.s3.us-west-2.amazonaws.com/', $imagePath);
                $imagePath = str_replace('//lmc.ssmdataserver.com/', 'https://lmcstaging.s3.us-west-2.amazonaws.com/', $imagePath);
                $path['category_image'] = $imagePath;
                //dd($storeItem['id']);
                ACategory::where('id', $storeItem['id'])->update($path);
                echo 'Updated : ' . $storeItem['title'] . '<br>';
            endforeach;
        }

        if ($target == 'blog') {
            $store = Blog::select('id', 'title')->limit($limit)->offset($offset)->get()->toArray();
            foreach ($store as $storeItem) :
                $path = [];
                $img = $storeItem['image'] ? $storeItem['image']['url'] : '';

                $imagePath = str_replace('https://.s3.amazonaws.com/', 'https://lmcstaging.s3.us-west-2.amazonaws.com/', $img);
                $imagePath = str_replace('http://localhost/', 'https://lmcstaging.s3.us-west-2.amazonaws.com/', $imagePath);
                $imagePath = str_replace('//lmc.ssmdataserver.com/', 'https://lmcstaging.s3.us-west-2.amazonaws.com/', $imagePath);
                $path['blog_image'] = $imagePath;
                //dd($storeItem['id']);
                ABlog::where('id', $storeItem['id'])->update($path);
                echo 'Updated : ' . $storeItem['title'] . '<br>';
            endforeach;
        }

        if ($target == 'coupon') {
            $siteid = config('app.siteid');
            $region = config('app.Region');
            // dd($region, $siteid);
            $store = Coupon::select('id', 'title', 'description')->CustomWhereBasedData($siteid)->limit($limit)->offset($offset)->get()->toArray();
            // dd($store);
            foreach ($store as $storeItem) :
                $path = [];

                $desc_us = '<h3>Terms & Conditions</h3> <ul> <li>For full Terms & Conditions please see website.</li> <li>All brands reserve the right to remove any offer without giving prior notice.</li> <li>Cannot be used in conjunction with any other offer.</li> <li>Some Exclusions Apply.</li> </ul>';

                $desc_nl = '<h3>Voorwaarden</h3> <ul> <li>Voor de volledige voorwaarden zie website.</li> <li>Alle merken behouden zich het recht voor om aanbiedingen te verwijderen zonder voorafgaande kennisgeving.</li> <li>Kan niet worden gebruikt in combinatie met andere aanbiedingen.</li> <li>Enkele uitsluitingen zijn van toepassing.</li> </ul>';

                $desc_fr = '<h3>termes et conditions</h3> <ul> <li>Pour les termes et conditions complets, veuillez consulter le site Web.</li> <li>Toutes les marques se réservent le droit de supprimer toute offre sans préavis.</li> <li>Offre non cummulable.</li> <li>Certaines exclusions s\'appliquent.</li> </ul>';

                $desc_de = '<h3>Geschäftsbedingungen</h3> <ul> <li>Die vollständigen Geschäftsbedingungen finden Sie auf der Website.</li> <li>Alle Marken behalten sich das Recht vor, Angebote ohne Vorankündigung zu entfernen.</li> <li>Kann nicht in Verbindung mit anderen Angeboten verwendet werden.</li> <li>Es gelten einige Ausschlüsse.</li> </ul>';
                if ($region === 'us') {
                    $data_desc['description'] = $desc_us;
                }
                if ($region === 'nl') {
                    $data_desc['description'] = $desc_nl;
                }
                if ($region === 'fr') {

                    $data_desc['description'] = $desc_fr;
                }
                if ($region === 'de') {
                    $data_desc['description'] = $desc_de;
                }

                Coupon::where('id', $storeItem['id'])->update($data_desc);
                echo 'Updated : ' . $storeItem['title'] . '<br>';
            endforeach;
        }

        if ($target == 'banner') {
            $store = ABanner::select('id', 'title')->limit($limit)->offset($offset)->get()->toArray();
            foreach ($store as $storeItem) :
                $path = [];
                $img = $storeItem['image'] ? $storeItem['image']['url'] : '';

                $imagePath = str_replace('https://.s3.amazonaws.com/', 'https://lmcstaging.s3.us-west-2.amazonaws.com/', $img);
                $imagePath = str_replace('http://localhost/', 'https://lmcstaging.s3.us-west-2.amazonaws.com/', $imagePath);
                $imagePath = str_replace('http://lmc-new.local/', 'https://lmcstaging.s3.us-west-2.amazonaws.com/', $imagePath);
                $imagePath = str_replace('//lmc.ssmdataserver.com/', 'https://lmcstaging.s3.us-west-2.amazonaws.com/', $imagePath);
                $imagePath = str_replace('', 'https://lmcstaging.s3.us-west-2.amazonaws.com/', $imagePath);
                // dd($imagePath);
                // dd($img);
                if (!empty($img)) {
                    $path['banner_image'] = $imagePath;
                } else {
                    $path['banner_image'] = Null;
                }


                ABanner::where('id', $storeItem['id'])->update($path);
                echo 'Updated : ' . $storeItem['title'] . '<br>';
                echo 'path : ' . $path['banner_image'] . '<br><br>';
            endforeach;
        }
    }
}
