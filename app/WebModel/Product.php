<?php

namespace App\WebModel;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, Auditable;

    public $table = 'products';

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'sort',
        'date',
        'best',
        'code',
        'price',
        'title',
        'rating',
        'latest',
        'viewed',
        'popular',
        'publish',
        'featured',
        'updated_at',
        'created_at',
        'deleted_at',
        'home_featured',
        'affiliate_url',
        'discount_price',
        'discount_percent',
        'long_description',
        'short_description',
        'custom_image_title'
    ];
    public function scopeCustomWhereBasedData($query,$siteid=null) {
		return $query
			->where('publish', 1)
			->with('sites')
            ->whereHas('sites', function($q) use ($siteid){
            $q->where('site_id',$siteid);
            });
	}

    public function sites()
    {
        return $this->belongsToMany(Site::class);
    }

    public function product_categories()
    {
        return $this->belongsToMany(ProductCategory::class);
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class);
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
