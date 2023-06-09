@if(isset($store) && (!empty($store)))
    <div class="cardStyle4">
        <a href="{{ config('app.app_path') }}/{{ isset($store['slugs']['slug']) ? $store['slugs']['slug'] : '' }}" class="card card--{{($variant)?$variant:2}}" aria-label="Visit {!! isset($store['name']) ? $store['name'] : '' !!} Page" draggable="false">    
            <div class="card__wrapper">
                <div class="card__top">
                    <div class="card__image">
                        <figure>
                            <img src="{{ isset($store['store_image']) ? $store['store_image'] : config('app.app_image') . '/build/images/placeholder.png' }}" alt="{!! isset($store['name']) ? $store['name'] : '' !!}" draggable="false">
                        </figure>
                    </div>
                </div>

                <div class="card__bottom d-none">
                    <h3 class="card__title">
                        {!! isset($store['name']) ? (Str::limit($store['name'], 9)) : ''!!}
                    </h3>
                </div>
            </div>
        </a>
    </div>
@endif