@extends ('layouts.admin.main')

@section ('title', '| ')

@section ('stylesheets')
    {{ Html::style('css/admin.css') }}
@stop 
 
@section('content')

	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li><a href="{{ route('products.index') }}">Products</a></li>
		<li class="active">Create</li>
	</ol>

	{!! Form::open(array('route' => 'products.store','method'=>'POST')) !!}

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class='panel-heading panel-relative'>
						Create Product
						<span class="pull-right">
							<button type="submit" name="submit" class="btn btn-success btn-xs">
								<div class="text text-left">
									<i class="fa fa-save"></i> Create Product
								</div>
							</button>
							<a href="{{ route('products.index') }}" class="btn btn-default btn-xs">
								<div class="text text-left">
									<i class="fa fa-arrow-left" aria-hidden="true"></i> Cancel
								</div>
							</a>
						</span>
					</div>
					<div class="panel-body">
						@include('products.form')
					</div>
					<div class="panel-footer">
						@include('layouts.admin.displayErrorsWarning')
					</div>
				</div>
			</div>
		</div>

	{!! Form::close() !!}

@stop

@section ('scripts')
@stop