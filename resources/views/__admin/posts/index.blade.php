@extends('layouts.admin.main')

@section('title','| ')

@section('stylesheets')
  {{ Html::style('css/admin.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li>Posts</li>
@stop

@section('page_top_menu')
  <div class="well well-sm clearfix">
    <div class="pull-right">
      {{--================================================================================================================================--}}
      {{-- IMPORT / EXPORT DROPDOWN                                                                                                       --}}
      {{--================================================================================================================================--}}
      {{-- @ability('admin','posts_export_admin') --}}
        <div class="btn-group">
          <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-refresh" aria-hidden="true"></i>
            Import / Export <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="{{ route('admin.posts.import') }}"><i class="fa fa-upload" aria-hidden="true"></i> Import Data</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ URL::to('admin/posts/downloadExcel/xls') }}"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download as XLS</a></li>
            <li><a href="{{ URL::to('admin/posts/downloadExcel/xlsx') }}"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download as XLSX</a></li>
            <li><a href="{{ URL::to('admin/posts/downloadExcel/csv') }}"><i class="fa fa-file-text-o" aria-hidden="true"></i>Download as CSV</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ URL::to('admin/posts/exportPDF') }}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export to PDF</a></li>
          </ul>
        </div>
      {{-- @endability --}}
      {{--================================================================================================================================--}}
      {{-- END IMPORT / EXPORT DROPDOWN                                                                                                   --}}
      {{--================================================================================================================================--}}

      {{--================================================================================================================================--}}
      {{-- ADD BUTTON                                                                                                                     --}}
      {{--================================================================================================================================--}}
      {{-- @ability('admin', 'admin,posts_create,posts_create_admin') --}}
        <a href="{{ route('admin.posts.create') }}" class="btn btn-success btn-xs">
          @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}}<i class="fa fa-plus-square" aria-hidden="true"></i> New Post
          @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}}<i class="fa fa-plus-square" aria-hidden="true"></i>
          @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}}New Post
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
            <th>ID</th>
            <th>Title</th>
            <th>Views</th>
            <th>Comments</th>
            <th>Author</th>
            <th>Created At</th>
            <th data-orderable="false"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($posts as $post)
            <tr>
              <th>{{ $post->id }}</th>
              <td><a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a></td>
              <td>{{ $post->views }}</td>
              <td>{{ $post->comments()->count() }}</td>
              <td>@include('layouts.common.author', ['model'=>$post, 'field'=>'user'])</td>
              <td>@include('layouts.common.dateFormat', ['model'=>$post, 'field'=>'created_at'])</td>
              <td>
                {{-- EDIT BUTTON --}}
                {{-- @include('includes.admin.buttons.edit', ['id'=>$post->id, 'uid'=>$post->user->id, 'model'=>'posts']) --}}
                {{-- DELETE BUTTON --}}
                {{-- @include('includes.admin.buttons.delete', ['id'=>$post->id, 'uid'=>$post->user->id, 'model'=>'posts']) --}}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@stop