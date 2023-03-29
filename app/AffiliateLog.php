<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class AffiliateLog extends Model
{
    public $table = 'affiliate_url_logs';

    protected $fillable = [
        'network_name',
        'store_id',
        'coupon_id',
        'region',
        'website',
        'previous_aff_url',
        'new_aff_url',
        'action',
        'source',
        'created_by',
    ];


    public function websites()
    {
        return $this->belongsTo(Site::class, 'website');
    }

    public function store()
    {
        return $this->belongsTo(Store::class , 'store_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class , 'coupon_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class , 'created_by');
    }
}
