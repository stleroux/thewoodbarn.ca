@extends ('layouts.admin.main')

@section ('title', '| ')

@section ('stylesheets')
    {{ Html::style('css/admin.css') }}
@stop 

@section('content')

	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li><a href="{{ route('products.index') }}">Products</a></li>
		<li class="active">Import</li>
	</ol>

	<form 
		{{-- style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" --}}
		action="{{ URL::to('products/importExcel') }}"
		class="form-horizontal"
		method="post"
		enctype="multipart/form-data">
		
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="panel panel-default">
					<div class='panel-heading panel-relative'>
						Import Product
						<span class="pull-right">
							<button type="submit" name="submit" class="btn btn-success btn-xs">
								<div class="text text-left">
									<i class="fa fa-save"></i> Import Products
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
						{!! Form::token() !!}
						<input type="file" name="import_file" class="btn"/>
					</div>
				</div>
			</div>
		</div>
	</form>

@stop

@section ('scripts')
@stop