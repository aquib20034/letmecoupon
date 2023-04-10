<div class="cardStyle4">
    <a href="{{config('app.app_path')}}/review?category={{ $category['slugs']['slug'] }}" class="card card--1" aria-label="Visit Page" draggable="false">
        <div class="card__wrapper">
            <div class="card__top">
                <div class="card__image">
                    <figure>
                        <img src="{{ isset($category['category_image']) ? $category['category_image'] : config('app.image_path') . '/build/images/placeholder.png' }}" alt="" draggable="false">
                    </figure>
                </div>
            </div>

            <div class="card__bottom">
                <h3 class="card__title">
                    {{$category['title'] ? $category['title']:''}}
                </h3>
            </div>
        </div>
    </a>
</div>