@extends('layouts.admin')
 
@section('content')

	<div class="row">
	    <div class="col-md-12">
	    	<div class="pull-right">
	    		<a class="btn btn-primary btn-xs" href="{{ route('roles.index') }}"> Back</a>
	    	</div>
	    </div>
	</div>
<br />
	<div class="row">
	    <div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Show Role</div>
				<div class="panel-body">
					<strong>Name:</strong> {{ $role->display_name }}
					<br />
					<strong>Description:</strong> {{ $role->description }}
					<br /><br />
					<strong>Permissions:</strong>
					
					@if(!empty($rolePermissions))
					{{-- dd($rolePermissions) --}}
						{{-- @foreach($rolePermissions as $v)
							<p><label class="label label-success">{{ $v->display_name }}</label></p>
						@endforeach --}}

						<?php $tmpHead = ''; ?>
						@foreach($rolePermissions as $value)
							<?php $split = explode("_", $value->name); ?>
							@if($tmpHead != $split[0])
								<?php $tmpHead = $split[0]; ?>
								<br /><br />
								<strong>{!! ucfirst($tmpHead) !!}</strong>
								<br/>
							@endif
							
							- {{ str_replace($tmpHead, '', $value->display_name) }}
							&nbsp;&nbsp;
						@endforeach

					@endif
				</div>
			</div>
	    </div>
	</div>
@endsection