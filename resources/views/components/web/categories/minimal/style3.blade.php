@foreach ($categories as $category)
<div>
    <div class="cardStyle5">
        <div class="card">
            <div class="card__wrapper">
                <a href="{{ config('app.app_path') }}/{{ isset($category['slugs']) ? $category['slugs']['slug'] : '#' }}" class="card__image" aria-label="Visit Category Inner Page">
                    <figure>
                        <img src="{{ isset($category['category_banner_image']) ? $category['category_banner_image'] : $category['category_image'] }}" alt="Category Name">
                    </figure>
                </a>
                <div class="card__typography">
                    <a href="{{ config('app.app_path') }}/{{ isset($category['slugs']) ? $category['slugs']['slug'] : '#' }}" class="card__title" aria-label="Visit Category Inner Page">
                        <h2>{!! $category['title'] !!}</h2>
                    </a>
                    <div class="card__subTitle">
                        100 Reviews
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach