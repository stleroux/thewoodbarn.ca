@extends('layouts.admin.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/articles.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li>Permissions</li>
@stop

@section('page_top_menu')
  <div class="well well-sm clearfix">
    <div class="pull-right">
      {{--================================================================================================================================--}}
      {{-- IMPORT / EXPORT DROPDOWN                                                                                                       --}}
      {{--================================================================================================================================--}}
      @ability('admin','permissions_export_admin')
        <div class="btn-group">
          <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-refresh" aria-hidden="true"></i>
            Import / Export <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="{{ route('admin.permissions.import') }}"><i class="fa fa-upload" aria-hidden="true"></i> Import Data</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ URL::to('admin/permissions/downloadExcel/xls') }}"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download as XLS</a></li>
            <li><a href="{{ URL::to('admin/permissions/downloadExcel/xlsx') }}"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download as XLSX</a></li>
            <li><a href="{{ URL::to('admin/permissions/downloadExcel/csv') }}"><i class="fa fa-file-text-o" aria-hidden="true"></i>Download as CSV</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ URL::to('admin/permissions/exportPDF') }}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export to PDF</a></li>
          </ul>
        </div>
      @endability
      {{--================================================================================================================================--}}
      {{-- END IMPORT / EXPORT DROPDOWN                                                                                                   --}}
      {{--================================================================================================================================--}}

      {{--================================================================================================================================--}}
      {{-- ADD BUTTON                                                                                                                     --}}
      {{--================================================================================================================================--}}
      @ability('admin', 'admin,permissions_create,permissions_create_admin')
        <a href="{{ route('admin.permissions.create') }}" class="btn btn-success btn-xs">
          @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}}<i class="fa fa-plus-square" aria-hidden="true"></i> New Permission
          @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}}<i class="fa fa-plus-square" aria-hidden="true"></i>
          @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}}New Permission
          @endif
        </a>
      @endability
      {{--================================================================================================================================--}}
      {{-- END ADD BUTTON                                                                                                                 --}}
      {{--================================================================================================================================--}}
    </div>
  </div>
@stop
@section('content')

  <div class="row">
    <div class="col-md-12">
      <table id="datatable" class="table table-hover table-condensed">
        <thead>
          <tr>
            <th>Name</th>
            <th>Display Name</th>
            <th>Description</th>
            <th>Admin</th>
            <th data-orderable="false"></th>
            </tr>
        </thead>
        <tbody>
          @foreach ($permissions as $permission)
            <tr style="{{ ($permission->admin == 1) ? 'color:#0000FF' : '' }}">
              <td>{{ $permission->name }}</td>
              <td>{{ $permission->display_name }}</td>
              <td>{{ $permission->description }}</td>
              <td>{{ $permission->admin == 1 ? 'Yes' : 'No' }}</td>
              <td class="text-right" nowrap="nowrap">
                {{--================================================================================================================================--}}
                {{-- MAKE ADMIN BUTTON                                                                                                              --}}
                {{--================================================================================================================================--}}
                @if(!$permission->admin == 1)
                  @ability('admin', 'admin,permissions_create_admin')
                    <a href="{{ route('admin.permissions.makeAdmin', $permission->id) }}" class="btn btn-default btn-xs" {{ (Auth::user()->actionButtons == 2 ? 'title=Make Admin' : '') }}>
                      @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}} <i class="glyphicon glyphicon-text-color"></i> Admin
                      @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}} <i class="glyphicon glyphicon-text-color"></i>
                      @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}} Admin
                      @endif
                    </a>
                  @endability
                @endif
                {{--================================================================================================================================--}}
                {{-- END MAKE ADMIN BUTTON                                                                                                          --}}
                {{--================================================================================================================================--}}

                {{--================================================================================================================================--}}
                {{-- EDIT BUTTON                                                                                                                    --}}
                {{--================================================================================================================================--}}
                @ability('admin', 'permissions_edit_admin')
                  <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-primary btn-xs" {{ (Auth::user()->actionButtons == 1) ? 'title=Edit' : '' }}>
                    @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}} <i class="glyphicon glyphicon-pencil"></i> Edit
                    @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}} <i class="glyphicon glyphicon-pencil"></i>
                    @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}} Edit
                    @endif
                  </a>
                @endability
                {{--================================================================================================================================--}}
                {{-- END EDIT BUTTON                                                                                                                --}}
                {{--================================================================================================================================--}}
                
                {{--================================================================================================================================--}}
                {{-- DELETE BUTTON                                                                                                                  --}}
                {{--================================================================================================================================--}}
                @ability('admin', 'admin,permissions_delete,permissions_delete_admin')
                  <form method="POST" action="{{ route('admin.permissions.destroy', $permission->id) }}" accept-charset="UTF-8" style="display:inline">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button
                      class="btn btn-xs btn-danger"
                      {{ Auth::user()->actionButtons == 2 ? 'title=Delete' : '' }}
                      type="button"
                      data-toggle="modal"
                      data-id="{{ $permission->id }}"
                      data-target="#confirmDelete"
                      data-title="Delete Article"
                      data-message="Are you sure you want to delete this permission?">
                        @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}}<i class="glyphicon glyphicon-trash"></i> Delete
                        @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}}<i class="glyphicon glyphicon-trash"></i>
                        @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}}Delete
                        @endif
                    </button>
                  </form>
                @endability
                {{--================================================================================================================================--}}
                {{-- END DELETE BUTTON                                                                                                              --}}
                {{--================================================================================================================================--}}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@stop