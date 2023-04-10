@if(isset($category))
<div class="cardStyle4">
    @php($variant = '1')
    <a href="{{ config('app.app_path')}}/{{($category['slugs'])?($category['slugs']['slug'])?$category['slugs']['slug']:'':''}}" class="card  card--{{$variant}}" aria-label="Visit {{($category['title'])?$category['title']:''}} Page" draggable="false">
        <div class="card__wrapper">
            <div class="card__top">
                <div class="card__image">
                    <figure>
                        <img src="{{ ($category['category_image']) ? $category['category_image'] : config('app.app_image') . '/build/images/placeholder.png' }}" alt="{!! ($category['title'])?$category['title']:'' !!}" draggable="false">
                    </figure>
                </div>
            </div>

            <div class="card__bottom">
                <h3 class="card__title">
                    {!!($category['title'])?Str::limit($category['title'], 10):''!!}
                </h3>
            </div>
        </div>
    </a>
</div>
@endif