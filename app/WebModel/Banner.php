<?php

namespace App\WebModel;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'banners';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'button_text',
        'link',
        'sort',
        'title',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function scopeCustomWhereBasedData($query,$siteid=null) {
		return $query
			->with('sites')
            ->whereHas('sites', function($q) use ($siteid){
            $q->where('site_id',$siteid);
            });
	}

    public function sites()
    {
        return $this->belongsToMany(Site::class);
    }
}
