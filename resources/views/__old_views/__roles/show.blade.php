@extends ('layouts.main')

@section ('title', '| ')

@section ('stylesheets')
	{{ Html::style('css/admin.css') }}
@stop 
 
@section('content')

	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
		<li class="active">Roles</li>
	</ol>

	<div class="row">
	    <div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Role :: {{ $role->display_name }}
					<div class="pull-right">
						<a class="btn btn-primary btn-xs" href="{{ URL::previous() }}">Back</a>
					</div>
				</div>
				<div class="panel-body">
					<div class="panel panel-default">
						<div class="panel-heading">Description:</div>
						<div class="panel-body">{{ $role->description }}</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">Permissions:</div>
						<div class="panel-body">
							@if(!empty($rolePermissions))
								@php $tmpHead = ''; @endphp
								@foreach($rolePermissions as $value)
									@php $split = explode("_", $value->name); @endphp
									@if($tmpHead != $split[0])
										@php $tmpHead = $split[0]; @endphp
										<p>
										<strong><div class="text text-danger">{!! ucfirst($tmpHead) !!}</div></strong>
									@endif

									<i class="fa fa-minus" aria-hidden="true"></i> {{ str_replace($tmpHead, '', $value->display_name) }}
									&nbsp;&nbsp;
								@endforeach
							@endif
						</div>
					</div>
				</div>
			</div>
	    </div>
	</div>
@stop

@section ('scripts')
@stop 
