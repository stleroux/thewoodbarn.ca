@extends('layouts.admin.main')

@section('title', '| Delete?')

@section ('stylesheets')
	{{ Html::style('css/admin.css') }}
@stop

@section('content')
	<div class="col-md-10">
		@include('admin.includes.breadcrumb')

	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-danger">
				<div class="panel-heading">Delete Module?</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel panel-body">
									<table class="table table-condensed">
										<thead>
											<tr>
												<th>ID</th>
												<th>Name</th>
												<th>Created At</th>
												<th>Updated At</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>{{ $module->id}}</td>
												<td>{{ $module->name}}</td>
												<td>{{ $module->created_at}}</td>
												<td>{{ $module->updated_at}}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

					{{-- @while($categories) --}}
					@if($categories->count() > 0)
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-warning">
									<div class="panel panel-heading">The following categories will also be deleted</div>
									<div class="panel panel-body">
										<table class="table table-striped table-condensed">
											<thead>
												<tr>
													<th>ID</th>
													<th>Name</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($categories as $category)
													<tr>
														<th>{{ $category->id }}</th>
														<td>{{ $category->name }}</td>
													</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					{{-- @endwhile --}}
					@endif
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">Options</div>
				<div class="panel-body">
					{{ Form::open(['route' => ['admin.modules.destroy', $module->id], 'method' => 'DELETE']) }}
						
						{{Form::button('<div class="text text-left"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete module</div>', array('type' => 'submit', 'class' => 'btn btn-danger btn-block'))}}
						
						<a href="{{ route('admin.modules.index') }}" class="btn btn-default btn-block">
							<div class="text text-left">
								<i class="fa fa-ban" aria-hidden="true"></i> Cancel
							</div>
						</a>

					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
@stop

@section ('scripts')
@stop