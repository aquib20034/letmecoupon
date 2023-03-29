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
