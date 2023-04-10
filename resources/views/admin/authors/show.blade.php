@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ $author->first_name }} {{ $author->last_name }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.authors.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.author.fields.id') }}
                            </th>
                            <td>
                                {{ $author->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.author.fields.site') }}
                            </th>
                            <td>
                                @foreach ($author->sites as $key => $site)
                                    <span class="label label-info">{{ $site->name }}, </span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.author.fields.name') }}
                            </th>
                            <td>
                                {{ $author->first_name }} {{ $author->last_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.author.fields.email') }}
                            </th>
                            <td>
                                {{ $author->email }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.author.fields.phone') }}
                            </th>
                            <td>
                                {{ $author->phone }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.author.fields.type') }}
                            </th>
                            <td>
                                {{ ($author->author_types)?$author->author_types->title:$author->type }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.author.fields.facebook_url') }}
                            </th>
                            <td>
                                {{ $author->facebook_url }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.author.fields.instagram_url') }}
                            </th>
                            <td>
                                {{ $author->instagram_url }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.author.fields.linkedin_url') }}
                            </th>
                            <td>
                                {{ $author->linkedin_url }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.author.fields.twitter_url') }}
                            </th>
                            <td>
                                {{ $author->twitter_url }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.author.fields.language') }}
                            </th>
                            <td>
                                @foreach ($author->languages as $key => $language)
                                    <span class="label label-info">{{ $language->language }}, </span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.author.fields.short_description') }}
                            </th>
                            <td>
                                {!! $author->short_description !!}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.author.fields.long_description') }}
                            </th>
                            <td>
                                {!! $author->long_description !!}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.author.fields.image') }}
                            </th>
                            <td>
                                @if ($author->image)
                                    <a href="{{ $author->image->getUrl() }}" target="_blank">
                                        <img src="{{ $author->image->getUrl('thumb') }}" width="50px" height="50px">
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.author.fields.created_by') }}
                            </th>
                            <td>
                                @if (isset($author->created_by))
                                    {{ \App\User::findOrFail($author->created_by)->name }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.author.fields.updated_by') }}
                            </th>
                            <td>
                                @if (isset($author->updated_by))
                                    {{ \App\User::findOrFail($author->updated_by)->name }}
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.authors.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
