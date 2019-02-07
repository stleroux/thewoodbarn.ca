@extends('layouts.admin.main')

@section ('title','| ')

@section ('stylesheets')
  {{ Html::style('css/admin.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li>Recipes</li>
@stop

@section('page_top_menu')
  <div class="well well-sm clearfix">
    <div class="pull-right">
      {{--================================================================================================================================--}}
      {{-- IMPORT / EXPORT DROPDOWN                                                                                                       --}}
      {{--================================================================================================================================--}}
      {{-- @ability('admin','recipes_export_admin') --}}
        <div class="btn-group">
          <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-refresh" aria-hidden="true"></i>
            Import / Export <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="{{ route('admin.recipes.import') }}"><i class="fa fa-upload" aria-hidden="true"></i> Import Data</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ URL::to('admin/recipes/downloadExcel/xls') }}"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download as XLS</a></li>
            <li><a href="{{ URL::to('admin/recipes/downloadExcel/xlsx') }}"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download as XLSX</a></li>
            <li><a href="{{ URL::to('admin/recipes/downloadExcel/csv') }}"><i class="fa fa-file-text-o" aria-hidden="true"></i>Download as CSV</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ URL::to('admin/recipes/exportPDF') }}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export to PDF</a></li>
          </ul>
        </div>
      {{-- @endability --}}
      {{--================================================================================================================================--}}
      {{-- END IMPORT / EXPORT DROPDOWN                                                                                                   --}}
      {{--================================================================================================================================--}}

      {{--================================================================================================================================--}}
      {{-- ADD BUTTON                                                                                                                     --}}
      {{--================================================================================================================================--}}
      {{-- @ability('admin', 'admin,recipes_create,recipes_create_admin') --}}
        <a href="{{ route('admin.recipes.create') }}" class="btn btn-success btn-xs">
          @if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}}<i class="fa fa-plus-square" aria-hidden="true"></i> New Recipe
          @elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}}<i class="fa fa-plus-square" aria-hidden="true"></i>
          @elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}}New Recipe
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
      <div class="panel-group" id="accordion">
        <table class="table">
          <tr style="background-color: #C0C0C0">
            <th width="50%">&nbsp;&nbsp;&nbsp;Title</th>
            <th width="18%">Author</th>
            <th width="18%">Create Date</th>
            <th width=""></th>
          </tr>
        </table>
	    	
        @foreach ($recipes as $recipe)
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h4 class="panel-title">
                    <table width="100%" border="0">
                      <tr>
                        <td width="50%"><a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $recipe->id }}">{{ $recipe->title }}</a></td>
                        <td width="18%">@include('layouts.common.author', ['model'=>$recipe, 'field'=>'user'])</td>
                        <td width="18%">@include('layouts.common.dateFormat', ['model'=>$recipe, 'field'=>'created_at'])</td>
                        <td class="text-right" nowrap="nowrap">
                          {{--================================================================================================================================--}}
                          {{-- EDIT BUTTON                                                                                                                    --}}
                          {{--================================================================================================================================--}}
                          {{-- @ability('admin', 'admin,recipes_edit,recipes_edit_admin') --}}
                            <a href="{{ route('admin.recipes.edit', $recipe->id) }}" class="btn btn-primary btn-xs" {{ (Auth::user()->actionButtons == 1) ? 'title=Edit' : '' }}>
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
                          {{-- @ability('admin', 'admin,recipes_delete,recipes_delete_admin') --}}
                            <form method="POST" action="{{ route('recipes.destroy', $recipe->id) }}" accept-charset="UTF-8" style="display:inline">
                              <input type="hidden" name="_method" value="DELETE">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <button
                                class="btn btn-danger btn-xs"
                                {{ Auth::user()->actionButtons == 2 ? 'title=Delete' : '' }}
                                type="button"
                                data-toggle="modal"
                                data-id="{{ $recipe->id }}"
                                data-target="#confirmDelete"
                                data-title="Delete Recipe"
                                data-message="Are you sure you want to delete this recipe?">
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
                    </table>
                  </h4>
              </div>
              <div id="collapse{{ $recipe->id }}" class="panel-collapse collapse">
                <div class="panel-body">
                  <div class="panel panel-primary">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Views</th>
                            <th>Image</th>
                            <th>Modified On</th>
                            <th>Modified By</th>
                            <th>Last Viewed On</th>
                            <th>Last Viewed By</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>{{ $recipe->views }}</td>
                            <td>
                              @if ($recipe->image)
                                <div class="{{ ($recipe->personal)?'text text-danger':''}}">
                                  <i class="fa fa-check" aria-hidden="true"></i>
                                </div>
                              @else
                                <div class="{{ ($recipe->personal)?'text text-danger':''}}">
                                  <i class="fa fa-ban" aria-hidden="true"></i>
                                </div>
                              @endif
                            </td>
                            <td>@include('layouts.common.dateFormat', ['model'=>$recipe, 'field'=>'updated_at'])</td>
                            <td>@include('layouts.common.author', ['model'=>$recipe, 'field'=>'modified_by'])</td>
                            
                            <td>@include('layouts.common.dateFormat', ['model'=>$recipe, 'field'=>'last_viewed_on'])</td>
                            {{-- <td>@include('layouts.common.author', ['model'=>$recipe, 'field'=>'last_viewed_by'])</td> --}}
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        @endforeach
      </div>
      
      <p><strong>Note:</strong> Click on the title to display detailed information related to this record.</p>
    </div>
  </div>
@stop