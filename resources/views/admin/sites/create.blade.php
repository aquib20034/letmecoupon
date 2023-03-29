@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.site.title_singular') }}
        </div>

        <div class="card-body" id="siteBody">
            <form method="POST" action="{{ route('admin.sites.store') }}" enctype="multipart/form-data" id="siteSubmit">
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.site.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                        id="name" value="{{ old('name', '') }}" required>
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.site.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="country_name">{{ trans('cruds.site.fields.country_name') }}</label>
                    <input class="form-control {{ $errors->has('country_name') ? 'is-invalid' : '' }}" type="text"
                        name="country_name" id="country_name" value="{{ old('country_name', '') }}" required>
                    @if ($errors->has('country_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('country_name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.site.fields.country_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="country_code">{{ trans('cruds.site.fields.country_code') }}</label>
                    <input class="form-control {{ $errors->has('country_code') ? 'is-invalid' : '' }}" type="text"
                        name="country_code" id="country_code" value="{{ old('country_code', '') }}" required>
                    @if ($errors->has('country_code'))
                        <div class="invalid-feedback">
                            {{ $errors->first('country_code') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.site.fields.country_code_helper') }}</span>
                </div>


                <div class="form-group" id="langCode">
                    <label class="required" for="language_code">{{ trans('cruds.site.fields.language_code') }}</label>
                    <select class="form-control select2" name="language_code" id="language_code" required>
                        @if (count($language) > 0)
                            @foreach ($language as $id => $item)
                                <option value="{{ $item['code'] }}"
                                    {{ old('language_code') == $item['code'] ? 'selected' : '' }}>
                                    {{ $item['language'] }}</option>
                            @endforeach
                        @else
                            <option value="en">English</option>
                        @endif
                    </select>
                    @if ($errors->has('language_code'))
                        <div class="invalid-feedback">
                            {{ $errors->first('language_code') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.site.fields.language_code_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="flag">{{ trans('cruds.site.fields.flag') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('flag') ? 'is-invalid' : '' }}" id="flag-dropzone">
                    </div>
                    @if ($errors->has('flag'))
                        <div class="invalid-feedback">
                            {{ $errors->first('flag') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.site.fields.flag_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="url">{{ trans('cruds.site.fields.url') }}</label>
                    <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url"
                        id="url" value="{{ old('url', '') }}" required>
                    @if ($errors->has('url'))
                        <div class="invalid-feedback">
                            {{ $errors->first('url') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.site.fields.url_helper') }}</span>
                </div>

                <div class="form-group">
                    <label for="html_tags">{{ trans('cruds.site.fields.html_tags') }}</label>
                    <textarea class="form-control {{ $errors->has('html_tags') ? 'is-invalid' : '' }}" name="html_tags" id="html_tags">{{ old('html_tags') }}</textarea>
                    @if ($errors->has('html_tags'))
                        <div class="invalid-feedback">
                            {{ $errors->first('html_tags') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.site.fields.html_tags_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="javascript_tags">{{ trans('cruds.site.fields.javascript_tags') }}</label>
                    <textarea class="form-control {{ $errors->has('javascript_tags') ? 'is-invalid' : '' }}" name="javascript_tags"
                        id="javascript_tags">{{ old('javascript_tags') }}</textarea>
                    @if ($errors->has('javascript_tags'))
                        <div class="invalid-feedback">
                            {{ $errors->first('javascript_tags') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.site.fields.javascript_tags_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="meta_title">{{ trans('cruds.site.fields.meta_title') }}</label>
                    <input class="form-control {{ $errors->has('meta_title') ? 'is-invalid' : '' }}" type="text"
                        name="meta_title" id="meta_title" value="{{ old('meta_title', '') }}" required>
                    @if ($errors->has('meta_title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('meta_title') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.site.fields.meta_title_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required" for="meta_keywords">{{ trans('cruds.site.fields.meta_keywords') }}</label>
                    <input class="form-control {{ $errors->has('meta_keywords') ? 'is-invalid' : '' }}" type="text"
                        name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', '') }}" required>
                    @if ($errors->has('meta_keywords'))
                        <div class="invalid-feedback">
                            {{ $errors->first('meta_keywords') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.site.fields.meta_keywords_helper') }}</span>
                </div>

                <div class="form-group">
                    <label class="required"
                        for="meta_description">{{ trans('cruds.site.fields.meta_description') }}</label>
                    <input class="form-control {{ $errors->has('meta_description') ? 'is-invalid' : '' }}" type="text"
                        name="meta_description" id="meta_description" value="{{ old('meta_description', '') }}" required
                        maxlength="500" minlength="70">
                    @if ($errors->has('meta_description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('meta_description') }}
                        </div>
                    @endif
                    <span class="help-block float-left">{{ trans('cruds.site.fields.meta_description_helper') }}</span>
                    <div id="the-count_meta_description" class="float-right" style="">
                        <span id="meta_description_message"></span>
                        <span id="current_meta_description">0</span>
                        <span id="maximum_meta_description"> / 320</span>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="form-group">
                    <label class="required" for="about_image">{{ trans('cruds.site.fields.about_us_image') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('about_image') ? 'is-invalid' : '' }}"
                        id="about-image-dropzone">
                    </div>
                    @if ($errors->has('about_image'))
                        <div class="invalid-feedback">
                            {{ $errors->first('about_image') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.site.fields.about_us_image_helper') }}</span>
                </div>

                <div class="form-group">
                    <label for="about_desc">{{ trans('cruds.site.fields.about_desc') }}</label>
                    <textarea class="form-control ckeditor {{ $errors->has('about_desc') ? 'is-invalid' : '' }}" name="about_desc"
                        id="about_desc"> {!! old('about_desc') !!} </textarea>
                    @if ($errors->has('about_desc'))
                        <div class="invalid-feedback">
                            {{ $errors->first('about_desc') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.site.fields.about_desc_helper') }}</span>
                </div>

                <div class="form-group">
                    <div class="form-check {{ $errors->has('publish') ? 'is-invalid' : '' }}">
                        <input type="hidden" name="publish" value="0">
                        <input class="form-check-input" type="checkbox" name="publish" id="publish" value="1"
                            {{ old('publish', 0) == 1 || old('publish') === null ? 'checked' : '' }}>
                        <label class="form-check-label" for="publish">{{ trans('cruds.site.fields.publish') }}</label>
                    </div>
                    @if ($errors->has('publish'))
                        <div class="invalid-feedback">
                            {{ $errors->first('publish') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.site.fields.publish_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required"
                        for="name">{{ trans('cruds.site.fields.store_heading_one_suffix') }}</label>
                    <input class="form-control {{ $errors->has('store_heading_one_suffix') ? 'is-invalid' : '' }}"
                        type="text" name="store_heading_one_suffix" id="store_heading_one_suffix"
                        value="{{ old('store_heading_one_suffix', '') }}" required>
                    @if ($errors->has('store_heading_one_suffix'))
                        <div class="invalid-feedback">
                            {{ $errors->first('store_heading_one_suffix') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.site.fields.store_heading_one_suffix_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.site.fields.primary_keyword') }}</label>
                    <input class="form-control {{ $errors->has('primary_keyword') ? 'is-invalid' : '' }}" type="text"
                        name="primary_keyword" id="primary_keyword"
                        value="{{ old('primary_keyword', '') }}" required>
                    @if ($errors->has('primary_keyword'))
                        <div class="invalid-feedback">
                            {{ $errors->first('primary_keyword') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.site.fields.primary_keyword_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.site.fields.secondary_keyword') }}</label>
                    <input class="form-control {{ $errors->has('secondary_keyword') ? 'is-invalid' : '' }}"
                        type="text" name="secondary_keyword" id="secondary_keyword"
                        value="{{ old('secondary_keyword', '') }}" required>
                    @if ($errors->has('secondary_keyword'))
                        <div class="invalid-feedback">
                            {{ $errors->first('secondary_keyword') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.site.fields.secondary_keyword_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required"
                        for="name">{{ trans('cruds.site.fields.store_meta_title_template') }}</label>
                    <input class="form-control {{ $errors->has('store_meta_title_template') ? 'is-invalid' : '' }}"
                        type="text" name="store_meta_title_template" id="store_meta_title_template"
                        value="{{ old('store_meta_title_template', '') }}" required>
                    @if ($errors->has('store_meta_title_template'))
                        <div class="invalid-feedback">
                            {{ $errors->first('store_meta_title_template') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.site.fields.store_meta_title_template_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required"
                        for="name">{{ trans('cruds.site.fields.store_meta_description_template') }}</label>
                    <input class="form-control {{ $errors->has('store_meta_description_template') ? 'is-invalid' : '' }}"
                        type="text" name="store_meta_description_template" id="store_meta_description_template"
                        value="{{ old('store_meta_description_template', '') }}"
                        required>
                    @if ($errors->has('store_meta_description_template'))
                        <div class="invalid-feedback">
                            {{ $errors->first('store_meta_description_template') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.site.fields.store_meta_description_template_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required"
                        for="name">{{ trans('cruds.site.fields.category_page_title_template') }}</label>
                    <input class="form-control {{ $errors->has('category_page_title_template') ? 'is-invalid' : '' }}"
                        type="text" name="category_page_title_template" id="category_page_title_template"
                        value="{{ old('category_page_title_template', '') }}" required>
                    @if ($errors->has('category_page_title_template'))
                        <div class="invalid-feedback">
                            {{ $errors->first('category_page_title_template') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.site.fields.category_page_title_template_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required"
                        for="name">{{ trans('cruds.site.fields.category_meta_title_template') }}</label>
                    <input class="form-control {{ $errors->has('category_meta_title_template') ? 'is-invalid' : '' }}"
                        type="text" name="category_meta_title_template" id="category_meta_title_template"
                        value="{{ old('category_meta_title_template', '') }}" required>
                    @if ($errors->has('category_meta_title_template'))
                        <div class="invalid-feedback">
                            {{ $errors->first('category_meta_title_template') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.site.fields.category_meta_title_template_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required"
                        for="name">{{ trans('cruds.site.fields.category_meta_description_template') }}</label>
                    <input
                        class="form-control {{ $errors->has('category_meta_description_template') ? 'is-invalid' : '' }}"
                        type="text" name="category_meta_description_template" id="category_meta_description_template"
                        value="{{ old('category_meta_description_template', '') }}"
                        required>
                    @if ($errors->has('category_meta_description_template'))
                        <div class="invalid-feedback">
                            {{ $errors->first('category_meta_description_template') }}
                        </div>
                    @endif
                    <span
                        class="help-block">{{ trans('cruds.site.fields.category_meta_description_template_helper') }}</span>
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
                $("#meta_description_message").html("{{ trans('cruds.site.fields.meta_description_500') }}");
                $("#meta_description_message").css('color', '#B22222');
                $("#meta_description_message").css('fontWeight', 'bold');
            } else if (characterCount > 320) {
                current.css('color', '#FF4500');
                current.css('fontWeight', 'bold');
                $("#meta_description_message").html("{{ trans('cruds.site.fields.meta_description_320') }}");
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

        Dropzone.options.flagDropzone = {
            url: '{{ route('admin.sites.storeMedia') }}',
            maxFilesize: 1, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif,.webp',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 1,
                width: 150,
                height: 150
            },
            success: function(file, response) {
                $('form').find('input[name="flag"]').remove()
                $('form').append('<input type="hidden" name="flag" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="flag"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($site) && $site->flag)
                    var file = {!! json_encode($site->flag) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, '{{ $site->flag->getUrl('thumb') }}')
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="flag" value="' + file.file_name + '">')
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
        Dropzone.options.aboutImageDropzone = {
            url: '{{ route('admin.sites.storeMedia') }}',
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
                $('form').find('input[name="about_image"]').remove()
                $('form').append('<input type="hidden" name="about_image" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="about_image"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($site) && $site->about_image)
                    var file = {!! json_encode($site->about_image) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, '{{ $site->about_image->getUrl('thumb') }}')
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="about_image" value="' + file.file_name + '">')
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
