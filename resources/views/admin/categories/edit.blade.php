@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.category.title_singular') }}
        </div>

        <div class="card-body">
            <input type="hidden" data-name="edit_id" value="{{ $category->id }}" class="edit_id">
            <form method="POST" action="{{ route('admin.categories.update', [$category->id]) }}" enctype="multipart/form-data"
                id="categoryForm">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="sites">{{ trans('cruds.category.fields.site') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all"
                            style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all"
                            style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('sites') ? 'is-invalid' : '' }}" name="sites[]"
                        id="sites" multiple required>
                        @foreach ($sites as $id => $site)
                            <option value="{{ $id }}"
                                {{ in_array($id, old('sites', [])) || $category->sites->contains($id) ? 'selected' : '' }}>
                                {{ $site }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('sites'))
                        <div class="invalid-feedback">
                            {{ $errors->first('sites') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.category.fields.site_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="title">{{ trans('cruds.category.fields.title') }}</label>
                    <input class="form-control auto_slug {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text"
                        name="title" id="title" data-target_controller="category"
                        value="{{ old('title', $category->title) }}" required>
                    @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.category.fields.title_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="slug">{{ trans('cruds.category.fields.slug') }}</label>
                    <div class="row">
                        <div class="col-lg-2">
                            <input type="text" value="categories/" disabled class="form-control">
                        </div>
                        <div class="col-lg-10">
                            @if (count(explode('/', $category->slugs->slug)) > 2)
                                <input class="form-control org_slug {{ $errors->has('slug') ? 'is-invalid' : '' }}"
                                    type="text" name="slug" id="slug" value="{!! old(
                                        'slug',
                                        str_replace('categories/', '', isset($category->slugs->slug) ? explode('/', $category->slugs->slug)[2] : ''),
                                    ) !!}" required>
                            @else
                                <input class="form-control org_slug {{ $errors->has('slug') ? 'is-invalid' : '' }}"
                                    type="text" name="slug" id="slug" value="{!! old('slug', str_replace('categories/', '', isset($category->slugs->slug) ? $category->slugs->slug : '')) !!}" required>
                            @endif
                            @if ($errors->has('slug'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('slug') }}
                                </div>
                            @endif
                        </div>
                        @php
                            $end_val_slug = null;
                            if (isset($category->slugs->slug)) {
                                $cat_slug = explode('/', str_replace('categories/', '', $category->slugs->slug));
                                if (count($cat_slug) != 1) {
                                    $end_val_slug = $cat_slug[0] . '/';
                                } else {
                                    $end_val_slug = null;
                                }
                            }
                        @endphp
                        <input type="hidden" id="parnt_slug" name="parnt_slug" value="{{ $end_val_slug }}" />
                    </div>
                    <span class="help-block">{{ trans('cruds.category.fields.slug_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="parent_id">{{ trans('cruds.category.fields.parent') }}</label>
                    <select class="form-control select2 {{ $errors->has('parent') ? 'is-invalid' : '' }}" name="parent_id"
                        id="parent_id">
                        @foreach ($parents as $id => $parent)
                            <option value="{{ $id }}"
                                {{ ($category->parent ? $category->parent->id : old('parent_id')) == $id ? 'selected' : '' }}>
                                {{ $parent }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('parent_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('parent_id') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.category.fields.parent_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required"
                        for="short_description">{{ trans('cruds.category.fields.short_description') }}</label>
                    <textarea class="form-control ckeditor {{ $errors->has('short_description') ? 'is-invalid' : '' }}"
                        name="short_description" id="short_description" required>{{ old('short_description', $category->short_description) }}</textarea>
                    @if ($errors->has('short_description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('short_description') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.category.fields.short_description_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="long_description">{{ trans('cruds.category.fields.long_description') }}</label>
                    <textarea class="form-control ckeditor {{ $errors->has('long_description') ? 'is-invalid' : '' }}"
                        name="long_description" id="long_description">{{ old('long_description', $category->long_description) }}</textarea>
                    @if ($errors->has('long_description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('long_description') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.category.fields.long_description_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="image">{{ trans('cruds.category.fields.image') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                    </div>
                    @if ($errors->has('image'))
                        <div class="invalid-feedback">
                            {{ $errors->first('image') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.category.fields.image_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="category_banner_image">{{ trans('cruds.category.fields.category_banner_image') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('category_banner_image') ? 'is-invalid' : '' }}"
                        id="category-banner-image-dropzone">
                    </div>
                    @if ($errors->has('category_banner_image'))
                        <div class="invalid-feedback">
                            {{ $errors->first('category_banner_image') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.category.fields.image_helper') }}</span>
                </div>

                <div class="form-group">
                    <label for="category_coupon_image">{{ trans('cruds.category.fields.category_coupon_image') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('category_coupon_image') ? 'is-invalid' : '' }}"
                        id="category-coupon-image-dropzone">
                    </div>
                    @if ($errors->has('category_coupon_image'))
                        <div class="invalid-feedback">
                            {{ $errors->first('category_coupon_image') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.category.fields.category_coupon_image_helper') }}</span>
                </div>

                <div class="form-group">
                    <label for="category_blog_image">{{ trans('cruds.category.fields.category_blog_image') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('category_blog_image') ? 'is-invalid' : '' }}"
                        id="category-blog-image-dropzone">
                    </div>
                    @if ($errors->has('category_blog_image'))
                        <div class="invalid-feedback">
                            {{ $errors->first('category_blog_image') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.category.fields.category_blog_image_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="sort">{{ trans('cruds.category.fields.sort') }}</label>
                    <input class="form-control {{ $errors->has('sort') ? 'is-invalid' : '' }}" type="number"
                        name="sort" id="sort" value="{{ old('sort', $category->sort) }}" step="1"
                        required>
                    @if ($errors->has('sort'))
                        <div class="invalid-feedback">
                            {{ $errors->first('sort') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.category.fields.sort_helper') }}</span>
                </div>
                <div class="form-group">
                    <div class="form-check {{ $errors->has('featured') ? 'is-invalid' : '' }}">
                        <input type="hidden" name="featured" value="0">
                        <input class="form-check-input" type="checkbox" name="featured" id="featured" value="1"
                            {{ $category->featured || old('featured', 0) === 1 ? 'checked' : '' }}>
                        <label class="form-check-label"
                            for="featured">{{ trans('cruds.category.fields.featured') }}</label>
                    </div>
                    @if ($errors->has('featured'))
                        <div class="invalid-feedback">
                            {{ $errors->first('featured') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.category.fields.featured_helper') }}</span>
                </div>
                <div class="form-group">
                    <div class="form-check {{ $errors->has('popular') ? 'is-invalid' : '' }}">
                        <input type="hidden" name="popular" value="0">
                        <input class="form-check-input" type="checkbox" name="popular" id="popular" value="1"
                            {{ $category->popular || old('popular', 0) === 1 ? 'checked' : '' }}>
                        <label class="form-check-label"
                            for="popular">{{ trans('cruds.category.fields.popular') }}</label>
                    </div>
                    @if ($errors->has('popular'))
                        <div class="invalid-feedback">
                            {{ $errors->first('popular') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.category.fields.popular_helper') }}</span>
                </div>
                <div class="form-group">
                    <div class="form-check {{ $errors->has('publish') ? 'is-invalid' : '' }}">
                        <input type="hidden" name="publish" value="0">
                        <input class="form-check-input" type="checkbox" name="publish" id="publish" value="1"
                            {{ $category->publish || old('publish', 0) === 1 ? 'checked' : '' }}>
                        <label class="form-check-label"
                            for="publish">{{ trans('cruds.category.fields.publish') }}</label>
                    </div>
                    @if ($errors->has('publish'))
                        <div class="invalid-feedback">
                            {{ $errors->first('publish') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.category.fields.publish_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="meta_title">{{ trans('cruds.category.fields.meta_title') }}</label>
                    <input class="form-control {{ $errors->has('meta_title') ? 'is-invalid' : '' }}" type="text"
                        name="meta_title" id="meta_title" value="{{ old('meta_title', $category->meta_title) }}"
                        required>
                    @if ($errors->has('meta_title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('meta_title') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.category.fields.meta_title_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required"
                        for="meta_keywords">{{ trans('cruds.category.fields.meta_keywords') }}</label>
                    <input class="form-control {{ $errors->has('meta_keywords') ? 'is-invalid' : '' }}" type="text"
                        name="meta_keywords" id="meta_keywords"
                        value="{{ old('meta_keywords', $category->meta_keywords) }}" required>
                    @if ($errors->has('meta_keywords'))
                        <div class="invalid-feedback">
                            {{ $errors->first('meta_keywords') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.category.fields.meta_keywords_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required"
                        for="meta_description">{{ trans('cruds.category.fields.meta_description') }}</label>
                    <input class="form-control {{ $errors->has('meta_description') ? 'is-invalid' : '' }}" type="text"
                        name="meta_description" id="meta_description"
                        value="{{ old('meta_description', $category->meta_description) }}" required maxlength="500"
                        minlength="70">
                    @if ($errors->has('meta_description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('meta_description') }}
                        </div>
                    @endif
                    <span
                        class="help-block float-left">{{ trans('cruds.category.fields.meta_description_helper') }}</span>
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
            $("#meta_description_message").html("{{ trans('cruds.category.fields.meta_description_500') }}");
            $("#meta_description_message").css('color', '#B22222');
            $("#meta_description_message").css('fontWeight', 'bold');
        } else if (characterCount > 320) {
            current.css('color', '#FF4500');
            current.css('fontWeight', 'bold');
            $("#meta_description_message").html("{{ trans('cruds.category.fields.meta_description_320') }}");
            $("#meta_description_message").css('color', '#FF4500');
            $("#meta_description_message").css('fontWeight', 'bold');
        } else {
            var col = maximum.css('color');
            var fontW = maximum.css('fontWeight');
            current.css('color', col);
            current.css('fontWeight', fontW);
            $("#meta_description_message").html('');
        }

        $('#meta_description').keyup(function() {
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
                $("#meta_description_message").html("{{ trans('cruds.category.fields.meta_description_500') }}");
                $("#meta_description_message").css('color', '#B22222');
                $("#meta_description_message").css('fontWeight', 'bold');
            } else if (characterCount > 320) {
                current.css('color', '#FF4500');
                current.css('fontWeight', 'bold');
                $("#meta_description_message").html("{{ trans('cruds.category.fields.meta_description_320') }}");
                $("#meta_description_message").css('color', '#FF4500');
                $("#meta_description_message").css('fontWeight', 'bold');
            } else {
                var col = maximum.css('color');
                var fontW = maximum.css('fontWeight');
                current.css('color', col);
                current.css('fontWeight', fontW);
                $("#meta_description_message").html('');
            }
        });

        Dropzone.options.imageDropzone = {
            url: '{{ route('admin.categories.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif,.webp',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="image"]').remove()
                $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="image"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($category) && $category->image)
                    var file = {!! json_encode($category->image) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, '{{ $category->image->getUrl('thumb') }}')
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
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
        Dropzone.options.iconDropzone = {
            url: '{{ route('admin.categories.storeMedia') }}',
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
            success: function(file, response) {
                $('form').find('input[name="icon"]').remove()
                $('form').append('<input type="hidden" name="icon" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="icon"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($category) && $category->icon)
                    var file = {!! json_encode($category->icon) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, '{{ $category->icon->getUrl('thumb') }}')
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="icon" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
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
        $(document).ready(function() {
            $('#parent_id').change(function() {
                var cat_id = $(this).val();
                //var current_cat_slug = $("#current_cat_slug").val();
                var post_url = "{!! config('app.app_path') . '/get-category-name' !!}";
                $_token = "{{ csrf_token() }}";
                $.ajax({
                    url: post_url,
                    type: 'GET',
                    data: {
                        "cat_id": cat_id
                    }
                }).done(function(response) {
                    var cat_slug = response.toLowerCase().replace("categories/", "");
                    var parnt_slug = $('#parnt_slug').attr("value", cat_slug);
                    //$('.org_slug').attr("value", parnt_slug + current_cat_slug);
                    /*$(".org_slug").val(function() {
                        return cat_slug+'/'+original_slug_val;
                    });*/
                });
            });
        });



        Dropzone.options.categoryBannerImageDropzone = {
            url: '{{ route('admin.categories.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif,.webp',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="category_banner_image"]').remove()
                $('form').append('<input type="hidden" name="category_banner_image" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="category_banner_image"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($category) && $category->category_banner_image)
                    var file = {!! json_encode($category->category_banner_image) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file,
                        '{{ $category->category_banner_image->getUrl('thumb') }}')
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="category_banner_image" value="' + file.file_name +
                        '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
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

        Dropzone.options.categoryCouponImageDropzone = {
            url: '{{ route('admin.categories.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif,.webp',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="category_coupon_image"]').remove()
                $('form').append('<input type="hidden" name="category_coupon_image" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="category_coupon_image"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($category) && $category->category_coupon_image)
                    var file = {!! json_encode($category->category_coupon_image) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file,
                        '{{ $category->category_coupon_image->getUrl('thumb') }}')
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="category_coupon_image" value="' + file.file_name +
                        '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
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

        Dropzone.options.categoryBlogImageDropzone = {
            url: '{{ route('admin.categories.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif,.webp',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="category_blog_image"]').remove()
                $('form').append('<input type="hidden" name="category_blog_image" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="category_blog_image"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($category) && $category->category_blog_image)
                    var file = {!! json_encode($category->category_blog_image) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file,
                        '{{ $category->category_blog_image->getUrl('thumb') }}')
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="category_blog_image" value="' + file.file_name +
                        '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
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
