
@if( isset($author_blogs) && count($author_blogs) > 0 )
<div class="cardGrid-v2">
    <div class="cardGrid">
        @foreach($author_blogs as $blog)
            <div class="cardGrid__item">
                @web_component([ 'postfixes' => 'blogs.minimal.style2','data' => [ 'blog' => $blog  ] ])@endweb_component
            </div>
        @endforeach
    </div>
</div>
@else
    <div>
        <h4>{{ trans('sentence.blogs_not_found') }}</h4>
    </div>
@endif