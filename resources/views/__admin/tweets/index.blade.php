@extends('layouts.admin.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/admin.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li>Tweets</li>
@stop

@section('page_top_menu')
  <div class="well well-sm clearfix">
    <div class="pull-right">
      {{--================================================================================================================================--}}
      {{-- IMPORT / EXPORT DROPDOWN                                                                                                       --}}
      {{--================================================================================================================================--}}
      {{-- @ability('admin','tweets_export_admin') --}}
        <div class="btn-group">
          <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-refresh" aria-hidden="true"></i>
            Import / Export <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="{{ route('admin.tweets.import') }}"><i class="fa fa-upload" aria-hidden="true"></i> Import Data</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ URL::to('admin/tweets/downloadExcel/xls') }}"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download as XLS</a></li>
            <li><a href="{{ URL::to('admin/tweets/downloadExcel/xlsx') }}"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download as XLSX</a></li>
            <li><a href="{{ URL::to('admin/tweets/downloadExcel/csv') }}"><i class="fa fa-file-text-o" aria-hidden="true"></i>Download as CSV</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ URL::to('admin/tweets/exportPDF') }}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export to PDF</a></li>
          </ul>
        </div>
      {{-- @endability --}}
      {{--================================================================================================================================--}}
      {{-- END IMPORT / EXPORT DROPDOWN                                                                                                   --}}
      {{--================================================================================================================================--}}

      {{--================================================================================================================================--}}
      {{-- ADD BUTTON                                                                                                                     --}}
      {{--================================================================================================================================--}}
      {{-- @ability('admin', 'admin,tweets_create,tweets_create_admin') --}}
        <a href="{{ route('admin.tweets.create') }}" class="btn btn-success btn-xs">
          @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}}<i class="fa fa-plus-square" aria-hidden="true"></i> New Tweet
          @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}}<i class="fa fa-plus-square" aria-hidden="true"></i>
          @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}}New Tweet
          @endif
        </a>
      {{-- @endability --}}
      {{--================================================================================================================================--}}
      {{-- END ADD BUTTON                                                                                                                 --}}
      {{--================================================================================================================================--}}
    </div>
  </div>
@stop

@section('content')
  <div class="row">
    <div class="col-md-12">
      <table id="datatable" class="table table-hover table-striped table-condensed">
        <thead>
          <tr>
            <th>Title</th>
            <th class="hidden-xs">Author</th>
            <th  class="hidden-sm hidden-xs">Created On</th>
            <th data-orderable="false"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($tweets as $key => $tweet)
            <tr>
              <td><a href="{{ route('admin.tweets.show', $tweet->id) }}" class="">{{ $tweet->title }}</a></td>
              <td class="hidden-xs">@include('layouts.common.author', ['model'=>$tweet, 'field'=>'user'])</td>
              <td class="hidden-sm hidden-xs">@include('layouts.common.dateFormat', ['model'=>$tweet, 'field'=>'created_at'])</td>
              <td class="text-right">
                {{--================================================================================================================================--}}
                {{-- EDIT BUTTON                                                                                                                    --}}
                {{--================================================================================================================================--}}
                {{-- @ability('admin', 'admin,roles_edit,roles_edit_admin') --}}
                  <a href="{{ route('admin.tweets.edit', $tweet->id) }}" class="btn btn-primary btn-xs" {{ (Auth::user()->actionButtons == 1) ? 'title=Edit' : '' }}>
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
                {{-- @ability('admin', 'admin,roles_delete,roles_delete_admin') --}}
                  <form method="POST" action="{{ route('admin.tweets.destroy', $tweet->id) }}" accept-charset="UTF-8" style="display:inline">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button
                      class="btn btn-danger btn-xs"
                      {{ Auth::user()->actionButtons == 2 ? 'title=Delete' : '' }}
                      type="button"
                      data-toggle="modal"
                      data-id="{{ $tweet->id }}"
                      data-target="#confirmDelete"
                      data-title="Delete Role"
                      data-message="Are you sure you want to delete this role?">
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
  </div>
@stop