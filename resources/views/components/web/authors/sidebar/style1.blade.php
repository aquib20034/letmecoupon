<h2 class="sidebar__heading">{{trans('sentence.meet_the_authors')}}</h2>
@if(isset($authors) && count($authors) > 0)
<ul class="sidebar__navList">
    @foreach($authors as $author)
        <li class="sidebar__navItem">
            <a href="{{config('app.app_path')}}/{{($module)?$module:''}}/author/{{$author['id']}}" class="sidebar__navLink" aria-label="Visit Page">
                {{$author['first_name']}} {{$author['last_name']}}
            </a>
        </li>
    @endforeach
</ul>
@endif