
@if(isset($categories) && count($categories) > 0)
    <h2 class="sidebar__heading">{{trans('sentence.related_categories')}}</h2>
    <ul class="sidebar__navList">

    @php
        $categories = array_slice($categories, 0, 10, true);
    @endphp
    @foreach($categories as $category)
        <li class="sidebar__navItem">
            <a href="{{config('app.app_path')}}/{{($module)?$module:''}}?category={{isset( $category['slugs']['slug'] )  ?  $category['slugs']['slug']  : '' }}" class="sidebar__navLink" aria-label="Visit Category">{!! isset($category['title']) ? $category['title'] : '' !!}</a>
        </li>
    @endforeach
    <li class="sidebar__navItem">
        <a href="{{config('app.app_path')}}/{{($module)?$module:''}}-categories" class="sidebar__navLink primary" aria-label="View All Categories">
            {{trans('sentence.view_all_categories')}}
        </a>
    </li>
</ul>
@endif