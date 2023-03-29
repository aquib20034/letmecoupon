<?php

namespace App\WebModel;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Slug;

class Store extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'stores';

    protected $primaryKey = 'id';
    protected $slug_prefix = 'store/';
    protected $page_type = 'stores';


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

    const TEMPLATE_SELECT = [
        'template_1' => 'template 1',
        'template_2' => 'template 2',
        'template_3' => 'template 3',
    ];

    protected $fillable = [
        'faq',
        'name',
        'slug',
        'sort',
        'viewed',
        'popular',
        'new_url',
        'old_url',
        'publish',
        'template',
        'featured',
        'html_tags',
        'store_url',
        'updated_at',
        'created_at',
        'updated_by',
        'created_by',
        'meta_title',
        'deleted_at',
        'network_id',
        'scrap_store',
        'script_tags',
        'meta_keywords',
        'affiliate_url',
        'meta_description',
        'long_description',
        'short_description',
        'flashbanner',
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

    public function storeCoupons()
    {
        return $this->hasMany(Coupon::class, 'store_id', 'id');
    }

    public function storesAddspaceStores()
    {
        return $this->belongsToMany(AddspaceStore::class);
    }

    public function storeEvents()
    {
        return $this->belongsToMany(Event::class);
    }

    public function storeProducts()
    {
        return $this->belongsToMany(Product::class);
    }

    public function sites()
    {
        return $this->belongsToMany(Site::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function network()
    {
        return $this->belongsTo(Network::class, 'network_id');
    }

    public function getAllStores($siteid,$q = ''){
        $siteid = config('app.siteid');
		if($q != ''){
			if($q == '0-9'){
				return $this->where(function($q1) use ($siteid){
					$q1->where('name', 'LIKE', '0%')
					->orWhere('name', 'LIKE', '1%')
					->orWhere('name', 'LIKE', '2%')
					->orWhere('name', 'LIKE', '3%')
					->orWhere('name', 'LIKE', '4%')
					->orWhere('name', 'LIKE', '5%')
					->orWhere('name', 'LIKE', '6%')
					->orWhere('name', 'LIKE', '7%')
					->orWhere('name', 'LIKE', '8%')
					->orWhere('name', 'LIKE', '9%');
				})->CustomWhereBasedData($siteid)->orderBy('name', 'asc')->get()->toArray();
			}
			else{
				return $this
                ->CustomWhereBasedData($siteid)->where('name', 'LIKE', $q.'%')->orderBy('name', 'asc')->get()->toArray();
			}
		}
		else{
			return $this->CustomWhereBasedData($siteid)->orderBy('name', 'asc')->get()->toArray();
		}
	}

    public function getPopularStores($siteid){
        return $this->CustomWhereBasedData($siteid)->where('popular',1)->orderBy('id', 'desc')->take(18)->get()->toArray();
    }
}
