<div class="breadCrumbStyle1">
    <ul class="breadCrumbListing">
        @foreach ($routes as $route)
            @if(isset($route["path"]))
                <li>
                    <a href="{{$route['path']}}" class="breadCrumb" aria-label="Visit {{($route['title'])}}">
                        {{($route['title'])}}
                    </a>
                </li>
            @else
                <li>
                    <a class="breadCrumb active" aria-label="Visit {{($route['title'])}}">
                        {{($route['title'])}}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</div>