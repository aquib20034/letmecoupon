<div class="container-inner">
    <div>
        <h2 class="heading-1">{{ trans('sentence.recent_blog') }}<!-- Recent Blogs --></h2>
    </div>

    @if(isset($latestBlog))
    <div class="cardGrid-v1">
        <div class="cardGrid">
            @foreach($latestBlog as $latestBlg)
                <div class="cardGrid__item">
                    @web_component([ 'postfixes' => 'blogs.minimal.style2','data' => [ 'latestBlg' => $latestBlg ] ])@endweb_component
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>