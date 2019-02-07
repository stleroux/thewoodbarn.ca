@extends ('layouts.admin.main')

@section ('title', '')

@section ('stylesheets')
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li><a href="/admin">Control Panel</a></li>
  <li>Site Settings</li>
@stop

@section ('content')
	
	<div class="panel panel-info">
		<div class="panel-heading">Site Settings</div>
		<div class="panel-body">
			<table class="table table-condensed table-striped table-hover table-responsive">
				<thead>
					<tr style="background-color: #C0C0C0">
						{!! Form::open(['route' => 'settings.store', 'method'=> 'POST']) !!}
							<td>
								<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
									{!! Form::text("name", null, ["class" => "form-control input-sm", "autofocus", 'onfocus' => 'this.focus();this.select()']) !!}
									<span class="text-danger">{{ $errors->first('name') }}</span>
								</div>
							</td>
							<td>
								<div class="form-group {{ $errors->has('displayName') ? 'has-error' : '' }}">
									{{ Form::text('displayName', null, ['class' => 'form-control input-sm']) }}
									<span class="text-danger">{{ $errors->first('displayName') }}</span>
								</div>
							</td>
							<td>
								<div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
									{{ Form::text('value', null, ['class' => 'form-control input-sm']) }}
									<span class="text-danger">{{ $errors->first('value') }}</span>
								</div>
							</td>
							<td>
								<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
									{{ Form::text('description', null, ['class' => 'form-control input-sm']) }}
									<span class="text-danger">{{ $errors->first('description') }}</span>
								</div>
							</td>
							<td colspan="2">
								{{ Form::submit('New Setting', ['class'=>'btn btn-primary btn-sm btn-block']) }}
							</td>
						{!! Form::close() !!}
					</tr>
					<tr>
						<th>Internal Name</th>
						<th>Display Name</th>
						<th>Value</th>
						<th>Description</th>
						<th colspan="2"></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($settings as $key => $setting)
						{!! Form::model($setting, ['route'=>['settings.update', $setting->id], 'method' => 'PUT']) !!}
							<tr>
								<td>{{ Form::input('text', 'name', null, ['class' => 'form-control input-sm', 'disabled' => 'disabled']) }}</td>
								<td>{{ Form::input('text', 'displayName', null, ['class' => 'form-control input-sm']) }}</td>
								<td>{{ Form::input('text', 'value', null, ['class' => 'form-control input-sm']) }}</td>
								<td>{{ Form::input('text', 'description', null, ['class' => 'form-control input-sm']) }}</td>
								@if(Auth::check())
									<td>{{ Form::submit('Update', ['class'=>'btn btn-success btn-xs btn-block']) }}</td>
								@endif
							{!! Form::close() !!}
						
							{{ Form::open(array('method' => 'DELETE', 'route' => array('settings.delete', $setting->id), 'onsubmit' => 'return confirm("Are you sure you want to delete this record?")')) }}
								<td>{{ Form::submit('Delete', array('class' => 'btn btn-danger btn-xs btn-block')) }}</td>
							{{ Form::close() }}
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

@stop

@section ('scripts')
@stop