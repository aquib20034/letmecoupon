<div class="navigation__wrapper">
    <div class="navigation__heading">
        <h3>
            Follow Us
        </h3>
    </div>

    <ul class="navigation__list">
        <!--<li class="navigation__item">
            <a href="https://www.facebook.com/" target="_blank" rel="nofollow noopener noreferrer" class="navigation__link" aria-label="Visit Our Facebook Profile">
                Facebook
            </a>
        </li>
        <li class="navigation__item">
            <a href="https://www.instagram.com/" target="_blank" rel="nofollow noopener noreferrer" class="navigation__link" aria-label="Visit Our Instagram Profile">
                Instagram
            </a>
        </li>
        <li class="navigation__item">
            <a href="https://twitter.com/" target="_blank" rel="nofollow noopener noreferrer" class="navigation__link" aria-label="Visit Our Twitter Profile">
                Twitter
            </a>
        </li>
        <li class="navigation__item">
            <a href="https://www.linkedin.com/" target="_blank" rel="nofollow noopener noreferrer" class="navigation__link" aria-label="Visit Our LinkedIn Profile">
                LinkedIn
            </a>
        </li>-->
        @php
            $socials = [['field_name' => 'facebook', 'icon_name' => 'facebook'], ['field_name' => 'twitter', 'icon_name' => 'twitter'], ['field_name' => 'instagram', 'icon_name' => 'instagram'], ['field_name' => 'linked_in', 'icon_name' => 'linkedin'], ['field_name' => 'youtube', 'icon_name' => 'youtube'], ['field_name' => 'pinterest', 'icon_name' => 'facebook']];
        @endphp
        @foreach ($socials as $social)
            @if ($social['field_name'])
                <li class="navigation__item">
                    <a href="{{ $global_data[$social['field_name']] }}"
                        title="{{ ucwords($social['icon_name']) }}" target="_blank" rel="nofollow noopener noreferrer" class="navigation__link" aria-label="{{ ucwords($social['icon_name']) }}">
                        {{ ucwords($social['icon_name']) }}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</div>