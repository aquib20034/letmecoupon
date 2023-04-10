@extends('web.layouts.app')
@section('content')
    <div class="container-fluid">
        
        <!-- ***************************** -->
        <!-- Contact Us Page Content Starts Here -->
        <!-- ***************************** -->
        <div class="container">
            <div class="section">
                <!-- Breadcrumbs Section Starts Here -->
                <section class="section pd-top-none onlyDesktop">
                    <div class="container-inner">
                    <?php
                        $routes = [["title" => "Home", "path" => config('app.app_path')], ["title" => trans('sentence.contact_us'), "path" => config('app.app_path')."/contact"]];
                    ?>
                    @web_component([ 'postfixes' => 'breadcrumbs.style1','data' => ['routes' => $routes] ])@endweb_component
                    </div>
                </section>
                <!-- Breadcrumbs Section Ends Here -->

                <!-- Contact Us Grid Section Starts Here -->
                <section class="section">
                    <div class="contactGrid">
                        <div class="contactGrid__wrapper">
                            <div class="contactGrid__left">
                                <div class="contactGrid__typography">
                                    <div class="title">
                                        <h1 class="heading-1 primary m-0">{{ trans('sentence.contact_us') }}</h1>
                                    </div>

                                    <div class="description">
                                        <p class="title">{!! trans('sentence.contact_tag_line') !!}</p>
                                        <p class="desc">
                                            {{ config('app.name') }}® 22491 Garrett Highway McHenry, MD 21541
                                        </p>
                                    </div>
                                </div>

                                <div class="contactGrid__form">
                                    <form class="form" id="contactBox" method="POST"  action="{{ route('contact.store') }}" enctype="multipart/form-data">
                                        <div class="form__group">
                                            <div class="inputStyle1">
                                                <div class="inputStyle1__left">
                                                    <span class="inputStyle1__icon">
                                                        <i class="x_user-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                </div>

                                                <div class="inputStyle1__right">
                                                    <input id="name" name="name" type="text" placeholder="{{ trans('sentence.contact_name') }}" class="inputStyle1__input">
                                                    <label for="name" class="inputStyle1__label">Full Name</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form__group form__group--half">
                                            <div class="inputStyle1">
                                                <div class="inputStyle1__left">
                                                    <span class="inputStyle1__icon">
                                                        <i class="x_envelope-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                </div>

                                                <div class="inputStyle1__right">
                                                    <input id="email" name="email" type="email" placeholder="{{ trans('sentence.contact_name') }}" class="inputStyle1__input">
                                                    <label for="email" class="inputStyle1__label">Email Address</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form__group form__group--half">
                                            <div class="inputStyle1">
                                                <div class="inputStyle1__left">
                                                    <span class="inputStyle1__icon">
                                                        <i class="x_phone-1">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </span>
                                                </div>

                                                <div class="inputStyle1__right">
                                                    <input id="phone" name="phone" type="tel" placeholder="{{ trans('sentence.contact_name') }}" class="inputStyle1__input">
                                                    <label for="phone" class="inputStyle1__label">Contact No.</label>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="error contact-error"></p>
                                        <div class="form__group">
                                            <div class="inputStyle1 inputStyle1--no-icon">
                                                <div class="inputStyle1__right">
                                                    <textarea id="message" name="message" type="text" placeholder="{{ trans('sentence.contact_name') }}" class="inputStyle1__input inputStyle1__input--textarea"></textarea>
                                                    <label for="message" class="inputStyle1__label">Your Message</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div id='msgcontact'></div><br />

                                        <div class="form__group form__group--btn">
                                            <div>
                                                <button type="submit" class="btn-2" aria-label="Send">SEND</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="contactGrid__right">
                                <div class="contactGrid__image">
                                    <figure>
                                        <img src="{{ config('app.app_path')}}/build/images/contact-image-1.webp" alt="People Connected Globally">
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Contact Us Grid Section Ends Here -->
            </div>
        </div>
        <!-- ***************************** -->
        <!-- Contact Us Page Content Ends Here -->
        <!-- ***************************** -->

    </div>
@endsection
