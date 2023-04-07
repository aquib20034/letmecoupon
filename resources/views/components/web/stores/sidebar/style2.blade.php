@if($relatedStores->store_details !== null)
    <h2 class="sidebar__heading">
        Related Stores
    </h2>

    @if(count($relatedStores->store_details) > 0)
        <div class="popularListing-v1">
            <div class="popularListing popularListing--grid-3">
                <div class="popularListing__wrapper">
                    <div class="popularListing__content">
                        <ul class="popularListing__list">
                            @foreach($relatedStores->store_details as $store)
                                <li class="popularListing__listItem">
                                    <?php $variant = '3'; ?>
                                    @web_component([ 'postfixes' => 'stores.minimal.style1','data' => ['variant' => $variant, 'store' => $store ] ])@endweb_component
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div>
            <h4>{{ trans('sentence.stores_not_found') }}</h4>
        </div>
    @endif
@endif