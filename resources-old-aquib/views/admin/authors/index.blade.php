@extends('layouts.admin')
@section('content')
@can('author_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-8">
            <a class="btn btn-success" href="{{ route("admin.authors.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.author.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.author.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Author">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th width="50">
                            {{ trans('cruds.author.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.author.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.author.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.author.fields.phone') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($authors as $key => $author)
                        <tr data-entry-id="{{ $author->id }}">
                            <td>
                                &nbsp;
                            </td>
                            <td align="center">
                                @if($author->image)
                                    <a href="{{ $author->image->getUrl() }}" target="_blank">
                                        <img src="{{ $author->image->getUrl('thumb') }}" width="50px" height="50px">
                                    </a>
                                @else
                                    <img src="{{asset('build/images/author_placeholder.png')}}" width="50px" height="50px">
                                @endif
                            </td>
                            <td>
                                {{ $author->first_name ?? '' }}&nbsp;{{ $author->last_name ?? '' }} 
                            </td>
                            <td>
                                {{ $author->email ?? '' }}
                            </td>
                            <td>
                                {{ $author->phone ?? '' }}
                            </td>
                            <td>
                                @can('author_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.authors.show', $author->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('author_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.authors.edit', $author->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('author_delete')
                                    @php
                                        $url = isset(request()->test_id) ? route('admin.authors.destroy', $author->id) . '?test_id=1' : route('admin.authors.destroy', $author->id);
                                    @endphp
                                    <form action="{{ $url }}" id="{{ 'authors' . $author->id }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    function siteOpt(siteId, modelName) {
        $.ajax({
            headers: {'x-csrf-token': "{{ csrf_token() }}"},
            method: 'POST',
            url: '/admin/filter_records',
            data: { siteId, modelName },
            beforeSend: function() {
                $('.datatable-Author').DataTable().clear().row.add(['', '', '', '', '', '', '']).draw();
                $(`<div id="DataTables_Table_0_processing" class="dataTables_processing card" style="display: block;">Processing...</div>`).insertAfter("#DataTables_Table_0_info")
            },
            success: function(data) {

                const obj = JSON.parse(data);
                var table = $('.datatable-Author').DataTable();

                if(obj.length > 0) {
                    table.clear();
                    obj.forEach(function(key) {
                        table.row
                            .add([
                                '',
                                `<span class="badge badge-info">${key['first_name']}</span>`,
                                key['last_name'],
                                key['email'],
                                key['phone'],
                                `
                                @can('author_show')
                                    <a class="btn btn-xs btn-primary" href="/admin/${modelName}/${key['id']}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('author_edit')
                                    <a class="btn btn-xs btn-info" href="/admin/${modelName}/${key['id']}/edit">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('author_delete')
                                    <form action="/admin/${modelName}/${key['id']}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan
                                `
                            ]).draw();

                        $(".datatable-Author tbody tr").attr('data-entry-id', `${key['id']}`)
                    });
                } else {
                    table.clear().draw();
                }
                $("#DataTables_Table_0_processing").remove();

            }
        })
    }

    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        @can('author_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.authors.massDestroy') }}",
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
        order: [[ 2, 'asc' ]],
        pageLength: 10,
    });
    $('.datatable-Author:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
