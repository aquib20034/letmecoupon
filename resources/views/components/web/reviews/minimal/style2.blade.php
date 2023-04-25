<div class="cardStyle3">
    <div class="card">
        <div class="card__wrapper">
            <div class="card__left">
                <div class="card__thumbnail">
                    <a href="{{ config('app.app_path') }}/{{ isset($review['slugs']['slug']) ? $review['slugs']['slug'] : '' }}" class="card__tag" aria-label="Visit review Page">
                        <span>
                            {{ trans('sentence.review') }}
                        </span>
                    </a>

                    <figure>
                        <img src="{{ isset($review['review_image']) ? $review['review_image'] : config('app.image_path').'/build/images/placeholder.png' }}" alt="">
                    </figure>
                </div>
            </div>

            <div class="card__bottom">
                <div class="card__category">
                    <a href="{{ config('app.app_path') }}//review?category={{ $review['categories'] != null ? $review['categories'][0]['slug'] :'' }}" aria-label="Visit Category Inner Page">{!! isset($review['categories'][0]['title']) ? $review['categories'][0]['title'] : ""!!}</a>
                </div>

                <div class="card__title">
                    <h2>
                        <a href="{{ config('app.app_path') }}/{{ isset($review['slugs']['slug']) ? $review['slugs']['slug'] : '' }}" aria-label="Visit review Inner Page">{{$review['title'] ? $review['title']:'' }}</a>
                    </h2>
                </div>

                <div class="card__attributes">
                    <span>
                        <a href="{{ config('app.app_path')}}/review/author/{{ isset($review['author']) ? $review['author']['id']:'' }}">{{ isset($review['author']) ? $review['author']['first_name'].' '.$review['author']['last_name']:'' }}</a>
                        <!-- <a href="">{{ isset($review['user']['name']) ? $review['user']['name']:'' }}</a> -->
                    </span>

                    <span>
                        @if(isset($review['created_at']))
                            {{date('j F Y', strtotime($review['created_at']) ) }}
                        @endif
                    </span>
                </div>

                <div class="card__cta">
                    <a href="{{ config('app.app_path') }}/{{ isset($review['slugs']['slug']) ? $review['slugs']['slug'] : '' }}" aria-label="Visit review Inner Page">Start Reading</a>
                </div>
            </div>
        </div>
    </div>
</div>