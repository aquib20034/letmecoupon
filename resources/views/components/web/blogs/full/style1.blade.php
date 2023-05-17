<div>
    <h2 class="heading-1 primary">>{{ isset($category_data['title']) ? $category_data['title'] : '' }}</h2>
</div>
@if( isset($category_data['blogs']) && count($category_data['blogs']) > 0 )
<div class="cardGrid-v2">
    <div class="cardGrid">
        @foreach($category_data['blogs'] as $blog)
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