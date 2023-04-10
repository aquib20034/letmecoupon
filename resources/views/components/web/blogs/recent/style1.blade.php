<div>
    <h2 class="heading-1">{{ trans('sentence.recent_blog') }}<!-- Recent Blogs --></h2>
</div>

@if( isset($recent_blogs) && !empty($recent_blogs) )
<div class="cardGrid-v2">
    <div class="cardGrid">
        @foreach($recent_blogs as $blog)
            <div class="cardGrid__item">
                @web_component([ 'postfixes' => 'blogs.minimal.style2','data' => [ 'blog' => $blog ] ])@endweb_component
            </div>
        @endforeach
    </div>
</div>
@else
    <div>
        <h4>{{ trans('sentence.blogs_not_found') }}</h4>
    </div>
@endif