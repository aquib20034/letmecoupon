<div class="storeBoxStyle1">
    @if(isset($alphabet) && (!(empty($alphabet))))
        @foreach ($alphabet as $key => $item)
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
    @endif
</div>