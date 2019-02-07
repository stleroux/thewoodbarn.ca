<div class="panel panel-default">
    <div class="panel-heading">Account Type(s)</div>
    <div class="panel-body">
    	<!-- @if (Auth::check())
            Authenticated User
        @endif -->
        
        @foreach ($user->roles as $role)
	        <div> {{ $role->name }} </div>
    	@endforeach
    </div>
</div>
