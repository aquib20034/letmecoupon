<?php
namespace App\Http\Controllers\Web;
use Illuminate\Http\Request;
use App\WebModel\Slug;
use App\WebModel\Page;
use App\WebModel\Coupon;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;
use App\WebModel\Site;

class PagesController extends Controller
{
    public function detail(){
        $data = [];
        try{
            $id = 1; // about-us
            $data['pageCss'] = 'about-us';
            $siteid = config('app.siteid');
            
            // $data['pageRecord']     = Page::whereId(PAGE_ID)->CustomWhereBasedData($siteid)->first();
            $data['pageRecord']     = Page::whereId($id)->CustomWhereBasedData($siteid)->first();
            if($data['pageRecord']){ 
                $data['pageRecord'] = $data['pageRecord']->toArray(); 
            }else{ 
                abort(404);
            }    
            $meta['title']          = $data['pageRecord']['meta_title'];
            $meta['description']    = $data['pageRecord']['meta_description'];
            $data['meta']           = $meta;
            return view('web.pages.about-us')->with($data);
        }catch (\Exception $e) {
            abort(404);
        }
    }

    public function advertiseWithUs(){
    	$data = [];
        try{
            $id = 12; // Adversite
            $data['pageCss'] = 'advertise-with-us';
            $siteid = config('app.siteid');
            
            // $data['pageRecord']     = Page::whereId(PAGE_ID)->CustomWhereBasedData($siteid)->first();
            $data['pageRecord']     = Page::whereId($id)->CustomWhereBasedData($siteid)->first();
            if($data['pageRecord']){ 
                $data['pageRecord'] = $data['pageRecord']->toArray(); 
            }else{ 
                abort(404);
            }    
            $meta['title']          = $data['pageRecord']['meta_title'];
            $meta['description']    = $data['pageRecord']['meta_description'];
            $data['meta']           = $meta;
            return view('web.pages.advertise-with-us')->with($data);
        }catch (\Exception $e) {
            abort(404);
        }
    }

    public function privacyPolicy(){
    	$data = [];
        try{
            $id = 11; // privacy-policy
            $data['pageCss'] = 'privacy-policy';
            $siteid = config('app.siteid');
            
            // $data['pageRecord']     = Page::whereId(PAGE_ID)->CustomWhereBasedData($siteid)->first();
            $data['pageRecord']     = Page::whereId($id)->CustomWhereBasedData($siteid)->first();
            if($data['pageRecord']){ 
                $data['pageRecord'] = $data['pageRecord']->toArray(); 
            }else{ 
                abort(404);
            }    
            $meta['title']          = $data['pageRecord']['meta_title'];
            $meta['description']    = $data['pageRecord']['meta_description'];
            $data['meta']           = $meta;
            return view('web.pages.privacy-policy')->with($data);
        }catch (\Exception $e) {
            abort(404);
        }
    }

    public function contactUs(){
    	$data = [];
        try{
            $id = 12; // contact-us
            $data['pageCss'] = 'contact-us';
            $siteid = config('app.siteid');
            
            // $data['pageRecord']     = Page::whereId(PAGE_ID)->CustomWhereBasedData($siteid)->first();
            $data['pageRecord']     = Page::whereId($id)->CustomWhereBasedData($siteid)->first();
            if($data['pageRecord']){ 
                $data['pageRecord'] = $data['pageRecord']->toArray(); 
            }else{ 
                abort(404);
            }    
            $meta['title']          = $data['pageRecord']['meta_title'];
            $meta['description']    = $data['pageRecord']['meta_description'];
            $data['meta']           = $meta;
            return view('web.pages.contact-us')->with($data);
        }catch (\Exception $e) {
            abort(404);
        }
    }
}
