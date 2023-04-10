<div id="js-headerSearchStyle1" class="search">
    <div class="search__wrapper">
        <input type="text" id="searchInput" placeholder="{{trans('sentence.search_all_field_placeholder')}}" class="search__input">
        </input>

        <div class="search__button default">
            <span class="icon">
                <i class="x_Search">
                    <span class="path1"></span><span class="path2"></span>
                </i>
            </span>
        </div>

        <div class="search__button close">
            <span class="icon">
                <i class="x_close"></i>
            </span>
        </div>
    </div>

    <div id="js-headerSearchStyle1Dropdown" class="search__dropdown">
        <div class="dropdown">
            <div class="dropdown__wrapper">
                <ul class="dropdown__list" id="storeResult"></ul>
                <ul class="dropdown__list">
                    <li class="dropdown__listItem">
                        <a href="{{ config('app.app_path') }}/sitemap" class="title link bold" aria-label="{{trans('sentence.browse_all_stores')}}">{{trans('sentence.browse_all_stores')}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>