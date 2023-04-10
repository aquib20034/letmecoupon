<div class="cardStyle2">
    <div class="card">
        <div class="card__wrapper">
            <div class="card__top">
                <div class="card__thumbnail">
                    <a href="{{ config('app.app_path')}}/{{ ($blog['slugs']) ? $blog['slugs']['slug'] : '' }}" class="card__tag" aria-label="Visit Blog Page">
                        <span>
                            Blog
                        </span>
                    </a>

                    <figure>
                        <img src="{{ isset($blog['blog_image']) ? $blog['blog_image'] : config('app.image_path').'/build/images/placeholder.png' }}" alt="">
                    </figure>
                </div>
            </div>

            <div class="card__bottom">
                <div class="card__category">
                    <a href="{{ config('app.app_path')}}/{{ ($blog['categories'][0]['slug'])?$blog['categories'][0]['slug']:'' }}" aria-label="Visit Category Inner Page">{{ ($blog['categories'][0]['title'])?$blog['categories'][0]['title']:"" }}</a>
                </div>

                <div class="card__title">
                    <h2>
                        <a href="{{ config('app.app_path')}}/{{ ($blog['slugs']) ? $blog['slugs']['slug'] : '' }}" aria-label="Visit Blog Inner Page">{{ ($blog['title'])?$blog['title']:"" }}</a>
                    </h2>
                </div>

                <div class="card__attributes">
                    <span>
                        <a href="{{ config('app.app_path')}}/blog-author" aria-label="Visit Author Page">Aaron Paul</a>
                    </span>

                    <span>
                        {{date('j F Y', strtotime($blog['created_at']) ) }}
                    </span>
                </div>

                <div class="card__cta">
                    <a href="{{ config('app.app_path')}}/{{ ($blog['slugs']) ? $blog['slugs']['slug'] : '' }}" aria-label="Visit Blog Inner Page">Start Reading</a>
                </div>
            </div>
        </div>
    </div>
</div>