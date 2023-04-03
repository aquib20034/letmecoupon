@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.review.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.reviews.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.review.fields.id') }}
                            </th>
                            <td>
                                {{ $review->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.review.fields.site') }}
                            </th>
                            <td>
                                @foreach ($review->sites as $key => $site)
                                    <span class="label label-info">{{ $site->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.review.fields.title') }}
                            </th>
                            <td>
                                {{ $review->title }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.review.fields.slug') }}
                            </th>
                            <td>
                                {{ $review->slug }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.review.fields.short_description') }}
                            </th>
                            <td>
                                {!! $review->short_description !!}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.review.fields.long_description') }}
                            </th>
                            <td>
                                {!! $review->long_description !!}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.review.fields.image') }}
                            </th>
                            <td>
                                @if ($review->image)
                                    <a href="{{ $review->image->getUrl() }}" target="_blank">
                                        <img src="{{ $review->image->getUrl('thumb') }}" width="50px" height="50px">
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.review.fields.banner_image') }}
                            </th>
                            <td>
                                @if ($review->banner_image)
                                    <a href="{{ $review->banner_image->getUrl() }}" target="_blank">
                                        <img src="{{ $review->banner_image->getUrl('thumb') }}" width="50px"
                                            height="50px">
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.review.fields.sort') }}
                            </th>
                            <td>
                                {{ $review->sort }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.review.fields.featured') }}
                            </th>
                            <td>
                                <input type="checkbox" disabled="disabled" {{ $review->featured ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.review.fields.popular') }}
                            </th>
                            <td>
                                <input type="checkbox" disabled="disabled" {{ $review->popular ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.review.fields.publish') }}
                            </th>
                            <td>
                                <input type="checkbox" disabled="disabled" {{ $review->publish ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.review.fields.category') }}
                            </th>
                            <td>
                                @foreach ($review->categories as $key => $category)
                                    <span class="label label-info">{{ $category->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.review.fields.tag') }}
                            </th>
                            <td>
                                @foreach ($review->tags as $key => $tag)
                                    <span class="label label-info">{{ $tag->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.review.fields.store') }}
                            </th>
                            <td>
                                @foreach ($review->store_details as $key => $store)
                                    <span class="label label-info">{{ $store->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.review.fields.view') }}
                            </th>
                            <td>
                                {{ $review->view }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.review.fields.meta_title') }}
                            </th>
                            <td>
                                {{ $review->meta_title }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.review.fields.meta_keywords') }}
                            </th>
                            <td>
                                {{ $review->meta_keywords }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.review.fields.meta_description') }}
                            </th>
                            <td>
                                {{ $review->meta_description }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.review.fields.created_by') }}
                            </th>
                            <td>
                                {{ $review->created_by }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.review.fields.update_by') }}
                            </th>
                            <td>
                                {{ $review->update_by }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.reviews.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
