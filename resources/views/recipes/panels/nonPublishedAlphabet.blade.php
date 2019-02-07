<div class="text text-center">
	<a href="{{ route('recipes.nonPublished', $key='all') }}" class="{{ Request::is('recipes/nonPublished/all') ? "btn-primary": "btn-default" }} btn btn-sm alphabet">All</a>
	@foreach($letters as $value)
		<a href="{{ route('recipes.nonPublished', $value) }}" class="{{ Request::is('recipes/nonPublished/'.$value) ? "btn-primary": "btn-default" }} btn btn-sm alphabet">{{ strtoupper($value) }}</a>
	@endforeach
</div>
<br />
