<div class="popularListing-v1">
    <div class="popularListing">
        <div class="popularListing__wrapper">
            <div class="popularListing__header">
                <div>
                    <h2 class="heading-1 m-0">{{trans('sentence.popular_stores_brands')}}</h2>
                </div>

                <div>
                    <a href="{{ config('app.app_path') }}/sitemap" class="btn-1 responsive" aria-label="{{trans('global.view_all')}}">{{trans('global.view_all')}}</a>
                </div>
            </div>

            <div class="popularListing__content">
                <ul class="popularListing__list" onmousedown="mouseDownHandler(this, event)" onmouseup="mouseUpHandler(this)" ontouchend="mouseUpHandler(this)" ontouchstart="mouseDownHandler(this, event)">
                    @if(isset($popularStores) && (!empty($popularStores)))
                        @foreach ($popularStores as $popularStore)
                            @php($variant = 2)
                            <li class=" popularListing__listItem">
                                @web_component([ 'postfixes' => 'stores.minimal.style1','data' => ['variant' => $variant, 'store' => $popularStore ] ])@endweb_component
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>