<?php

namespace App\Console\Commands;

use App\WebModel\Coupon;
use App\WebModel\Store;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\RequestOptions;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use mattwright\URLResolver;

class CheckAffiliateUrls extends Command
{

    protected $signature = 'check_affiliate_urls';

    protected $description = 'get Affilaite Urls And dispatch jobs to check either its working or broken';

    public $specificURLs  = [ 'shareasale-analytics.com' ];

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $getStoresAffiliateUrls     =   Store::join('site_store','site_store.store_id','stores.id')
                                        ->join('sites','sites.id','site_store.site_id')
                                        ->select('stores.id','stores.name','store_url','affiliate_url','sites.country_code')
                                        ->where('affiliate_url_update',1)
                                        ->whereNotNull('affiliate_url')->where('affiliate_url','<>','')
                                        ->whereNull('stores.deleted_at')
                                        ->groupBy('affiliate_url')
                                        ->get()->toArray();

        $getCouponsAffiliateUrls    =   Coupon::join('stores','stores.id','coupons.store_id')
                                        ->join('site_store','site_store.store_id','stores.id')
                                        ->join('sites','sites.id','site_store.site_id')
                                        ->select('stores.store_url','coupons.affiliate_url','stores.id','sites.country_code','stores.name')
                                        ->where('stores.affiliate_url_update',1)
                                        ->whereNotNull('coupons.affiliate_url')->where('coupons.affiliate_url','<>','')
                                        ->whereNull('stores.deleted_at')
                                        ->groupBy('coupons.store_id','coupons.affiliate_url')->get()->toArray();

        if ( count($getStoresAffiliateUrls) > 0 && count($getCouponsAffiliateUrls) > 0 ) {
            foreach ($getCouponsAffiliateUrls as $key => $value) {
                foreach ($getStoresAffiliateUrls as $key2 => $val) {
                    if( $value['affiliate_url'] == $val['affiliate_url'] && $value['id'] == $val['id'] ){
                        unset($getCouponsAffiliateUrls[$key]);
                    }
                }
            }
        }

        $data   =   array_merge($getStoresAffiliateUrls,$getCouponsAffiliateUrls);

        // $data = Store::join('website_details','store_details.web_region_id','website_details.id')
        //                                 ->select('store_details.id','store_details.name','store_url','affiliate_url','website_details.country_code')
        //                                 ->where('affiliate_url','like','%https://www.linkbux.com/track/127bhnUW7_b1Q6v_aV8oGanu_bGpMd_ajuFa8cTue_biGKfIMiHT90eGz18kEedpAMlBK?url=https%3A%2F%2Ffr-store.acer.com%2F%')
        //                                 ->whereNotNull('affiliate_url')->where('affiliate_url','<>','')
        //                                 ->groupBy('affiliate_url')->get()->toArray();

        // $data =  Coupon::join('store_details','store_details.id','coupon_details.store_detail_id')
        //                                 ->join('website_details','store_details.web_region_id','website_details.id')
        //                                 ->select('store_details.store_url','coupon_details.affiliate_url','store_details.id','website_details.country_code','store_details.name')
        //                                 ->where('coupon_details.affiliate_url','like','%https://affiliate.flickstree.com/click?pid=95&offer_id=237%')
        //                                 ->whereNotNull('coupon_details.affiliate_url')->where('coupon_details.affiliate_url','<>','')
        //                                 ->whereNull('store_details.deleted_at')
        //                                 ->groupBy('coupon_details.affiliate_url')->get()->toArray();
        if ( count($data) > 0 ) {

            $emailsData = [];
            foreach ($data as $key => $value) {

                $finalDestinationURL  = $this->findLastDestination($value['affiliate_url']);
                $sanitizedFinalDestinationURL = $this->sanitizeURL($finalDestinationURL);
                $store_url = $value['store_url'];
                $finalStoreURL = $this->sanitizeURL($store_url);

                if ($finalDestinationURL == $value['affiliate_url']) {
                    if (Str::contains($finalDestinationURL,'accesstra.de')) {
                        $finalDestinationURL  = $this->isAccessTradeUrl($finalDestinationURL);
                        $sanitizedFinalDestinationURL = $this->sanitizeURL($finalDestinationURL);
                    } else if ( Str::contains($finalDestinationURL,'linkbux.com/track') ) {
                        $finalDestinationURL  = $this->isLinkbuxUrl($finalDestinationURL);
                        $sanitizedFinalDestinationURL = $this->sanitizeURL($finalDestinationURL);
                    } else if( Str::contains($finalDestinationURL,'xty.oviala.com') ){
                        $finalDestinationURL  = $this->isOvialaURL($finalDestinationURL);
                        $sanitizedFinalDestinationURL = $this->sanitizeURL($finalDestinationURL);
                    } else if ( Str::contains($finalDestinationURL,'linkhaitao.com') ) {
                        $finalDestinationURL  = $this->isLinkhaitoURL($finalDestinationURL);
                        $sanitizedFinalDestinationURL = $this->sanitizeURL($finalDestinationURL);
                    } else if ( Str::contains($finalDestinationURL,'alf.') ) {
                        $finalDestinationURL  = $this->isAlfURL($finalDestinationURL);
                        $sanitizedFinalDestinationURL = $this->sanitizeURL($finalDestinationURL);
                    } else if ( Str::contains($finalDestinationURL,'://mqs') ) {
                        $finalDestinationURL  = $this->isMqsURL($finalDestinationURL);
                        $sanitizedFinalDestinationURL = $this->sanitizeURL($finalDestinationURL);
                    } 
                } else if ( Str::contains($finalDestinationURL,'chinesean.com/affiliate') ) {
                    $finalDestinationURL  = $this->isChineseanURL($finalDestinationURL);
                    $sanitizedFinalDestinationURL = $this->sanitizeURL($finalDestinationURL);
                } else if ( Str::contains($value['affiliate_url'],'//t.adcell.com/p/click') ){
                    $finalDestinationURL  = $this->isAdcellURL($finalDestinationURL);
                    $sanitizedFinalDestinationURL = $this->sanitizeURL($finalDestinationURL);
                }

                if( $sanitizedFinalDestinationURL !=  $finalStoreURL && Str::contains($sanitizedFinalDestinationURL, $this->specificURLs) === false ){
                    $emailsData[$key]['store_id']       =   $value['id'];
                    $emailsData[$key]['store_name']     =   $value['name'];
                    $emailsData[$key]['store_url']      =   $value['store_url'];
                    $emailsData[$key]['affiliate_url']  =   $value['affiliate_url'];
                    $emailsData[$key]['region']         =   strtoupper($value['country_code']);
                    
                    echo $value['affiliate_url']."\n";
                    echo $this->sanitizeURL($value['affiliate_url'])."\n";
                    echo $finalDestinationURL."\n";
                    echo $sanitizedFinalDestinationURL."\n";
                    echo $store_url."\n";
                    echo $finalStoreURL."\n";
                    echo "\n";
                    echo "\n";
                }
            }
            if (count($emailsData) > 0) {

                Mail::to(
                    [
                        'ppc@8thloop.com'
                    ])
                ->cc(['umair.khan@8thloop.com','mubashir.akhtar@8thloop.com','murtaza@8thloop.com','ali@8thloop.com'])
                ->send(new \App\Mail\BrokenLinks($emailsData)); 
                echo "Email has been sent \n";
            }

            echo "Comamnd Execution completed \n";
        } else {
            echo "No Data found \n";
        }


    }


    private static function quickRandom($length = 16)
    {
        $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    private function findLastDestination($url, $name = "")
    {
        clearstatcache();
        $url = trim($url);
        try {
            if($this->is_redirect($url)) {
                if(config('app.is_local')) {
                    // echo "STORE URL BEFORE REDIRECT: $url \n";
                }
                $url = $this->loc_redirect($url, $name);
                if(config('app.is_local')) {
                    // echo "STORE URL AFTER REDIRECT: $url \n";
                }
                return $url;
            }
            return $url;
        } catch (RequestException $e) {
            return $url;
        } catch (\Exception $e) {
            return $url;
        }
    }

    private function is_redirect($url) 
    {
        clearstatcache();
        $opts = array(
                        'http' =>  array('max_redirects'=>1, 'ignore_errors'=>1) , 
                        "ssl"  =>  array("verify_peer" => false, "verify_peer_name" => false)  
                );
        stream_context_get_default($opts);
        $headers = get_headers($url,true);
        $opts = array(
                    'http' =>  array('max_redirects'=>20, 'ignore_errors'=>0) , 
                    "ssl"  =>  array("verify_peer" => false, "verify_peer_name"=>false) 
                );
        stream_context_get_default($opts);
        $status = $headers[0];
        list($protocol,$code,$message) = explode(' ', $status,3);
        return ($code>=300 && $code<400);
    }

    private function loc_redirect($url, $name = "") 
    {
        clearstatcache();
        if(!$name) $name = $this->quickRandom();
        $resolver = new URLResolver();
        $resolver->setUserAgent("Mozilla/5.0 (compatible; {$name}/1.0; +{$url})");
        $url_result = $resolver->resolveURL($url);
        if ($url_result->didErrorOccur()) {
            $stack = HandlerStack::create();
            $lastRequest = null;
            $stack->push(Middleware::mapRequest(function (\Psr\Http\Message\RequestInterface $request) use(&$lastRequest) {
                $lastRequest = $request;
                return $request;
            }));
            $client = new Client([
                'handler' => $stack,
                RequestOptions::ALLOW_REDIRECTS => true,
                'timeout' => 25,
                'connect_timeout' => 25
            ]);
            $request = new \GuzzleHttp\Psr7\Request('GET', $url);
            $client->send($request);
            return $lastRequest->getUri()->__toString();
        }
        return $url_result->getURL();
    }

    private function sanitizeURL($storeURL, $parseURL = "")
    {
        clearstatcache();
        $storeURL = strtok($storeURL, '?');
        if($parseURL) {
            $url = str_replace('/', '', trim(strtolower($parseURL)));
        } else {
            if($storeURL) {

                $storeURL = str_replace('https:///', 'https://', $storeURL);
                $storeURL = str_replace('http:///', 'http://', $storeURL);

                if($this->is_english($storeURL)) {
                    $storeURL = trim(strtolower($storeURL));
                    $urlparts = parse_url($storeURL);
                    if(isset($urlparts['path'])) {
                        $path = explode('/', $urlparts['path']);
                        if(count($path) > 0 && isset($urlparts['host'])){;
                            $urlpathlenght = strlen($path[1]);
                            if( ($urlpathlenght < 3) && ($urlpathlenght > 1) ){
                                $path  = ($urlpathlenght == 0) ? '' : '/'.$path[1];
                                $url = str_replace('www.', '', $urlparts['host']).$path;
                            }
                            elseif($urlpathlenght <= 5) {
                                if (str_contains($path[1], "-")) {
                                    $path2 = explode('-', $path[1]);
                                    if( (strlen($path2[0]) == 2) && (strlen($path2[1]) == 2) ){
                                        $url = str_replace('www.', '', $urlparts['host']).'/'.$path[1];
                                    } else {
                                        $url = str_replace('www.', '', $urlparts['host']);
                                    }
                                }
                                elseif (str_contains($path[1], "_")) {
                                    $path2 = explode('_', $path[1]);
                                    if( (strlen($path2[0]) == 2) && (strlen($path2[1]) == 2) ){
                                        $url = str_replace('www.', '', $urlparts['host']).'/'.$path[1];
                                    } else {
                                        $url = str_replace('www.', '', $urlparts['host']);
                                    }
                                } else {
                                    $url = str_replace('www.', '', $urlparts['host']);
                                }
                            }
                            else{
                                $url = str_replace('www.', '', $urlparts['host']);
                            }
                        }
                        else {
                            $url = str_replace(['www.'], '', $urlparts['path']);
                        }
                    }
                    else {
                        if (isset($urlparts['host'])) {
                            $url = str_replace(['www.', '/'], '', $urlparts['host']);
                        } else {
                            $url = $storeURL;
                        }
                    }
                }
                else {
                    $url = $storeURL;
                }
            }
            else {
                $url = $storeURL;
            }
        }

        $checkSubDirectory = explode('/',$url);

        if (count($checkSubDirectory) > 1) {
            $storeURL = $checkSubDirectory[0];
            $storeURL = rtrim($storeURL, "/");
        } else {
            $storeURL = rtrim($url, "/");
        }   

        $storeURL = utf8_encode($storeURL);
       
        return $storeURL;
    }

    private function is_english($str)
    {
        clearstatcache();
        if (strlen($str) != strlen(utf8_decode($str))) {
            return false;
        } else {
            return true;
        }
    }

    private function isAccessTradeUrl($url)
    {
        clearstatcache();
        $response = Http::get($url);
        $htmlDom = new \DOMDocument();
        libxml_use_internal_errors(true);
        @$htmlDom->loadHTML($response->body());
        $tags = $htmlDom->getElementsByTagName('meta'); 
        if( is_null($tags->item(0)) ){
            return $url;
        }
        $url = $tags->item((count($tags) - 1))->getAttribute('content');
        $finalUrl = $this->findLastDestination($url);
        return $finalUrl;
    } 

    private function isLinkbuxUrl($url)
    {
        clearstatcache();
        $response = Http::get($url);
        $htmlDom = new \DOMDocument();
        libxml_use_internal_errors(true);
        @$htmlDom->loadHTML($response->body());
        $tags = $htmlDom->getElementsByTagName('noscript');
        if( is_null($tags->item(0)) ){
            return $url;
        }
        $val = $tags->item(0)->getElementsByTagName('meta')->item(0)->getAttribute('content'); 
        $url = str_replace('0;url=','',$val);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_exec($ch);
        $redirectedUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        curl_close($ch);
        $finalUrl = $redirectedUrl;
        
        return $finalUrl;
    } 

    private function isOvialaURL($url) 
    {
        clearstatcache();
        $response = Http::get($url);
        $htmlDom = new \DOMDocument();
        libxml_use_internal_errors(true);
        @$htmlDom->loadHTML($response->body());
        $tags = $htmlDom->getElementsByTagName('meta'); 
        if( is_null($tags->item(0)) ){
            return $url;
        }
        $val = $tags->item(0)->getAttribute('content');
        $url = str_replace('0; url=','',$val);
        $finalUrl = $this->findLastDestination($url);
        return $finalUrl;
    }

    private function isLinkhaitoURL($url) 
    {
        clearstatcache();
        $response = Http::get($url);
        $htmlDom = new \DOMDocument();
        libxml_use_internal_errors(true);
        @$htmlDom->loadHTML($response->body());
        $tags = $htmlDom->getElementsByTagName('noscript');
        if( is_null($tags->item(0)) ){
            return $url;
        }
        $val = $tags->item(0)->getElementsByTagName('meta')->item(0)->getAttribute('content'); 
        $url = str_replace('0;url=','',$val);
        $finalUrl = $this->findLastDestination($url);
        return $finalUrl;
    }

    private function isChineseanURL($url) 
    {
        clearstatcache();
        $response = Http::get($url);
        $htmlDom = new \DOMDocument();
        libxml_use_internal_errors(true);
        @$htmlDom->loadHTML($response->body());
        $tags = $htmlDom->getElementsByTagName('noscript');
        if( is_null($tags->item(0)) ){
            return $url;
        }
        $val = $tags->item(0)->getElementsByTagName('meta')->item(0)->getAttribute('content'); 
        $url = str_replace('0;url=','',$val);
        $finalUrl = $this->findLastDestination($url);
        return $finalUrl;
    }

    private function isAlfURL($url) 
    {
        clearstatcache();
        $response = Http::get($url);
        $htmlDom = new \DOMDocument();
        libxml_use_internal_errors(true);
        @$htmlDom->loadHTML($response->body());
        $tags = $htmlDom->getElementsByTagName('meta'); 
        if( is_null($tags->item(0)) ){
            return $url;
        }
        $val = $tags->item(0)->getAttribute('content');
        $url = str_replace('0; url=','',$val);
        $finalUrl = $this->findLastDestination($url);
        return $finalUrl;
    }

    private function isMqsURL($url) 
    {
        clearstatcache();
        $response = Http::get($url);
        $htmlDom = new \DOMDocument();
        libxml_use_internal_errors(true);
        @$htmlDom->loadHTML($response->body());
        $tags = $htmlDom->getElementsByTagName('meta'); 
        if( is_null($tags->item(0)) ){
            return $url;
        }
        $val = $tags->item(0)->getAttribute('content');
        $url = str_replace('0; url=','',$val);
        $finalUrl = $this->findLastDestination($url);
        return $finalUrl;
    }
    private function isAdcellURL($url) 
    {
        clearstatcache();
        $response = Http::get($url);
        $htmlDom = new \DOMDocument();
        libxml_use_internal_errors(true);
        @$htmlDom->loadHTML($response->body());
        $tags = $htmlDom->getElementsByTagName('noscript');
        if( is_null($tags->item(0)) ){
            return $url;
        }
        $val = "https://t.adcell.com/".$tags->item(0)->getElementsByTagName('a')->item(0)->getAttribute('href'); 
        $finalUrl = $this->findLastDestination($val);
        return $finalUrl;
    }
}
