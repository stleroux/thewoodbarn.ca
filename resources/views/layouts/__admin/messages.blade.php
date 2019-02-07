<div class="pull-right">
	@if (Session::has('success'))
		<div class="alert alert-success alert-dismissible alert-sm" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			{{ Session::get('success') }}
		</div>
	@endif
	@if (Session::has('danger'))
		<div class="alert alert-danger alert-dismissible alert-sm" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			{{ Session::get('danger') }}
		</div>
	@endif
	@if (Session::has('info'))
		<div class="alert alert-info alert-dismissible alert-sm" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			{{ Session::get('info') }}
		</div>
	@endif
	@if (Session::has('warning'))
		<div class="alert alert-warning alert-dismissible alert-sm" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			{{ Session::get('warning') }}
		</div>
	@endif
	@if (Session::has('default'))
		<div class="alert alert-default alert-dismissible alert-sm" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			{{ Session::get('default') }}
		</div>
	@endif
</div>