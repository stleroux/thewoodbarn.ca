@extends ('layouts.main')

@section ('title', '| ')

@section ('stylesheets')
    {{ Html::style('css/admin.css') }}
@stop 

@section('content')
ITEMS
	<div class="container">
		<form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('items/importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
			{!! Form::token() !!}
			<input type="file" name="import_file" class="btn"/>
			<br />
			<button class="btn btn-primary">Import File</button>
		</form>
	</div>
@stop

@section ('scripts')
@stop