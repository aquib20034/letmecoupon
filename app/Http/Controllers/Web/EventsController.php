<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\WebModel\Coupon;
use App\WebModel\Site;
use App\WebModel\Event;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;
use App\WebModel\WebsiteSetting;
use Carbon\Carbon;
use App\WebModel\Category;
use Illuminate\Support\Facades\Cache;

class EventsController extends Controller
{
    public function detail()
    {
        $data = [];
        try {
            $siteid = config('app.siteid');
            $data['pageCss'] = 'store-inner';
            $dt = Carbon::now();
            $date = $dt->toDateString();
            $pageid = PAGE_ID;

            $data['detail'] = Cache::remember(
                "EventDetailPage__EventDetail__{$siteid}__{$pageid}",
                21600,
                function () use ($pageid, $siteid, $date) {
                    return Event::select(
                        'id',
                        'title',
                        'short_description',
                        'long_description',
                        'meta_title',
                        'meta_description',
                        'event_image'
                    )
                        ->with('categories')
                        ->with('stores')
                        ->with(['coupons' => function ($query) use ($date) {
                            $query
                                ->select([
                                    'id',
                                    'title',
                                    'store_id',
                                    'description',
                                    'affiliate_url',
                                    'custom_image_title',
                                    'verified',
                                    'sort',
                                    'on_going',
                                    'date_expiry',
                                    'on_going',
                                    'code',
                                    'viewed',
                                    'free_shipping',
                                    'exclusive',
                                    'coupon_image'
                                ])
                                ->with('store.slugs')
                                ->where(function ($query) use ($date) {
                                    return $query
                                        ->where('date_expiry', '>=', $date)
                                        ->orWhere('on_going', 1);
                                })
                                ->wherePublish(1);
                        }])
                        ->CustomWhereBasedData($siteid)
                        ->where('id', $pageid)
                        ->first();
                }
            );
            //dd($data['detail']);    
            $data['categoryLists'] = Cache::remember(
                "EventDetailPage__CategoryLists__{$siteid}",
                21600,
                function () use ($siteid) {
                    return Category::select(
                            'id',
                            'title',
                        )
                        ->CustomWhereBasedData($siteid)
                        ->take(3)
                        ->get()
                        ->toArray();
                }
            );

            if ($data['detail']) $data['detail'] = $data['detail']->toArray();
            else abort(404);

            $data['meta'] = [
                'title' => $data['detail']['meta_title'],
                'description' => $data['detail']['meta_description']
            ];

            return view(
                'web.event.detail'
            )
                ->with($data);
        } catch (\Exception $e) {
            abort(404);
        }
    }
}
