<div class="cardStyle3">
    <div class="card">
        <div class="card__wrapper">
            <div class="card__left">
                <div class="card__thumbnail">
                    <a href="{{ config('app.image_path')}}/blog" class="card__tag" aria-label="Visit Blog Page">
                        <span>
                            Review
                        </span>
                    </a>

                    <figure>
                        <img src="{{ isset($blog['blog_image']) ? $blog['blog_image'] : config('app.image_path') . '/build/images/placeholder.png' }}" alt="">
                    </figure>
                </div>
            </div>

            <div class="card__bottom">
                <div class="card__category">
                    <a href="{{ config('app.app_path') }}/{{ isset($blog['categories'][0]['slug']) ? $blog['categories'][0]['slug']: '#' }}" aria-label="Visit Category Inner Page">{{ isset($blog['categories'][0]['title']) ? $blog['categories'][0]['title'] : "" }}</a>
                </div>

                <div class="card__title">
                    <h2>
                        <a href="{{ config('app.app_path') }}/{{ ($blog['slugs']) ? $blog['slugs']['slug'] : '' }}" aria-label="Visit Blog Inner Page">
                            {{isset($blog['title']) ? $blog['title'] : ""}}
                        </a>
                    </h2>
                </div>

                <div class="card__attributes">
                    <span>
                        <a href="{{ config('app.image_path')}}/blog-author/{{isset($blog['user']['name']) ? $blog['user']['name'] : ''}}" aria-label="Visit Author Page">
                            {{isset($blog['user']['name']) ? $blog['user']['name'] : ""}}
                        </a>
                    </span>

                    <span>
                        {{ isset($blog['created_at']) ? date('j F Y', strtotime($blog['created_at']) ): "" }}
                    </span>
                </div>

                <div class="card__cta">
                    <a href="{{ config('app.app_path') }}/{{ ($blog['slugs']) ? $blog['slugs']['slug'] : '' }}" aria-label="Visit Blog Inner Page">Start Reading</a>
                </div>
            </div>
        </div>
    </div>
</div>