@extends ('layouts.admin.main')

@section ('title', '| ')

@section ('stylesheets')
	{{ Html::style('css/admin.css') }}
@stop 

@section('breadcrumb')
	<li><a href="/">Home</a></li>
	<li><a href="/admin">Control Panel</a></li>
	<li><a href="{{ route('admin.articles.index') }}">Articles</a></li>
	<li>Import Articles</li>
@stop

@section('page_top_menu')
<form action="{{ URL::to('admin/articles/importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-12">
			<div class="well well-sm clearfix">
				<div class="pull-right">
					{{--================================================================================================================================--}}
					{{-- IMPORT BUTTON                                                                                                                  --}}
					{{--================================================================================================================================--}}
					<button type="submit" name="submit" class="btn btn-success btn-xs">
						<div class="text text-left">
							<i class="fa fa-save"></i> Import Articles
						</div>
					</button>
					{{--================================================================================================================================--}}
					{{-- END IMPORT BUTTON                                                                                                              --}}
					{{--================================================================================================================================--}}

					{{--================================================================================================================================--}}
					{{-- CANCEL BUTTON                                                                                                                  --}}
					{{--================================================================================================================================--}}
					<a href="{{ route('admin.articles.index') }}" class="btn btn-default btn-xs">
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
				</div>
			</div>
		</div>
	</div>
@stop

@section('content')
	<div class="panel panel-default">
		<div class='panel-heading panel-relative'>Import Articles</div>
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