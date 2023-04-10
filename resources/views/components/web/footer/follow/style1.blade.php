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
        @if(isset($socials) && !empty($socials))
            @foreach ($socials as $social)
                @if ($social['field_name'] && $global_data[$social['field_name']])
                <li class="navigation__item">
                    <a href="{{isset($global_data[$social['field_name']]) ? $global_data[$social['field_name']] : 'https://www.'.$social['field_name'].'.com'}}"
                        title="{{ ucwords($social['icon_name']) }}" target="_blank" class="navigation__link" rel="nofollow noopener noreferrer" aria-label="{{ ucwords($social['icon_name']) }}">
                        {{ ucwords($social['icon_name']) }}
                    </a>
                </li>    
                @endif
            @endforeach
        @endif   
    </ul>
</div>