
@if(isset($categories) && count($categories) > 0)
<h2 class="sidebar__heading">{{trans('sentence.related_categories')}}</h2>
<ul class="sidebar__navList">

@php
    $categories = array_slice($categories, 0, 10, true);
@endphp
    @foreach($categories as $category)
        <li class="sidebar__navItem">
            <a href="{{config('app.app_path')}}/blog?category={{ $category['slugs']['slug'] }}" class="sidebar__navLink" aria-label="Visit Category">{!! $category['title'] !!}</a>
        </li>
    @endforeach
    <li class="sidebar__navItem">
        <a href="{{config('app.app_path')}}/blog-categories" class="sidebar__navLink primary" aria-label="View All Categories">
            View All Categories
        </a>
    </li>
</ul>
@endif