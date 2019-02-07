<div class="panel panel-default">
	<div class="panel-heading">Search Articles</div>
	<div class="panel-body">
		{!! Form::open(['route' => 'search.articles', 'method'=> 'GET']) !!}
			
			{{ Form::text('search', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) }}
			
			{{Form::button('<div class="text text-left"><i class="fa fa-search" aria-hidden="true"></i> Search Articles</div>', array('type' => 'submit', 'class' => 'btn btn-primary btn-block'))}}

		{!! Form::close() !!}
	</div>
</div>