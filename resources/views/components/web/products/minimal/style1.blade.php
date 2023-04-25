@if(isset($product) && (!empty($product)))
<div class="cardStyle4">
    @php($variant = '2')
    <a href="{{ config('app.app_path')}}/{{isset($product['slugs']['slug']) ? ($product['slugs']['slug']) :''}}" class="card  card--{{$variant}}" aria-label="Visit {{ (isset($product['name'])) ? ($product['name']) : '' }} Page" draggable="false">
        <div class="card__wrapper">
            <div class="card__top">
                <div class="card__image">
                    <figure>
                        <img src="{{ isset($product['product_category_image']) ? ($product['product_category_image']) : config('app.app_image') . '/build/images/placeholder.png' }}" alt="{!! (isset($product['name'])) ? ($product['name']) : '' !!}" draggable="false">
                    </figure>
                </div>
            </div>

            <div class="card__bottom">
                <h3 class="card__title">
                    {!! isset($product['name']) ? (Str::limit($product['name'], 9)) :''!!}
                </h3>
            </div>
        </div>
    </a>
</div>
@endif