@extends('web.layouts.app')
@section('content')
    <main class="main">
        <!-- components/contact-form.scss -->
        <section class="section">
            <div class="container">
                <div class="top-heading">
                    <h2>{{ trans('sentence.contact_us') }}</h2>
                </div>
                <div class="contact-form">
                    <div class="info">
                        <p class="title">{!! trans('sentence.contact_tag_line') !!}</p>
                        <p class="desc">
                            {{ config('app.name') }}® 22491 Garrett Highway
                            McHenry, MD 21541
                        </p>
                        {{-- <a href="#">

                        </a>
                        <a href="#"></a> --}}
                    </div>
                    <form class="form" id="contactBox" action="{{ route('contact.store') }}" enctype="multipart/form-data">
                        <input type="text" id="name" name="name"
                            placeholder="{{ trans('sentence.contact_name') }}">
                        <input type="email" id="email" name="email"
                            placeholder="{{ trans('sentence.contact_email') }}">
                        <!-- .success, .inform, .warning, .danger, .error use theese classes to show errors-->
                        <p class="error contact-error"></p>
                        <input type="tel" id="phone" name="phone"
                            placeholder="{{ trans('sentence.contact_phone') }}">
                        <textarea name="message" id="message" cols="10" rows="6" placeholder="{{ trans('sentence.contact_msg') }}"></textarea>
                        <div id='msgcontact'></div><br />
                        <div class="btn-wrp">
                            <button type="submit" class="secondary-btn sbmtBtn">
                                {{ trans('sentence.contact_btn') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
