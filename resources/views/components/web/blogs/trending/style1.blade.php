<div class="container-inner">
    <div>
        <h2 class="heading-1">Trending Blogs & Reviews</h2>
    </div>

    <div class="cardGrid-v1">
        <div class="cardGrid">
            @if(isset($trendingBlog))
                @foreach($trendingBlog as $key=>$trendingBlg)
                    <div class="cardGrid__item @if($key === 0){{'cardGrid__item--vertical'}}@else{{'cardGrid__item--horizontal'}}@endif">
                        @if($key === 0)
                            @web_component([ 'postfixes' => 'blogs.minimal.style1','data' => [ 'blog' => $trendingBlg ] ])@endweb_component
                        @else
                            @web_component([ 'postfixes' => 'blogs.minimal.style2','data' => [ 'blog' => $trendingBlg ] ])@endweb_component
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>