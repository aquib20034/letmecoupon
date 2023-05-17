@php
    $blogs_popular = isset($web_settings['blogs_popular'])?unserialize($web_settings['blogs_popular']):[];
@endphp

@if(isset($blogs_popular['status']) && $blogs_popular['status'] == 'on')
@if( isset($popular_blogs) && !empty($popular_blogs) )
<div class="container-inner">
    <div>
        <h2 class="heading-1">{{trans('sentence.popular_blogs')}}</h2>
    </div>

    <div class="cardGrid-v1">
        <div class="cardGrid">
            @foreach($popular_blogs as $blog)
                <div class="cardGrid__item">
                    <?php //include('../components/Cards/Style3/index.php'); ?>
                    @web_component([ 'postfixes' => 'blogs.minimal.style2','data' => [ 'blog' => $blog ] ])@endweb_component
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@endif