@if( isset($latestBlogs) && !empty($latestBlogs) )
<div class="container-inner">
    <div>
        <h2 class="heading-1">{{ trans('sentence.recent_blog') }}<!-- Recent Blogs --></h2>
    </div>

    @if(isset($latestBlogs))
    <div class="cardGrid-v1">
        <div class="cardGrid">
            @foreach($latestBlogs as $blog)
                <div class="cardGrid__item">
                    @web_component([ 'postfixes' => 'blogs.minimal.style2','data' => [ 'blog' => $blog ] ])@endweb_component
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endif