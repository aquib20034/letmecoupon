@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.websiteSetting.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.website-settings.store') }}" enctype="multipart/form-data"
                id="permissionForm">
                @csrf

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="primary_color">Primary Color</label>
                        <input class="form-control {{ $errors->has('primary_color') ? 'is-invalid' : '' }}" type="text"
                            name="primary_color" id="primary_color"
                            value="{{ old('primary_color', '') }}">
                        @if ($errors->has('primary_color'))
                            <div class="invalid-feedback">
                                {{ $errors->first('primary_color') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="secondary_color">Secondary Color</label>
                        <input class="form-control {{ $errors->has('secondary_color') ? 'is-invalid' : '' }}" type="text"
                            name="secondary_color" id="secondary_color"
                            value="{{ old('secondary_color', '') }}">
                        @if ($errors->has('secondary_color'))
                            <div class="invalid-feedback">
                                {{ $errors->first('secondary_color') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tertiary_color">Tertiary Color</label>
                        <input class="form-control {{ $errors->has('tertiary_color') ? 'is-invalid' : '' }}" type="text"
                            name="tertiary_color" id="tertiary_color"
                            value="{{ old('tertiary_color', '') }}">
                        @if ($errors->has('tertiary_color'))
                            <div class="invalid-feedback">
                                {{ $errors->first('tertiary_color') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="linked_in">{{ trans('cruds.websiteSetting.fields.linked_in') }}</label>
                        <input class="form-control {{ $errors->has('linked_in') ? 'is-invalid' : '' }}" type="text"
                            name="linked_in" id="linked_in" value="{{ old('linked_in', '') }}">
                        @if ($errors->has('linked_in'))
                            <div class="invalid-feedback">
                                {{ $errors->first('linked_in') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.websiteSetting.fields.linked_in_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="facebook">{{ trans('cruds.websiteSetting.fields.facebook') }}</label>
                        <input class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}" type="text"
                            name="facebook" id="facebook" value="{{ old('facebook', '') }}">
                        @if ($errors->has('facebook'))
                            <div class="invalid-feedback">
                                {{ $errors->first('facebook') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.websiteSetting.fields.facebook_helper') }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="youtube">{{ trans('cruds.websiteSetting.fields.youtube') }}</label>
                        <input class="form-control {{ $errors->has('youtube') ? 'is-invalid' : '' }}" type="text"
                            name="youtube" id="youtube" value="{{ old('youtube', '') }}">
                        @if ($errors->has('youtube'))
                            <div class="invalid-feedback">
                                {{ $errors->first('youtube') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.websiteSetting.fields.youtube_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="instagram">{{ trans('cruds.websiteSetting.fields.instagram') }}</label>
                        <input class="form-control {{ $errors->has('instagram') ? 'is-invalid' : '' }}" type="text"
                            name="instagram" id="instagram" value="{{ old('instagram', '') }}">
                        @if ($errors->has('instagram'))
                            <div class="invalid-feedback">
                                {{ $errors->first('instagram') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.websiteSetting.fields.instagram_helper') }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="pinterest">{{ trans('cruds.websiteSetting.fields.pinterest') }}</label>
                        <input class="form-control {{ $errors->has('pinterest') ? 'is-invalid' : '' }}" type="text"
                            name="pinterest" id="pinterest" value="{{ old('pinterest', '') }}">
                        @if ($errors->has('pinterest'))
                            <div class="invalid-feedback">
                                {{ $errors->first('pinterest') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.websiteSetting.fields.pinterest_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="twitter">{{ trans('cruds.websiteSetting.fields.twitter') }}</label>
                        <input class="form-control {{ $errors->has('twitter') ? 'is-invalid' : '' }}" type="text"
                            name="twitter" id="twitter" value="{{ old('twitter', '') }}">
                        @if ($errors->has('twitter'))
                            <div class="invalid-feedback">
                                {{ $errors->first('twitter') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.websiteSetting.fields.twitter_helper') }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="required" for="logo">{{ trans('cruds.websiteSetting.fields.logo') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('logo') ? 'is-invalid' : '' }}" id="logo-dropzone">
                        </div>
                        @if ($errors->has('logo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('logo') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.websiteSetting.fields.logo_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required" for="favicon">{{ trans('cruds.websiteSetting.fields.favicon') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('favicon') ? 'is-invalid' : '' }}"
                            id="favicon-dropzone">
                        </div>
                        @if ($errors->has('favicon'))
                            <div class="invalid-feedback">
                                {{ $errors->first('favicon') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.websiteSetting.fields.favicon_helper') }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title">{{ trans('cruds.websiteSetting.fields.site_javascript') }}</label>
                    <textarea class="form-control {{ $errors->has('site_javascript') ? 'is-invalid' : '' }}" name="site_javascript"
                        id="site_javascript">{{ old('site_javascript', '') }}</textarea>
                    @if ($errors->has('site_javascript'))
                        <div class="invalid-feedback">
                            {{ $errors->first('site_javascript') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.websiteSetting.fields.site_javascript_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="title">{{ trans('cruds.websiteSetting.fields.site_html_tags') }}</label>
                    <textarea class="form-control {{ $errors->has('site_html_tags') ? 'is-invalid' : '' }}" type="text"
                        name="site_html_tags" id="site_html_tags">{{ old('site_html_tags', '') }}</textarea>
                    @if ($errors->has('site_html_tags'))
                        <div class="invalid-feedback">
                            {{ $errors->first('site_html_tags') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.websiteSetting.fields.site_html_tags_helper') }}</span>
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
        Dropzone.options.logoDropzone = {
            url: '{{ route('admin.website-settings.storeMedia') }}',
            maxFilesize: 1, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif,.webp,.svg',
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
                $('form').find('input[name="logo"]').remove()
                $('form').append('<input type="hidden" name="logo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="logo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($websiteSetting) && $websiteSetting->logo)
                    var file = {!! json_encode($websiteSetting->logo) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, '{{ $websiteSetting->logo->getUrl('thumb') }}')
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="logo" value="' + file.file_name + '">')
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
        Dropzone.options.faviconDropzone = {
            url: '{{ route('admin.website-settings.storeMedia') }}',
            maxFilesize: 1, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif,.webp,.svg',
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
                $('form').find('input[name="favicon"]').remove()
                $('form').append('<input type="hidden" name="favicon" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="favicon"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($websiteSetting) && $websiteSetting->favicon)
                    var file = {!! json_encode($websiteSetting->favicon) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, '{{ $websiteSetting->favicon->getUrl('thumb') }}')
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="favicon" value="' + file.file_name + '">')
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
