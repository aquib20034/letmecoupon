@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.review.title_singular') }}
    </div>

    <div class="card-body">
        <input type="hidden" data-name="edit_id" value="{{ $review->id }}" class="edit_id">
        <form method="POST" action='{{ route("admin.reviews.update", [$review->id]) }}' enctype="multipart/form-data" id="reviewForm">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="sites">{{ trans('cruds.review.fields.site') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('sites') ? 'is-invalid' : '' }}" name="sites[]" id="sites" multiple required>
                    @foreach($sites as $id => $site)
                        <option value="{{ $id }}" {{ (in_array($id, old('sites', [])) || $review->sites->contains($id)) ? 'selected' : '' }}>{{ $site }}</option>
                    @endforeach
                </select>
                @if($errors->has('sites'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sites') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.site_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.review.fields.title') }}</label>
                <input class="form-control auto_slug {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" data-target_controller="review" value="{{ old('title', $review->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="slug">{{ trans('cruds.review.fields.slug') }}</label>
                <div class="row">
                    <div class="col-lg-2">
                        <input type="text" value="review/" disabled class="form-control">
                    </div>
                    <div class="col-lg-10">
                        <input class="form-control org_slug {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', str_replace('review/', '', isset($review->slugs->slug) ? $review->slugs->slug : '')) }}" required>
                        @if($errors->has('slug'))
                            <div class="invalid-feedback">
                                {{ $errors->first('slug') }}
                            </div>
                        @endif
                    </div>
                </div>
                <span class="help-block">{{ trans('cruds.review.fields.slug_helper') }}</span>
            </div>
            <div class="form-group" id="shortDescription">
                <label for="short_description">{{ trans('cruds.review.fields.short_description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('short_description') ? 'is-invalid' : '' }}" name="short_description" id="short_description">{!! old('short_description', $review->short_description) !!}</textarea>
                @if($errors->has('short_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('short_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.short_description_helper') }}</span>
            </div>
            <div class="form-group" id="longDescription">
                <label for="long_description">{{ trans('cruds.review.fields.long_description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('long_description') ? 'is-invalid' : '' }}" name="long_description" id="long_description">{{ old('long_description', $review->long_description) }}</textarea>
                @if($errors->has('long_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('long_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.long_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="image">{{ trans('cruds.review.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sort">{{ trans('cruds.review.fields.sort') }}</label>
                <input class="form-control {{ $errors->has('sort') ? 'is-invalid' : '' }}" type="number" name="sort" id="sort" value="{{ old('sort', $review->sort) }}" step="1" required>
                @if($errors->has('sort'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sort') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.sort_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('featured') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="featured" value="0">
                    <input class="form-check-input" type="checkbox" name="featured" id="featured" value="1" {{ $review->featured || old('featured', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="featured">{{ trans('cruds.review.fields.featured') }}</label>
                </div>
                @if($errors->has('featured'))
                    <div class="invalid-feedback">
                        {{ $errors->first('featured') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.featured_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('popular') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="popular" value="0">
                    <input class="form-check-input" type="checkbox" name="popular" id="popular" value="1" {{ $review->popular || old('popular', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="popular">{{ trans('cruds.review.fields.popular') }}</label>
                </div>
                @if($errors->has('popular'))
                    <div class="invalid-feedback">
                        {{ $errors->first('popular') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.popular_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('publish') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="publish" value="0">
                    <input class="form-check-input" type="checkbox" name="publish" id="publish" value="1" {{ $review->publish || old('publish', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="publish">{{ trans('cruds.review.fields.publish') }}</label>
                </div>
                @if($errors->has('publish'))
                    <div class="invalid-feedback">
                        {{ $errors->first('publish') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.publish_helper') }}</span>
            </div>

            <div class="form-group d-none">
                <label for="users">User</label>
                <select class="form-control select2 {{ $errors->has('users') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ ($review->user ? $review->user->id : old('user_id')) == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('users'))
                    <div class="invalid-feedback">
                        {{ $errors->first('users') }}
                    </div>
                @endif

            </div>

            <div class="form-group">
                <label for="author_id">Author</label>
                <select class="form-control select2 {{ $errors->has('author_id') ? 'is-invalid' : '' }}" name="author_id" id="author_id">
                    @if(isset($auhors) && (!(empty($auhors))))    
                        @foreach($authors as $id => $author)
                            <option value="{{ $id }}" {{ ($review->author_id ? $review->author->id : old('author_id')) == $id ? 'selected' : '' }}>{{ $author }}</option>
                        @endforeach
                    @endif
                </select>
                @if($errors->has('author_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('author_id') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="categories">{{ trans('cruds.review.fields.category') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ (in_array($id, old('categories', [])) || $review->categories->contains($id)) ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('categories'))
                    <div class="invalid-feedback">
                        {{ $errors->first('categories') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.category_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="tags">{{ trans('cruds.review.fields.tag') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                    @foreach($tags as $id => $tag)
                        <option value="{{ $id }}" {{ (in_array($id, old('tags', [])) || $review->tags->contains($id)) ? 'selected' : '' }}>{{ $tag }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tags') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.tag_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="stores">{{ trans('cruds.review.fields.store') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('stores') ? 'is-invalid' : '' }}" name="stores[]" id="stores" multiple>
                    @foreach($stores as $id => $store)
                        <option value="{{ $id }}" {{ (in_array($id, old('stores', [])) || $review->store_details->contains($id)) ? 'selected' : '' }}>{!! $store !!}</option>
                    @endforeach
                </select>
                @if($errors->has('stores'))
                    <div class="invalid-feedback">
                        {{ $errors->first('stores') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.store_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="meta_title">{{ trans('cruds.review.fields.meta_title') }}</label>
                <input class="form-control {{ $errors->has('meta_title') ? 'is-invalid' : '' }}" type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $review->meta_title) }}" required>
                @if($errors->has('meta_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meta_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.meta_title_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="meta_keywords">{{ trans('cruds.review.fields.meta_keywords') }}</label>
                <input class="form-control {{ $errors->has('meta_keywords') ? 'is-invalid' : '' }}" type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', $review->meta_keywords) }}" required>
                @if($errors->has('meta_keywords'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meta_keywords') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.review.fields.meta_keywords_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="meta_description">{{ trans('cruds.review.fields.meta_description') }}</label>
                <input class="form-control {{ $errors->has('meta_description') ? 'is-invalid' : '' }}" type="text" name="meta_description" id="meta_description" value="{{ old('meta_description', $review->meta_description) }}" required maxlength="500" minlength="70">
                @if($errors->has('meta_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meta_description') }}
                    </div>
                @endif
                <span class="help-block float-left">{{ trans('cruds.review.fields.meta_description_helper') }}</span>
                <div id="the-count_meta_description" class="float-right" style="">
                    <span id="meta_description_message"></span>
                    <span id="current_meta_description">0</span>
                    <span id="maximum_meta_description"> / 320</span>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
@include('admin.common.shortcodes')
<script>
    var characterCount = $('#meta_description').val().length,
        current = $('#current_meta_description'),
        maximum = $('#maximum_meta_description'),
        theCount = $('#the-count_meta_description');
    var maxlength = $('#meta_description').attr('maxlength');
    var changeColor = 0.75 * maxlength;
    current.text(characterCount);

    if (characterCount >= 500) {
        current.css('color', '#B22222');
        current.css('fontWeight', 'bold');
        $("#meta_description_message").html("{{ trans('cruds.review.fields.meta_description_500') }}");
        $("#meta_description_message").css('color', '#B22222');
        $("#meta_description_message").css('fontWeight', 'bold');
    }
    else if(characterCount > 320) {
        current.css('color', '#FF4500');
        current.css('fontWeight', 'bold');
        $("#meta_description_message").html("{{ trans('cruds.review.fields.meta_description_320') }}");
        $("#meta_description_message").css('color', '#FF4500');
        $("#meta_description_message").css('fontWeight', 'bold');
    }
    else {
        var col = maximum.css('color');
        var fontW = maximum.css('fontWeight');
        current.css('color', col);
        current.css('fontWeight', fontW);
        $("#meta_description_message").html('');
    }

    $('#meta_description').keyup(function () {
        var characterCount = $(this).val().length,
            current = $('#current_meta_description'),
            maximum = $('#maximum_meta_description'),
            theCount = $('#the-count_meta_description');
        var maxlength = $(this).attr('maxlength');
        var changeColor = 0.75 * maxlength;
        current.text(characterCount);

        if (characterCount >= 500) {
            current.css('color', '#B22222');
            current.css('fontWeight', 'bold');
            $("#meta_description_message").html("{{ trans('cruds.review.fields.meta_description_500') }}");
            $("#meta_description_message").css('color', '#B22222');
            $("#meta_description_message").css('fontWeight', 'bold');
        }
        else if(characterCount > 320) {
            current.css('color', '#FF4500');
            current.css('fontWeight', 'bold');
            $("#meta_description_message").html("{{ trans('cruds.review.fields.meta_description_320') }}");
            $("#meta_description_message").css('color', '#FF4500');
            $("#meta_description_message").css('fontWeight', 'bold');
        }
        else {
            var col = maximum.css('color');
            var fontW = maximum.css('fontWeight');
            current.css('color', col);
            current.css('fontWeight', fontW);
            $("#meta_description_message").html('');
        }
    });

    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.reviews.storeMedia') }}',
    maxFilesize: 1, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif,.webp',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 1,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($review) && $review->image)
      var file = {!! json_encode($review->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $review->image->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
<script>
    Dropzone.options.bannerImageDropzone = {
    url: '{{ route('admin.reviews.storeMedia') }}',
    maxFilesize: 1, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif,.webp',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 1,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="banner_image"]').remove()
      $('form').append('<input type="hidden" name="banner_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="banner_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($review) && $review->banner_image)
      var file = {!! json_encode($review->banner_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $review->banner_image->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="banner_image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection
