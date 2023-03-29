<?php

namespace App\Traits;

trait CouponCardTrait
{
  public function getQueryColumns($VARIATION_NAME)
  {
    $query_fields = ['id', 'title'];

    switch ($VARIATION_NAME):
      case "style-1":
        $query_fields = [
          'id',
          'title',
          'description',
          'date_expiry',
          'on_going',
          'viewed',
          'code',
          'featured',
          'exclusive',
          'verified',
          'popular',
          'affiliate_url',
          'store_id'
        ];

      case "style-2":
        $query_fields = [
          'id',
          'title',
          'description',
          'date_expiry',
          'on_going',
          'viewed',
          'code',
          'featured',
          'exclusive',
          'verified',
          'popular',
          'affiliate_url',
          'store_id'
        ];

      case "style-3":
        $query_fields = [
          'id',
          'title',
          'description',
          'date_expiry',
          'on_going',
          'viewed',
          'code',
          'featured',
          'exclusive',
          'verified',
          'popular',
          'affiliate_url',
          'store_id'
        ];

      case "style-4":
        $query_fields = [
          'id',
          'title',
          'description',
          'date_expiry',
          'on_going',
          'viewed',
          'code',
          'featured',
          'exclusive',
          'verified',
          'popular',
          'affiliate_url',
          'store_id'
        ];

      case "style-5":
        $query_fields = [
          'id',
          'title',
          'description',
          'date_expiry',
          'on_going',
          'viewed',
          'code',
          'featured',
          'exclusive',
          'verified',
          'popular',
          'affiliate_url',
          'store_id'
        ];

      default:
        break;
    endswitch;

    return $query_fields;
  }
}
