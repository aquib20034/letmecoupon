@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.websiteSetting.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.website-settings.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.websiteSetting.fields.id') }}
                            </th>
                            <td>
                                {{ $websiteSetting->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Primary Color
                            </th>
                            <td>
                                {{ $websiteSetting->primary_color }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Secondary Color
                            </th>
                            <td>
                                {{ $websiteSetting->secondary_color }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Tertiary Color
                            </th>
                            <td>
                                {{ $websiteSetting->tertiary_color }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.websiteSetting.fields.twitter') }}
                            </th>
                            <td>
                                {{ $websiteSetting->twitter }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.websiteSetting.fields.linked_in') }}
                            </th>
                            <td>
                                {{ $websiteSetting->linked_in }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.websiteSetting.fields.facebook') }}
                            </th>
                            <td>
                                {{ $websiteSetting->facebook }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.websiteSetting.fields.youtube') }}
                            </th>
                            <td>
                                {{ $websiteSetting->youtube }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.websiteSetting.fields.instagram') }}
                            </th>
                            <td>
                                {{ $websiteSetting->instagram }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.websiteSetting.fields.pinterest') }}
                            </th>
                            <td>
                                {{ $websiteSetting->pinterest }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Logo
                            </th>
                            <td>
                                @if ($websiteSetting->logo)
                                    <a href="{{ $websiteSetting->logo->getUrl() }}" target="_blank">
                                        <img src="{{ $websiteSetting->logo->getUrl('thumb') }}" width="50px"
                                            height="50px">
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Favicon
                            </th>
                            <td>
                                @if ($websiteSetting->favicon)
                                    <a href="{{ $websiteSetting->favicon->getUrl() }}" target="_blank">
                                        <img src="{{ $websiteSetting->favicon->getUrl('thumb') }}" width="50px"
                                            height="50px">
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.websiteSetting.fields.site_javascript') }}
                            </th>
                            <td>
                                {{ $websiteSetting->site_javascript }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.websiteSetting.fields.site_html_tags') }}
                            </th>
                            <td>
                                {{ $websiteSetting->site_html_tags }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.website-settings.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>


        </div>
    </div>
@endsection
