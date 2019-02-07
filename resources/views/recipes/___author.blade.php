{{-- 
Expects author variable and model named
See recipes.index for example code
--}}

@if (Auth::user()->author == 0) {{-- Username --}}
	<a href="">{{ $model->user->username}}</a>
@endif

@if (Auth::user()->author == 1) {{-- Last Name, First Name --}}
	<a href="">{{ $model->user->last_name }}, {{ $model->user->first_name }}</a>
@endif

@if (Auth::user()->author == 2) {{-- First Name Last Name --}}
	<a href="">{{ $model->user->first_name }} {{ $model->user->last_name }}</a>
@endif

@if (Auth::user()->author > 2) {{-- Username --}}
	<a href="">{{ $model->user->username }}</a>
@endif
