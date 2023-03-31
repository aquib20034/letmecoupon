<h2 class="sidebar__heading">
    Categories
</h2>

<ul class="sidebar__navList">
@if (isset($categories)) 
    @foreach ($categories as $category)
        <li class="sidebar__navItem">
            <a href="{{ config('app.app_path') }}/{{ isset($category['slugs']) ? $category['slugs']['slug'] : '#' }}" class="sidebar__navLink" aria-label="Visit Category Inner Page">
                {{isset($category['title']) ? ($category['title']) : "" }}
            </a>
        </li>
    @endforeach
@endif

    <li class="sidebar__navItem">
        <a href="{{config('app.app_path')}}/category" class="sidebar__navLink primary" aria-label="View All Categories">
            View All Categories
        </a>
    </li>
</ul>