{{--  
Expects author variable and model named
See recipes.index for example code
 --}}
@if (Auth::check())
		@if (Auth::user()->authorFormat == 1) {{-- Username --}}
			<a href="{{ route('profile.showUser', $model->$field) }}">{{ $model->$field->username}}</a>
		@endif

		@if (Auth::user()->authorFormat == 2) {{-- Last Name, First Name --}}
			<a href="{{ route('profile.showUser', $model->$field) }}">{{ $model->$field->last_name }}, {{ $model->$field->first_name }}</a>
		@endif

		@if (Auth::user()->authorFormat == 3) {{-- First Name Last Name --}}
			<a href="{{ route('profile.showUser', $model->$field) }}">{{ $model->$field->first_name }} {{ $model->$field->last_name }}</a>
		@endif
@else
	{{ $model->user->username }}
@endif