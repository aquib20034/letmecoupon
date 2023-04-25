<?php

namespace App\WebModel;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'categories';
    protected $primaryKey   = 'id';
    protected $slug_prefix  = 'categories/';
    protected $page_type    = 'categories';

    public function getBasicData()
    {
        $ret_arr = array();
        $ret_arr['table_name']  = $this->table;
        $ret_arr['primary_key'] = $this->primaryKey;
        $ret_arr['page_type']   = $this->page_type;
        $ret_arr['slug_prefix'] = $this->slug_prefix;
        return $ret_arr;
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'sort',
        'slug',
        'title',
        'user_id',
        'popular',
        'publish',
        'featured',
        'parent_id',
        'update_by',
        'updated_at',
        'created_at',
        'created_by',
        'meta_title',
        'deleted_at',
        'meta_keywords',
        'meta_description',
        'long_description',
        'short_description',
        'category_image',
        'category_banner_image',
        'category_coupon_image'
    ];
    public function scopeCustomWhereBasedData($query,$siteid=null) {
		return $query
			->where('publish', 1)
			->has('slugs')
			//->with(['slugs','sites'])
            ->with(['slugs' => function($slugQuery){
                $slugQuery->select(['id','obj_id','slug','old_slug']);
            }])->with(['sites' => function($siteQuery){
                $siteQuery->select(['id','name']);
            }])
            ->whereHas('sites', function($q) use ($siteid){
            $q->where('site_id',$siteid);
            });
	}
    public function blogs()
    {
        return $this->belongsToMany(Blog::class);
    }
    public function reviews()
    {
        //return $this->belongsToMany(Review::class);
        return $this->belongsToMany(Review::class, 'review_category', 'category_id', 'review_id');
    }

    public function slugs() {
		return $this->hasOne(Slug::class, 'obj_id', $this->primaryKey)->where('table_name', $this->table);
	}

    public function parentCategories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function categoryBlogs()
    {
        return $this->belongsToMany(Blog::class);
    }

    public function categoryReviews()
    {
        return $this->belongsToMany(Review::class);
    }

    public function categoryCoupons()
    {
        return $this->belongsToMany(Coupon::class);
    }

    public function categoryEvents()
    {
        return $this->belongsToMany(Event::class);
    }

    public function categoryStores()
    {
        return $this->belongsToMany(Store::class);
    }

    public function mostPopularStores()
    {
        return $this->belongsToMany(Store::class);
    }

    public function sites()
    {
        return $this->belongsToMany(Site::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function children(){
        return $this->hasMany(self::class, 'parent_id','id');
    }
}
