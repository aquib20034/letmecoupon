<?php
use App\Http\Controllers\Web\Routes as Routes;
use App\Site as SITES;
use DB as DB;
use App\Coupon;
use App\Store;
use App\Category;
use App\Site;
use App\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent as Agent;

function clearCache() {
    \Artisan::call('config:clear');
    return true;
}


function checkCountryAndSetConfigs() {
    if (Schema::hasTable('sites')) {
        try {
            $segments = \Request::segments();
            $segments0 = $segments[0] ?? '';
            $default_site = SITES::where('id', 1)->first()->toArray();
            if ($segments0 == $default_site['country_code'] || $segments0 == '') {
                config(['app.route_prefix' => '']);
                $segments0 = $default_site['country_code'];
            } else {
                config(['app.route_prefix' => $segments0]);
            }

            if($segments0=='admin'){
                return true;
            }else{

                $siteid = 0;
                $reg=$default_site['country_code'];
                $get = SITES::where('country_code',config('app.route_prefix'))->first();

                if($get){
                    $siteid = $get['id'];
                    $reg = $get['country_code'];

                    config(['app.db_obj' => $get]);
                    if (file_exists(base_path('resources/lang/' .strtolower($reg) . '/sentence.php'))) {
                        $lang = strtolower($reg);
                    }else{
                        $lang = 'en';
                    }
                }else{

                    $get = $default_site;
                    $lang = $default_site['language_code'];
                    if($get) {
                        $siteid = $get['id'];
                        $reg = $get['country_code'];
                        config(['app.route_prefix'=>'']);

                        config(['app.db_obj' => $get]);
                    } else {
                        abort(404);
                    }

                }
                $regurl = config('app.route_prefix') ? '/'.config('app.route_prefix') : '';
                if (\App::environment('production')) {
                    config([
                        "app.siteid" => $siteid,
                        "app.Region" => $reg,
                        'app.namespace_name' => 'web',
                        'app.image_path' => str_replace( 'http://', 'https://', \URL::to('/') ),
                        'app.app_path' => str_replace( 'http://', 'https://', \URL::to('/').$regurl ),
                    ]);
                    \App::setLocale($lang);
                }else{
                    config([
                        "app.siteid" => $siteid,
                        "app.Region" => $reg,
                        'app.namespace_name' => 'web',
                        'app.image_path' => \URL::to('/') ,
                        'app.app_path' =>  \URL::to('/').$regurl ,
                    ]);
                }
                \App::setLocale($lang);
                clearCache();
                $routes = new Routes;
                $routes = $routes->find_route($segments[0] ?? '', $segments[1] ?? '', $segments[2] ?? '', $segments[3] ?? '');
                if(defined('ROUTE_NAME')){
                 config(['app.routename'=>ROUTE_NAME]);
                 }
                return true;

            }


        } catch (\Exception $e) {
            dd($e);
            abort(404);
        }
    }
}

function data_toArray_Web($data) {
    $data = json_encode($data);
    return json_decode($data, true);
}

function isJson($string) {
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
}

function get_string_between($string, $start, $end) {
    $string = " " . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) {
        return "";
    }

    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } else if (isset($_SERVER['HTTP_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    } else if (isset($_SERVER['REMOTE_ADDR'])) {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    } else {
        $ipaddress = 'UNKNOWN';
    }

    return $ipaddress;
}
function ip_details($IPaddress) {
    $json = file_get_contents("http://ipinfo.io/{$IPaddress}");
    $details = json_decode($json, true);
    return $details;
}
function getCouponRecord($coupon_id){
    try{
    // $coupon = \App\Coupon::select('id','title','date_expiry','code','description','store_id','custom_image_title','free_shipping')->with('store:id,name,store_url')->whereId($coupon_id)->wherePublish(1)->first();
    $coupon = \App\WebModel\Coupon::select('id','title','date_expiry','on_going','code','description','store_id','custom_image_title','free_shipping','coupon_image')->with('store:id,name,store_url,store_image')->whereId($coupon_id)->wherePublish(1)->first();
    $coupon = ($coupon) ? $coupon->toArray() : null;    
    return $coupon;
    }catch (\Exception $e) {
        // dd($e->getMessage());
       abort(404);
    }
}


function _404(){
    $data = [];
    try{
        $agent = new Agent();

        $siteid = config('app.siteid');
        $dt = Carbon::now();

        $data['pageCss'] = 'error';

        if($agent->isMobile()){
            $limit['common'] = 4;
            $limit['banner'] = 3;
            $limit['categories'] = 5;
        }else{
            $limit['common'] = 8;
            $limit['banner'] = 4;
            $limit['categories'] = 10;
        }
        $date = $dt->toDateString();

        $data['banners'] = Banner::select('id','title','link','banner_image')->CustomWhereBasedData($siteid)->orderBy('sort', 'asc')->get()->toArray();

        $query = Coupon::select('id','store_id','description','title','date_expiry','on_going','viewed','code','featured','exclusive','verified','popular','affiliate_url','recommended','free_shipping')->CustomWhereBasedData($siteid);

        $query = $query->where(function($q) {
            $q->orwhere('featured', 1)->orwhere('popular', 1)->orwhere('recommended', 1);
        });

        $data['featuredCoupons'] = Coupon::select('id','description','title','date_expiry','on_going','viewed','code','featured','exclusive','verified','popular','affiliate_url','store_id','free_shipping','recommended','coupon_image')
        ->CustomWhereBasedData($siteid)->with('store.slugs')
        ->where('featured',1)->where( function($q) use ($date) {
                        return $q->where('date_expiry', '>=', $date)->orWhere('on_going',1);
                    })->orderBy('sort', 'asc')->limit($limit['common'])->get()->toArray();

        $data['recommendedCoupons'] = Coupon::select('id','description','title','date_expiry','on_going','viewed','code','featured','exclusive','verified','popular','affiliate_url','store_id','free_shipping','recommended','coupon_image')
        ->CustomWhereBasedData($siteid)->with('store.slugs')
        ->where('recommended',1)->where( function($q) use ($date) {
                        return $q->where('date_expiry', '>=', $date)->orWhere('on_going',1);
                    })->orderBy('sort', 'asc')->limit($limit['common'])->get()->toArray();

        // return view('web.home.index')->with($data);
        return $data;
    }catch (\Exception $e) {
        // dd($e->getMessage());
        abort(404);
    }
}
function addhttps($url) {
    // if (\App::environment('production')) {
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "https://" . $url;
        }
    // }
    return $url;
}
function getNetworkName($affUrl){
    if(empty($affUrl)){
        return "";
    }
    $networkArr = [
        "Brand Reward" => "r.brandreward.com",
        "Commission Factory" => "//t.cfjump.com",
        "Daisycon" => "//lt45.net/c",
        "Optimise Media" => "track.omguk.com",
        "Paid on result" => "paidonresults.net",
        "Share a sale" => "shareasale.com",
        "TradeDoubler" => "tracker.tradedoubler.com",
        "Webgains" => "track.webgains.com",
        "Sovrn" => "//redirect.viglink.com",
        "Skimlinks" => "//go.skimresources.com",
        "Involveasia" => "//invol.co/aff_m?",
        "Ganet" => "//c.ga-net.com/click",
        "Admitad" => "//ad.admitad.com",
        "AliExpress" => "//best.aliexpress.com",
        "Duomai" => "//c.duomai.com",
        "NetAffilition" => "//action.metaffiliation.com",
        "Indoleads" => "//ir3.xyz",
        "Yieldkit" => "//r.secprf.com/v1/redirect",
        "Effiliation" => "//track.effiliation.com",
    ];
    foreach($networkArr as $key => $val){
        if(str_contains($affUrl,$val)){
            return $key;
        }
    } 
    return "";
}
?>
