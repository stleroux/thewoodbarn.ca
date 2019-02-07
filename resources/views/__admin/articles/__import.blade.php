@extends('layouts.admin.main')

@section ('title','| ')

@section ('stylesheets')
	{{ Html::style('css/articles.css') }}
@stop

@section('content')
	<div class="container">
		<form
			style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;"
			action="{{ URL::to('admin/articles/importExcel') }}"
			class="form-horizontal"
			method="post"
			enctype="multipart/form-data">
			{!! Form::token() !!}
			<input type="file" title="Select Input File" name="import_file" class="btn btn-default"/>
			<br /><br />
			<button class="btn btn-primary">Import File</button>
		</form>
	</div>
@stop

@section ('scripts')
	{!! Html::script('js/bootstrap.file-input.js') !!}

	<script type="text/javascript">
		$('input[type=file]').bootstrapFileInput();
		$('.file-inputs').bootstrapFileInput();
	</script>
@stop