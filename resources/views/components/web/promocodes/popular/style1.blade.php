<div>
    <h2 class="heading-1">{{ trans('sentence.popular') }} {!! $detail['name'] !!}  {{ trans('sentence.promo_codes_sales') }}</h2>
</div>
<div>
    <div class="tabularDetailsStyle1">
        <div class="tabularDetails">
            <table class="tabularDetails__table">
                <tbody>
                    <tr>
                        <th>{{ trans('sentence.cp_tbl_desc') }}</th>
                        <th>{{ trans('sentence.cp_tbl_detail') }}</th>
                        <th>{{ trans('sentence.cp_tbl_end_date') }}</th>
                    </tr>
                    @foreach ($detail['store_coupons'] as $key => $coupon)
                            @if ($key == 5)
                            @break
                        @endif
                        @php
                            $expiry = $coupon['on_going'] == 1 ? trans('sentence.exp_on_going') : date('M-j-Y', strtotime($coupon['date_expiry']));
                        @endphp
                        <tr>
                            <td class="longColumn">{!! $coupon['title'] !!}</td>
                            <td>{!! $coupon['code'] != '' ? substr($coupon['code'], 0, -3) . '*****' : 'No Cod*****' !!}</td>
                            <td>{!! $expiry !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>