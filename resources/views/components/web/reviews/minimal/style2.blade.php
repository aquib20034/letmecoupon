<div class="cardStyle3">
    <div class="card">
        <div class="card__wrapper">
            <div class="card__left">
                <div class="card__thumbnail">
                    <a href="{{ config('app.image_path')}}/reviews" class="card__tag" aria-label="Visit review Page">
                        <span>
                            Review
                        </span>
                    </a>

                    <figure>
                        <img src="{{ isset($review['review_image']) ? $review['review_image'] : config('app.image_path') . '/build/images/placeholder.png' }}" alt="">
                    </figure>
                </div>
            </div>

            <div class="card__bottom">
                <div class="card__category">
                    <a href="{{ config('app.app_path') }}/{{ isset($review['categories'][0]['slug']) ? $review['categories'][0]['slug']: '#' }}" aria-label="Visit Category Inner Page">{{ isset($review['categories'][0]['title']) ? $review['categories'][0]['title'] : "" }}</a>
                </div>

                <div class="card__title">
                    <h2>
                        <a href="{{ config('app.app_path') }}/{{ isset($review['slugs']) ? $review['slugs']['slug'] : '' }}" aria-label="Visit review Inner Page">
                            {{isset($review['title']) ? $review['title'] : ""}}
                        </a>
                    </h2>
                </div>

                <div class="card__attributes">
                    <span>
                        <a href="{{ config('app.image_path')}}/review-author/{{isset($review['user']['name']) ? $review['user']['name'] : ''}}" aria-label="Visit Author Page">
                            {{isset($review['user']['name']) ? $review['user']['name'] : ""}}
                        </a>
                    </span>

                    <span>
                        {{ isset($review['created_at']) ? date('j F Y', strtotime($review['created_at']) ): "" }}
                    </span>
                </div>

                <div class="card__cta">
                    <a href="{{ config('app.app_path') }}/{{ isset($review['slugs']) ? $review['slugs']['slug'] : '' }}" aria-label="Visit review Inner Page">Start Reading</a>
                </div>
            </div>
        </div>
    </div>
</div>