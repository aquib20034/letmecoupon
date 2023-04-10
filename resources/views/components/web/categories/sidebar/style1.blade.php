@if(isset($categories) && count($categories) > 0)
<h2 class="sidebar__heading">{{trans('sentence.menu_categories')}}</h2>
<ul class="sidebar__navList">
    @foreach($categories as $category)
        <li class="sidebar__navItem">
            @if(isset($sidebarOf) && (($sidebarOf) == "reviews"))
                <a href="{{config('app.app_path')}}/review?category={{ $category['slugs']['slug'] }}" class="sidebar__navLink" aria-label="Visit Category">{!! $category['title'] !!}</a>
            @else
                <a href="{{config('app.app_path')}}/blog?category={{ $category['slugs']['slug'] }}" class="sidebar__navLink" aria-label="Visit Category">{!! $category['title'] !!}</a>
            @endif
        </li>
    @endforeach
    <li class="sidebar__navItem">
        @if(isset($sidebarOf) && (($sidebarOf) == "reviews"))
            <a href="{{config('app.app_path')}}/review-categories" class="sidebar__navLink primary" aria-label="View All Categories">
                {{trans('sentence.view_all_categories')}}
            </a>
        @else
            <a href="{{config('app.app_path')}}/blog-categories" class="sidebar__navLink primary" aria-label="View All Categories">
                {{trans('sentence.view_all_categories')}}
            </a>

        @endif
    </li>
</ul>
@endif