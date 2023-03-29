<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyWebsiteSettingRequest;
use App\Http\Requests\StoreWebsiteSettingRequest;
use App\Http\Requests\UpdateWebsiteSettingRequest;
use App\WebsiteSetting;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WebsiteSettingsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('website_setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        if($status) return redirect('/admin');

        if(isset(request()->wid)) {
            $websiteSettings = WebsiteSetting::where('id', request()->wid)->get();
        } else {
            $websiteSettings = WebsiteSetting::all();
        }

        return view('admin.websiteSettings.index', compact('websiteSettings'));
    }

    public function create()
    {
        abort_if(Gate::denies('website_setting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        if($status) return redirect('/admin');

        return view('admin.websiteSettings.create');
    }

    public function store(StoreWebsiteSettingRequest $request)
    {
        $web = WebsiteSetting::where('id',1)->first();

        if(empty($web)){
            $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
            if($status) return redirect('/admin');

            $websiteSetting = WebsiteSetting::create($request->all());

            if (\App::environment('production')) {

                if ($request->input('logo', false)) {
                    $websiteSetting->addMedia(storage_path('tmp/uploads/' . $request->input('logo')))->addCustomHeaders([
                        'ACL' => 'public-read'
                    ])->toMediaCollection('logo','s3');
                }

                if ($request->input('favicon', false)) {
                    $websiteSetting->addMedia(storage_path('tmp/uploads/' . $request->input('favicon')))->addCustomHeaders([
                        'ACL' => 'public-read'
                    ])->toMediaCollection('favicon','s3');
                }

            } else {

                if ($request->input('logo', false)) {
                    $websiteSetting->addMedia(storage_path('tmp/uploads/' . $request->input('logo')))->toMediaCollection('logo');
                }

                if ($request->input('favicon', false)) {
                    $websiteSetting->addMedia(storage_path('tmp/uploads/' . $request->input('favicon')))->toMediaCollection('favicon');
                }

            }

            /*Update Path in Website Setting table*/
                $webSetting = WebsiteSetting::select('id')->where('id',$websiteSetting->id)->first();
                $logo     = $webSetting['logo'] ? $webSetting['logo']['url'] : '';
                $favicon = $webSetting['favicon'] ? $webSetting['favicon']['url'] : '';
                $path['site_logo']     = $logo;
                $path['site_favicon']   = $favicon;
                $webSetting->update($path);
            /*Update Path in Website Setting table end*/

            if(isset($request->test_id)) {
                $url = route('admin.website-settings.index') . $request->test_id;
            } else {
                $url = route('admin.website-settings.index');
            }

            return redirect($url);
        }else{
            $url = route('admin.website-settings.edit', $web->id);
            return redirect($url);
        }
    }

    public function edit(WebsiteSetting $websiteSetting)
    {
        abort_if(Gate::denies('website_setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        if($status) return redirect('/admin');

        return view('admin.websiteSettings.edit', compact('websiteSetting'));
    }

    public function update(UpdateWebsiteSettingRequest $request, WebsiteSetting $websiteSetting)
    {
        $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        if($status) return redirect('/admin');

        $websiteSetting->update($request->all());

        if (\App::environment('production')) {

            if ($request->input('logo', false)) {
                if (!$websiteSetting->logo || $request->input('logo') !== $websiteSetting->logo->file_name) {
                    $websiteSetting->addMedia(storage_path('tmp/uploads/' . $request->input('logo')))->addCustomHeaders([
                        'ACL' => 'public-read'
                    ])->toMediaCollection('logo','s3');
                }
            } elseif ($websiteSetting->logo) {
                $websiteSetting->logo->delete();
            }

            if ($request->input('favicon', false)) {
                if (!$websiteSetting->favicon || $request->input('favicon') !== $websiteSetting->favicon->file_name) {
                    $websiteSetting->addMedia(storage_path('tmp/uploads/' . $request->input('favicon')))->addCustomHeaders([
                        'ACL' => 'public-read'
                    ])->toMediaCollection('favicon','s3');
                }
            } elseif ($websiteSetting->favicon) {
                $websiteSetting->favicon->delete();
            }

        } else {

            if ($request->input('logo', false)) {
                if (!$websiteSetting->logo || $request->input('logo') !== $websiteSetting->logo->file_name) {
                    $websiteSetting->addMedia(storage_path('tmp/uploads/' . $request->input('logo')))->toMediaCollection('logo');
                }
            } elseif ($websiteSetting->logo) {
                $websiteSetting->logo->delete();
            }

            if ($request->input('favicon', false)) {
                if (!$websiteSetting->favicon || $request->input('favicon') !== $websiteSetting->favicon->file_name) {
                    $websiteSetting->addMedia(storage_path('tmp/uploads/' . $request->input('favicon')))->toMediaCollection('favicon');
                }
            } elseif ($websiteSetting->favicon) {
                $websiteSetting->favicon->delete();
            }

        }

        /*Update Path in Website Setting table*/
            $webSetting = WebsiteSetting::select('id')->where('id',$websiteSetting->id)->first();

            $logo       = $webSetting['logo'] ? $webSetting['logo']['url'] : '';
            $favicon    = $webSetting['favicon'] ? $webSetting['favicon']['url'] : '';
            
            
            if ($request->input('logo', false)) {
                $path['site_logo']      = $logo;
            }

            if ($request->input('favicon', false)) {
                $path['site_favicon']   = $favicon;
            }
            if($request->input('logo', false) || $request->input('favicon', false)){
                $webSetting->update($path);    
            }
            
        /*Update Path in Website Setting table end*/

        if(isset($request->test_id)) {
            $url = route('admin.website-settings.index') . $request->test_id;
        } else {
            $url = route('admin.website-settings.index');
        }

        return redirect($url);
    }

    public function show(WebsiteSetting $websiteSetting)
    {
        abort_if(Gate::denies('website_setting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        if($status) return redirect('/admin');

        return view('admin.websiteSettings.show', compact('websiteSetting'));
    }

    public function destroy(WebsiteSetting $websiteSetting)
    {
        abort_if(Gate::denies('website_setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $status = (isset(request()->test_id) ? !request()->test_id > 0 : !getSiteID() > 0);
        if($status) return redirect('/admin');

        $websiteSetting->delete();

        return back();
    }

    public function massDestroy(MassDestroyWebsiteSettingRequest $request)
    {
        WebsiteSetting::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
