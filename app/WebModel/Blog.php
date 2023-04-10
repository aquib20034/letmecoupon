<?php

namespace App\WebModel;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Author;
use App\Tag;

class Blog extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'blogs';

    protected $primaryKey   = 'id';
    protected $slug_prefix  = 'blog/';
    protected $page_type    = 'blogs';


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
        'view',
        'sort',
        'slug',
        'title',
        'popular',
        'publish',
        'featured',
        'update_by',
        'meta_title',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
        'meta_keywords',
        'long_description',
        'meta_description',
        'short_description',
        'user_id',
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

    public function slugs() {
        return $this->hasOne(Slug::class, 'obj_id', $this->primaryKey)->where('table_name', $this->table);
    }

    public function sites()
    {
        return $this->belongsToMany(Site::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function store_details()
    {
        return $this->belongsToMany(Store::class);
    }
}
