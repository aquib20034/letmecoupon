<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyStoreRequest;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Network;
use App\Site;
use App\Store;
use App\Slug;
use App\AffiliateLog;
use App\User;
use App\Coupon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Spatie\SchemaOrg\Schema;
use App\Jobs\SendEmailAboutAffiliateUrl;

class StoresController extends Controller
{
    public function __construct() {
        $this->slug = new Slug;
    }

    protected function getUserName($id) {
        return User::select('name')->where('id', $id)->first()->name;
    }

    use MediaUploadingTrait;

    public $table = 'stores';
    protected $primaryKey   = 'id';
    protected $slug_prefix  =  ''; //'store/';
    protected $page_type    = 'store';

    public function index(Request $request)
    {
        abort_if(Gate::denies('store_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        if($status) return redirect('/admin');

        if ($request->ajax()) {
            $query = Store::with(['sites', 'storeCoupons', 'categories', 'network'])->select(sprintf('%s.*', (new Store)->table));

            if(isset($request->stid)) {
                $query = $query->where('id', $request->stid);
            }

            $query = $query->whereHas('sites', function($q) use ($request) {
                if($request->siteId != 'all') {
                    if(!empty($request->siteId)) {
                        $q->where('site_id', $request->siteId);
                    } elseif (isset(request()->test_id)) {
                        $q->where('site_id', request()->test_id);
                    } else {
                        $q->where('site_id', getSiteID());
                    }
                }
            });

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewCoupon    = 'view_coupon';
                $viewGate      = 'store_show';
                $editGate      = 'store_edit';
                $deleteGate    = 'store_delete';
                $crudRoutePart = 'stores';

                return view('partials.datatablesActions', compact(
                    'viewCoupon',
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('site', function ($row) {
                $labels = [];

                foreach ($row->sites as $site) {
                    $labels[] = sprintf('<span class="badge badge-info">%s</span>', $site->country_name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('name', function ($row) {
                $affiliate_url = $row->affiliate_url ? '<small><b>'.trans('cruds.store.fields.affiliate_url').':</b> <a href="'.$row->affiliate_url.'">'.$row->affiliate_url.'</a></small>' : '';
                $name = $row->name ? $row->name : "";
                return new HtmlString('<p style="word-break: break-all">'. $name . ' <br />' . $affiliate_url .'</p>');
            });
            $table->editColumn('sort', function ($row) {
                return $row->sort ? $row->sort : "";
            });
            $table->addColumn('network_name', function ($row) {
                return $row->network ? $row->network->name : '';
            });
            $table->addColumn('coupon_count', function ($row) {
                return $row->storeCoupons ? $row->storeCoupons->count() : '';
            });
            $table->addColumn('expiry_date', function ($row) {
                if($row->storeCoupons->count()>0){
                   $dateExpiry = date("Y-m-d");
                   foreach($row->storeCoupons->toArray() as $coupon){
                        if($coupon['on_going'] == 0){
                            $dateExpiry = $coupon['date_expiry'];
                            break;
                        }
                   }
                   return '<div title="Date Expiry won`t be changed for the coupons which are marked as `on going` " class="container"><input onchange="changeExpDate('.$row->id.')" value="'.$dateExpiry.'" type="date" id="store_id_'.$row->id.'" >
                                <div  id="loader_'.$row->id.'" style="display:none;position:absolute; height:1rem !important; width:1rem !important; margin-left:5px; margin-top:7px;"  class="spinner-border text-success" role="status">
                                  <span class="sr-only">Loading...</span>
                                </div>
                            </div>'; 
                }
                else{
                    return '';
                }
                
            });             
            $table->addColumn('created_by', function ($row) {
                $created_by = $row->created_by ? $this->getUserName($row->created_by) . ' / ' : '';
                $created_at = $row->created_at ? $row->created_at : '';
                return $created_by . ' ' . $created_at;
            });
            $table->addColumn('updated_by', function ($row) {
                $updated_by = $row->updated_by ? $this->getUserName($row->updated_by) . ' / ' : '';
                $updated_at = $row->updated_at ? $row->updated_at : '';
                return $updated_by . ' ' . $updated_at;
            });

            $table->editColumn('publish', function ($row) {
                return '<input type="checkbox" id="published'.$row->id.'" onclick="published('.$row->id.')" ' . ($row->publish ? 'checked' : null) . '>';
            });

            $table->editColumn('affiliate_url_update', function ($row) {
                return '<input type="checkbox" id="affiliate_url_updated'.$row->id.'" onclick="affiliateUrlUpdate('.$row->id.')" ' . ($row->affiliate_url_update ? 'checked' : null) . '>';
            });   

            $table->rawColumns(['actions', 'placeholder', 'site', 'network', 'publish','affiliate_url_update','expiry_date']);

            return $table->make(true);
        }

        return view('admin.stores.index');//, compact('stores'));
    }

    public function create()
    {
        abort_if(Gate::denies('store_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        if($status) return redirect('/admin');

        $sites = Site::all()->pluck('name', 'id');

        $categories = Category::with('sites')->whereHas('sites', function($q) {
            $q->where('site_id', isset(request()->test_id) ? request()->test_id : getSiteID());
        })->pluck('title', 'id');

        $networks = Network::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.stores.create', compact('sites', 'categories', 'networks'));
    }

    public function affiliateUrlUpdated(Request $request) {

        $store = Store::where('id',$request->id)->update(['affiliate_url_update' => $request->affiliate_url]);
    }     

    public function store(StoreStoreRequest $request)
    {
        $faq_title = NULL;
        $faq_json = NULL;
        $faq_schema = NULL;

        if($request->enable_faq) {
            $data = [];
            $json = [];

            $question = $request->question;
            $answer = $request->answer;

            for($a = 0; $a < COUNT($question); $a++) {
                $content = Schema::
                question()
                    ->name($question[$a])
                    ->acceptedAnswer(Schema::answer()->text($answer[$a]));
                array_push($data, $content);

                $con = ['question' => $question[$a], 'answer' => $answer[$a]];
                array_push($json, $con);
            }

            $localBusiness = Schema::FAQPage()
                ->mainEntity($data);

            $faq_title = $request->faq_title;
            $faq_json = json_encode($json);
            $faq_schema = $localBusiness->toScript();
        }

        $store = Store::create(array_merge($request->all(), ['faq_title' => $faq_title, 'faq_json' => $faq_json, 'faq_schema' => $faq_schema, 'created_by' => auth()->id(), 'updated_by' => auth()->id()]));
        $store->sites()->sync($request->input('sites', []));
        $store->categories()->sync($request->input('categories', []));

        $last_id    = $store->id;
        $slug       = $store->slug;

        $return = $this->slug->insertSlug($last_id, $this->slug_prefix . $slug, $this->table, $request->input('sites', []));
        if (isset($return['status']) && $return['status'] === false) {
            return $return;
        }

        if (\App::environment('production')) {

            if ($request->input('image', false)) {
                $store->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->addCustomHeaders([
                    'ACL' => 'public-read'
                ])->toMediaCollection('image','s3');
            }

            if ($request->input('trendingcouponimage', false)) {
                $store->addMedia(storage_path('tmp/uploads/' . $request->input('trendingcouponimage')))->addCustomHeaders([
                    'ACL' => 'public-read'
                ])->toMediaCollection('trendingcouponimage','s3');
            }

        } else {

            if ($request->input('image', false)) {
                $store->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }

            if ($request->input('trendingcouponimage', false)) {
                $store->addMedia(storage_path('tmp/uploads/' . $request->input('trendingcouponimage')))->toMediaCollection('trendingcouponimage');
            }

        }

        $storeUpdate = Store::select('id','name','store_image')->where('id',$last_id)->first();
        $img = $storeUpdate['image'] ? $storeUpdate['image']['url'] : '';
        $trending_coupon_image = $storeUpdate['trendingcouponimage'] ? $storeUpdate['trendingcouponimage']['url'] : '';
        
        if ($request->input('image', false)) {
            $path['store_image'] = $img;
        }

        if ($request->input('trendingcouponimage', false)) {
            $path['trending_coupon_image'] = $trending_coupon_image;
        }

        if($request->input('image', false) || $request->input('trendingcouponimage', false)){
            Store::where('id', $last_id)->update($path);
        }
        if($request->input('affiliate_url') && !empty($request->input('affiliate_url'))){
            $affiliateLog = AffiliateLog::create([
                'network_name' => getNetworkName($request->input('affiliate_url')),
                'store_id' => $store->id,
                'website' => isset($request->input('sites')[0]) ? $request->input('sites')[0] : null,               
                'new_aff_url' => $request->input('affiliate_url'),
                'action' => 'created',
                'created_by' => auth()->user()->id,
            ]);   
            SendEmailAboutAffiliateUrl::dispatch($affiliateLog->id)->onQueue("send_email_about_affiliate_url");             
        }

        if(isset($request->test_id)) {
            $url = route('admin.stores.index') . $request->test_id;
        } else {
            $url = route('admin.stores.index');
        }

        return redirect($url);
    }

    public function edit(Store $store)
    {
        abort_if(Gate::denies('store_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        if($status) return redirect('/admin');

        $sites = Site::all()->pluck('name', 'id');

        $categories = Category::with('sites')->whereHas('sites', function($q) use($store) {
            if($store->sites()->pluck('site_id')->count() > 0) {
                $q->whereIn('site_id', $store->sites()->pluck('site_id'));
            } else {
                $q->where('site_id', isset(request()->test_id) ? request()->test_id : getSiteID());
            }

        })->pluck('title', 'id');

        $networks = Network::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $store->load('sites', 'categories', 'network');

        $slug = Slug::where('obj_id', $store['id'])->where('table_name', $this->table)->get()->toArray();

        return view('admin.stores.edit', compact('sites', 'categories', 'networks', 'store','slug'));
    }

    public function update(UpdateStoreRequest $request, Store $store)
    {
        $oldAffiliateUrl = $store->affiliate_url;
        $faq_title = NULL;
        $faq_json = NULL;
        $faq_schema = NULL;

        if($request->enable_faq) {
            $data = [];
            $json = [];

            $question = $request->question;
            $answer = $request->answer;

            for($a = 0; $a < COUNT($question); $a++) {
                $content = Schema::
                question()
                    ->name($question[$a])
                    ->acceptedAnswer(Schema::answer()->text($answer[$a]));
                array_push($data, $content);

                $con = ['question' => $question[$a], 'answer' => $answer[$a]];
                array_push($json, $con);
            }

            $localBusiness = Schema::FAQPage()
                ->mainEntity($data);

            $faq_title = $request->faq_title;
            $faq_json = json_encode($json);
            $faq_schema = $localBusiness->toScript();
        }

        $store->update(array_merge($request->all(), ['faq_title' => $faq_title, 'faq_json' => $faq_json, 'faq_schema' => $faq_schema, 'updated_by' => auth()->id()]));
        $store->sites()->sync($request->input('sites', []));
        $store->categories()->sync($request->input('categories', []));

        $id         = $store->id;
        $slug       = $store->slug;

        if($request['old_slug'] != ""){
            $old_slug = $request['slug'];
            $slug = $request['old_slug'];
        }else{
            $old_slug = "";
        }

        $return = $this->slug->updateSlug($id, $this->slug_prefix . $slug, $this->table, $request->input('sites', []), 0, $old_slug);
        if (isset($return['status']) && $return['status'] === false) {
            return $return;
        }

        
        if (\App::environment('production')) {
            if ($request->input('image', false)) {
                if (!$store->image || $request->input('image') !== $store->image->file_name) {
                    $store->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->addCustomHeaders([
                        'ACL' => 'public-read'
                    ])->toMediaCollection('image','s3');
                }
            } elseif ($store->image) {
                $store->image->delete();
            }

            if ($request->input('trendingcouponimage', false)) {
                if (!$store->trendingcouponimage || $request->input('trendingcouponimage') !== $store->trendingcouponimage->file_name) {
                    $store->addMedia(storage_path('tmp/uploads/' . $request->input('trendingcouponimage')))->addCustomHeaders([
                        'ACL' => 'public-read'
                    ])->toMediaCollection('trendingcouponimage','s3');
                }
            } elseif ($store->trendingcouponimage) {
                $store->trendingcouponimage->delete();
            }

        } else {
            if ($request->input('image', false)) {
                if (!$store->image || $request->input('image') !== $store->image->file_name) {
                    $store->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
                }
            } elseif ($store->image) {
                $store->image->delete();
            }

            if ($request->input('trendingcouponimage', false)) {
                if (!$store->trendingcouponimage || $request->input('trendingcouponimage') !== $store->trendingcouponimage->file_name) {
                    $store->addMedia(storage_path('tmp/uploads/' . $request->input('trendingcouponimage')))->toMediaCollection('trendingcouponimage');
                }
            } elseif ($store->trendingcouponimage) {
                $store->trendingcouponimage->delete();
            }
        }

        $storeUpdate = Store::select('id','name','store_image')->where('id',$id)->first();
        $img                    = $storeUpdate['image'] ? $storeUpdate['image']['url'] : '';
        $trending_coupon_image  = $storeUpdate['trendingcouponimage'] ? $storeUpdate['trendingcouponimage']['url'] : '';

        if ($request->input('image', false)) {
            $path['store_image'] = $img;
        }

        if ($request->input('trendingcouponimage', false)) {
            $path['trending_coupon_image'] = $trending_coupon_image;
        }

        if($request->input('image', false) || $request->input('trendingcouponimage', false)){
            Store::where('id', $id)->update($path);
        }
        
        if($oldAffiliateUrl != $request->input('affiliate_url')){
            $affiliateLog = AffiliateLog::create([
                'network_name' => getNetworkName($request->input('affiliate_url')),
                'store_id' => $store->id,
                'website' =>isset($request->input('sites')[0]) ? $request->input('sites')[0] : null,
   
                'new_aff_url' => $request->input('affiliate_url'),
                'previous_aff_url' => $oldAffiliateUrl,
                'action' => 'updated',
                'created_by' => auth()->user()->id,
            ]); 

            SendEmailAboutAffiliateUrl::dispatch($affiliateLog->id)->onQueue("send_email_about_affiliate_url");
        }  
        if(isset($request->test_id)) {
            $url = route('admin.stores.index') . $request->test_id;
        } else {
            $url = route('admin.stores.index');
        }

        return redirect($url);
    }

    public function show(Store $store)
    {
        abort_if(Gate::denies('store_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        if($status) return redirect('/admin');

        $store->load('sites', 'categories', 'network');

        return view('admin.stores.show', compact('store'));
    }

    public function destroy(Store $store)
    {
        abort_if(Gate::denies('store_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        if($status) return redirect('/admin');
        //dd($store->id);
        $store->delete();
        $this->slug->deleteSlug($store->id, $this->table);

        return back();
    }

    public function massDestroy(MassDestroyStoreRequest $request)
    {

        Store::whereIn('id', request('ids'))->delete();
        $this->slug->massdeleteSlug(request('ids'), $this->table);
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function published(Request $request) {
        $store = Store::find($request->id);
        $store->update($request->all());
        $store_id = $request->id;
        $coupons = Coupon::where('store_id',$store_id)->get();
        foreach($coupons as $coupon):
        $coupon = Coupon::find($coupon->id);
        $array = ['id'=>$coupon->id,'publish'=>$request->publish];
        $ab = $coupon->update($array);
        endforeach;
    }

    public function updateExpiry(Request $request){
        if( ($request->storeId && $request->date_expiry) && (!empty($request->storeId) && !empty($request->date_expiry)) ) {
            if (\DateTime::createFromFormat('Y-m-d', $request->date_expiry) !== false) {
                $coupons = Coupon::select("id","on_going","date_expiry")->where("store_id",$request->storeId)->get();
                foreach($coupons as $coupon){
                    if($coupon->on_going == 0){
                        $coupon->date_expiry = $request->date_expiry;
                        $coupon->save();                    
                    }
                }
            }
        }
    }

}
