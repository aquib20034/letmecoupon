@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.site.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.sites.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.site.fields.id') }}
                            </th>
                            <td>
                                {{ $site->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.site.fields.name') }}
                            </th>
                            <td>
                                {{ $site->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.site.fields.country_name') }}
                            </th>
                            <td>
                                {{ $site->country_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.site.fields.country_code') }}
                            </th>
                            <td>
                                {{ $site->country_code }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.site.fields.flag') }}
                            </th>
                            <td>
                                @if ($site->flag)
                                    <a href="{{ $site->flag->getUrl() }}" target="_blank">
                                        <img src="{{ $site->flag->getUrl('thumb') }}" width="50px" height="50px">
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.site.fields.url') }}
                            </th>
                            <td>
                                {{ $site->url }}
                            </td>
                        </tr>

                        <tr>
                            <th>
                                {{ trans('cruds.site.fields.html_tags') }}
                            </th>
                            <td>
                                {{ $site->html_tags }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.site.fields.javascript_tags') }}
                            </th>
                            <td>
                                {{ $site->javascript_tags }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.site.fields.publish') }}
                            </th>
                            <td>
                                <input type="checkbox" disabled="disabled" {{ $site->publish ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.site.fields.store_heading_one_suffix') }}
                            </th>
                            <td>
                                {{ $site->store_heading_one_suffix }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.sites.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
