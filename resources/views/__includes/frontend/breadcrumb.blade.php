<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<ol class="breadcrumb">
			<li><a href="/">Home</a></li>
			@if($section_name)

				@if($section_name === 'recipes')
					<li><a href="{{ route($section_name.'.index','all') }}">{{ ucfirst($section_name) }}</a></li>
				@elseif($section_name === 'products')
					{{-- <li><a href="{{ route($section_name.'.index','all') }}">{{ ucfirst($section_name) }}</a></li> --}}
					<li><a href="/shop/index/all"> Products</a></li>
				@else
					<li><a href="{{ route($section_name.'.index') }}">{{ ucfirst($section_name) }}</a></li>
				@endif
			@endif

			@if ($action_name)
				<li>{{ ucfirst($action_name) }}</li>
			@endif
		</ol>
	</div>
</div>