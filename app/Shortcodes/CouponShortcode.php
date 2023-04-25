<?php

namespace App\Shortcodes;

use App\Coupon;

class CouponShortcode {

  public function register($shortcode, $content, $compiler, $name, $viewData)
  {
    $data = [];
    $style = ($shortcode->style)?$shortcode->style:'style2';
    $coupons = ($shortcode->coupons)?explode(",",$shortcode->coupons):'';
    $coupons_data = Coupon::with('sites')->whereIn('id',$coupons);
    if(sizeof($coupons) > 1){
      $data['coupons'] = $coupons_data->get();
      return view('components.web.coupon.full.'.$style,$data);     
    }else{
      $data['coupon'] = $coupons_data->first();
      return view('components.web.coupon.minimal.'.$style,$data);
    }
  }
}