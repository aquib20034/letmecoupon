<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySiteRequest;
use App\Http\Requests\StoreSiteRequest;
use App\Http\Requests\UpdateSiteRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Site;
use App\Jobs\SiteLanguage;
use Gate;
use App;
use File;


class SitesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('site_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        if($status) return redirect('/admin');

        if(isset($request->sit_id)) {
            $sites = Site::where('id', $request->sit_id)->get();
        } else {
            $sites = Site::all();
        }

        return view('admin.sites.index', compact('sites'));
    }

    public function create()
    {
        abort_if(Gate::denies('site_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        if($status) return redirect('/admin');

        $language = \App\Langauge::select('language', 'code')->get()->toArray();

        return view('admin.sites.create', compact('language'));
    }

    public function store(StoreSiteRequest $request)
    {
        $site = Site::create($request->all());
        $last_id    = $site->id;

        if (\App::environment('production')) {

            if ($request->input('flag', false)) {
                $site->addMedia(storage_path('tmp/uploads/' . $request->input('flag')))->addCustomHeaders([
                    'ACL' => 'public-read'
                ])->toMediaCollection('flag','s3');
            }
            if ($request->input('about_image', false)) {
                $site->addMedia(storage_path('tmp/uploads/' . $request->input('about_image')))->addCustomHeaders([
                    'ACL' => 'public-read'
                ])->toMediaCollection('about_image','s3');
            }

        } else {

            if ($request->input('flag', false)) {
                $site->addMedia(storage_path('tmp/uploads/' . $request->input('flag')))->toMediaCollection('flag');
            }
            if ($request->input('about_image', false)) {
                $site->addMedia(storage_path('tmp/uploads/' . $request->input('about_image')))->toMediaCollection('about_image');
            }
        }

        $siteUpdate = Site::select('id','name')->where('id',$last_id)->first();
        
        
        
        $flag = $siteUpdate['flag'] ? $siteUpdate['flag']['url'] : '';
        $about_image    = $siteUpdate['about_image'] ? $siteUpdate['about_image']['url'] : '';
        $flag = str_replace( config('app.cdn_path_remove'), config('app.cdn_path') ?? '', $flag);
        $path['country_flag']      = $flag;
        $path['about_image']      = $about_image;
        Site::where('id', $last_id)->update($path);

        if(isset($request->test_id)) {
            $url = route('admin.sites.index') . $request->test_id;
        } else {
            $url = route('admin.sites.index');
        }

        return redirect($url);
    }

    public function edit(Site $site)
    {
        abort_if(Gate::denies('site_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        if($status) return redirect('/admin');

        $language = \App\Langauge::select('language', 'code')->get()->toArray();

        return view('admin.sites.edit', compact('site', 'language'));
    }

    public function update(UpdateSiteRequest $request, Site $site)
    {
        $site->update($request->all());
        $last_id    = $site->id;

        if (\App::environment('production')) {

            if ($request->input('flag', false)) {
                if (!$site->flag || $request->input('flag') !== $site->flag->file_name) {
                    $site->addMedia(storage_path('tmp/uploads/' . $request->input('flag')))->addCustomHeaders([
                        'ACL' => 'public-read'
                    ])->toMediaCollection('flag','s3');
                }
            } elseif ($site->flag) {
                $site->flag->delete();
            }

            if ($request->input('about_image', false)) {
                if (!$site->about_image || $request->input('about_image') !== $site->about_image->file_name) {
                    $site->addMedia(storage_path('tmp/uploads/' . $request->input('about_image')))->addCustomHeaders([
                        'ACL' => 'public-read'
                    ])->toMediaCollection('about_image','s3');
                }
            } elseif ($site->about_image) {
                $site->about_image->delete();
            }

        } else {

            if ($request->input('flag', false)) {
                if (!$site->flag || $request->input('flag') !== $site->flag->file_name) {
                    $site->addMedia(storage_path('tmp/uploads/' . $request->input('flag')))->toMediaCollection('flag');
                }
            } elseif ($site->flag) {
                $site->flag->delete();
            }

            if ($request->input('about_image', false)) {
                if (!$site->about_image || $request->input('about_image') !== $site->about_image->file_name) {
                    $site->addMedia(storage_path('tmp/uploads/' . $request->input('about_image')))->toMediaCollection('about_image');
                }
            } elseif ($site->about_image) {
                $site->about_image->delete();
            }

        }

        $siteUpdate = Site::select('id','name')->where('id',$last_id)->first();
        
        
        $flag = $siteUpdate['flag'] ? $siteUpdate['flag']['url'] : '';
        $about_image    = $siteUpdate['about_image'] ? $siteUpdate['about_image']['url'] : '';
        $flag = str_replace( config('app.cdn_path_remove'), config('app.cdn_path') ?? '', $flag);
        
        $path['country_flag']      = $flag;
        $path['about_image']      = $about_image;
        Site::where('id', $last_id)->update($path);

        if(isset($request->test_id)) {
            $url = route('admin.sites.index') . $request->test_id;
        } else {
            $url = route('admin.sites.index');
        }

        return redirect($url);
    }

    public function show(Site $site)
    {
        abort_if(Gate::denies('site_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        if($status) return redirect('/admin');

        $site->load('siteCategories', 'siteStores', 'siteCoupons', 'sitePages', 'sitePresses', 'siteEvents', 'siteTags', 'siteProductCategories', 'siteAddspaceStores', 'siteAddSpaceProducts', 'siteBanners', 'siteNetworks', 'siteBlogs', 'siteProducts');

        return view('admin.sites.show', compact('site'));
    }

    public function destroy(Site $site)
    {
        abort_if(Gate::denies('site_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        if($status) return redirect('/admin');

        $site->delete();

        return back();
    }

    public function massDestroy(MassDestroySiteRequest $request)
    {
        Site::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
