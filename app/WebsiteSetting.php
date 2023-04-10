<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class WebsiteSetting extends Model implements HasMedia
{
    use HasMediaTrait;

    public $table = 'website_settings';

    protected $appends = [
        'logo',
        'favicon',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'site_javascript',
        'site_html_tags',
        'site_logo',
        'site_favicon',
        'twitter',
        'linked_in',
        'facebook',
        'youtube',
        'instagram',
        'pinterest',
        'created_at',
        'updated_at',
        'deleted_at',
        'primary_color',
        'secondary_color',
        'tertiary_color',
        'categories_popular',
        'stores_popular',
        'stores_related',
        'coupons_active',
        'coupons_expired',
        'coupons_full',
        'coupons_minimal',
        'blogs_trending',
        'blogs_popular',
        'blogs_recent',
        'reviews_trending',
        'reviews_popular',
        'reviews_recent',
        'coupon_card_style_primary',
        'coupon_card_style_secondary'
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }


    public function getLogoAttribute()
    {
        $file = $this->getMedia('logo')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;
    }

    public function getFaviconAttribute()
    {
        $file = $this->getMedia('favicon')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;
    }

}
