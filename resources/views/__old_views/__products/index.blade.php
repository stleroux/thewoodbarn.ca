@extends ('layouts.main')

@section ('title', '| ')

@section ('stylesheets')
	{{ Html::style('css/admin.css') }}
@stop 

@section('content')
	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li class="active">Products</li>
	</ol>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Products
					<div class="pull-right">
						@ability('admin','products_export')
			        		<div class="btn-group">
								<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Import / Export <span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="{{ route('products.import') }}">Import Data</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="{{ URL::to('products/downloadExcel/xls') }}">Download as XLS</a></li>
									<li><a href="{{ URL::to('products/downloadExcel/xlsx') }}">Download as XLSX</a></li>
									<li><a href="{{ URL::to('products/downloadExcel/csv') }}">Download as CSV</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="{{ URL::to('products/exportPDF') }}">Export to PDF</a></li>
								</ul>
							</div>
						@endability
						@ability('admin','products_create')
							<a class="btn btn-success btn-xs" href="{{ route('products.create') }}"> Create New Product</a>
						@endability
			        </div>
				</div>
				<div class="panel-body">
					<table id="datatable" class="table table-hover table-striped table-condensed">
						<thead>
							<tr>
								<th>Title</th>
								<th>Category</th>
								<th class="hidden-sm hidden-xs">Description</th>
								<th>Price</th>
								<th class="hidden-xs">Author</th>
								@if (Auth::check())
									<th data-orderable="false"></th>
								@endif
							</tr>
						</thead>
						<tbody>
							@forelse ($products as $key => $product)
								<tr>
									<td><a href="{{ route('products.show', $product->id) }}" class="">{{ $product->title }}</a></td>
									<td>{{ $product->category->name }}</td>
									<td class="hidden-sm hidden-xs">{!! str_limit($product->description, $limit = 45, $end = '...') !!}</td>
									<td style="text-align: right;">
										@if ($product->price > 0)
											$ {{ number_format($product->price, 2, '.', ',') }}
										@else
											N/A
										@endif
									</td>
									<td class="hidden-xs">@include('partials._author', ['model'=>$product, 'field'=>'user'])</td> 
									@if (Auth::check())
										<td>@include('partials._buttons', ['model'=>$product, 'field'=>'products'])</td>
									@endif
								</tr>
							@empty
								<p class="alert alert-danger">No records found</p>
							@endforelse
						</tbody>
					</table>
				</div>
				<div class="panel-footer"></div>
			</div>
		</div>
	</div>		
@stop

@section ('scripts')
@stop