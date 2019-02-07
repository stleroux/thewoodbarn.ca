{{-- <div class="text text-center">
	<a href="{{ route('recipes.myFavorites', $key='all') }}" class="{{ Request::is('recipes/myFavorites/all') ? "btn-primary": "btn-default" }} btn btn-sm alphabet">All</a>
	@foreach($favs as $value)
		<a href="{{ route('recipes.myFavorites', $value) }}" class="{{ Request::is('recipes/myFavorites/'.$value) ? "btn-primary": "btn-default" }} btn btn-sm alphabet">{{ strtoupper($value) }}</a>
	@endforeach
</div>
<br /> --}}

<div class="text text-center">
	<a href="{{ route('recipes.myFavorites', $key='all') }}" class="{{ Request::is('recipes/myFavorites/all') ? "btn-primary": "btn-default" }} btn btn-sm alphabet">All</a>
	@foreach($letters as $value)
		<a href="{{ route('recipes.myFavorites', $value) }}" class="{{ Request::is('recipes/myFavorites/'.$value) ? "btn-primary": "btn-default" }} btn btn-sm alphabet">{{ strtoupper($value) }}</a>
	@endforeach
</div>
<br />
