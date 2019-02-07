<div class="text text-center">
	<a href="{{ route('recipes.published', $key='all') }}" class="{{ Request::is('recipes/published/all') ? "btn-primary": "btn-default" }} btn btn-sm alphabet">All</a>
	@foreach($letters as $value)
		<a href="{{ route('recipes.published', $value) }}" class="{{ Request::is('recipes/published/'.$value) ? "btn-primary": "btn-default" }} btn btn-sm alphabet">{{ strtoupper($value) }}</a>
	@endforeach
</div>
<br />
