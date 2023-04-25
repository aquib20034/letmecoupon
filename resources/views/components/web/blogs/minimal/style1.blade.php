@if(isset($blog) )
<div class="cardStyle2">
    <div class="card">
        <div class="card__wrapper">
            <div class="card__top">
                <div class="card__thumbnail">
                    <a href="{{ config('app.app_path')}}/ {{ isset($blog['slugs']['slug']) ? ($blog['slugs']['slug']) : '' }}" class="card__tag" aria-label="Visit Blog Page">
                        <span>
                            {{trans('sentence.blog_page')}}
                        </span>
                    </a>

                    <figure>
                        <img src="{{ isset($blog['blog_image']) ? $blog['blog_image'] : config('app.image_path').'/build/images/placeholder.png' }}" alt="">
                    </figure>
                </div>
            </div>

            <div class="card__bottom">
                <div class="card__category">
                    <a href="{{ config('app.app_path')}}/{{ isset($blog['categories'][0]['slug']) ? ($blog['categories'][0]['slug']) :'' }}" aria-label="Visit Category Inner Page">{{ ($blog['categories'][0]['title']) ? $blog['categories'][0]['title'] : "" }}</a>
                </div>

                <div class="card__title">
                    <h2>
                        <a href="{{ config('app.app_path')}}/{{ isset($blog['slugs']['slug']) ? $blog['slugs']['slug'] : '' }}" aria-label="Visit Blog Inner Page">{{ ($blog['title'])?$blog['title']:"" }}</a>
                    </h2>
                </div>

                <div class="card__attributes">
                    <span>
                        <!-- <a href="{{ config('app.app_path')}}/blog-author" aria-label="Visit Author Page">Aaron Paul</a> -->
                        <a href="{{ config('app.app_path')}}/blog/author/{{ isset($blog['author']['id']) ? $blog['author']['id']:'' }}">{{ isset($blog['author']['first_name']) ? $blog['author']['first_name'].' '.$blog['author']['last_name']:'' }}</a>
                    </span>

                    <span>
                        @if(isset($blog['created_at']))
                            {{date('j F Y', strtotime($blog['created_at']) ) }}
                        @endif
                    </span>
                </div>

                <div class="card__cta">
                    <a href="{{ config('app.app_path')}}/{{ isset($blog['slugs']['slug']) ? $blog['slugs']['slug'] : '' }}" aria-label="Visit Blog Inner Page">Start Reading</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
