@extends ('layouts.main')

@section ('title', '| All Tags')

@section ('stylesheets')
	{{ Html::style('css/admin.css') }}
@stop

@section ('content')
	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li class="active">Tags</li>
	</ol>

	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">Tags</div>
				<div class="panel-body">
					@if (count($tags) > 0)
						<table id="datatable" class="table table-hover table-striped table-condensed">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									@if (Auth::check())
										<th data-orderable="false"></th>
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach ($tags as $tag)
									<tr>
										<th>{{ $tag->id }}</th>
										<td><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></td>
										@if (Auth::check())
											<td>@include('partials._buttons', ['model'=>$tag, 'field'=>'tags'])</td>
										@endif
									</tr>
								@endforeach
							</tbody>
						</table>
					@else
						<div class="alert alert-danger">No records found</div>
					@endif
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">New Tag</div>
				<div class="panel-body">
					@ability('admin','tags_create')
					{!! Form::open(['route' => 'tags.store', 'method'=> 'POST']) !!}
						
						<div class="form-group">
							{{ Form::label('name', 'Name:') }}
							{{ Form::text('name', null, ['class' => 'form-control', 'autofocus'=>'autofocus']) }}
						</div>
						
						{{ Form::submit('Create New Tag', ['class'=>'btn btn-primary btn-block']) }}

					{!! Form::close() !!}
					@endability
				</div>
			</div>
		</div>
	</div>
@stop

@section ('scripts')
@stop