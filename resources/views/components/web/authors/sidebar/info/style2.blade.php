@if(isset($author) && !empty($author))
<div class="authorCard-v1">
    <div class="authorCard">
        <div class="authorCard__left">
            <figure>
                <img src="{{ ($author['image']) ? $author['image']['url'] : config('app.app_image') . '/build/images/author_placeholder.png' }}" alt="{{ $author['first_name'] }} {{ $author['last_name'] }}">
            </figure>
        </div>
        <div class="authorCard__right">
            <div class="authorCard__heading">
                <h2>
                    {{ isset($author['first_name']) ? $author['first_name'] : ''}} 
                    {{ isset($author['last_name']) ? $author['last_name'] : ''}}
                </h2>
            </div>
            <div class="authorCard__subHeading">
                <h3>{{ (isset($author['author_type']) && !empty($author['author_type'])) ? $author['author_type']['title']:'' }}</h3>
            </div><div class="authorCard__attributes">
                @if(isset($author['review_count']))
                    <span>{{ shortViews($author['review_count']) }}  Reviews</span>
                @else
                    <span>{{ shortViews($author['blogs_count']) }}  Blogs</span>
                @endif
                <span>2.7K Views</span>
                @if( isset($author['languages']) && !empty($author['languages']) )
                    <span>
                    @foreach($author['languages'] as $key => $language)
                            @if($key < count($author['languages'])-1)
                                {{$language['language']}}, 
                            @else
                                {{$language['language']}}
                            @endif
                    @endforeach
                    </span>
                @endif
            </div>
            <div class="authorCard__content">
                <p>{!! $author['short_description'] ? $author['short_description']:'' !!}</p>
            </div>
            <div class="authorCard__social">
                <a href="{{$author['facebook_url'] ? $author['facebook_url'] :'#'}}" target="_blank">
                    <i class="x_facebook-1"></i>
                </a>
                <a href="{{$author['instagram_url'] ? $author['instagram_url'] :'#'}}" target="_blank">
                    <i class="x_instagram-1"></i>
                </a>
                <a href="{{$author['linkedin_url'] ? $author['linkedin_url'] :'#'}}" target="_blank">
                    <i class="x_linkedin-1"></i>
                </a>
                <a href="{{$author['twitter_url'] ? $author['twitter_url'] :'#'}}" target="_blank">
                    <i class="x_twitter-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endif