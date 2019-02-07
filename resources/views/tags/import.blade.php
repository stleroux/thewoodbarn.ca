@extends ('layouts.main')

@section ('title', '| ')

@section ('stylesheets')
	{{ Html::style('css/styles.css') }}
@stop 

@section('breadcrumb')
	<li><a href="/">Home</a></li>
	<li><a href="{{ route('tags.index') }}">Tags</a></li>
	<li>Import Tags</li>
@stop

@section('menubar')
<form action="{{ URL::to('tags/importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
	@include('layouts.buttons.cancel', ['name'=>'tags'])

					{{--================================================================================================================================--}}
					{{-- IMPORT BUTTON                                                                                                                  --}}
					{{--================================================================================================================================--}}
					{{-- <button type="submit" name="submit" class="btn btn-success btn-xs">
						<div class="text text-left">
							<i class="fa fa-save"></i> Import Tags 123
						</div>
					</button> --}}
					{{--================================================================================================================================--}}
					{{-- END IMPORT BUTTON                                                                                                              --}}
					{{--================================================================================================================================--}}
@include('layouts.buttons.import', ['name'=>'tags'])
@stop

@section('content')
	<div class="panel panel-default">
		<div class='panel-heading panel-relative'>Import Tags</div>
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