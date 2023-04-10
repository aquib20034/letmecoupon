@extends('layouts.admin')
@section('content')
@can('website_setting_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.website-settings.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.websiteSetting.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.websiteSetting.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Permission">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.websiteSetting.fields.site_javascript') }}
                        </th>
                        <th>
                            {{ trans('cruds.websiteSetting.fields.site_html_tags') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($websiteSettings) && count($websiteSettings) > 0)
                        @foreach($websiteSettings as $key => $websiteSetting)
                            <tr data-entry-id="{{ $websiteSetting->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $websiteSetting->site_javascript ?? '' }}
                                </td>
                                 <td>
                                    {{ $websiteSetting->site_html_tags ?? '' }}
                                </td>
                                <td>
                                    @can('website_setting_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.website-settings.show', $websiteSetting->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('website_setting_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.website-settings.edit', $websiteSetting->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr data-entry-id="">
                            <td>

                            </td>
                            <td>
                                
                            </td>
                             <td>
                                
                            </td>
                            <td>
                                

                                @can('website_setting_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route("admin.website-settings.create") }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan


                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>


    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('website_setting_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.website-settings.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': "{{ csrf_token() }}"},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'asc' ]],
    pageLength: 10,
  });
  $('.datatable-Permission:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
