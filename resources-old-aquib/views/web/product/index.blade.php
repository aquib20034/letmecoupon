@extends('web.layouts.app')
@section('content')
<div class="breadcrumb">
    <ul>
        <li>
            <a href="{{ route('home') }}"><i class="lm_home"></i> Home</a>
        </li>
        <li>
            <a href="{{ route('product') }}">{{ trans('sentence.product_heading') }}</a>
        </li>
    </ul>
</div>
<div class="flexWrapper ftRemMar">
    <div class="contntWrpr">
        <!-- brandLogo class use for brand logo page styling -->
        <div class="popularProducts">
            <div class="flexWrap rowbar">
                @if(!empty($detail))
                    @foreach($detail as $categoryListing)
                        <div class="productlisting">
                            <a href="{{ config('app.app_path') }}/{{ $categoryListing['slugs']['slug'] }}">
                                <div class="icon">
                                    <img src="{{config('app.image_path')}}/build/images/placeholder.png" data-src="{{ isset($categoryListing['product_category_image']) ? $categoryListing['product_category_image'] : config('app.image_path').'/build/images/placeholder.png' }}" alt=""/>
                                </div>
                                <p>{{ $categoryListing['name'] }}</p>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

</div>
@endsection
