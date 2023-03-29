<?php

namespace App\WebModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebsiteSetting extends Model
{

    public $table = 'website_settings';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'site_javascript',
        'site_html_tags',
        'primary_color',
        'secondary_color',
        'tertiary_color',
        'coupon_card_style_primary',
        'coupon_card_style_secondary',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


}
