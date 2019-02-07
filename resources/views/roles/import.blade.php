@extends ('layouts.main')

@section ('title', '| ')

@section ('stylesheets')
	{{ Html::style('css/styles.css') }}
@stop 

@section('breadcrumb')
	<li><a href="/">Home</a></li>
	<li><a href="{{ route('roles.index') }}">Roles</a></li>
	<li>Import Roles</li>
@stop

@section('menubar')
<form action="{{ URL::to('roles/importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
					{{--================================================================================================================================--}}
					{{-- CANCEL BUTTON                                                                                                                  --}}
					{{--================================================================================================================================--}}
					<a href="{{ route('roles.index') }}" class="btn btn-default btn-xs">
						<div class="text text-left">
							@if(Auth::user()->actionButtons == 1) {{-- Icons and Text --}}<i class="fa fa-ban" aria-hidden="true"></i> Cancel
							@elseif(Auth::user()->actionButtons == 2) {{-- Icons Only --}}<i class="fa fa-ban" aria-hidden="true"></i>
							@elseif(Auth::user()->actionButtons == 3) {{-- Text Only --}}Cancel
							@endif
						</div>
					</a>
					{{--================================================================================================================================--}}
					{{-- END CANCEL BUTTON                                                                                                              --}}
					{{--================================================================================================================================--}}

					{{--================================================================================================================================--}}
					{{-- IMPORT BUTTON                                                                                                                  --}}
					{{--================================================================================================================================--}}
					<button type="submit" name="submit" class="btn btn-success btn-xs">
						<div class="text text-left">
							<i class="fa fa-save"></i> Import Roles
						</div>
					</button>
					{{--================================================================================================================================--}}
					{{-- END IMPORT BUTTON                                                                                                              --}}
					{{--================================================================================================================================--}}
@stop

@section('content')
	<div class="panel panel-default">
		<div class='panel-heading'>Import Roles</div>
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