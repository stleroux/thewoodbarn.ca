@extends('layouts.admin.main')

@section('title','| ')

@section('stylesheets')
  {{ Html::style('css/admin.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li>Modules</li>
@stop

@section('page_top_menu')
  <div class="well well-sm clearfix">
    <div class="pull-right">{{-- IMPORT / EXPORT DROPDOWN                                                                                                       --}}
      {{--================================================================================================================================--}}
      {{-- @ability('admin','modules_export_admin') --}}
        <div class="btn-group">
          <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-refresh" aria-hidden="true"></i>
            Import / Export <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="{{ route('admin.modules.import') }}"><i class="fa fa-upload" aria-hidden="true"></i> Import Data</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ URL::to('admin/modules/downloadExcel/xls') }}"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download as XLS</a></li>
            <li><a href="{{ URL::to('admin/modules/downloadExcel/xlsx') }}"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download as XLSX</a></li>
            <li><a href="{{ URL::to('admin/modules/downloadExcel/csv') }}"><i class="fa fa-file-text-o" aria-hidden="true"></i>Download as CSV</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ URL::to('admin/modules/exportPDF') }}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export to PDF</a></li>
          </ul>
        </div>
      {{-- @endability --}}
      {{--================================================================================================================================--}}
      {{-- END IMPORT / EXPORT DROPDOWN                                                                                                   --}}
      {{--================================================================================================================================--}}
    </div>
  </div>
@stop

@section('content')

  <div class="row">
    <div class="col-md-9">
      <table id="datatable" class="table table-hover table-condensed">
        <thead>
          <tr>
            <th>Name</th>
            <th data-orderable="false"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($modules as $module)
            <tr>
              <td>{{ $module->name }}</td>
              <td class="text-right">
                {{--================================================================================================================================--}}
                {{-- EDIT BUTTON                                                                                                                    --}}
                {{--================================================================================================================================--}}
                {{-- @ability('admin', 'modules_edit_admin') --}}
                  <a href="{{ route('admin.modules.edit', $module->id) }}" class="btn btn-primary btn-xs" {{ (Auth::user()->actionButtons == 1) ? 'title=Edit' : '' }}>
                    @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}} <i class="glyphicon glyphicon-pencil"></i> Edit
                    @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}} <i class="glyphicon glyphicon-pencil"></i>
                    @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}} Edit
                    @endif
                  </a>
                {{-- @endability --}}
                {{--================================================================================================================================--}}
                {{-- END EDIT BUTTON                                                                                                                --}}
                {{--================================================================================================================================--}}
                
                {{--================================================================================================================================--}}
                {{-- DELETE BUTTON                                                                                                                  --}}
                {{--================================================================================================================================--}}
                {{-- @ability('admin', 'admin,module_delete,modules_delete_admin') --}}
                  <form method="POST" action="{{ route('admin.modules.destroy', $module->id) }}" accept-charset="UTF-8" style="display:inline">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button
                      class="btn btn-xs btn-danger"
                      {{ Auth::user()->actionButtons == 2 ? 'title=Delete' : '' }}
                      type="button"
                      data-toggle="modal"
                      data-id="{{ $module->id }}"
                      data-target="#confirmDelete"
                      data-title="Delete Module"
                      data-message="Are you sure you want to delete this module?">
                        @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}}<i class="glyphicon glyphicon-trash"></i> Delete
                        @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}}<i class="glyphicon glyphicon-trash"></i>
                        @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}}Delete
                        @endif
                    </button>
                  </form>
                {{-- @endability --}}
                {{--================================================================================================================================--}}
                {{-- END DELETE BUTTON                                                                                                              --}}
                {{--================================================================================================================================--}}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>


    <div class="col-md-3">
      {{-- @ability('admin','modules_create') --}}
        {!! Form::open(['route' => 'admin.modules.store']) !!}
          <div class="panel panel-default">
            <div class="panel-heading">New Module</div>
            <div class="panel-body">
              <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                {{ Form::label('name', 'Name', ['class'=>'required']) }}
                {{ Form::text('name', null, ['class' => 'form-control input-sm', 'autofocus']) }}
                <span class="text-danger">{{ $errors->first('name') }}</span>
              </div>
              {{ Form::button('<div class="text text-left"><i class="fa fa-save" aria-hidden="true"></i> Save</div>', array('type' => 'submit', 'class' => 'btn btn-success btn-xs btn-block')) }}
            </div>
            <div class="panel-footer">
              <div>Fields with <i class="fa fa-star" style="color:#ff0000" aria-hidden="true"></i> are required</div>
            </div>
        </div>
      {!! Form::close() !!}
    {{-- @endability --}}
  </div>

</div>

@stop