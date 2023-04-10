@extends('layouts.admin')
@section('content')
<style type="text/css">
    .label-catg {
        background: #dcc4c4;
        padding: 5px;
        margin: 2px;
        display: block;
        color: #000;
        font-size: 11px;
    }
</style>
@can('blog_detail_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
         <!--    <a class="btn btn-success" href="{{ route('admin.blog-details.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.blogDetail.title_singular') }}
            </a> -->
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.affiliateUrlLogs.title') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-BlogDetail">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.affiliateUrlLogs.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.affiliateUrlLogs.fields.store_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.affiliateUrlLogs.fields.coupon_name') }}
                    </th>     
                    <th>
                        {{ trans('cruds.affiliateUrlLogs.fields.prev_aff_url') }}
                    </th> 
                    <th>
                        {{ trans('cruds.affiliateUrlLogs.fields.new_aff_url') }}
                    </th> 
                    <th>
                        {{ trans('cruds.affiliateUrlLogs.fields.action') }}
                    </th>                                                                                
<!--                     <th>
                        {{ trans('cruds.blogDetail.fields.coupon_name') }}
                    </th>
                    <th width="140">
                        {{ trans('cruds.blogDetail.fields.previous_affiliate_url') }}
                    </th>
                    <th>
                        {{ trans('cruds.blogDetail.fields.new_affiliate_url') }}
                    </th> -->
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>


    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('blog_detail_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.blog-details.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.affiliate-logs.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
    { data: 'id', name: 'id' },
    { data: 'store_name', name: 'store.name' },
    { data: 'coupon_name', name: 'coupon.title' },
    { data: 'previous_aff_url', name: 'previous_aff_url' },
    { data: 'new_aff_url', name: 'new_aff_url' },
    { data: 'action', name: 'action' },
    // { data: 'title', name: 'title' },
    // { data: 'category', name: 'categories.title' },
    // { data: 'publish', name: 'publish' },
    { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-BlogDetail').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection