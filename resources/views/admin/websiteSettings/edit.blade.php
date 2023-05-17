@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.websiteSetting.title_singular') }}
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('admin.website-settings.update', [$websiteSetting->id]) }}"
                enctype="multipart/form-data" id="permissionForm">
                @method('PUT')
                @csrf
                @php
                    $websiteSetting->categories_popular = isset($websiteSetting->categories_popular)?unserialize($websiteSetting->categories_popular):[];
                    $websiteSetting->stores_popular = isset($websiteSetting->stores_popular)?unserialize($websiteSetting->stores_popular):[];
                    $websiteSetting->stores_related = isset($websiteSetting->stores_related)?unserialize($websiteSetting->stores_related):[];
                    $websiteSetting->coupons_active = isset($websiteSetting->coupons_active)?unserialize($websiteSetting->coupons_active):[];
                    $websiteSetting->coupons_expired = isset($websiteSetting->coupons_expired)?unserialize($websiteSetting->coupons_expired):[];
                    $websiteSetting->coupons_full = isset($websiteSetting->coupons_full)?unserialize($websiteSetting->coupons_full):[];
                    $websiteSetting->coupons_minimal = isset($websiteSetting->coupons_minimal)?unserialize($websiteSetting->coupons_minimal):[];
                    $websiteSetting->blogs_popular = isset($websiteSetting->blogs_popular)?unserialize($websiteSetting->blogs_popular):[];
                    $websiteSetting->blogs_trending = isset($websiteSetting->blogs_trending)?unserialize($websiteSetting->blogs_trending):[];
                    $websiteSetting->blogs_recent = isset($websiteSetting->blogs_recent)?unserialize($websiteSetting->blogs_recent):[];
                    $websiteSetting->reviews_popular = isset($websiteSetting->reviews_popular)?unserialize($websiteSetting->reviews_popular):[];
                    $websiteSetting->reviews_trending = isset($websiteSetting->reviews_trending)?unserialize($websiteSetting->reviews_trending):[];
                    $websiteSetting->reviews_recent = isset($websiteSetting->reviews_recent)?unserialize($websiteSetting->reviews_recent):[];
                    $componentsStyles = [['label' => 'Style 1', 'value' => 'style1'], ['label' => 'Style 2', 'value' => 'style2'], ['label' => 'Style 3', 'value' => 'style3'], ['label' => 'Style 4', 'value' => 'style4'], ['label' => 'Style 5', 'value' => 'style5']];
                @endphp
                
                <div class="row">
                    <div class="form-group col-md-4">
                        <div class="row">
                            <div class="form-group col-md-12"><strong>Categories</strong></div>
                            <div class="form-group col-md-12">
                                <label for="categories_popular pull-left">Popular Categories Style</label>
                                <div class="custom-control custom-switch custom-switch-lg pull-right">
                                    <input type="checkbox" class="custom-control-input" name="categories_popular[status]" id="categories_popular_status" {{ ($websiteSetting->categories_popular ? isset($websiteSetting->categories_popular['status'])?$websiteSetting->categories_popular['status']:old('categories_popular[status]') : old('categories_popular[status]')) === 'on' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="categories_popular_status"></label>
                                </div>
                                <select class="form-control select2" name="categories_popular[style]" id="categories_popular" required>
                                    @foreach ($componentsStyles as $style)
                                        <option value="{{ $style['value'] }}"
                                            {{ ($websiteSetting->categories_popular ? $websiteSetting->categories_popular['style'] : old('categories_popular[style]')) === $style['value'] ? 'selected' : '' }}>
                                            {{ $style['label'] }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('categories_popular'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('categories_popular') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-8">
                        <div class="row">
                            <div class="form-group col-md-12"><strong>Stores</strong></div>
                            <div class="form-group col-md-6">
                                <label for="stores_popular pull-left">Popular Stores Style</label>
                                <div class="custom-control custom-switch custom-switch-lg pull-right">
                                    <input type="checkbox" class="custom-control-input" name="stores_popular[status]" id="stores_popular_status" {{ ($websiteSetting->stores_popular ? $websiteSetting->stores_popular['status'] : old('stores_popular[status]')) === 'on' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="stores_popular_status"></label>
                                </div>
                                <select class="form-control select2" name="stores_popular[style]" id="stores_popular" required>
                                    @foreach ($componentsStyles as $style)
                                        <option value="{{ $style['value'] }}"
                                            {{ ($websiteSetting->stores_popular ? $websiteSetting->stores_popular['style'] : old('stores_popular[style]')) === $style['value'] ? 'selected' : '' }}>
                                            {{ $style['label'] }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('stores_popular'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('stores_popular') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="stores_related pull-left">Related Stores Style</label>
                                <div class="custom-control custom-switch custom-switch-lg pull-right">
                                    <input type="checkbox" class="custom-control-input" name="stores_related[status]" id="stores_related_status" {{ ($websiteSetting->stores_related ? $websiteSetting->stores_related['status'] : old('stores_related[status]')) === 'on' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="stores_related_status"></label>
                                </div>
                                <select class="form-control select2" name="stores_related[style]" id="stores_related" required>
                                    @foreach ($componentsStyles as $style)
                                        <option value="{{ $style['value'] }}"
                                            {{ ($websiteSetting->stores_related ? $websiteSetting->stores_related['style'] : old('stores_related[style]')) === $style['value'] ? 'selected' : '' }}>
                                            {{ $style['label'] }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('stores_related'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('stores_related') }}
                                    </div>
                                @endif
                            </div>    
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12"><strong>Coupons</strong></div>
                    <div class="form-group col-md-3">
                        <label for="coupons_active pull-left">Active Coupons Style</label>
                        <div class="custom-control custom-switch custom-switch-lg pull-right">
                            <input type="checkbox" class="custom-control-input" name="coupons_active[status]" id="coupons_active_status" {{ ($websiteSetting->coupons_active ? $websiteSetting->coupons_active['status'] : old('coupons_active[status]')) === 'on' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="coupons_active_status"></label>
                        </div>
                        <select class="form-control select2" name="coupons_active[style]" id="coupons_active" required>
                            @foreach ($componentsStyles as $style)
                                <option value="{{ $style['value'] }}"
                                    {{ (($websiteSetting->coupons_active) ? $websiteSetting->coupons_active['style'] : old('coupons_active[style]')) === $style['value'] ? 'selected' : '' }}>
                                    {{ $style['label'] }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('coupons_active'))
                            <div class="invalid-feedback">
                                {{ $errors->first('coupons_active') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="coupons_expired pull-left">Expired Coupons Style</label>
                        <div class="custom-control custom-switch custom-switch-lg pull-right">
                            <input type="checkbox" class="custom-control-input" name="coupons_expired[status]" id="coupons_expired_status" {{ ($websiteSetting->coupons_expired ? $websiteSetting->coupons_expired['status'] : old('coupons_expired[status]')) === 'on' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="coupons_expired_status"></label>
                        </div>
                        <select class="form-control select2" name="coupons_expired[style]" id="coupons_expired" required>
                            @foreach ($componentsStyles as $style)
                                <option value="{{ $style['value'] }}"
                                    {{ ($websiteSetting->coupons_expired ? $websiteSetting->coupons_expired['style'] : old('coupons_expired[style]')) === $style['value'] ? 'selected' : '' }}>
                                    {{ $style['label'] }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('coupons_expired'))
                            <div class="invalid-feedback">
                                {{ $errors->first('coupons_expired') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="coupons_full pull-left">Full Coupons Style</label>
                        <select class="form-control select2" name="coupons_full[style]" id="coupons_full" required>
                            @foreach ($componentsStyles as $style)
                                <option value="{{ $style['value'] }}"
                                    {{ ($websiteSetting->coupons_full ? $websiteSetting->coupons_full['style'] : old('coupons_full[style]')) === $style['value'] ? 'selected' : '' }}>
                                    {{ $style['label'] }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('coupons_full'))
                            <div class="invalid-feedback">
                                {{ $errors->first('coupons_full') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        <label for="coupons_minimal pull-left">Minimal Coupons Style</label>
                        <select class="form-control select2" name="coupons_minimal[style]" id="coupons_minimal" required>
                            @foreach ($componentsStyles as $style)
                                <option value="{{ $style['value'] }}"
                                    {{ ($websiteSetting->coupons_minimal ? $websiteSetting->coupons_minimal['style'] : old('coupons_minimal[style]')) === $style['value'] ? 'selected' : '' }}>
                                    {{ $style['label'] }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('coupons_minimal'))
                            <div class="invalid-feedback">
                                {{ $errors->first('coupons_minimal') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12"><strong>Blogs</strong></div>
                    <div class="form-group col-md-4">
                        <label for="blogs_popular pull-left">Popular Blogs Style</label>
                        <div class="custom-control custom-switch custom-switch-lg pull-right">
                            <input type="checkbox" class="custom-control-input" name="blogs_popular[status]" id="blogs_popular_status" {{ ($websiteSetting->blogs_popular ? $websiteSetting->blogs_popular['status'] : old('blogs_popular[status]')) === 'on' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="blogs_popular_status"></label>
                        </div>
                        <select class="form-control select2" name="blogs_popular[style]" id="blogs_popular" required>
                            @foreach ($componentsStyles as $style)
                                <option value="{{ $style['value'] }}"
                                    {{ ($websiteSetting->blogs_popular ? $websiteSetting->blogs_popular['style'] : old('blogs_popular[style]')) === $style['value'] ? 'selected' : '' }}>
                                    {{ $style['label'] }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('blogs_popular'))
                            <div class="invalid-feedback">
                                {{ $errors->first('blogs_popular') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="blogs_recent pull-left">Recent Blogs Style</label>
                        <div class="custom-control custom-switch custom-switch-lg pull-right">
                            <input type="checkbox" class="custom-control-input" name="blogs_recent[status]" id="blogs_recent_status" {{ ($websiteSetting->blogs_recent ? $websiteSetting->blogs_recent['status'] : old('blogs_recent[status]')) === 'on' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="blogs_recent_status"></label>
                        </div>
                        <select class="form-control select2" name="blogs_recent[style]" id="blogs_recent" required>
                            @foreach ($componentsStyles as $style)
                                <option value="{{ $style['value'] }}"
                                    {{ ($websiteSetting->blogs_recent ? $websiteSetting->blogs_recent['style'] : old('blogs_recent[style]')) === $style['value'] ? 'selected' : '' }}>
                                    {{ $style['label'] }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('blogs_recent'))
                            <div class="invalid-feedback">
                                {{ $errors->first('blogs_recent') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="blogs_trending pull-left">Trending Blogs Style</label>
                        <div class="custom-control custom-switch custom-switch-lg pull-right">
                            <input type="checkbox" class="custom-control-input" name="blogs_trending[status]" id="blogs_trending_status" {{ ($websiteSetting->blogs_trending ? $websiteSetting->blogs_trending['status'] : old('blogs_trending[status]')) === 'on' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="blogs_trending_status"></label>
                        </div>
                        <select class="form-control select2" name="blogs_trending[style]" id="blogs_trending" required>
                            @foreach ($componentsStyles as $style)
                                <option value="{{ $style['value'] }}"
                                    {{ ($websiteSetting->blogs_trending ? $websiteSetting->blogs_trending['style'] : old('blogs_trending[style]')) === $style['value'] ? 'selected' : '' }}>
                                    {{ $style['label'] }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('blogs_trending'))
                            <div class="invalid-feedback">
                                {{ $errors->first('blogs_trending') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12"><strong>Reviews</strong></div>
                    <div class="form-group col-md-4">
                        <label for="reviews_popular pull-left">Popular Reviews Style</label>
                        <div class="custom-control custom-switch custom-switch-lg pull-right">
                            <input type="checkbox" class="custom-control-input" name="reviews_popular[status]" id="reviews_popular_status" {{ ($websiteSetting->reviews_popular ? $websiteSetting->reviews_popular['status'] : old('reviews_popular[status]')) === 'on' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="reviews_popular_status"></label>
                        </div>
                        <select class="form-control select2" name="reviews_popular[style]" id="reviews_popular" required>
                            @foreach ($componentsStyles as $style)
                                <option value="{{ $style['value'] }}"
                                    {{ ($websiteSetting->reviews_popular ? $websiteSetting->reviews_popular['style'] : old('reviews_popular[style]')) === $style['value'] ? 'selected' : '' }}>
                                    {{ $style['label'] }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('reviews_popular'))
                            <div class="invalid-feedback">
                                {{ $errors->first('reviews_popular') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="reviews_recent pull-left">Recent Reviews Style</label>
                        <div class="custom-control custom-switch custom-switch-lg pull-right">
                            <input type="checkbox" class="custom-control-input" name="reviews_recent[status]" id="reviews_recent_status" {{ ($websiteSetting->reviews_recent ? $websiteSetting->reviews_recent['status'] : old('reviews_recent[status]')) === 'on' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="reviews_recent_status"></label>
                        </div>
                        <select class="form-control select2" name="reviews_recent[style]" id="reviews_recent" required>
                            @foreach ($componentsStyles as $style)
                                <option value="{{ $style['value'] }}"
                                    {{ ($websiteSetting->reviews_recent ? $websiteSetting->reviews_recent['style'] : old('reviews_recent[style]')) === $style['value'] ? 'selected' : '' }}>
                                    {{ $style['label'] }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('stores_recent'))
                            <div class="invalid-feedback">
                                {{ $errors->first('stores_recent') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="reviews_trending pull-left">Trending Reviews Style</label>
                        <div class="custom-control custom-switch custom-switch-lg pull-right">
                            <input type="checkbox" class="custom-control-input" name="reviews_trending[status]" id="reviews_trending_status" {{ ($websiteSetting->reviews_trending ? $websiteSetting->reviews_trending['status'] : old('reviews_trending[status]')) === 'on' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="reviews_trending_status"></label>
                        </div>
                        <select class="form-control select2" name="reviews_trending[style]" id="reviews_trending" required>
                            @foreach ($componentsStyles as $style)
                                <option value="{{ $style['value'] }}"
                                    {{ ($websiteSetting->reviews_trending ? $websiteSetting->reviews_trending['style'] : old('reviews_trending[style]')) === $style['value'] ? 'selected' : '' }}>
                                    {{ $style['label'] }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('reviews_trending'))
                            <div class="invalid-feedback">
                                {{ $errors->first('reviews_trending') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row d-none">
                    <div class="form-group col-md-12">
                        <label for="coupon_card_style_primary">Primary Coupon Card Style</label>
                        <select class="form-control select2" name="coupon_card_style_primary" id="coupon_card_style_primary"
                            required>
                            @php
                                $primaryCouponCardStyles = [['label' => 'Style 1', 'value' => 'style-1'], ['label' => 'Style 2', 'value' => 'style-2'], ['label' => 'Style 3', 'value' => 'style-3'], ['label' => 'Style 4', 'value' => 'style-4'], ['label' => 'Style 5', 'value' => 'style-5']];
                            @endphp

                            @foreach ($primaryCouponCardStyles as $style)
                                <option value="{{ $style['value'] }}"
                                    {{ ($websiteSetting->coupon_card_style_primary ? $websiteSetting->coupon_card_style_primary : old('coupon_card_style_primary')) === $style['value'] ? 'selected' : '' }}>
                                    {{ $style['label'] }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('coupon_card_style_primary'))
                            <div class="invalid-feedback">
                                {{ $errors->first('coupon_card_style_primary') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="coupon_card_style_secondary">Secondary Coupon Card Style</label>
                        <select class="form-control select2" name="coupon_card_style_secondary"
                            id="coupon_card_style_secondary" required>
                            @php
                                $secondaryCouponCardStyles = [['label' => 'Style 1', 'value' => 'style-1'], ['label' => 'Style 2', 'value' => 'style-2'], ['label' => 'Style 3', 'value' => 'style-3'], ['label' => 'Style 4', 'value' => 'style-4'], ['label' => 'Style 5', 'value' => 'style-5']];
                            @endphp

                            @foreach ($secondaryCouponCardStyles as $style)
                                <option value="{{ $style['value'] }}"
                                    {{ ($websiteSetting->coupon_card_style_secondary ? $websiteSetting->coupon_card_style_secondary : old('coupon_card_style_secondary')) === $style['value'] ? 'selected' : '' }}>
                                    {{ $style['label'] }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('coupon_card_style_secondary'))
                            <div class="invalid-feedback">
                                {{ $errors->first('coupon_card_style_secondary') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12"><strong>Colors</strong></div>
                    <div class="form-group col-md-4">
                        <label for="primary_color">Primary Color</label>
                        <input class="form-control {{ $errors->has('primary_color') ? 'is-invalid' : '' }}" type="text"
                            name="primary_color" id="primary_color"
                            value="{{ old('primary_color', $websiteSetting->primary_color) }}">
                        @if ($errors->has('primary_color'))
                            <div class="invalid-feedback">
                                {{ $errors->first('primary_color') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="secondary_color">Secondary Color</label>
                        <input class="form-control {{ $errors->has('secondary_color') ? 'is-invalid' : '' }}"
                            type="text" name="secondary_color" id="secondary_color"
                            value="{{ old('secondary_color', $websiteSetting->secondary_color) }}">
                        @if ($errors->has('secondary_color'))
                            <div class="invalid-feedback">
                                {{ $errors->first('secondary_color') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="tertiary_color">Tertiary Color</label>
                        <input class="form-control {{ $errors->has('tertiary_color') ? 'is-invalid' : '' }}" type="text"
                            name="tertiary_color" id="tertiary_color"
                            value="{{ old('tertiary_color', $websiteSetting->tertiary_color) }}">
                        @if ($errors->has('tertiary_color'))
                            <div class="invalid-feedback">
                                {{ $errors->first('tertiary_color') }}
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group col-md-12"><strong>Social</strong></div>
                    <div class="form-group col-md-6">
                        <label for="linked_in">{{ trans('cruds.websiteSetting.fields.linked_in') }}</label>
                        <input class="form-control {{ $errors->has('linked_in') ? 'is-invalid' : '' }}" type="text"
                            name="linked_in" id="linked_in" value="{{ old('linked_in', $websiteSetting->linked_in) }}">
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
                            name="facebook" id="facebook" value="{{ old('facebook', $websiteSetting->facebook) }}">
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
                            name="youtube" id="youtube" value="{{ old('youtube', $websiteSetting->youtube) }}">
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
                            name="instagram" id="instagram" value="{{ old('instagram', $websiteSetting->instagram) }}">
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
                            name="pinterest" id="pinterest" value="{{ old('pinterest', $websiteSetting->pinterest) }}">
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
                            name="twitter" id="twitter" value="{{ old('twitter', $websiteSetting->twitter) }}">
                        @if ($errors->has('twitter'))
                            <div class="invalid-feedback">
                                {{ $errors->first('twitter') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.websiteSetting.fields.twitter_helper') }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12"><strong>Logos</strong></div>
                    <div class="form-group col-md-6">
                        <label for="logo">{{ trans('cruds.websiteSetting.fields.logo') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('logo') ? 'is-invalid' : '' }}"
                            id="logo-dropzone">
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
                    <label for="site_javascript">{{ trans('cruds.websiteSetting.fields.site_javascript') }}</label>
                    <textarea class="form-control {{ $errors->has('site_javascript') ? 'is-invalid' : '' }}" name="site_javascript"
                        id="site_javascript">{{ old('site_javascript', $websiteSetting->site_javascript) }}</textarea>
                    @if ($errors->has('site_javascript'))
                        <div class="invalid-feedback">
                            {{ $errors->first('site_javascript') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.websiteSetting.fields.site_javascript_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required"
                        for="site_html_tags">{{ trans('cruds.websiteSetting.fields.site_html_tags') }}</label>
                    <textarea class="form-control {{ $errors->has('site_html_tags') ? 'is-invalid' : '' }}" name="site_html_tags"
                        id="site_html_tags">{{ old('site_html_tags', $websiteSetting->site_html_tags) }}</textarea>
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

    <!-- Checkbox CSS -->    
    <style>
    .custom-switch.custom-switch-lg {
        padding-left: 0rem;
    }
    .custom-switch.custom-switch-lg .custom-control-label {
        padding-left: .75rem;
        padding-top: 0.15rem;
    }
    .custom-switch.custom-switch-lg .custom-control-label::before {
        left: -1.75rem;
        border-radius: 1rem;
        height: 1.25rem;
        width: 2.5rem;
    }
    .custom-switch .custom-control-input:checked~.custom-control-label::before {

    }

    .custom-switch.custom-switch-lg .custom-control-label::after {
        border-radius: .65rem;
        height: calc(1.25rem - 4px);
        width: calc(1.25rem - 4px);
        left: calc(-1.75rem + 2px);
    }
    .custom-switch .custom-control-input:checked~.custom-control-label::after{
        left: calc(-1.25rem + 2px);
    }
    </style>
@endsection