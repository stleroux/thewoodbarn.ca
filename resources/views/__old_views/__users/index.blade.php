@extends ('layouts.main')

@section ('title', '| All Users')

@section ('stylesheets')
    {{ Html::style('css/admin.css') }}
@stop
 
@section('content')

	<ol class="breadcrumb">
		<li><a href="/">Home</a></li>
		<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
		<li class="active">Users</li>
	</ol>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Users Management
					<div class="pull-right">
			        	@ability('admin','users_export')
							<div class="btn-group">
							  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    Import / Export <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu">
							    <li><a href="{{ route('users.import') }}">Import Data</a></li>
							    <li role="separator" class="divider"></li>
							    <li><a href="{{ URL::to('users/downloadExcel/xls') }}">Download as XLS</a></li>
							    <li><a href="{{ URL::to('users/downloadExcel/xlsx') }}">Download as XLSX</a></li>
							    <li><a href="{{ URL::to('users/downloadExcel/csv') }}">Download as CSV</a></li>
							    <li role="separator" class="divider"></li>
							    <li><a href="{{ URL::to('users/exportPDF') }}">Export to PDF</a></li>
							  </ul>
							</div>
				        @endability
			        	@ability('admin','permissions_list')
			        		<a class="btn btn-default btn-xs" href="{{ route('permissions.index') }}">Permissions</a>
			        	@endability
				       	@ability('admin','roles_list')
				       		<a class="btn btn-default btn-xs" href="{{ route('roles.index') }}">Roles</a>
				       	@endability
			        	@ability('admin','users_create')
			            	<a class="btn btn-success btn-xs" href="{{ route('users.create') }}">Create New User</a>
			            @endability
		        	</div>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table id="datatable" class="table table-hover table-striped table-condensed">
							<thead>
								<tr>
									<th>Username</th>
									<th>Email</th>
									<th class="hidden-sm hidden-xs">SR</th>
									<th class="hidden-sm hidden-xs">Logins</th>
									<th class="hidden-sm hidden-xs">Active</th>
									<th>Roles</th>
									<th class="hidden-sm hidden-xs">Update Date</th>
									@if (Auth::check())
										<th data-orderable="false"></th>
									@endif
								</tr>
							</thead>
							@foreach ($data as $key => $user)
								<tr>
									<td>
										<a href="#" data-toggle="tooltip" data-placement="right" title="{{ $user->first_name}} {{ $user->last_name}} [{{ $user->id }}]" style="text-decoration:none;" class="{{ (!$user->active)?'text text-danger':''}}">{{ $user->username }}</a>
									</td>
									<td>
										<div class="{{ (!$user->active)?'text text-danger':''}}">
											{{ $user->email }}
										</div>
									</td>
									<td class="hidden-sm hidden-xs">
										<div class="{{ (!$user->active)?'text text-danger':''}}">
											{{ ($user->selfRegistered == 1)? 'Yes':'No' }}
										</div>
									</td>
									<td class="hidden-sm hidden-xs">
										<div class="{{ (!$user->active)?'text text-danger':''}}">
											{{ $user->login_count }}
										</div>
									</td>
									<td class="hidden-sm hidden-xs">
										@if ($user->active)
											<i class="fa fa-check" aria-hidden="true"></i>
										@else
											<div class="{{ (!$user->active)?'text text-danger':''}}">
												<i class="fa fa-ban" aria-hidden="true"></i>
											</div>
										@endif
									</td>
									<td>
										@if(!empty($user->roles))
											@foreach($user->roles as $v)
												<label class="{{ (!$user->active)?'label label-danger':'label label-primary'}}"><a href="{{ route('roles.show', $v->id) }}">{{ $v->display_name }}</a></label>
											@endforeach
										@endif
									</td>
									<td class="hidden-sm hidden-xs">
										<div class="{{ (!$user->active)?'text text-danger':''}}">
											{{ date('M j, Y', strtotime($user->updated_at)) }}
										</div>
									</td>
									<td>
										<div class="btn-group pull-right">
											<button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    								Options <span class="caret"></span>
											</button>
											
											<ul class="dropdown-menu">
												<li>
													<a href="{{ route('users.show',$user->id) }}">
														<i class="fa fa-eye fa-fw text-info"></i>
														<span class="text text-info">View</span>
													</a>
												</li>
											
												@ability('admin','users_activate')
													<li>
														<a href="{{ route('users.activate', $user->id) }}">
															<i class="fa fa-check-circle-o fa-fw text-primary" aria-hidden="true"></i>
															<span class="text text-primary">Activate</span>
														</a>
													</li>
													<li>
														<a href="{{ route('users.deactivate', $user->id) }}">
															<i class="fa fa-times-circle-o fa-fw text-warning" aria-hidden="true"></i>
															<span class="text text-warning">Deactivate</span>
														</a>
													</li>
												@endability
											
												@ability('admin','users_edit')
													<li>
														<a href="{{ route('users.edit',$user->id) }}">
															<i class="fa fa-pencil-square-o fa-fw text-success" aria-hidden="true"></i>
															<span class="text text-success">Edit</span>
														</a>
													</li>
												@endability

												@ability('admin','users_delete')
													<li>
														<a href="{{ route('users.delete', $user->id) }}">
															<i class="fa fa-trash-o fa-fw text-danger"></i>
															<span class="text text-danger">Delete</span>
														</a>
													</li>
							        			@endability

												{{-- <li><a href="#"><i class="fa fa-ban fa-fw"></i>Ban</a></li>
												<li class="divider"></li>
												<li><a href="#"><i class="fa fa-unlock fa-fw"></i>Make admin</a></li> --}}
											</ul>
										</div>
									</td>
								</tr>
							@endforeach
						</table>
					</div>
				</div>
				<div class="panel-footer visible-lg visible-md">
					LEGEND : <br />
					SR => Self Registered account
				</div>
			</div>
		</div>
	</div>
	{{-- @include('users/delete_confirm') --}}
@stop

@section ('scripts')

@stop
