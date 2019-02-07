@extends ('layouts.main')

@section ('title', '| ')

@section ('stylesheets')
	{{ Html::style('css/admin.css') }}
@stop 
 
@section('content')

	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
		<li class="active">Roles</li>
	</ol>

	<div class="row">
	    <div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Roles Management
					<div class="pull-right">
			        	@ability('admin','roles_export')
							<div class="btn-group">
							  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    Import / Export <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu">
							    <li><a href="{{ route('roles.import') }}">Import Data</a></li>
							    <li role="separator" class="divider"></li>
							    <li><a href="{{ URL::to('roles/downloadExcel/xls') }}">Download as XLS</a></li>
							    <li><a href="{{ URL::to('roles/downloadExcel/xlsx') }}">Download as XLSX</a></li>
							    <li><a href="{{ URL::to('roles/downloadExcel/csv') }}">Download as CSV</a></li>
							    <li role="separator" class="divider"></li>
							    <li><a href="{{ URL::to('roles/exportPDF') }}">Export to PDF</a></li>
							  </ul>
							</div>
				        @endability
				        @ability('admin','permissions_list')
			        		<a class="btn btn-default btn-xs" href="{{ route('permissions.index') }}">Permissions</a>
			        	@endability
			        	@ability('admin','users_list')
			        		<a class="btn btn-default btn-xs" href="{{ route('users.index') }}">Users</a>
			        	@endability
			        	@ability('admin','roles_create')
			        	    <a class="btn btn-success btn-xs" href="{{ route('roles.create') }}">Create New Role</a>
			            @endability
			        </div>
				</div>

				<div class="panel-body">
					<table id="datatable" class="table table-hover table-striped table-condensed">
						<thead>
							<tr>
								<th>No</th>
								<th>Internal Name</th>
								<th>Display Name</th>
								<th>Description</th>
								@if (Auth::check())
									<th data-orderable="false"></th>
								@endif
							</tr>
						</thead>
						
						@foreach ($roles as $key => $role)
						<tr>
							<td>{{ ++$i }}</td>
							<td>{{ $role->name }}</td>
							<td>{{ $role->display_name }}</td>
							<td>{{ $role->description }}</td>
							@if (Auth::check())
								<td>@include('partials._buttons', ['model'=>$role, 'field'=>'roles'])</td>
							@endif
						</tr>
						@endforeach
					</table>
				</div>

			</div>
		</div>
	</div>
@stop

@section ('scripts')
@stop