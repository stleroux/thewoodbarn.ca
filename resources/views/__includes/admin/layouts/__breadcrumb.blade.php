{{-- <div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<ol class="breadcrumb">
			<li><a href="/">Home</a></li>
			<li><a href="{{ route('admin') }}">Control Panel</a></li>
			@if (!$action_name)
				<li>{{ ucfirst($section_name) }}</li>
			@else
				<li><a href="{{ route('admin.'.$section_name.'.index') }}">{{ ucfirst($section_name) }}</a></li>
				<li>{{ ucfirst($action_name) }}</li>
			@endif
		</ol>
	</div>
</div> --}}