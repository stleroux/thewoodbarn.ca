@extends ('layouts.admin.main')

@section ('title', '| ')

@section ('stylesheets')
    {{ Html::style('css/admin.css') }}
@stop 
 
@section('content')

	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li><a href="{{ route('products.index') }}">Products</a></li>
		<li class="active">Edit</li>
	</ol>

	{!! Form::model($product, ['method' => 'PUT','route' => ['products.update', $product->id]]) !!}

		<div class="panel panel-default">
			<div class='panel-heading panel-relative'>
				Update Product
				<span class="pull-right">
					<button type="submit" name="submit" class="btn btn-primary btn-xs">
						<div class="text text-left">
							<i class="fa fa-save"></i> Update Product
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
				@include('items.form')
			</div>
			<div class="panel-footer">
				@include('layouts.admin.displayErrorsWarning')
			</div>
		</div>
		
	{!! Form::close() !!}

@stop

@section ('scripts')
@stop