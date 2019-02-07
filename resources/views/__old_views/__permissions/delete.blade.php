@extends ('layouts.main')

@section ('title', '| Delete User')

@section ('stylesheets')
    {{ Html::style('css/admin.css') }}
@stop

@section('content')
	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-danger">
				<div class="panel-heading"><h2>Are you sure you want to delete this permission?</h2></div>
				<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<th>Internal Name</th>
								<th>Display Name</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{ $permission->name }}</td>
								<td>{{ $permission->display_name }}</td>
								<td>{{ $permission->description }}</td>
							</tr>
						</tbody>
					</table>

					<div class="panel-danger">
						<div class="panel-heading">Removing this permission will also delete the following items from the database</div>
						<div class="panel-body">
							<table class="table table-striped table-condensed">
								<tr>
									<td>All users that have been assigned this permission will lose this permission</td>
								</tr>
								<tr>
									<td></td>
								</tr>
							</table>
						</div>
					</div>
                </div>
    	        <div class="panel-footer"></div>
    		</div>
        </div>

        <div class="col-md-3">
        	<div class="panel panel-danger">
                <div class="panel-heading">Options</div>
                <div class="panel-body">
                	{!! Form::open(['route' => ['permissions.destroy', $permission->id], 'method' => 'DELETE']) !!}
                		<div>
                			{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm btn-block']) !!}
                            <a href="{{ route('permissions.index') }}" class="btn btn-default btn-sm btn-block">Cancel</a>
    					</div>
    				{!! Form::close() !!}
    			</div>
    		</div>
    	</div>
        
    </div>
@stop

@section ('scripts')
@stop
