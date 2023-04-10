@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.store.title_singular') }}
    </div>

    <div class="card-body">
              <input type="hidden" data-name="edit_id" value="{{ $store->id }}" class="edit_id">
        <form method="POST" action="{{ route("admin.stores.update", [$store->id]) }}" enctype="multipart/form-data" id="storesForm">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="sites">{{ trans('cruds.store.fields.site') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('sites') ? 'is-invalid' : '' }}" name="sites[]" id="sites" multiple required>
                    @foreach($sites as $id => $site)
                        <option value="{{ $id }}" {{ (in_array($id, old('sites', [])) || $store->sites->contains($id)) ? 'selected' : '' }}>{{ $site }}</option>
                    @endforeach
                </select>
                @if($errors->has('sites'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sites') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.site_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.store.fields.name') }}</label>
                <input class="form-control auto_slug {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" data-target_controller="store" value="{{ old('name', $store->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="store_url">{{ trans('cruds.store.fields.store_url') }}</label>
                <input class="form-control {{ $errors->has('store_url') ? 'is-invalid' : '' }}" type="text" name="store_url" id="store_url" value="{{ old('store_url', $store->store_url) }}" required>
                @if($errors->has('store_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('store_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.store_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="affiliate_url">{{ trans('cruds.store.fields.affiliate_url') }}</label>
                <input class="form-control {{ $errors->has('affiliate_url') ? 'is-invalid' : '' }}" type="text" name="affiliate_url" id="affiliate_url" value="{{ old('affiliate_url', $store->affiliate_url) }}">
                @if($errors->has('affiliate_url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('affiliate_url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.affiliate_url_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="rating">{{ trans('cruds.store.fields.rating') }}</label>
                <input class="form-control {{ $errors->has('rating') ? 'is-invalid' : '' }}" type="number" name="rating" id="rating" value="{{ old('rating', $store->rating) }}" min="1" max="5" >
                @if($errors->has('rating'))
                    <div class="invalid-feedback">
                        {{ $errors->first('rating') }}
                    </div>
                @endif
                <div class="help-block" id="ratingError" style="color: red;"></div>
                <span class="help-block">{{ trans('cruds.store.fields.rating_helper') }}</span>
            </div>             
            <div class="form-group">
                <label class="required" for="slug">{{ trans('cruds.store.fields.slug') }}</label>
                @if(!empty($slug[0]['old_slug']))
                <input class="form-control org_slug {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', $slug[0]['old_slug']) }}" required>
                @else
                <input class="form-control org_slug {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', $slug[0]['slug']) }}" required>
                @endif
                @if($errors->has('slug'))
                    <div class="invalid-feedback">
                        {{ $errors->first('slug') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.slug_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="old_slug">New Slug</label>
                @if(!empty($slug[0]['old_slug']))
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="old_slug" id="old_slug" value="{{ old('slug', $slug[0]['slug']) }}">
                @else
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="old_slug" id="old_slug" value="{{ old('slug', $slug[0]['old_slug']) }}">
                @endif

                @if($errors->has('old_slug'))
                    <div class="invalid-feedback">
                        {{ $errors->first('old_slug') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.slug_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="categories">{{ trans('cruds.store.fields.category') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ (in_array($id, old('categories', [])) || $store->categories->contains($id)) ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('categories'))
                    <div class="invalid-feedback">
                        {{ $errors->first('categories') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="short_description">{{ trans('cruds.store.fields.short_description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('short_description') ? 'is-invalid' : '' }}" name="short_description" id="short_description" required>{{ old('short_description', $store->short_description) }}</textarea>
                @if($errors->has('short_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('short_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.short_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="long_description">{{ trans('cruds.store.fields.long_description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('long_description') ? 'is-invalid' : '' }}" name="long_description" id="long_description">{{ old('long_description', $store->long_description) }}</textarea>
                @if($errors->has('long_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('long_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.long_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="image">{{ trans('cruds.store.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.image_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="trendingcouponimage">{{ trans('cruds.store.fields.trendingcouponimage') }}</label>
                <div class="needsclick dropzone {{ $errors->has('trendingcouponimage') ? 'is-invalid' : '' }}" id="trendingImage-dropzone">
                </div>
                @if($errors->has('trendingcouponimage'))
                    <div class="invalid-feedback">
                        {{ $errors->first('trendingcouponimage') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.trendingcouponimage_helper') }}</span>
            </div>

            <div class="form-group">
                <div class="form-check {{ $errors->has('featured') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="featured" value="0">
                    <input class="form-check-input" type="checkbox" name="featured" id="featured" value="1" {{ $store->featured || old('featured', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="featured">{{ trans('cruds.store.fields.featured') }}</label>
                </div>
                @if($errors->has('featured'))
                    <div class="invalid-feedback">
                        {{ $errors->first('featured') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.featured_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('popular') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="popular" value="0">
                    <input class="form-check-input" type="checkbox" name="popular" id="popular" value="1" {{ $store->popular || old('popular', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="popular">{{ trans('cruds.store.fields.popular') }}</label>
                </div>
                @if($errors->has('popular'))
                    <div class="invalid-feedback">
                        {{ $errors->first('popular') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.popular_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('publish') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="publish" value="0">
                    <input class="form-check-input" type="checkbox" name="publish" id="publish" value="1" {{ $store->publish || old('publish', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="publish">{{ trans('cruds.store.fields.publish') }}</label>
                </div>
                @if($errors->has('publish'))
                    <div class="invalid-feedback">
                        {{ $errors->first('publish') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.publish_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('affiliate_url_update') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="affiliate_url_update" value="0">
                    <input class="form-check-input" type="checkbox" name="affiliate_url_update" id="affiliate_url_update" value="1" {{ $store->affiliate_url_update || old('affiliate_url_update', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="affiliate_url_update">{{ trans('cruds.store.fields.affiliate_url_update') }}</label>
                </div>
                @if($errors->has('affiliate_url_update'))
                    <div class="invalid-feedback">
                        {{ $errors->first('affiliate_url_update') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.affiliate_url_update_helper') }}</span>
            </div>                    
            <div class="form-group">
                <label class="required" for="meta_title">{{ trans('cruds.store.fields.meta_title') }}</label>
                <input class="form-control {{ $errors->has('meta_title') ? 'is-invalid' : '' }}" type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $store->meta_title) }}" required>
                @if($errors->has('meta_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meta_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.meta_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="meta_keywords">{{ trans('cruds.store.fields.meta_keywords') }}</label>
                <input class="form-control {{ $errors->has('meta_keywords') ? 'is-invalid' : '' }}" type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', $store->meta_keywords) }}" required>
                @if($errors->has('meta_keywords'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meta_keywords') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.meta_keywords_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="meta_description">{{ trans('cruds.store.fields.meta_description') }}</label>
                <input class="form-control {{ $errors->has('meta_description') ? 'is-invalid' : '' }}" type="text" name="meta_description" id="meta_description" value="{{ old('meta_description', $store->meta_description) }}" required maxlength="500" minlength="70">
                @if($errors->has('meta_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meta_description') }}
                    </div>
                @endif
                <span class="help-block float-left">{{ trans('cruds.store.fields.meta_description_helper') }}</span>
                <div id="the-count_meta_description" class="float-right" style="">
                    <span id="meta_description_message"></span>
                    <span id="current_meta_description">0</span>
                    <span id="maximum_meta_description"> / 320</span>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <label for="sort">{{ trans('cruds.store.fields.sort') }}</label>
                <input class="form-control {{ $errors->has('sort') ? 'is-invalid' : '' }}" type="number" name="sort" id="sort" value="{{ old('sort', $store->sort) }}" step="1">
                @if($errors->has('sort'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sort') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.sort_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="flashbanner">Flash Banner</label>
                <textarea class="form-control {{ $errors->has('flashbanner') ? 'is-invalid' : '' }}" name="flashbanner" id="flashbanner">{{ old('flashbanner', $store->flashbanner) }}</textarea>
                @if($errors->has('flashbanner'))
                    <div class="invalid-feedback">
                        {{ $errors->first('flashbanner') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>

            <div class="form-group">
                <label for="html_tags">{{ trans('cruds.store.fields.html_tags') }}</label>
                <textarea class="form-control {{ $errors->has('html_tags') ? 'is-invalid' : '' }}" name="html_tags" id="html_tags">{{ old('html_tags', $store->html_tags) }}</textarea>
                @if($errors->has('html_tags'))
                    <div class="invalid-feedback">
                        {{ $errors->first('html_tags') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.html_tags_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="script_tags">{{ trans('cruds.store.fields.script_tags') }}</label>
                <textarea class="form-control {{ $errors->has('script_tags') ? 'is-invalid' : '' }}" name="script_tags" id="script_tags">{{ old('script_tags', $store->script_tags) }}</textarea>
                @if($errors->has('script_tags'))
                    <div class="invalid-feedback">
                        {{ $errors->first('script_tags') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.script_tags_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.store.fields.template') }}</label>
                <select class="form-control {{ $errors->has('template') ? 'is-invalid' : '' }}" name="template" id="template">
                    <option value disabled {{ old('template', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Store::TEMPLATE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('template', $store->template) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('template'))
                    <div class="invalid-feedback">
                        {{ $errors->first('template') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.store.fields.template_helper') }}</span>
            </div>

            <div class="faq-question-answer">

                @php
                    $faqData = json_decode($store->faq_json, true);
                    $questions = old('question', '');
                    $answers = old('answer', '');
                @endphp

                <div class="form-group">
                    @if(!empty($faqData) || $questions)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="enable_faq" id="enable_faq" value="1" {{ old('enable_faq', 0) == 1 || old('enable_faq') == null ? 'checked' : '' }}>
                            <label class="form-check-label" for="enable_faq">{{ trans('cruds.store.fields.enable_faq') }}</label>
                        </div>
                    @else
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="enable_faq" id="enable_faq" value="1" {{ old('enable_faq', 0) == 1 || old('enable_faq') ? 'checked' : '' }}>
                            <label class="form-check-label" for="enable_faq">{{ trans('cruds.store.fields.enable_faq') }}</label>
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.store.fields.enable_faq_helper') }}</span>
                </div>

                <div class="form-group">
                    <label for="faq_title">{{ trans('cruds.store.fields.faq_title') }}</label>
                    <input class="form-control {{ $errors->has('faq_title') ? 'is-invalid' : '' }}" type="text" name="faq_title" id="faq_title" value="{{ old('faq_title', $store->faq_title) }}" @if(!$questions) @if(empty($faqData)) disabled @endif @endif>
                    @if($errors->has('faq_title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('faq_title') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.store.fields.faq_title_helper') }}</span>
                </div>

                @if(!empty($faqData))
                    @foreach($faqData as $key => $faq)
                        <div id="faqContent{{ $key }}">
                            <div class="form-group">
                                <label for="question{{ $key }}">{{ trans('cruds.store.fields.question') }}</label>
                                <input class="form-control question {{ $errors->has('question') ? 'is-invalid' : '' }}" type="text" name="question[]" id="question{{ $key }}" value="{!! $faq['question'] !!}" required>
                                @if($errors->has('question'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('question') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.store.fields.question_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="answer{{ $key }}">{{ trans('cruds.store.fields.answer') }}</label>
                                <textarea class="form-control answer {{ $errors->has('answer') ? 'is-invalid' : '' }}" name="answer[]" id="answer{{ $key }}" required>{!! $faq['answer'] !!}</textarea>
                                @if($errors->has('answer'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('answer') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.store.fields.answer_helper') }}</span>
                            </div>
                            @if($key > 0)
                                <div class="form-group">
                                    <button class="btn btn-danger removeBttn" type="button" onclick="removeMore({{ $key }})">
                                        {{ trans('cruds.store.fields.remove_more') }}
                                    </button>
                                </div>
                            @endif
                            <hr />
                        </div>
                    @endforeach
                @else

                    @if($questions)
                        @foreach($questions as $key => $question)
                            <div id="faqContent{{ $key }}">
                                <div class="form-group">
                                    <label for="question">{{ trans('cruds.store.fields.question') }}</label>
                                    <input class="form-control question {{ $errors->has('question') ? 'is-invalid' : '' }}" type="text" name="question[]" id="question{{ $key }}" value="{{ $question }}" required>
                                    @if($errors->has('question'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('question') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.store.fields.question_helper') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="answer">{{ trans('cruds.store.fields.answer') }}</label>
                                    <textarea class="form-control answer {{ $errors->has('answer') ? 'is-invalid' : '' }}" name="answer[]" id="answer{{ $key }}" required>{!! $answers[$key] !!}</textarea>
                                    @if($errors->has('answer'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('answer') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.store.fields.answer_helper') }}</span>
                                </div>

                                @if($key > 0)
                                    <div class="form-group">
                                        <button class="btn btn-danger removeBttn" type="button" onclick="removeMore({{ $key }})">
                                            {{ trans('cruds.store.fields.remove_more') }}
                                        </button>
                                    </div>
                                @endif

                                <hr />
                            </div>
                        @endforeach
                    @else
                        <div class="form-group">
                            <label for="question">{{ trans('cruds.store.fields.question') }}</label>
                            <input class="form-control question {{ $errors->has('question') ? 'is-invalid' : '' }}" type="text" name="question[]" id="question" value="" required disabled>
                            @if($errors->has('question'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('question') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.store.fields.question_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="answer">{{ trans('cruds.store.fields.answer') }}</label>
                            <textarea class="form-control answer {{ $errors->has('answer') ? 'is-invalid' : '' }}" name="answer[]" id="answer" required disabled></textarea>
                            @if($errors->has('answer'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('answer') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.store.fields.answer_helper') }}</span>
                        </div>
                        <hr />
                    @endif

                @endif

                <div id="addMoreContent"></div>

                <div class="form-group">
                    <button class="btn btn-success" type="button" id="addMoreBttn" onclick="addMore(1)" @if(!$questions) @if(empty($faqData)) disabled @endif @endif>
                        {{ trans('cruds.store.fields.add_more') }}
                    </button>
                </div>
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
    function addMore(no) {
        $("#addMoreContent").append(`
            <div id="faqContent${no}">
                <div class="form-group">
                    <label for="question${no}">{{ trans('cruds.store.fields.question') }}</label>
                    <input class="form-control question" type="text" name="question[]" id="question${no}" value="" required>
                    <span class="help-block">{{ trans('cruds.store.fields.question_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="answer${no}">{{ trans('cruds.store.fields.answer') }}</label>
                    <textarea class="form-control answer" name="answer[]" id="answer${no}" required></textarea>
                    <span class="help-block">{{ trans('cruds.store.fields.answer_helper') }}</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger removeBttn" type="button" onclick="removeMore(${no})">
                        {{ trans('cruds.store.fields.remove_more') }}
        </button>
    </div>
    <hr />
</div>
`);
        $("#addMoreBttn").attr('onclick', `addMore(${no+1})`);
    }

    function removeMore(no) {
        $(`#faqContent${no}`).remove();
    }

    $('#enable_faq').on('change', function(e) {
        if($('#enable_faq').is(':checked')) {

            $("#faq_title").removeAttr('disabled');
            $(".question").removeAttr('disabled');
            $(".answer").removeAttr('disabled');
            $("#addMoreBttn").removeAttr('disabled');
            $(".removeBttn").removeAttr('disabled');

        } else {

            $("#faq_title").attr('disabled', 'disabled');
            $(".question").attr('disabled', 'disabled');
            $(".answer").attr('disabled', 'disabled');
            $("#addMoreBttn").attr('disabled', 'disabled');
            $(".removeBttn").attr('disabled', 'disabled');

        }
    });

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
        $("#meta_description_message").html("{{ trans('cruds.store.fields.meta_description_500') }}");
        $("#meta_description_message").css('color', '#B22222');
        $("#meta_description_message").css('fontWeight', 'bold');
    }
    else if(characterCount > 320) {
        current.css('color', '#FF4500');
        current.css('fontWeight', 'bold');
        $("#meta_description_message").html("{{ trans('cruds.store.fields.meta_description_320') }}");
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
            $("#meta_description_message").html("{{ trans('cruds.store.fields.meta_description_500') }}");
            $("#meta_description_message").css('color', '#B22222');
            $("#meta_description_message").css('fontWeight', 'bold');
        }
        else if(characterCount > 320) {
            current.css('color', '#FF4500');
            current.css('fontWeight', 'bold');
            $("#meta_description_message").html("{{ trans('cruds.store.fields.meta_description_320') }}");
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
        url: '{{ route('admin.stores.storeMedia') }}',
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
        @if(isset($store) && $store->image)
              var file = {!! json_encode($store->image) !!}
                  this.options.addedfile.call(this, file)
              this.options.thumbnail.call(this, file, '{{ $store->image->getUrl('thumb') }}')
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

    Dropzone.options.trendingImageDropzone = {
        url: '{{ route('admin.stores.storeMedia') }}',
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
          $('form').find('input[name="trendingcouponimage"]').remove()
          $('form').append('<input type="hidden" name="trendingcouponimage" value="' + response.name + '">')
        },
        removedfile: function (file) {
          file.previewElement.remove()
          if (file.status !== 'error') {
            $('form').find('input[name="trendingcouponimage"]').remove()
            this.options.maxFiles = this.options.maxFiles + 1
          }
        },
        init: function () {
        @if(isset($store) && $store->trendingcouponimage)
              var file = {!! json_encode($store->trendingcouponimage) !!}
                  this.options.addedfile.call(this, file)
              this.options.thumbnail.call(this, file, '{{ $store->trendingcouponimage->getUrl('thumb') }}')
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="trendingcouponimage" value="' + file.file_name + '">')
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
