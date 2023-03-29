<?php
namespace App\Http\Controllers\Web;
use Illuminate\Http\Request;
use App\WebModel\Coupon;
use App\WebModel\Site;
use App\WebModel\Event;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
class CouponController extends Controller {
//  public function index() {
//    $data = [];
//    try{
//      $siteid = config('app.siteid');
//      $data['detail'] = Event::with('categories')->with('stores')->with('coupons')->with(['sites'=> function($q) use ($siteid) {
//      $q->where('site_id',$siteid);
//      } ])->where('publish',1)->get()->toArray();
//      return view('web.coupon.index')->with($data);
//    }catch (\Exception $e) {
//			abort(404);
//    }
//
//  }

  public function updateCouponViews(Request $request){
    $id = decrypt($request->data_id);
    $info = Coupon::where('id',$id)->first();
        if($info){
             $views = $info->viewed+1;
            $a = Coupon::where('id',$id)->update(['viewed' => $views]);
        }
  }

}
