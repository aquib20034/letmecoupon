<ul class="storeListing__list">
    @if(isset($data))
        @foreach ($data as $key => $item)
            <li>
                <div class="storeBoxStyle1">
                    <div id="{{ $key }}" class="storeBox">
                        <div class="storeBox__wrapper">
                            <h2 class="storeBox__heading">
                                {{ strtoupper($key) }}
                            </h2>
                            <ul class="storeBox__list">
                            @if($item)
                                @foreach ($item as $k => $arrItem)
                                    <li class="storeBox__item">
                                        <a href="{{ config('app.app_path') }}/{{ $arrItem['slugs']['slug'] ? $arrItem['slugs']['slug'] : '' }}" class="storeBox__link" aria-label="Visit {!! $arrItem['name'] ?? '' !!} Store Inner Page">    
                                            {!! $arrItem['name'] ?? '' !!}
                                        </a>
                                    </li>
                                @endforeach
                            @endif   
                            </ul>
                        </div>
                    </div>   
                </div>
            </li>
        @endforeach
    @endif   
</ul>