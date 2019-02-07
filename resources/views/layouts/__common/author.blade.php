{{--  --}}
@if (Auth::check())
	@if (Auth::user()->authorFormat == 1)
		{{-- Username --}}
		<a href="{{ route('profile.showUser', $model->$field) }}">{{ $model->$field->username}}</a>
	@elseif (Auth::user()->authorFormat == 2)
		{{-- Last Name, First Name --}}
		<a href="{{ route('profile.showUser', $model->$field) }}">{{ $model->$field->last_name }}, {{ $model->$field->first_name }}</a>
	@elseif (Auth::user()->authorFormat == 3)
		{{-- First Name Last Name --}}
		<a href="{{ route('profile.showUser', $model->$field) }}">{{ $model->$field->first_name }} {{ $model->$field->last_name }}</a>
	@endif
@else
	{{-- Username --}}
	{{ $model->user->username }}
@endif