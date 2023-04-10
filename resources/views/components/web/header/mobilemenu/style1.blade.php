<div class="mobileMenuStyle1">
    <div class="mobileMenu">
        <div class="mobileMenu__overlay" onclick="toggleHeader1MobileMenu()"></div>
        <div class="mobileMenu__wrapper">
            <div class="mobileMenu__header">
                <a href="{{ config('app.app_path') }}" class="mobileMenu__logo" aria-label="{{config('app.name')}}">
                    <figure>
                        <img src="{{ config('app.image_path') . '/build/images/header-logo.webp' }}" alt="{{config('app.name')}}">
                    </figure>
                </a>

                <button type="button" class="mobileMenu__closeBtn" aria-label="Close Side Menu" onclick="toggleHeader1MobileMenu()">
                    <i class="x_close"></i>
                </button>
            </div>

            <div class="mobileMenu__body">
                <ul class="sideNavigation">
                    <li onclick="toggleSideNavAccordion(this)">
                        <a href="javascript:;" aria-label="{{trans('sentence.menu_stores')}}"><span>{{trans('sentence.menu_stores')}}</span><i class="x_arrow-down-2 chevron-icon"></i></a>

                        <ul class="box-coupons sideDropdown" onclick="toggleHeader1MobileMenu()">
                            @if(isset($nav_popular_stores) && count($nav_popular_stores) > 0)
                                @foreach($nav_popular_stores as $key => $store)
                                <li>
                                    <a href="{{ config('app.app_path') }}/{{ isset($store['slugs']) ? $store['slugs']['slug'] : '#' }}" aria-label="{{ $store['name'] }}">
                                        {{ $store['name'] }}
                                    </a>
                                </li>
                                @endforeach
                            @endif
                            <li>
                                <a href="{{ config('app.app_path') }}/sitemap" class="bold" aria-label="{{trans('sentence.browse_all_stores')}}">
                                    {{trans('sentence.browse_all_stores')}}
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li onclick="toggleSideNavAccordion(this)">
                        <a href="javascript:;" aria-label="{{trans('sentence.menu_categories')}}"><span>{{trans('sentence.menu_categories')}}</span> <i class="x_arrow-down-2 chevron-icon"></i></a>

                        <ul class="box-categories sideDropdown" onclick="toggleHeader1MobileMenu()">
                            @if(isset($nav_popular_categories) && count($nav_popular_categories) > 0)
                                @foreach($nav_popular_categories as $key => $category)
                                    <li>
                                        <a href="{{ config('app.app_path') }}/{{ isset($category['slugs']) ? $category['slugs']['slug'] : '#' }}" aria-label="{{$category['title']}}">
                                            {{$category['title']}}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                            <li>
                                <a href="{{ config('app.app_path') }}/category" class="bold" aria-label="{{trans('sentence.browse_all_categories')}}">
                                    {{trans('sentence.browse_all_categories')}}
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="{{ config('app.app_path') }}/blog" aria-label="{{trans('sentence.visit_blogs_page')}}"><span>{{trans('sentence.menu_blogs')}}</span></a></li>
                    <li><a href="{{ config('app.app_path') }}/review" aria-label="{{trans('sentence.visit_reviews_page')}}"><span>{{trans('sentence.menu_reviews')}}</span></a></li>

                    <li onclick="toggleSideNavAccordion(this)">
                        <a href="javascript:;" aria-label="{{(isset($nav_all_sites) && COUNT($nav_all_sites) > 0) ? $nav_all_sites[$current_country]['country_name']:''}}">
                            <span>{{(isset($nav_all_sites) && COUNT($nav_all_sites) > 0) ? $nav_all_sites[$current_country]['country_name']:''}}</span>
                            <div class="flag-image">
                                <img src="{{(isset($nav_all_sites) && COUNT($nav_all_sites) > 0) ? $nav_all_sites[$current_country]['country_flag'] : config('app.image_path') . '/build/images/placeholder.png' }}" alt="{{(isset($nav_all_sites) && COUNT($nav_all_sites) > 0) ? $nav_all_sites[$current_country]['country_name']:''}}">
                            </div>
                            <i class="x_arrow-down-2 chevron-icon"></i>
                        </a>

                        <ul class="box-countries sideDropdown" onclick="toggleHeader1MobileMenu()">
                            @if(isset($nav_all_sites) && count($nav_all_sites) > 0)
                                @foreach($nav_all_sites as $site)
                                <li>
                                    <a href="{{ isset($site['country_code']) ? url(strtolower($site['country_code'])) : '' }}">
                                        {!! isset($site['country_name']) ? $site['country_name'] : '' !!}
                                    </a>
                                </li>
                                @endforeach
                            @endif
                        </ul>
                    </li>
                    
                    <li><a href="{{ config('app.app_path') }}/about-us" aria-label="Visit {{ trans('sentence.about_us') }} Page"><span>{{ trans('sentence.about_us') }}</span></a></li>
                    <li><a href="{{ config('app.app_path') }}/contact" aria-label="Visit {{ trans('sentence.contact_us') }} Page"><span>{{ trans('sentence.contact_us') }}</span></a></li>
                </ul>
            </div>

            <div class="mobileMenu__footer">
                <div class="mobileMenu__socialLinks">
                    @if(isset($socials) && !empty($socials))
                        @foreach ($socials as $social)
                            @if ($social['field_name'] && $global_data[$social['field_name']])
                                <a href="{{isset($global_data[$social['field_name']]) ? $global_data[$social['field_name']] : 'https://www.'.$social['field_name'].'.com'}}"
                                    title="{{ ucwords($social['icon_name']) }}" target="_blank" rel="nofollow noopener noreferrer" aria-label="{{ ucwords($social['icon_name']) }}">
                                    <i class="x_{{$social['icon_name']}}"></i>
                                </a>
                            @endif
                        @endforeach
                    @endif                    
                </div>
            </div>
        </div>
    </div>
</div>