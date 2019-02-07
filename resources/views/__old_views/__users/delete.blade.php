@extends ('layouts.main')

@section ('title', '| Delete User')

@section ('stylesheets')
    {{ Html::style('css/admin.css') }}
@stop

@section('content')
	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-danger">
				<div class="panel-heading"><h2>Are you sure you want to delete this user?</h2></div>
				<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Email Address</th>
							</tr>
						</thead>
						<tbody>
							<tr>
							<td>{{ $user->first_name }}</td>
								<td>{{ $user->last_name }}</td>
								<td>{{ $user->email }}</td>
							</tr>
						</tbody>
					</table>

					<div class="panel-danger">
						<div class="panel-heading">Removing this user will also delete the following items from the database</div>
						<div class="panel-body">
							<table class="table table-striped table-condensed">
								<tr>
									<td>All recipes created by this user</td>
								</tr>
								<tr>
									<td>All favorites this user added to the system</td>
								</tr>
								<tr>
									<td>All favorites from other users to this user's recipes</td>
								</tr>
								<tr>
									<td>Delete the user's profile image from the system</td>
								</tr>
								<tr>
									<td>Delete all tasks created by this user</td>
								</tr>
								<tr>
									<td>Delete all articles created by this user</td>
								</tr>
								<tr>
									<td>Delete all items created by this user</td>
								</tr>
								<tr>
									<td>Delete all posts created by this user</td>
								</tr>
								<tr>
									<td>Delete all tweets created by this user</td>
								</tr>
								<tr>
									<td class="text-danger">PERMANENTLY delete the user account from the system</td>
								</tr>
							</table>
						</div>
					</div>
					<div class="panel-warning">
						<div class="panel-heading">De-Activating the user</div>
						<div class="panel-body">
							<table class="table table-striped table-condensed">
								<tr>
									<td>De-activating the user will prevent the user from loging in but all relevant data will remain in the database</td>
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
                	{!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE']) !!}
                		<div>
                			<a href="{{ route('users.deactivate', $user->id) }}" class="btn btn-warning btn-lg btn-block" title="Deactivate">
                                <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                                De-Activate
                            </a>
                			{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm btn-block']) !!}
                            <a href="{{ route('users.index') }}" class="btn btn-default btn-sm btn-block">Cancel</a>
    					</div>
    				{!! Form::close() !!}
    			</div>
    		</div>
    	</div>
        
    </div>
@stop

@section ('scripts')
@stop
