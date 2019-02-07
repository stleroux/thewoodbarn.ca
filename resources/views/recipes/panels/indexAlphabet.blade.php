<div class="text text-center">
	<a href="{{ route('recipes.index', $key='all') }}" class="{{ Request::is('recipes/index/all') ? "btn-primary": "btn-default" }} btn btn-sm alphabet">All</a>
	@foreach($letters as $value)
		<a href="{{ route('recipes.index', $value) }}" class="{{ Request::is('recipes/index/'.$value) ? "btn-primary": "btn-default" }} btn btn-sm alphabet">{{ strtoupper($value) }}</a>
	@endforeach
</div>
<br />
