

<div class="dropdown">
    <div class="dropdown__wrapper">
        <div class="dropdown__top">
            <div class="dropdown__figure">
                <figure>
                    <img src="{{(isset($nav_all_sites) && COUNT($nav_all_sites) > 0) ? $nav_all_sites[$current_country]['country_flag'] : config('app.image_path') . '/build/images/placeholder.png' }}" alt="{{(isset($nav_all_sites) && COUNT($nav_all_sites) > 0) ? $nav_all_sites[$current_country]['country_name']:''}}">
                </figure>
            </div>

            <span class="dropdown__icon">
                <i class="x_arrow-down-1"></i>
            </span>
        </div>

        <div class="dropdown__bottom">
            <div class="countrySelect">
                <div class="countrySelect__top">
                    <div class="typography">
                        <div class="subTitle">
                            {{trans('sentence.current_region')}}
                        </div>
                        <div class="title">
                            {{(isset($nav_all_sites) && COUNT($nav_all_sites) > 0) ? $nav_all_sites[$current_country]['country_name']:''}}
                        </div>
                    </div>
                    <div class="image">
                        <figure>
                            <img src="{{(isset($nav_all_sites) && COUNT($nav_all_sites) > 0) ? $nav_all_sites[$current_country]['country_flag'] : config('app.image_path') . '/build/images/placeholder.png' }}" alt="{{(isset($nav_all_sites) && COUNT($nav_all_sites) > 0) ? $nav_all_sites[$current_country]['country_name']:''}}">
                        </figure>
                    </div>
                </div>
             
                @if(isset($nav_all_sites) && COUNT($nav_all_sites) > 0)
                <div class="countrySelect__bottom">
                    <div class="subTitle">
                        {{ trans('sentence.region') }}
                    </div>

                    <ul class="countrySelect__list">
                        @foreach($nav_all_sites as $site)
                        <li class="dropdown__listItem">
                            <a href="{{ isset($site['country_code']) ? url(strtolower($site['country_code'])) : '' }}" class="title link">
                            {!! isset($site['country_name']) ? $site['country_name'] : '' !!}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>