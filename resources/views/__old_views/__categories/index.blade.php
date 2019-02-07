@extends ('layouts.main')

@section ('title', '| All Categories')

@section ('stylesheets')
	{{ Html::style('css/admin.css') }}
@stop

@section ('content')
	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li class="active">Categories</li>
	</ol>

	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">Categories</div>
				<div class="panel-body">
					@if (count($categories) > 0)
						<table id="datatable" class="table table-hover table-condensed">
							<thead>
								<tr>
									<th>Name</th>
									<th>Module</th>
									@if (Auth::check())
										<th data-orderable="false"></th>
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach ($categories as $category)
									<tr>
										<td>{{ $category->name }}</td>
										<td>{{ $category->module->name }}</td>
										@if (Auth::check())
											<td>@include('partials._buttons', ['model'=>$category, 'field'=>'categories'])</td>
										@endif
									</tr>
								@endforeach
							</tbody>
						</table>
					@else
						<div class="row">
							<div class="col-md-12">
								<div class="alert alert-danger">No records found</div>
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>
		
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">New Category</div>
				<div class="panel-body">
					@ability('admin','categories_create')
						<a href="{{ route('categories.create') }}" class="btn btn-default btn-block">Create New Category</a>
					@endability
				</div>
			</div>
		</div>

	</div>
@stop

@section ('scripts')
    <script type="text/javascript">
        $(document).ready( function () {
            $('#datatable').dynatable();
        } );
    </script>
@stop