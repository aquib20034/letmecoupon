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
            $data['pageCss'] = 'content-pages';
            $siteid = config('app.siteid');
            $data['pageRecord'] = Page::whereId(PAGE_ID)->CustomWhereBasedData($siteid)->first();
            if($data['pageRecord']) $data['pageRecord']=$data['pageRecord']->toArray(); else abort(404);
            $meta['title']=$data['pageRecord']['meta_title'];
            $meta['description']=$data['pageRecord']['meta_description'];
            $data['meta']=$meta;
            return view('web.pages.index')->with($data);
        }catch (\Exception $e) {
            abort(404);
        }
    }
}
