@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.auditLog.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.audit-logs.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.auditLog.fields.id') }}
                            </th>
                            <td>
                                {{ $auditLog->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.auditLog.fields.description') }}
                            </th>
                            <td>
                                {{ $auditLog->description }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.auditLog.fields.subject_id') }}
                            </th>
                            <td>
                                {{ $auditLog->subject_id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.auditLog.fields.subject_type') }}
                            </th>
                            <td>
                                {{ $auditLog->subject_type }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.auditLog.fields.user_id') }}
                            </th>
                            <td>
                                {{ $user_name[0] }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.auditLog.fields.properties') }}
                            </th>
                            <td>
                                @if ($auditLog->subject_type == 'App\Banner')
                                    @if (!empty($auditLog->properties))
                                        <table width="100%">
                                            @foreach ($auditLog->properties as $key => $val)
                                                @if ($key == 'image' || $key == 'media')
                                                    @continue
                                                @endif
                                                @if (empty($val))
                                                    @continue
                                                @endif
                                                <tr>
                                                    <th scope="col">{{ str_replace('_', ' ', ucfirst($key)) }}</th>
                                                    <td>
                                                        {{-- @if (is_array($val))
                                                        <p>true</p> --}}
                                                        @if ($key == 'banner_image')
                                                            <img src="{{ $val }}" style="width:auto;height:300px"
                                                                alt="" />
                                                        @else
                                                            {!! $val !!}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @endif
                                    <br />
                                    <br />
                                    <h2>Recent History:</h2>
                                    @if (isset($history))
                                        @php
                                            $i = 1;
                                            $count = 0;
                                        @endphp
                                        @foreach ($history as $single)
                                            <hr />
                                            <br />
                                            @php
                                                if ($count % 2 == 0) {
                                                    echo "<h3 style='background-color:skyblue;'>#" . $i++ . ':</h3>';
                                                } else {
                                                    echo "<h3 style='background-color:yellow;'>#" . $i++ . ':</h3>';
                                                }
                                            @endphp
                                            <table width="100%">
                                                @if (isset($single['properties']))
                                                    <tr>
                                                        <td colspan="2">
                                                            <strong>Updated By:</strong>
                                                            {{ $single['user'] ? $single['user']['name'] : '' }}<br>
                                                            <strong>Created At:</strong>
                                                            {{ date('d-M-Y h:i:s A', strtotime($single['properties']['created_at'])) }}<br>
                                                            <strong>Updated At:</strong>
                                                            {{ date('d-M-Y h:i:s A', strtotime($single['properties']['updated_at'])) }}
                                                        </td>
                                                    </tr>
                                                    @foreach ($single['properties'] as $k => $v)
                                                        @if ($k == 'image' || $k == 'media' || $k == 'store_image' || $k == 'mobile_image')
                                                            @continue
                                                        @endif
                                                        @if (empty($v))
                                                            @continue
                                                        @endif
                                                        <tr>
                                                            <th scope="col">{{ str_replace('_', ' ', ucfirst($k)) }}
                                                            </th>
                                                            <td>
                                                                @if (is_array($v))
                                                                    @continue
                                                                @elseif($k == 'banner_image')
                                                                    <img src="{{ $v }}"
                                                                        style="width:auto;height:300px" alt="" />
                                                                @else
                                                                    {!! $v !!}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </table>
                                            @php
                                                $count++;
                                            @endphp
                                        @endforeach
                                    @endif
                                @else
                                    @if (!empty($auditLog->properties))
                                        <table width="100%">
                                            @foreach ($auditLog->properties as $key => $val)
                                                @if (
                                                    $key == 'image' ||
                                                        $key == 'icon' ||
                                                        $key == 'media' ||
                                                        $key == 'additional_image' ||
                                                        $key == 'flag' ||
                                                        $key == 'logo' ||
                                                        $key == 'favicon' ||
                                                        $key == 'banner_image')
                                                    @continue
                                                @endif
                                                @if (empty($val))
                                                    @continue
                                                @endif
                                                <tr>
                                                    <th scope="col">{{ str_replace('_', ' ', ucfirst($key)) }}</th>
                                                    <td>
                                                        @if (
                                                            $key == 'blog_image' ||
                                                                $key == 'blog_banner_image' ||
                                                                $key == 'event_image' ||
                                                                $key == 'category_image' ||
                                                                $key == 'coupon_image' ||
                                                                $key == 'product_image' ||
                                                                $key == 'product_category_image' ||
                                                                $key == 'site_logo' ||
                                                                $key == 'site_favicon' ||
                                                                $key == 'country_flag' ||
                                                                $key == 'store_image')
                                                            <img src="{{ $val }}" style="width:auto;height:300px"
                                                                alt="" />
                                                        @else
                                                            {!! $val !!}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @endif
                                    <br />
                                    <br />
                                    <h2>Recent History:</h2>
                                    @if (isset($history))
                                        @php
                                            $i = 1;
                                            $count = 0;
                                        @endphp
                                        @foreach ($history as $single)
                                            <hr />
                                            <br />
                                            @php
                                                if ($count % 2 == 0) {
                                                    echo "<h3 style='background-color:skyblue;'>#" . $i++ . ':</h3>';
                                                } else {
                                                    echo "<h3 style='background-color:yellow;'>#" . $i++ . ':</h3>';
                                                }
                                            @endphp
                                            <table width="100%">
                                                @if (isset($single['properties']))
                                                    <tr>
                                                        <td colspan="2">
                                                            <strong>Updated By:</strong>
                                                            {{ $single['user'] ? $single['user']['name'] : '' }}<br>
                                                            <strong>Created At:</strong>
                                                            {{ date('d-M-Y h:i:s A', strtotime($single['properties']['created_at'])) }}<br>
                                                            <strong>Updated At:</strong>
                                                            {{ date('d-M-Y h:i:s A', strtotime($single['properties']['updated_at'])) }}
                                                        </td>
                                                    </tr>
                                                    {{-- @dd($single['properties']) --}}
                                                    @foreach ($single['properties'] as $k => $v)
                                                        @if (
                                                            $k == 'image' ||
                                                                $k == 'icon' ||
                                                                $k == 'media' ||
                                                                $k == 'additional_image' ||
                                                                $k == 'flag' ||
                                                                $k == 'logo' ||
                                                                $k == 'favicon' ||
                                                                $k == 'banner_image')
                                                            @continue
                                                        @endif
                                                        @if (empty($v))
                                                            @continue
                                                        @endif
                                                        <tr>
                                                            <th scope="col">{{ str_replace('_', ' ', ucfirst($k)) }}
                                                            </th>
                                                            <td>
                                                                @if (
                                                                    $k == 'blog_image' ||
                                                                        $k == 'blog_banner_image' ||
                                                                        $k == 'event_image' ||
                                                                        $k == 'category_image' ||
                                                                        $k == 'coupon_image' ||
                                                                        $k == 'product_image' ||
                                                                        $k == 'product_category_image' ||
                                                                        $k == 'site_logo' ||
                                                                        $k == 'site_favicon' ||
                                                                        $k == 'country_flag' ||
                                                                        $k == 'store_image')
                                                                    <img src="{{ $v }}"
                                                                        style="width:auto;height:300px" alt="" />
                                                                @else
                                                                    {!! $v !!}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </table>
                                            @php
                                                $count++;
                                            @endphp
                                        @endforeach
                                    @endif
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.auditLog.fields.host') }}
                            </th>
                            <td>
                                {{ $auditLog->host }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.auditLog.fields.created_at') }}
                            </th>
                            <td>
                                {{ $auditLog->created_at }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.audit-logs.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>


        </div>
    </div>
@endsection
