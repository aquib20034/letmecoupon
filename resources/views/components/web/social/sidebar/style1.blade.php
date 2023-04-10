<h2 class="sidebar__heading">
    Share Via
</h2>

<ul class="sidebar__navList">
    <li class="sidebar__navItem">
        <a href="https://www.facebook.com/sharer.php?u={{ config('app.image_path')}}/{{ ($detail['slugs']) ? $detail['slugs']['slug'] : '' }}" target="_blank" class="sidebar__navLink" aria-label="Visit Our Facebook Profile">
            Facebook
        </a>
    </li>

    <li class="sidebar__navItem">
        <a href="https://twitter.com/share?text={{ config('app.image_path')}}/{{ ($detail['slugs']) ? $detail['slugs']['slug'] : '' }}" target="_blank" class="sidebar__navLink" aria-label="Visit Our Twitter Profile">
            Twitter
        </a>
    </li>

    <li class="sidebar__navItem">
        <a href="https://instagram.com/sharer.php?u={{ config('app.image_path')}}/{{ ($detail['slugs']) ? $detail['slugs']['slug'] : '' }}" target="_blank" class="sidebar__navLink" aria-label="Visit Our Instagram Profile">
            Instagram
        </a>
    </li>
</ul>