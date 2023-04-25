<div class="container-inner">
    <div>
        <h2 class="heading-1"> {{trans('sentence.trending_blog_reviews')}}</h2>
    </div>

    @if(isset($trendingBlog) && (!empty($trendingBlog)))
        <div class="cardGrid-v1">
            <div class="cardGrid">
                @foreach($trendingBlog as $key=>$trendingBlg)
                    <div class="cardGrid__item @if($key === 0){{'cardGrid__item--vertical'}}@else{{'cardGrid__item--horizontal'}}@endif">
                        @if($key === 0)
                            @web_component([ 'postfixes' => 'blogs.minimal.style1','data' => [ 'blog' => $trendingBlg ] ])@endweb_component
                        @else
                            @web_component([ 'postfixes' => 'blogs.minimal.style2','data' => [ 'blog' => $trendingBlg ] ])@endweb_component
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div>
            <h4>{{ trans('sentence.blogs_not_found') }}</h4>
        </div>
    @endif
</div>