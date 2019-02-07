<div class="panel panel-default">
    <div class="panel-heading">Account Type(s)</div>
    <div class="panel-body">

    	@if(!empty($user->roles))
			@foreach($user->roles as $role)
				{{ $role->display_name }}
			@endforeach
		@endif

    </div>
</div>
