@extends('layouts.admin.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/admin.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li>Products</li>
@stop

@section('page_top_menu')
  <div class="well well-sm clearfix">
    <div class="pull-right">
      {{--================================================================================================================================--}}
      {{-- IMPORT / EXPORT DROPDOWN                                                                                                       --}}
      {{--================================================================================================================================--}}
      {{-- @ability('admin','products_export_admin') --}}
        <div class="btn-group">
          <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-refresh" aria-hidden="true"></i>
            Import / Export <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="{{ route('admin.products.import') }}"><i class="fa fa-upload" aria-hidden="true"></i> Import Data</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ URL::to('admin/products/downloadExcel/xls') }}"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download as XLS</a></li>
            <li><a href="{{ URL::to('admin/products/downloadExcel/xlsx') }}"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download as XLSX</a></li>
            <li><a href="{{ URL::to('admin/products/downloadExcel/csv') }}"><i class="fa fa-file-text-o" aria-hidden="true"></i>Download as CSV</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ URL::to('admin/products/exportPDF') }}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export to PDF</a></li>
          </ul>
        </div>
      {{-- @endability --}}
      {{--================================================================================================================================--}}
      {{-- END IMPORT / EXPORT DROPDOWN                                                                                                   --}}
      {{--================================================================================================================================--}}

      {{--================================================================================================================================--}}
      {{-- ADD BUTTON                                                                                                                     --}}
      {{--================================================================================================================================--}}
      {{-- @ability('admin', 'admin,categories_create,categories_create_admin') --}}
        <a href="{{ route('admin.products.create') }}" class="btn btn-success btn-xs">
          @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}}<i class="fa fa-plus-square" aria-hidden="true"></i> New Product
          @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}}<i class="fa fa-plus-square" aria-hidden="true"></i>
          @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}}New Product
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
            <th>Category</th>
            <th class="hidden-sm hidden-xs">Description</th>
            <th>Price</th>
            <th class="hidden-xs">Author</th>
            <th data-orderable="false"></th>
          </tr>
        </thead>
        <tbody>
          @forelse ($products as $key => $product)
            <tr>
              <td><a href="{{ route('admin.products.show', $product->id) }}" class="">{{ $product->title }}</a></td>
              <td>{{ $product->category->name }}</td>
              <td class="hidden-sm hidden-xs">{!! str_limit($product->description, $limit = 50, $end = '...') !!}</td>
              <td style="text-align: right;">
                @if ($product->price > 0)
                  $ {{ number_format($product->price, 2, '.', ',') }}
                @else
                  N/A
                @endif
              </td>
              <td class="hidden-xs">@include('layouts.common.author', ['model'=>$product, 'field'=>'user'])</td> 
              <td class="text-rigth" nowrap="nowrap">
                {{--================================================================================================================================--}}
                {{-- EDIT BUTTON                                                                                                                    --}}
                {{--================================================================================================================================--}}
                {{-- @ability('admin', 'admin,products_edit,products_edit_admin') --}}
                  <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary btn-xs" {{ (Auth::user()->actionButtons == 1) ? 'title=Edit' : '' }}>
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
                {{-- @ability('admin', 'admin,products_delete,products_delete_admin') --}}
                  <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" accept-charset="UTF-8" style="display:inline">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button
                      class="btn btn-danger btn-xs"
                      {{ Auth::user()->actionButtons == 2 ? 'title=Delete' : '' }}
                      type="button"
                      data-toggle="modal"
                      data-id="{{ $product->id }}"
                      data-target="#confirmDelete"
                      data-title="Delete Product"
                      data-message="Are you sure you want to delete this product?">
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
          @empty
            <p class="alert alert-danger">No records found</p>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@stop
