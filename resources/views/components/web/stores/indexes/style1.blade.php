<div class="storeBoxStyle1">
    @foreach ($data as $key => $item)
    <div id="{{ $key }}" class="storeBox">
        <div class="storeBox__wrapper">
            <h2 class="storeBox__heading">
                {{ strtoupper($key) }}
            </h2>
            <ul class="storeBox__list">
                @foreach ($item as $k => $arrItem)
                    <li class="storeBox__item">
                        <a href="{{ config('app.app_path') }}/{{ $arrItem['slugs'] ? $arrItem['slugs']['slug'] : '' }}" class="storeBox__link" aria-label="Visit {!! $arrItem['name'] ?? '' !!} Store Inner Page">
                            {!! $arrItem['name'] ?? '' !!}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endforeach
</div>