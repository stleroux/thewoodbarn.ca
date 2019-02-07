@if (count($errors) > 0)
	<div class="text text-danger">
		Some fields require your attention!!!!
	</div>
@else
	<div>Fileds with <span class="input-group-addon" id="basic-addon1">@</span> are required</div>
@endif