@extends('layouts.admin.main')

@section('title','| ')

@section('stylesheets')
  {{ Html::style('css/admin.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li>Articles</li>
@stop

@section('page_top_menu')
  <div class="well well-sm clearfix">
    <div class="pull-right">
      {{--================================================================================================================================--}}
      {{-- IMPORT / EXPORT DROPDOWN                                                                                                       --}}
      {{--================================================================================================================================--}}
      {{-- @ability('admin','articles_export_admin') --}}
        <div class="btn-group">
          <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-refresh" aria-hidden="true"></i>
            Import / Export <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="{{ route('admin.articles.import') }}"><i class="fa fa-upload" aria-hidden="true"></i> Import Data</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ URL::to('admin/articles/downloadExcel/xls') }}"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download as XLS</a></li>
            <li><a href="{{ URL::to('admin/articles/downloadExcel/xlsx') }}"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download as XLSX</a></li>
            <li><a href="{{ URL::to('admin/articles/downloadExcel/csv') }}"><i class="fa fa-file-text-o" aria-hidden="true"></i>Download as CSV</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ URL::to('admin/articles/exportPDF') }}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export to PDF</a></li>
          </ul>
        </div>
      {{-- @endability --}}
      {{--================================================================================================================================--}}
      {{-- END IMPORT / EXPORT DROPDOWN                                                                                                   --}}
      {{--================================================================================================================================--}}

      {{--================================================================================================================================--}}
      {{-- ADD BUTTON                                                                                                                     --}}
      {{--================================================================================================================================--}}
      {{-- @ability('admin', 'admin,articles_create,articles_create_admin') --}}
        <a href="{{ route('admin.articles.create') }}" class="btn btn-success btn-xs">
          @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}}<i class="fa fa-plus-square" aria-hidden="true"></i> New Article
          @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}}<i class="fa fa-plus-square" aria-hidden="true"></i>
          @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}}New Article
          @endif
        </a>
      {{-- @endability --}}
      {{--================================================================================================================================--}}
      {{-- END ADD BUTTON                                                                                                                 --}}
      {{--================================================================================================================================--}}

{{-- <form method="POST" action="{{ route('admin.articles.deleteSelected', $ids_to_delete) }}" accept-charset="UTF-8" style="display:inline">
  <input type="hidden" name="_method" value="DELETE">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <button
    class="btn btn-xs btn-danger"
    {{ Auth::user()->actionButtons == 2 ? 'title=Delete' : '' }}
    type="button"
    data-toggle="modal"
    data-id="{{ $ids_to_delete }}"
    data-target="#confirmDelete"
    data-title="Delete Article"
    data-message="Are you sure you want to delete this article?">
      @if(Auth::user()->actionButtons == 1) <i class="glyphicon glyphicon-trash"></i> Delete
      @elseif(Auth::user()->actionButtons == 2) <i class="glyphicon glyphicon-trash"></i>
      @elseif(Auth::user()->actionButtons == 3) Delete
      @endif
  </button>
</form> --}}

    </div>
  </div>
@stop

@section('content')
  <div class="row">
    <div class="col-md-12">
      <table id="datatable" class="table table-hover table-striped table-condensed">
        <thead>
          <tr>
            <th></th>
            <th>Title</th>
            <th>Category</th>
            <th class="hidden-xs">Views</th>
            <th class="hidden-xs">Author</th>
            <th class="hidden-sm hidden-xs">Created On</th>
            <th data-orderable="false"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($articles as $key => $article)
            <tr>
              <td>
                {{-- {!! Form::radio('result', $article->id, false, ['disabled'=>'disabled']  )!!} --}}
                {{-- {!! Form::checkbox('result', $article->id, false)!!} --}}
                <input type="checkbox" name=ids_to_delete[]" value="{{$article->id}}" />
              </td>
              <td><a href="{{ route('admin.articles.show', $article->id) }}" class="">{{ $article->title }}</a></td>
              <td>{{ $article->category->name }}</td>
              <td class="hidden-xs">{{ $article->views }}</td>
              <td class="hidden-xs">@include('layouts.common.author', ['model'=>$article, 'field'=>'user'])</td>
              <td class="hidden-sm hidden-xs">@include('layouts.common.dateFormat', ['model'=>$article, 'field'=>'created_at'])</td>
              <td class="text-right" nowrap="nowrap">
                {{--================================================================================================================================--}}
                {{-- DUPLICATE BUTTON                                                                                                               --}}
                {{--================================================================================================================================--}}
                {{-- @ability('admin', 'articles_create_admin') --}}
                  <a href="{{ route('admin.articles.duplicate', $article->id) }}" class="btn btn-default btn-xs" {{ Auth::user()->actionButtons == 2 ? 'title=Duplicate' : '' }}>
                    @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}}<i class="glyphicon glyphicon-duplicate"></i> Duplicate
                    @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}}<i class="glyphicon glyphicon-duplicate"></i>
                    @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}}Duplicate
                    @endif
                  </a>
                {{-- @endability --}}
                {{--================================================================================================================================--}}
                {{-- END DUPLICATE BUTTON                                                                                                           --}}
                {{--================================================================================================================================--}}

                {{--================================================================================================================================--}}
                {{-- EDIT BUTTON                                                                                                                    --}}
                {{--================================================================================================================================--}}
                {{-- @ability('admin', 'articles_edit_admin') --}}
                  <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-primary btn-xs" {{ (Auth::user()->actionButtons == 1) ? 'title=Edit' : '' }}>
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
                {{-- @ability('admin', 'admin,article_delete,articles_delete_admin') --}}
                  <form method="POST" action="{{ route('admin.articles.destroy', $article->id) }}" accept-charset="UTF-8" style="display:inline">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button
                      class="btn btn-xs btn-danger"
                      {{ Auth::user()->actionButtons == 2 ? 'title=Delete' : '' }}
                      type="button"
                      data-toggle="modal"
                      data-id="{{ $article->id }}"
                      data-target="#confirmDelete"
                      data-title="Delete Article"
                      data-message="Are you sure you want to delete this article?">
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

@section('scripts')
@stop