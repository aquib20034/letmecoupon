@php
    $categories_popular = isset($web_settings['categories_popular'])?unserialize($web_settings['categories_popular']):[];
@endphp

@if(isset($categories_popular['status']) && $categories_popular['status'] == 'on')
<div class="popularListing-v1">
    <div class="popularListing">
        <div class="popularListing__wrapper">
            <div class="popularListing__header">
                <div>
                    <h2 class="heading-1 m-0">{{trans('sentence.popular_category')}}</h2>
                </div>

                <div>
                    <a href="{{ config('app.app_path') }}/category" class="btn-1 responsive" aria-label="{{trans('global.view_all')}}">{{trans('global.view_all')}}</a>
                </div>
            </div>

            <div class="popularListing__content">
                <ul class="popularListing__list" onmousedown="mouseDownHandler(this, event)" onmouseup="mouseUpHandler(this)" ontouchend="mouseUpHandler(this)" ontouchstart="mouseDownHandler(this, event)">
                    @if(isset($popularCategories))
                        @foreach($popularCategories as $key=>$popularCategory)
                            <li class="popularListing__listItem">
                                <?php //include('../components/Cards/Style4/index.php'); ?>
                                @web_component([ 'postfixes' => 'categories.minimal.style2','data' => ['category' => $popularCategory] ])@endweb_component
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
@endif