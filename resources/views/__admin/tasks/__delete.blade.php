@extends ('layouts.admin.main')

@section ('title', '| Delete User')

@section ('stylesheets')
    {{ Html::style('css/admin.css') }}
@stop

@section('content')

	<div class="col-md-10">
		@include('admin.includes.breadcrumb')
		<div class="row">
			<div class="col-md-9">
				<div class="panel panel-danger">
					<div class="panel-heading"><h2>Are you sure you want to delete this task?</h2></div>
					<div class="panel-body">
						<table class="table">
							<thead>
								<tr>
									<th>Name</th>
									<th>Author</th>
									<th>Create Date</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>{{ $task->name }}</td>
									<td>{{ $task->user->username }}</td>
									<td>{{ $task->created_at }}</td>
								</tr>
							</tbody>
						</table>
	                </div>
	    	        <div class="panel-footer"></div>
	    		</div>
	        </div>

	        <div class="col-md-3">
	        	<div class="panel panel-danger">
	                <div class="panel-heading">Options</div>
	                <div class="panel-body">
	                	{!! Form::open(['route' => ['admin.tasks.destroy', $task->id], 'method' => 'DELETE']) !!}
	                		<div>
	                			{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm btn-block']) !!}
	                            <a href="{{ route('admin.tasks.index') }}" class="btn btn-default btn-sm btn-block">Cancel</a>
	    					</div>
	    				{!! Form::close() !!}
	    			</div>
	    		</div>
	    	</div>
	        
	    </div>
	</div>
@stop

@section ('scripts')
@stop
