        <!--<footer class="footer">
            <div class="container">
                <div class="disclaimer">
                    <p>{{ trans('sentence.footer_desc') }}</p>
                    <p class="copy">
                        {!! trans('sentence.copyright_text') !!}
                    </p>
                    <ul class="social">
                        @php
                            //$socials = [['field_name' => 'facebook', 'icon_name' => 'facebook'], ['field_name' => 'twitter', 'icon_name' => 'twitter'], ['field_name' => 'instagram', 'icon_name' => 'instagram'], ['field_name' => 'linked_in', 'icon_name' => 'linkedin'], ['field_name' => 'youtube', 'icon_name' => 'youtube'], ['field_name' => 'pinterest', 'icon_name' => 'facebook']];
                        @endphp
                        @foreach ($socials as $social)
                            @if ($global_data[$social['field_name']])
                                <li class="social_icon">
                                    <a href="{{ $global_data[$social['field_name']] }}"
                                        title="{{ ucwords($social['icon_name']) }}">
                                        <i class="x_{{ $social['icon_name'] }}"></i>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <ul class="links">
                    @if (isset($bottom_event) && sizeof($bottom_event) > 0)
                        @foreach ($bottom_event as $event)
                            @if (isset($event) && isset($event['slugs']))
                                <li>
                                    <a
                                        href="{{ config('app.app_path') }}/{{ $event['slugs']['slug'] }}">{!! $event['title'] !!}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                    @if (isset($pages))
                        @foreach ($pages as $page)
                            @if ($page['bottom'] == 1 && $page['publish'] == 1)
                                <li><a href="{{ config('app.app_path') }}/{{ $page['slugs']['slug'] }}">{{ $page['title'] }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                    @if ($blogs_count > 0)
                        <li><a href="{{ config('app.app_path') }}/blog">{{ trans('sentence.blog_page') }}</a></li>
                    @endif
                    <li><a href="{{ config('app.app_path') }}/sitemap">{{ trans('sentence.sitemap_page') }}</a></li>
                    <li><a href="{{ config('app.app_path') }}/contact">{{ trans('sentence.contact_us') }}</a></li>
                </ul>

                @if (!empty($sites) && sizeof($sites) > 1)
                    <div class="country">
                        <p class="country__heading">{{ trans('sentence.region') }}</p>
                        <ul class="country__regions">
                            @foreach ($sites as $site)
                                <li class="country-region">
                                    <a href="{{ isset($site['country_code']) ? url(strtolower($site['country_code'])) : '' }}" 
                                        title="{!! isset($site['country_name']) ? $site['country_name'] : '' !!}">
                                        <img
                                            src="{{ config('app.image_path') }}/build/images/placeholder.png"
                                            data-src="{{ !empty($site['country_flag']) ? $site['country_flag'] : config('app.image_path') . '/build/images/placeholder.png' }}"
                                            alt="{!! isset($site['country_name']) ? $site['country_name'] : '' !!}"
                                        >
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </footer>-->
        @web_component([ 'postfixes' => 'footer.style1','data' => ['pages' => $pages,'sites' => $sites,'global_data' => $global_data,'bottom_event' => $bottom_event,'blogs_count' => $blogs_count, 'socials' => $socials] ])@endweb_component
    </div>
</div>
<?php if(isset($_GET['copy'])){ ?>
@php
    $copy = decrypt($_GET['copy']);
    $couponRecord = getCouponRecord($copy);
@endphp
@if ($couponRecord == null)
@else
    <div class="cpwrp">
        <div class="cpiwrp">
            <div class="cpbg"></div>
            <div class="cpowrp popup">
                <div class="coupon-popup-main">
                    <div class="closeOverlay close-popup-btn">
                        <i class="x_close"></i>
                    </div>
                    <div class="top-content">
                        <a href="{!! !empty($couponRecord['store']['store_url']) ? addhttps($couponRecord['store']['store_url']) : 'javascript:;' !!}" class="store" aria-label="Visit Store">
                            <img src="{{ config('app.image_path') }}/build/images/placeholder.png"
                                data-src="{{ !empty($couponRecord['store']['store_image']) ? $couponRecord['store']['store_image'] : config('app.image_path') . '/build/images/placeholder.png' }}"
                                alt="" />
                        </a>
                        <p class="coupon-title">
                            {!! $couponRecord['title'] !!}
                        </p>
                        <p class="copy-title">
                            {{ trans('sentence.copy_paste_code_at') }}<a href="{!! !empty($couponRecord['store']['store_url']) ? addhttps($couponRecord['store']['store_url']) : 'javascript:;' !!}"
                                class="store-name">{{ $couponRecord['store']['name'] }}</a>
                        </p>
                        <div class="copy-code-wrap">
                            <div class="offer-code">
                                <div class="code-input"> {{ $couponRecord['code'] }}</div>
                                <input id="input_output" class="code" type="text"
                                    value="{{ $couponRecord['code'] }}" readonly>
                                <button id="copyCodeBtn"
                                    class="copyCodeButton copy-button">{{ trans('sentence.copy') }}</button>
                            </div>
                        </div>
                        <p class="expires">
                            {{ trans('sentence.expiry') }}
                            @php
                                $expiry = $couponRecord['on_going'] == 1 ? trans('sentence.exp_on_going') : date('M-j-Y', strtotime($couponRecord['date_expiry']));
                            @endphp
                            {!! $expiry !!}</p>
                    </div>
                    <hr />
                    <div class="bottom-content">
                        <p class="title"> {{ trans('sentence.details') }}</p>
                        <p class="sub-title">{{ trans('sentence.ends') }}
                            @php
                                $expiry = $couponRecord['on_going'] == 1 ? trans('sentence.exp_on_going') : date('M-j-Y', strtotime($couponRecord['date_expiry']));
                            @endphp
                            {!! $expiry !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<?php } ?>

<?php if(isset($_GET['deal'])){ ?>
@php
    $deal = decrypt($_GET['deal']);
    $couponRecord = getCouponRecord($deal);
@endphp
@if ($couponRecord == null)
@else
    <div class="cpwrp">
        <div class="cpiwrp">
            <div class="cpbg"></div>
            <div class="cpowrp popup">
                <div class="coupon-popup-main">
                    <div class="closeOverlay close-popup-btn">
                        <i class="x_close"></i>
                    </div>
                    <div class="top-content">
                        <a href="{!! !empty($couponRecord['store']['store_url']) ? addhttps($couponRecord['store']['store_url']) : 'javascript:;' !!}" class="store" aria-label="Visit Store">
                            <img src="{{ config('app.image_path') }}/build/images/placeholder.png"
                                data-src="{{ !empty($couponRecord['coupon_image']) ? $couponRecord['coupon_image'] : (!empty($couponRecord['store']['store_image']) ? $couponRecord['store']['store_image'] : config('app.image_path') . '/build/images/placeholder.png') }}"
                                alt="" />
                        </a>
                        <p class="coupon-title">
                            {!! $couponRecord['title'] !!}
                        </p>
                        <p class="copy-title">
                            {{ trans('sentence.tip_no_coupon_needed') }}
                        </p>
                        <div class="btn-wrp">
                            <a href="{!! !empty($couponRecord['store']['store_url']) ? addhttps($couponRecord['store']['store_url']) : 'javascript:;' !!}"
                                class="secondary-btn fit-con">{{ trans('sentence.continue_to_store') }}</a>
                        </div>
                        <p class="expires">
                            {{ trans('sentence.expiry') }}
                            @php
                                $expiry = $couponRecord['on_going'] == 1 ? trans('sentence.exp_on_going') : date('M-j-Y', strtotime($couponRecord['date_expiry']));
                            @endphp
                            {!! $expiry !!}</p>
                    </div>
                    <hr />
                    <div class="bottom-content">
                        <p class="title"> {{ trans('sentence.details') }}</p>
                        <p class="sub-title">{{ trans('sentence.ends') }}
                            @php
                                $expiry = $couponRecord['on_going'] == 1 ? trans('sentence.exp_on_going') : date('M-j-Y', strtotime($couponRecord['date_expiry']));
                            @endphp
                            {!! $expiry !!}</p>
                        <p class="sub-title">{{ trans('sentence.no_coupon_needed') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<?php } ?>

@if (\App::environment('production'))
    <script src="{{ secure_asset('build/js/swiper.min.js') }}"></script>
    <script id="all-js-script" async src="{{ secure_asset('build/js/all.js') }}"></script>
    <script id="all-js-script" async src="{{ secure_asset('build/js/app/utilities.js') }}"></script>
@else
    <script src="{{ asset('build/js/swiper.min.js') }}"></script>
    <script id="all-js-script" async src="{{ asset('build/js/all.js') }}"></script>
    <script id="all-js-script" async src="{{ asset('build/js/app/utilities.js') }}"></script>
@endif

{!! isset($site_wide_data['javascript_tags']) ? $site_wide_data['javascript_tags'] : '' !!}
{!! isset($global_data['site_javascript']) ? $global_data['site_javascript'] : '' !!}

<script>
    const allJsScript = document.getElementById('all-js-script');

    allJsScript.addEventListener('load', function() {
        var baseTitle = window.document.title;
        window.onblur = function() {
            document.title =
                '{{ trans('sentence.back_to') }} {{ $site_wide_data['name'] ? $site_wide_data['name'] : '' }}';
        };
        window.onfocus = function() {
            document.title = baseTitle;
        };

        $(".close-popup-btn").click(function($event){
            
        })

        $(".submit").click(function(event) {
            event.preventDefault();
            var form = $(this);
            var sub_name = form.attr('data-name');
            var email = $("#1" + sub_name).val();
            var valid = validate_email(email);
            if (valid != false) {
                subscribe(form, sub_name, email);
                $("#1" + sub_name).css('border-color', '#ccc');
                $("." + sub_name + '-error').text('');
                form.val('');
            } else {
                $(".errorMsg").text('');
                $(".finalCartPopup").text('');
                $("." + sub_name + '-success').text('');
                $("#1" + sub_name).css('border', '1px solid red');
                $("." + sub_name + '-error').text('{{ trans('sentence.invalid_email') }}');
            }
        });

        $(".subBoxEmail").keypress(function(e) {
            if (e.which == 13) {
                event.preventDefault();
                var form = $(this);
                var sub_name = form.attr('data-name');
                var email = form.val();
                var valid = validate_email(email);
                if (valid != false) {
                    subscribe(form, sub_name, email);
                    $("#1" + sub_name).css('border-color', '#ccc');
                    $("." + sub_name + '-error').text('');
                } else {
                    $(".errorMsg").text('');
                    $(".finalCartPopup").text('');
                    $("." + sub_name + '-success').text('');
                    $("#1" + sub_name).css('border', '1px solid red');
                    $("." + sub_name + '-error').text('{{ trans('sentence.invalid_email') }}');
                }
            }
        });

        function subscribe(form, sub_name, email) {
            $.ajax({
                url: '{{ route('submitsubscribe') }}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "dataType": "JSON",
                    'data': {
                        'email': email
                    },
                },
                success: function(data) {
                    $("#" + sub_name).html(data.msg);
                    $('.subBoxEmail').val('');
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        function validate_email(email) {
            var validEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
            if (validEmail.test(email)) {
                return true;
            } else {
                return false;
            }
        }

        $("#subscribeNeverMisId").keypress(function(e) {
            if (e.which == 13) {
                event.preventDefault();
                var form = $(this);
                $.ajax({
                    url: '{{ config('app.app_path') . '/_subscribe' }}',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "dataType": "JSON",
                        'data': {
                            'email': $("#subscribeNeverMis").val()
                        },
                    },
                    success: function(data) {
                        $('.subscribeNeverMisNewLetter').html(data.msg);
                        $("#subscribeNeverMis").val('');
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }
        });

        $(document).on('submit', '#contactBox', function() {
            event.preventDefault();
            var form = $(this);
            var email = $('#email').val();
            var valid = validate_email(email);
            if (valid != false) {
                $(".contact-error").text('');
                $("#email").css('border-bottom', '2px solid #eaeaea');
                $.ajax({
                    url: '{{ route('contact.store') }}',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "dataType": "JSON",
                        'data': {
                            'name': $('#name').val(),
                            'email': $('#email').val(),
                            'contact': $('#phone').val(),
                            'message': $('#message').val()
                        },
                    },
                    success: function(data) {
                        $('#email').css('border-bottom', '2px solid #dedede');
                        $('#msgcontact').html(data.msg);
                        $('#name').val('');
                        $('#email').val('');
                        $('#phone').val('');
                        $('#message').val('');
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            } else {
                $(".errorMsg").text('');
                $("#email").css('border-bottom', '2px solid red');
                $(".contact-error").css('color', 'red');
                $(".contact-error").text('{{ trans('sentence.invalid_email') }}');
            }
        });

        $(document).on('click', '.sortalpha', function(e) {
            var target = $(this).attr('data-target2');
            window.location.href = '{{ config('app.app_path') }}' + target;
        });

        $(document).on('click', '.baseurlappend', function(e) {
            var varName = $(this).attr('data-id');
            var vartarg = $(this).attr('data-var');
            /* var varstor = $(this).data("store"); */
            var post_url = "{!! config('app.app_path') . '/update-coupon-views' !!}";
            var clickout_api_url = "{{ config('app.app_path') . '/clickout-api' }}";

            $_token = "{{ csrf_token() }}";
            $.ajax({
                url: post_url,
                type: 'GET',
                data: {
                    "data_id": varName
                }
            }).done(function(response) {
                console.log(response);
            });

            $.ajax({
                url: clickout_api_url,
                type: 'GET',
                data: {
                    "data_id": varName
                }
            }).done(function(response) {
                varstor = response;
                window.open('{{ url()->current() }}' + "?" + vartarg + "=" + varName);
                location.replace(varstor);
            });

            /* window.open('{{ url()->current() }}' + "?"+vartarg+"=" + varName);
            location.replace(varstor); */
        });

        $(document).on('click', '.baseurlappendhometrend', function(e) {
            var varName = $(this).attr('data-id');
            var vartarg = $(this).attr('data-var');
            var varstore = $(this).data("store");
            var varcouponstore = $(this).data("couponstore");
            var post_url = "{!! config('app.app_path') . '/update-coupon-views' !!}";
            $_token = "{{ csrf_token() }}";
            $.ajax({
                url: post_url,
                type: 'GET',
                data: {
                    "data_id": varName
                }
            }).done(function(response) {
                console.log(response);
            });
            window.open('{{ url()->current() }}' + "/" + varcouponstore + "?" + vartarg + "=" +
                varName);
            location.replace(varstore);
        });

        $('#searchInput').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{ config('app.app_path') . '/search_store' }}',
                data: {
                    'search': $value
                },
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    var rc_str = '';
                    $.each(data, function(i) {
                        rc_str += "<li class='dropdown__listItem'><a href='" + data[i].url + "'>" + data[i].name +"</a></li>";
                    });
                    if(rc_str){
                        $('.search__dropdown').show();
                        $("#storeResult").html(rc_str);
                    }else{
                        if((data == 0) && ($value == "")){
                            $('.search__dropdown').hide();
                        }
                        $("#storeResult").html('<li><a href="javascript:;">{{ trans('sentence.search_return_msg') }} "' +value + '"</a></li>');
                    }
                }
            });
        });

        $('#searchInputHome').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{ config('app.app_path') . '/search_store' }}',
                data: {
                    'search': $value
                },
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    var rc_str = '';
                    if (data != '') {
                        $.each(data, function(i) {
                            rc_str += "<li><a href='" + data[i].url + "'>" + data[i]
                                .name +
                                "</a></li>";
                        });
                        if (rc_str) {
                            $(".coupon-search .searchbox").addClass('active');
                            $(".searchbox__result").addClass('active');
                            $("#searchBoxResult").html(rc_str);
                        } else {
                            $("#searchBoxResult").html(
                                '<li><a href="javascript:;">{{ trans('sentence.search_return_msg') }} "' +
                                $value + '"</a></li>');
                        }
                    } else {
                        $(".coupon-search .searchbox").removeClass('active');
                    }
                }
            });
        });


        $(document).on('click', '#load_more_button', function(e) {
            var id = $(this).attr('data-id');
            var category_id = $(this).attr('blog-category-id');
            $('#load_more_button').html('<b>Loading...</b>');
            var post_url = "{!! config('app.app_path') . '/load-more-data' !!}";
            $_token = "{{ csrf_token() }}";
            $.ajax({
                url: post_url,
                type: 'GET',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "data_id": id,
                    "category_id": category_id
                }
            }).done(function(response) {
                $('#load_more_button').remove();
                $('#post_data').append(response);
                console.log(response);
            });
        });

        $(document).on('click', '#blog_load_more_button', function(e) {

            var id = $(this).attr('data-id');
            var author_id = $(this).attr('blog-author-id');
            $('#blog_load_more_button').html('<b>Loading...</b>');
            var post_url = "{!! config('app.app_path') . '/author-load-more-data' !!}";
            $_token = "{{ csrf_token() }}";
            $.ajax({
                url: post_url,
                type: 'GET',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "data_id": id,
                    "author_id": author_id
                }
            }).done(function(response) {
                $('#blog_load_more_button').remove();
                $('#post_data').append(response);
                console.log(response);
            });

        });

    });

    function toggleHeader1MobileMenu() {
        var mobileMenuDrawer = document.querySelector('.mobileMenu');
        var body = document.querySelector('body');
        if (mobileMenuDrawer.classList.contains('active')) {
            mobileMenuDrawer.classList.remove('active');
            body.style.overflow = 'auto';
        } else {
            mobileMenuDrawer.classList.add('active');
            body.style.overflow = 'hidden';
        }
        return true;
    };

    function toggleSideNavAccordion(targetElement) {
        var sideNavDropdown = targetElement.querySelector('.sideDropdown');
        if (!sideNavDropdown) return false;
        if (targetElement.classList.contains('active')) {
            targetElement.classList.remove('active');
        } else {
            targetElement.classList.add('active');
        }
        return true;
    };
</script>

<script type="module">
    //import Swiper from '../../build/js/vendor/swiper.js';
    const swiper = new Swiper(".homeCategorySwiper", {
        /* Default Parameters */
        slidesPerView: 1.45,
        spaceBetween: 15,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        /* Responsive breakpoints */
        breakpoints: {
            /* when window width is >= 320px */
            320: {
                slidesPerView: 1.45,
                spaceBetween: 15
            },
            /* when window width is >= 480px */
            480: {
                slidesPerView: 2,
                spaceBetween: 15
            },
            /* when window width is >= 768px */
            768: {
                slidesPerView: 3,
                spaceBetween: 15
            },
            /* when window width is >= 1280px */
            1280: {
                slidesPerView: 4,
                spaceBetween: 20
            },
        }
    });
</script>
@stack('scripts')
</body>
</html>