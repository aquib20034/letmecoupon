<?php

namespace App\WebModel;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'sites';

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
        'javascript_tags',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'html_tags',
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
}
