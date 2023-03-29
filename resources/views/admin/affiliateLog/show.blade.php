@extends('layouts.admin')
@section('content')

<style type="text/css">
    .short{
        width: 100%;
    }
    .short img{
        max-width: 100%;
    }
</style>
<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.affiliateUrlLogs.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.affiliate-logs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.affiliateUrlLogs.fields.id') }}
                        </th>
                        <th>
                            {{ $affiliateLog->id }}
                        </th>
                    </tr>
                    @if($affiliateLog->coupon_id)
                        <tr>
                            <th>
                                {{ trans('cruds.affiliateUrlLogs.fields.coupon_id') }}
                            </th>
                            <th>
                                {{ $affiliateLog->coupon->id }}
                            </th>
                        </tr>
                    @endif
                    <tr>
                        <th>
                            {{ trans('cruds.affiliateUrlLogs.fields.store_id') }}
                        </th>
                        <th>
                            {{ $affiliateLog->store->id }}
                        </th>
                    </tr>      

                    <tr>
                        <th>
                            {{ trans('cruds.affiliateUrlLogs.fields.module') }}
                        </th>
                        <th>
                            {{ isset($affiliateLog->coupon_id) ? "Coupons" : "Stores" }}
                        </th>
                    </tr>                      
                                                      
                    <tr>
                        <th>
                            {{ trans('cruds.affiliateUrlLogs.fields.store_name') }}
                        </th>
                        <th>
                           {{ $affiliateLog->store->name ?? '' }}
                        </th>
                    </tr>  
                    <tr>
                        <th>
                            {{ trans('cruds.affiliateUrlLogs.fields.coupon_name') }}
                        </th>
                        <th>
                           {{ $affiliateLog->coupon->title ?? '' }}
                        </th>
                    </tr> 
                    <tr>
                        <th>
                            {{ trans('cruds.affiliateUrlLogs.fields.network_name') }}
                        </th>
                        <th>
                           {{ $affiliateLog->network_name ?? '' }}
                        </th>
                    </tr>
                    @if($affiliateLog->action == "updated")    
                        <tr>
                            <th>
                                {{ trans('cruds.affiliateUrlLogs.fields.prev_aff_url') }}
                            </th>
                            <th>
                               {{ $affiliateLog->previous_aff_url }}
                            </th>
                        </tr> 
                    @endif
                    <tr>
                        <th>
                            {{ trans('cruds.affiliateUrlLogs.fields.new_aff_url') }}
                        </th>
                        <th>
                           {{ $affiliateLog->new_aff_url }}
                        </th>
                    </tr> 
                    @if($affiliateLog->action == "updated")    
                        <tr>
                            <th>
                                {{ trans('cruds.affiliateUrlLogs.fields.prev_network') }}
                            </th>
                            <th>
                               {{ getNetworkName($affiliateLog->previous_aff_url) }}
                            </th>
                        </tr> 
                    @endif
                    <tr>
                        <th>
                            {{ trans('cruds.affiliateUrlLogs.fields.new_network') }}
                        </th>
                        <th>
                           {{ getNetworkName($affiliateLog->new_aff_url) }}
                        </th>
                    </tr>                     
                    <tr>
                        <th>
                            {{ trans('cruds.affiliateUrlLogs.fields.created_by') }}
                        </th>
                        <th>
                           {{ isset($affiliateLog->users->name) ? $affiliateLog->users->name : '' }}
                        </th>
                    </tr> 
                    <tr>
                        <th>
                            {{ trans('cruds.affiliateUrlLogs.fields.source') }}
                        </th>
                        <th>
                           {{ $affiliateLog->source ?? '' }}
                        </th>
                    </tr>         

                    <tr>
                        <th>
                            {{ trans('cruds.affiliateUrlLogs.fields.region') }}
                        </th>
                        <th>
                           {{ isset($affiliateLog->websites->country_code) ? strToUpper($affiliateLog->websites->country_code) : '' }}
                        </th>
                    </tr>     
                    <tr>
                        <th>
                            {{ trans('cruds.affiliateUrlLogs.fields.action') }}
                        </th>
                        <th>
                           {{ isset($affiliateLog->action) ? $affiliateLog->action : '' }}
                        </th>
                    </tr>   

                    @if($affiliateLog->coupon_id)
                        <tr>
                            <th>
                                {{ trans('cruds.affiliateUrlLogs.fields.created_at') }}
                            </th>
                            <th>
                               {{ isset($affiliateLog->coupon->created_at) ? $affiliateLog->coupon->created_at->setTimezone('Asia/karachi')->format("d-m-Y H:i:s") : '' }}
                            </th>
                        </tr>
                        @if($affiliateLog->action == "updated")  
                            <tr>
                                <th>
                                    {{ trans('cruds.affiliateUrlLogs.fields.updated_at') }}
                                </th>
                                <th>
                                   {{ isset($affiliateLog->coupon->updated_at) ? $affiliateLog->coupon->updated_at->setTimezone('Asia/karachi')->format("d-m-Y H:i:s") : '' }}
                                </th>
                            </tr>
                        @endif
                    @else
                        <tr>
                            <th>
                                {{ trans('cruds.affiliateUrlLogs.fields.created_at') }}
                            </th>
                            <th>
                               {{ isset($affiliateLog->store->created_at) ? $affiliateLog->store->created_at->setTimezone('Asia/karachi')->format("d-m-Y H:i:s") : '' }}
                            </th>
                        </tr>
                        @if($affiliateLog->action == "updated")  
                            <tr>
                                <th>
                                    {{ trans('cruds.affiliateUrlLogs.fields.updated_at') }}
                                </th>
                                <th>
                                   {{ isset($affiliateLog->store->updated_at) ? $affiliateLog->store->updated_at->setTimezone('Asia/karachi')->format("d-m-Y H:i:s") : '' }}
                                </th>
                            </tr>
                        @endif                    
                    @endif


      

                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.affiliate-logs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection