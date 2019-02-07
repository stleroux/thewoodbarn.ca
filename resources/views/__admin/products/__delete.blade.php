@extends ('layouts.admin.main')

@section ('title', '| Delete User')

@section ('stylesheets')
    {{ Html::style('css/admin.css') }}
@stop

@section('content')

<div class="col-md-10">
	@include('admin.includes.breadcrumb')

	{!! Form::open(['route' => ['admin.products.destroy', $product->id], 'method' => 'DELETE']) !!}
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-danger">
					<div class='panel-heading panel-relative'>
						Delete {{ ucfirst($section_name) }}
						<span class="pull-right">
							<button type="submit" name="submit" class="btn btn-danger btn-xs">
								<div class="text text-left">
									<i class="fa fa-save"></i> Delete {{ ucfirst($section_name) }}
								</div>
							</button>
							<a href="{{ route('admin.products.index') }}" class="btn btn-default btn-xs">
								<div class="text text-left">
									<i class="fa fa-arrow-left" aria-hidden="true"></i> Cancel
								</div>
							</a>
						</span>
					</div>
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
									<td>{{ $product->title }}</td>
									<td>{{ $product->user->username }}</td>
									<td>{{ $product->created_at }}</td>
								</tr>
							</tbody>
						</table>
	                </div>
	    	        <div class="panel-footer"></div>
	    		</div>
	        </div>
	    </div>
	{!! Form::close() !!}
</div>
@stop

@section ('scripts')
@stop
