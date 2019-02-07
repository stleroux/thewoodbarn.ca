<div class="panel-heading">Search Recipes</div>
<div class="panel-body">
	{!! Form::open(['route' => 'search.recipes', 'method'=> 'GET']) !!}
		
		{{ Form::text('search', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) }}
		
		{{Form::button('<div class="text text-left"><i class="fa fa-search" aria-hidden="true"></i> Search Recipes</div>', array('type' => 'submit', 'class' => 'btn btn-primary btn-block'))}}

	{!! Form::close() !!}
</div>