<?php
namespace App\Http\Controllers\Web;
use Illuminate\Http\Request;
use App\WebModel\Category;
use App\WebModel\Page;
use App\SiteSetting;
use App\WebModel\ProductCategory;
use App\product;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;
use App\WebModel\Site;
use Cache;
class Product_categoriesController extends Controller {
  public function __construct() {
  }
    public function index() {
        $data = [];
        try{
            $siteid = config('app.siteid');
            $data['detail'] = ProductCategory::select('id','name','slug','product_category_image')->CustomWhereBasedData($siteid)->get()->toArray();
            return view('web.product.index')->with($data);
        }catch (\Exception $e) {
            abort(404);
        }

    }
    public function detail(Request $request) {
        $data = [];
        try{
            $siteid = config('app.siteid');
            $data['categoryProducts'] = ProductCategory::where('id',PAGE_ID)->with( 'productAddSpaceProducts')->CustomWhereBasedData($siteid)->first();
            if($data['categoryProducts'] == null){
                abort(404);
            }
            $meta['title']=$data['categoryProducts']['meta_title'];
            $meta['description']=$data['categoryProducts']['meta_description'];
            $data['meta']=$meta;
            return view('web.product.detail')->with($data);
        }catch (\Exception $e) {
            abort(404);
        }

    }
}
