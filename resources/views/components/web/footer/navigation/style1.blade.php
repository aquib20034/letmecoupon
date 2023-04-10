<div class="navigation__wrapper">
    <div class="navigation__heading">
        <h3>
            Navigate to
        </h3>
    </div>
    <!--<ul class="navigation__list">
        <li class="navigation__item">
            <a href="{{ config('app.app_path') }}/category-inner" class="navigation__link" aria-label="Visit Category Inner Page">
                Outdoor Clothing
            </a>
        </li>
        <li class="navigation__item">
            <a href="{{ config('app.app_path') }}/category-inner" class="navigation__link" aria-label="Visit Category Inner Page">
                Outdoor Accessories
            </a>
        </li>
        <li class="navigation__item">
            <a href="{{ config('app.app_path') }}/category-inner" class="navigation__link" aria-label="Visit Category Inner Page">
                Outdoor Sports
            </a>
        </li>
        <li class="navigation__item">
            <a href="{{ config('app.app_path') }}/category-inner" class="navigation__link" aria-label="Visit Category Inner Page">
                Sports Accessories
            </a>
        </li>
    </ul>-->
    <ul class="navigation__list" style="grid-template-columns: repeat(1,1fr);float:left;padding-right: 55px">
        @if (isset($bottom_event) && sizeof($bottom_event) > 0)
            @foreach ($bottom_event as $event)
                @if (isset($event) && isset($event['slugs']))
                    <li class="navigation__item">
                        <a href="{{ config('app.app_path') }}/{{ $event['slugs']['slug'] }}" class="navigation__link" aria-label="{!! $event['title'] !!}">{!! $event['title'] !!}</a>
                    </li>
                @endif
            @endforeach
        @endif
    </ul>
    <ul class="navigation__list" style="grid-template-columns: repeat(1,1fr);;float:left">
        @if (isset($pages))
            @foreach ($pages as $page)
                @if ($page['bottom'] == 1 && $page['publish'] == 1)
                    <li class="navigation__item"><a href="{{ config('app.app_path') }}/{{ $page['slugs']['slug'] }}" class="navigation__link" aria-label="{!! $event['title'] !!}">{{ $page['title'] }}</a></li>
                @endif
            @endforeach
        @endif
        @if ($blogs_count > 0)
            <li class="navigation__item"><a href="{{ config('app.app_path') }}/blog" class="navigation__link" aria-label="{{ trans('sentence.blog_page') }}">{{ trans('sentence.blog_page') }}</a></li>
        @endif
        <li class="navigation__item"><a href="{{ config('app.app_path') }}/sitemap" class="navigation__link" aria-label="{{ trans('sentence.sitemap_page') }}">{{ trans('sentence.sitemap_page') }}</a></li>
        <li class="navigation__item"><a href="{{ config('app.app_path') }}/contact" class="navigation__link" aria-label="{{ trans('sentence.contact_us') }}">{{ trans('sentence.contact_us') }}</a></li>
    </ul>
</div>