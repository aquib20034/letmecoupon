<?php

namespace App\WebModel;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Slug;

class Page extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'pages';

    protected $primaryKey = 'id';
    protected $slug_prefix = 'page/';
    protected $page_type = 'pages';


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
        'slug',
        'title',
        'publish',
        'top',
        'bottom',
        'meta_title',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
        'meta_keywords',
        'meta_description',
    ];
    public function scopeCustomWhereBasedData($query,$siteid=null) {
		return $query
			->wherePublish(1)
			->has('slugs')
			->with(['slugs','sites'])
            ->whereHas('sites', function($q) use ($siteid){
            $q->where('site_id',$siteid);
            });
	}

    public function scopeCustomWhereBasedDataForMetaInfo($query,$siteid=null) {
        return $query
            ->has('slugs')
            ->with(['slugs','sites'])
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
}
