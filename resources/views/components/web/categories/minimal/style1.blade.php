@if(isset($category) && (!empty($category)))
    <div class="cardStyle1">
        <div class="card">
            <div class="card__wrapper" style="background-image: linear-gradient(180deg, #00000000 0%, #00000073 100%), url({{ isset($category['category_banner_image']['url']) ? ($category['category_banner_image']['url'])?$category['category_banner_image']['url']:config('app.app_image') . '/build/images/placeholder.png' : config('app.app_image') . '/build/images/placeholder.png' }});">
                <div class="card__typography">
                    <h2 class="card__title">
                        {!! isset($category['title']) ? (Str::limit($category['title'], 10)) : '' !!}
                    </h2>
                    <p class="card__subTitle">
                        1000+ Reviews
                    </p>
                </div>
            </div>
        </div>
    </div>
@endif