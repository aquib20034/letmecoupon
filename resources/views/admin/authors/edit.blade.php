@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.author.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.authors.update", [$author->id]) }}" enctype="multipart/form-data" id="authorForm">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="sites">{{ trans('cruds.author.fields.site') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('sites') ? 'is-invalid' : '' }}" name="sites[]" id="sites" multiple required>
                    @foreach($sites as $id => $site)
                        <option value="{{ $id }}" {{ (in_array($id, old('sites', [])) ? 'selected' : (in_array($id, [getSiteID()]))) ? 'selected' : '' }}>{{ $site }}</option>
                    @endforeach
                </select>
                @if($errors->has('sites'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sites') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.author.fields.site_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="first_name">{{ trans('cruds.author.fields.first_name') }}</label>
                <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', $author->first_name) }}">
                @if($errors->has('first_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('first_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.author.fields.first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="last_name">{{ trans('cruds.author.fields.last_name') }}</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', $author->last_name) }}">
                @if($errors->has('last_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.author.fields.last_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.author.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $author->email) }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.author.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.author.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="phone" name="phone" id="phone" value="{{ old('phone', $author->phone) }}">
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.author.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="type">{{ trans('cruds.author.fields.type') }}</label>
                <select class="form-control select2" name="type" id="type">
                    @if (count($author_types) > 0)
                        @foreach ($author_types as $id => $type)
                            <option value="{{ $id }}"
                                {{ old('type') == $id ? 'selected' : ($author->type == $id ? 'selected' : '') }}>
                                {{ $type }}</option>
                        @endforeach
                    @else
                        <option value="1">Blogger</option>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="facebook_url">{{ trans('cruds.author.fields.facebook_url') }}</label>
                <input class="form-control {{ $errors->has('facebook_url') ? 'is-invalid' : '' }}" type="facebook_url" name="facebook_url" id="facebook_url" value="{{ old('facebook_url', $author->facebook_url) }}">
            </div>
            <div class="form-group">
                <label for="instagram_url">{{ trans('cruds.author.fields.instagram_url') }}</label>
                <input class="form-control {{ $errors->has('instagram_url') ? 'is-invalid' : '' }}" type="instagram_url" name="instagram_url" id="instagram_url" value="{{ old('instagram_url', $author->instagram_url) }}">
            </div>
            <div class="form-group">
                <label for="linkedin_url">{{ trans('cruds.author.fields.linkedin_url') }}</label>
                <input class="form-control {{ $errors->has('linkedin_url') ? 'is-invalid' : '' }}" type="linkedin_url" name="linkedin_url" id="linkedin_url" value="{{ old('linkedin_url', $author->linkedin_url) }}">
            </div>
            <div class="form-group">
                <label for="twitter_url">{{ trans('cruds.author.fields.twitter_url') }}</label>
                <input class="form-control {{ $errors->has('twitter_url') ? 'is-invalid' : '' }}" type="twitter_url" name="twitter_url" id="twitter_url" value="{{ old('twitter_url', $author->twitter_url) }}">
            </div>
            <div class="form-group">
                <label for="languages">{{ trans('cruds.author.fields.language') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('languages') ? 'is-invalid' : '' }}" name="languages[]" id="languages" multiple>
                    @foreach($languages as $id => $language)
                        <option value="{{ $id }}" {{ (in_array($id, old('languages', [])) || $author->languages->contains($id) ? 'selected' : '') }}>{{ $language }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="short_description">{{ trans('cruds.author.fields.short_description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('short_description') ? 'is-invalid' : '' }}" name="short_description" id="short_description">{!! old('short_description',$author->short_description) !!}</textarea>
                @if($errors->has('short_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('short_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.author.fields.short_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="long_description">{{ trans('cruds.author.fields.long_description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('long_description') ? 'is-invalid' : '' }}" name="long_description" id="long_description">{!! old('long_description',$author->long_description) !!}</textarea>
                @if($errors->has('long_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('long_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.author.fields.long_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="image">{{ trans('cruds.author.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.author.fields.image_helper') }}</span>
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
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.authors.storeMedia') }}',
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
@if(isset($author) && $author->image)
      var file = {!! json_encode($author->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $author->image->getUrl('thumb') }}')
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
    Dropzone.options.storeImageDropzone = {
    url: '{{ route('admin.authors.storeMedia') }}',
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
      $('form').find('input[name="store_image"]').remove()
      $('form').append('<input type="hidden" name="store_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="store_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($author) && $author->store_image)
      var file = {!! json_encode($author->store_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $author->store_image->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="store_image" value="' + file.file_name + '">')
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
    Dropzone.options.mobileImageDropzone = {
    url: '{{ route('admin.authors.storeMedia') }}',
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
      $('form').find('input[name="mobile_image"]').remove()
      $('form').append('<input type="hidden" name="mobile_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="mobile_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($author) && $author->mobile_image)
      var file = {!! json_encode($author->mobile_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $author->mobile_image->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="mobile_image" value="' + file.file_name + '">')
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
