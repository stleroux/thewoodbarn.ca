<div class="panel panel-primary">
	<div class="panel-heading">Inactive Users</div>
	<div class="panel-body">
		<table class="table table-hover table-mini">
			<thead>
				<tr>
					<th>Username</th>
					<th>Create Date</th>
				</tr>
			</thead>
			<tbody>
				@foreach($newUsers as $newUser)
					<tr>
						<td>
							<a href="{{ route('users.show', $newUser->id) }}" style="text-decoration: none">
								<div>
									{{ str_limit($newUser->username) }}
								</div>
							</a>
						</td>
						<td>@include('layouts.dateFormat', ['model'=>$newUser, 'field'=>'created_at'])</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="panel-footer">
		<div class="text-center">
			<a href="{{ route('users.index') }}" class="btn btn-xs btn-primary">More Users</a>
		</div>
	</div>
</div>