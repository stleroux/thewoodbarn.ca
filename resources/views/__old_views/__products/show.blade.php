@extends ('layouts.admin.main')

@section ('title', '| ')

@section ('stylesheets')
    {{ Html::style('css/admin.css') }}
@stop 
 
@section('content')

	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li><a href="{{ route('products.index') }}">Products</a></li>
		<li class="active">View</li>
	</ol>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="panel panel-default">
				<div class='panel-heading panel-relative'>
					View Product
					<span class="pull-right">
						<a href="{{ route('products.index') }}" class="btn btn-default btn-xs">
							<div class="text text-left">
								<i class="fa fa-arrow-left" aria-hidden="true"></i> Back
							</div>
						</a>
					</span>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="panel-default">
			<div class="panel-body">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<strong>Title:</strong>
						{{ $product->title }}
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<strong>Description:</strong>
						{{ $product->description }}
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<strong>Price:</strong>
						$ {{ $product->price }}
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section ('scripts')
@stop