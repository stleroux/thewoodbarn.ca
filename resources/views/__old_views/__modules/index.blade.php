@extends ('layouts.main')

@section ('title', '| All Modules')

@section ('stylesheets')
	{{ Html::style('../css/admin.css') }}
@stop

@section ('content')
	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li class="active">Modules</li>
	</ol>

	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">Modules</div>
				<div class="panel-body">
					@if (count($modules) > 0)
						<table id="datatable" class="table table-hover table-condensed">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									@if(Auth::check())
										<th data-orderable="false"></th>
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach ($modules as $module)
									<tr>
										<th>{{ $module->id }}</th>
										<td>{{ $module->name }}</td>
										@if(Auth::check())
											<td>@include('partials._buttons', ['model'=>$module, 'field'=>'modules'])</td>
										@endif
									</tr>
								@endforeach
							</tbody>
						</table>
					@else
						<div class="row">
							<div class="col-md-12">
								<div class="alert alert-danger">No records found</div>
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>

		@ability('admin','modules_create')
			{!! Form::open(['route' => 'modules.store']) !!}
				<div class="col-md-3">
					<div class="panel panel-default">
						<div class="panel-heading">New Module</div>
						<div class="panel-body">
							{{-- @include('partials._displayErrorsWarning') --}}

							<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
								{{ Form::label('name', 'Name:') }}
								{{ Form::text('name', null, ['class' => 'form-control', 'autofocus']) }}
								<span class="text-danger">{{ $errors->first('name') }}</span>
							</div>

							{{ Form::submit('Create New Module', ['class'=>'btn btn-primary btn-block btn-h1-spacing']) }}

						</div>
					</div>
				</div>
			{!! Form::close() !!}
		@endability
	</div>
@stop

@section ('scripts')
@stop