@extends ('layouts.main')

@section ('title', '| Delete User')

@section ('stylesheets')
    {{ Html::style('css/admin.css') }}
@stop

@section('content')
	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-danger">
				<div class="panel-heading"><h2>Are you sure you want to delete this recipe?</h2></div>
				<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<th>Title</th>
								<th>Author</th>
								<th>Create Date</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{ $recipe->title }}</td>
								<td>{{ $recipe->user->username }}</td>
								<td>{{ $recipe->created_at }}</td>
							</tr>
						</tbody>
					</table>
					<br />
	                <div class="panel-danger">
						<div class="panel-heading">Removing this recipe will also delete the following items from the database</div>
						<div class="panel-body">
							<table class="table table-striped table-condensed">
								<tr>
									<td>All associated favorites will be deleted</td>
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
                	{!! Form::open(['route' => ['recipes.destroy', $recipe->id], 'method' => 'DELETE']) !!}
                		<div>
                			{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm btn-block']) !!}
                            <a class="btn btn-default btn-sm btn-block" href="{{ URL::previous() }}">Cancel</a>
    					</div>
    				{!! Form::close() !!}
    			</div>
    		</div>
    	</div>
        
    </div>
@stop

@section ('scripts')
@stop
