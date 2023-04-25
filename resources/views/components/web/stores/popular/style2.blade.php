<h2 class="sidebar__heading">{{ isset($title) ? ($title) : ""}}</h2>

<div class="popularListing-v1">
    <div class="popularListing popularListing--grid-3">
        <div class="popularListing__wrapper">
            <div class="popularListing__content">
                <ul class="popularListing__list">
                    @if(isset($stores) && (!empty($stores)))
                        @foreach ($stores as $store)
                            @php($variant = 3)
                            <li class=" popularListing__listItem">
                                @web_component([ 'postfixes' => 'stores.minimal.style1','data' => ['variant' => $variant, 'store' => $store ] ])@endweb_component
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>