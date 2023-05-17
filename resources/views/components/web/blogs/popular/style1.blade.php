@php
    $blogs_popular = isset($web_settings['blogs_popular'])?unserialize($web_settings['blogs_popular']):[];
@endphp

@if(isset($blogs_popular['status']) && $blogs_popular['status'] == 'on')
<div>
    <h2 class="heading-1 primary">{{trans('sentence.popular_blogs')}}</h2>
</div>
@if( isset($popular_blogs) && !empty($popular_blogs) )
<div class="cardGrid-v2">
    <div class="cardGrid">
        @foreach($popular_blogs as $blog)
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
@endif