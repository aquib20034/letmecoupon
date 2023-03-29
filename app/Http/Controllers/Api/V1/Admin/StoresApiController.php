<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Http\Resources\Admin\StoreResource;
use App\Store;
use App\Coupon;
use App\Slug;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StoresApiController extends Controller
{
    public $slug = null;

    public function __construct()
    {
        $this->slug = new Slug;
    }

    use MediaUploadingTrait;

    public $table           = 'stores';
    protected $primaryKey   = 'id';
    protected $slug_prefix  = '';
    protected $page_type    = 'stores';

    public function index()
    {
        abort_if(Gate::denies('store_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StoreResource(Store::with(['sites', 'categories', 'network'])->get());
    }

    public function store(StoreStoreRequest $request)
    {
        $store = Store::create($request->all());
        $store->sites()->sync($request->input('sites', []));
        $store->categories()->sync($request->input('categories', []));

        $last_id    = $store->id;
        $slug       = $store->slug;

        $return = $this->slug->insertSlug($last_id, $this->slug_prefix . $slug, $this->table, $request->input('sites', []));

        if (isset($return['status']) && $return['status'] === false) {
            return $return;
        }


        if ($request->input('image', false)) {
            $store->addMediaFromUrl($request->input('image'))->toMediaCollection('image');
        }

        return (new StoreResource($store))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function bulkStoreCreate(Request $request)
    {
        if (!isset($request['stores'])) return [
            "success"   => false,
            "message"   => "Invalid input"
        ];

        if (!sizeof($request['stores'])) return [
            "success"   => false,
            "message"   => "No Stores in request"
        ];

        if (sizeof($request['stores']) > 10) return [
            "success"   => false,
            "message"   => "Too many Stores in request, limit to 10 per batch."
        ];

        $required_keys = [
            "_id",
            "coupons",
            "meta_title",
            "meta_description",
            "name",
            "slug",
            "store_url",
            "store_logo",
        ];

        $responses = [];

        foreach ($request['stores'] as $store) :

            if (!isset($store['_id'])) continue;

            foreach ($required_keys as $required_key) :

                if (!isset($store[$required_key])) :
                    $responses[$store['_id']] = [
                        "success" => false,
                        "message" => "missingKey(s)",
                    ];

                    $response[$store['_id']]['missingKeys'] = $response[$store['_id']]['missingKeys'] ?? [];

                    $response[$store['_id']]['missingKeys'][] = $required_key;

                endif;

            endforeach;

            if (isset($responses[$store['_id']])) continue;

            $responses[$store['_id']] = [];

            $store_entry = Store::create(
                [
                    "name"              => $store["name"],
                    "slug"              => $store["slug"],
                    "publish"           => 1, // hardcoded publish as 1 so this store is published by default
                    "store_url"         => $store["store_url"],
                    "meta_title"        => $store["meta_title"],
                    "scrap_store"       => 1, // hardcoded scrap_store as 1 as this store is received from scrapping
                    "store_image"       => $store["store_logo"],
                    "meta_description"  => $store["meta_description"],
                    "long_description"  => $store["long_description"] ?? "",
                    "short_description" => $store["short_description"] ?? ""
                ]
            );

            $store_entry->sites()->sync([1]);

            $slug = $store_entry->slug;

            $slug_entry = $this
                ->slug
                ->insertSlug(
                    $store_entry->id,
                    $this->slug_prefix . $slug,
                    $this->table,
                    [1] // hardcoded site ID as 1, data entry has been guided to only keep sites that have an ID of 1 as published
                );

            if (!isset($slug_entry['status']) || $slug_entry['status'] === false) :
                $responses[$store['_id']]['success']    = false;
                $responses[$store['_id']]['response']   = $slug_entry;

                continue;
            endif;

            $responses[$store['_id']]['offers_added'] = [];

            foreach ($store['coupons'] as $offer) :
                $offer_entry = Coupon::create(
                    [
                        "title"         => $offer["title"],
                        "publish"       => 1, // hardcoded publish as 1 so this offer is published by default
                        "verified"      => $offer["verified"] ?? 0,
                        "exclusive"     => $offer["exclusive"] ?? 0,
                        "store_id"      => $store_entry->id,
                        "date_expiry"   => $offer["date_expiry"] ? Carbon::createFromFormat('Y-m-d H:i:s', $offer["date_expiry"])->format('Y-m-d') : null,
                        "on_going"      => $offer["date_expiry"] ? 0 : 1,
                        "description"   => $offer["description"],
                        "code"          => $offer["code"] ?? Null,
                        "type"          => $offer["type"],
                        "coupon_image"  => $store["store_logo"]
                    ]
                );

                $offer_entry->sites()->sync([1]);

                $responses[$store['_id']]['offers_added'][] = $offer_entry->id;

            endforeach;

            $responses[$store['_id']]['success']    = true;
            $responses[$store['_id']]['response']   = $slug_entry;

        endforeach;

        return $responses;
    }

    public function show(Store $store)
    {
        abort_if(Gate::denies('store_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StoreResource($store->load(['sites', 'categories', 'network']));
    }

    public function update(UpdateStoreRequest $request, Store $store)
    {
        $store->update($request->all());
        $store->sites()->sync($request->input('sites', []));
        $store->categories()->sync($request->input('categories', []));

        if ($request->input('image', false)) {
            if (!$store->image || $request->input('image') !== $store->image->file_name) {
                $store->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        } elseif ($store->image) {
            $store->image->delete();
        }

        return (new StoreResource($store))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Store $store)
    {
        abort_if(Gate::denies('store_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $store->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
