<h2 class="sidebar__heading">
Meet the Authors
</h2>

<ul class="sidebar__navList">
@if (isset($authors)) 
    @foreach ($authors as $author)
        <li class="sidebar__navItem">
            <a href="{{ config('app.app_path') }}/{{ isset($author['slugs']) ? $author['slugs']['slug'] : '#' }}" class="sidebar__navLink" aria-label="Visit Category Inner Page">
                {{isset($author['first_name']) ? ($author['first_name']) : "" }}
            </a>
        </li>
    @endforeach
@endif