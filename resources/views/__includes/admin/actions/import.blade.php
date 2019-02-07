@extends ('includes.admin.layouts.main')

@section ('title', '| ')

@section ('stylesheets')
    {{ Html::style('css/admin.css') }}
@stop 

@section('content')

	<form 
		{{-- style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" --}}
		action="{{ URL::to('admin/'.$section_name.'/importExcel') }}"
		class="form-horizontal"
		method="post"
		enctype="multipart/form-data">

		<div class="panel panel-default">
			<div class='panel-heading panel-relative'>
				Import {{ ucfirst($section_name) }}
				<span class="pull-right">
					<a href="{{ route('admin.'.$section_name.'.index') }}" class="btn btn-default btn-xs">
						<div class="text text-left">
							<i class="fa fa-arrow-left" aria-hidden="true"></i> Cancel
						</div>
					</a>
					<button type="submit" name="submit" class="btn btn-success btn-xs">
						<div class="text text-left">
							<i class="fa fa-save"></i> Import
						</div>
					</button>
				</span>
			</div>
			<div class="panel-body">
				{!! Form::token() !!}
				<input type="file" name="import_file" class="btn"/>
			</div>
		</div>
	</form>

@stop

@section ('scripts')
	{!! Html::script('js/bootstrap.file-input.js') !!}

	<script type="text/javascript">
		$('input[type=file]').bootstrapFileInput();
		$('.file-inputs').bootstrapFileInput();
	</script>
@stop