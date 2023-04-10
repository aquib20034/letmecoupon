@extends('web.layouts.app')
@section('content')
    <div class="section main">
        <div class="section">
            <div class="container">
                <div class="top-heading">
                    @if (!empty($pageRecord['title']))
                        <h2>{!! $pageRecord['title'] !!}</h2>
                    @endif
                </div>
                <div class="richtext min-content">
                    @if (!empty($pageRecord['description']))
                        {!! html_entity_decode($pageRecord['description']) !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
    <section class="section pbn">
        <div class="subscribe">
            <div class="container">
                <p class="title">{{ trans('sentence.subscribe_heading') }}</p>
                <div class="subscribe-searchbar">
                    <input type="email" class="subBoxEmail" data-name="footer" id="1footer" name="subBoxEmail"
                        aria-label="Enter Email" required="" />
                    <label for="1footer" hidden></label>
                    <button type="button" class="submit btn"
                        data-name="footer">{{ trans('sentence.subscribe_btn') }}</button>
                </div>
                <div id="footer" style="width: 100%;margin: 0px;"></div>
                <p class="error footer-error" style="font-size: 15px;margin: 0px;padding: 0px;"></p>
                <p class="subtitle">{{ trans('sentence.privacy_policy_text') }} <a
                        href="{{ config('app.app_path') }}/privacy-policy"> {{ trans('sentence.privacy_policy_link') }}</a>.
                </p>
            </div>
        </div>
    </section>
@endsection
