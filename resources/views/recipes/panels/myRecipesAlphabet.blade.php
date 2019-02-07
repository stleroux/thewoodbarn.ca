<div class="text text-center">
	<a href="{{ route('recipes.myRecipes', $key='all') }}" class="{{ Request::is('recipes/myRecipes/all') ? "btn-primary": "btn-default" }} btn btn-sm alphabet">All</a>
	@foreach($letters as $value)
		<a href="{{ route('recipes.myRecipes', $value) }}" class="{{ Request::is('recipes/myRecipes/'.$value) ? "btn-primary": "btn-default" }} btn btn-sm alphabet">{{ strtoupper($value) }}</a>
	@endforeach
</div>
<br />