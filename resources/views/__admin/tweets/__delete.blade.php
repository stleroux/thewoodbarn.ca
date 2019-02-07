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
				<div class="panel-heading"><h4>Are you sure you want to delete this tweet?</h4></div>
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
								<td>{{ $tweet->title }}</td>
								<td>{{ $tweet->user->username }}</td>
								<td>{{ $tweet->created_at }}</td>
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
                	{!! Form::open(['route' => ['admin.tweets.destroy', $tweet->id], 'method' => 'DELETE']) !!}
                		<div>
                			{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm btn-block']) !!}
                            <a href="{{ route('admin.tweets.index') }}" class="btn btn-default btn-sm btn-block">Cancel</a>
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
