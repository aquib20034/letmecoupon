<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Site extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait, Auditable;

    public $table = 'sites';

    protected $appends = [
        'flag'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'url',
        'name',
        'publish',
        'country_name',
        'country_code',
        'language_code',
        'html_tags',
        'javascript_tags',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'country_flag',
        'about_image',
        'about_desc',
        'created_at',
        'updated_at',
        'deleted_at',
        'store_heading_one_suffix',
        'primary_keyword',
        'secondary_keyword',
        'store_meta_title_template',
        'store_meta_description_template',
        'category_page_title_template',
        'category_meta_title_template',
        'category_meta_description_template'
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function siteCategories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function siteStores()
    {
        return $this->belongsToMany(Store::class);
    }

    public function siteCoupons()
    {
        return $this->belongsToMany(Coupon::class);
    }

    public function sitePages()
    {
        return $this->belongsToMany(Page::class);
    }

    public function sitePresses()
    {
        return $this->belongsToMany(Press::class);
    }

    public function siteEvents()
    {
        return $this->belongsToMany(Event::class);
    }

    public function siteTags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function siteProductCategories()
    {
        return $this->belongsToMany(ProductCategory::class);
    }

    public function siteAddspaceStores()
    {
        return $this->belongsToMany(AddspaceStore::class);
    }

    public function siteAddSpaceProducts()
    {
        return $this->belongsToMany(AddSpaceProduct::class);
    }

    public function siteBanners()
    {
        return $this->belongsToMany(Banner::class);
    }

    public function siteNetworks()
    {
        return $this->belongsToMany(Network::class);
    }

    public function siteBlogs()
    {
        return $this->belongsToMany(Blog::class);
    }

    public function siteProducts()
    {
        return $this->belongsToMany(Product::class);
    }

    public function getFlagAttribute()
    {
        $file = $this->getMedia('flag')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;
    }

    public function getAboutImageAttribute()
    {
        $file = $this->getMedia('about_image')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;
    }

}
