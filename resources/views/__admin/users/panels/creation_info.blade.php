<div class="panel panel-default">
	<div class="panel-heading">Date(s)</div>
	<div class="panel-body">
		<div><strong>Created</strong> {{ date('M j, Y', strtotime($user->created_at)) }}</div>
		<div><strong>Updated</strong> {{ date('M j, Y', strtotime($user->updated_at)) }}</div>
	</div>
</div>
