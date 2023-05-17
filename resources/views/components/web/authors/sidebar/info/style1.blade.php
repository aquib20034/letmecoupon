<h2 class="sidebar__heading">{{trans('sentence.meet_the_author')}}</h2>
<div class="sidebar__author">
    <figure>
        <img src="{{ (isset($author['author']) && $author['author']['image'] != null) ? $author['author']['image']['url'] : config('app.app_image') . '/build/images/author_placeholder.png' }}">
    </figure>
    <h5>
        {{ isset($author['author']['first_name']) ? $author['author']['first_name'] : ''}} 
        {{ isset($author['author']['last_name']) ? $author['author']['last_name'] : ''}}
    </h5>
    <p>{!! isset($author['author']['short_description']) ? $author['author']['short_description']:'' !!}</p>
</div>