@extends ('layouts.main')

@section ('title', '| ')

@section ('stylesheets')
	{{ Html::style('css/admin.css') }}
@stop 
 
@section('content')

	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
		<li class="active">Permissions</li>
	</ol>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Permissions Management
					<div class="pull-right">
			        	@ability('admin','permissions_export')
							<div class="btn-group">
							  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    Import / Export <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu">
							    <li><a href="{{ route('permissions.import') }}">Import Data</a></li>
							    <li role="separator" class="divider"></li>
							    <li><a href="{{ URL::to('permissions/downloadExcel/xls') }}">Download as XLS</a></li>
							    <li><a href="{{ URL::to('permissions/downloadExcel/xlsx') }}">Download as XLSX</a></li>
							    <li><a href="{{ URL::to('permissions/downloadExcel/csv') }}">Download as CSV</a></li>
							    <li role="separator" class="divider"></li>
							    <li><a href="{{ URL::to('permissions/exportPDF') }}">Export to PDF</a></li>
							  </ul>
							</div>
				        @endability
				        @ability('admin','roles_list')
				       		<a class="btn btn-default btn-xs" href="{{ route('roles.index') }}">Roles</a>
				       	@endability
				       	@ability('admin','users_list')
				       		<a class="btn btn-default btn-xs" href="{{ route('users.index') }}">Users</a>
				       	@endability
			        	@ability('admin','permissions_create')
			            	<a class="btn btn-success btn-xs" href="{{ route('permissions.create') }}"> Create New Permission</a>
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
								@if(Auth::check())
									<th data-orderable="false"></th>
								@endif
							</tr>
						</thead>
						<tbody>
							@foreach ($permissions as $key => $permission)
								<tr>
									<td>{{ ++$i }}</td>
									<td>{{ $permission->name }}</td>
									<td>{{ $permission->display_name }}</td>
									<td>{{ $permission->description }}</td>
									@if (Auth::check())
										<td>@include('partials._buttons', ['model'=>$permission, 'field'=>'permissions'])</td>
									@endif
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@stop

@section ('scripts')
	<script type="text/javascript">
		$.dynatableSetup({
			// your global default options here
			features: {
				paginate: true,
				recordCount: true,
				sorting: true,
				search: true
			},
			dataset: {
				perPageDefault: 20,
				perPageOptions: [10,15,20,25,50,100],
			},
		});
		$(document).ready( function () {
			$('#datatable').dynatable();
		} );
	</script>
@stop