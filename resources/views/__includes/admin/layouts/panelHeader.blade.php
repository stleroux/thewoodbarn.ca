<div class="panel-heading">{{ ucfirst($section_name) }}
	<div class="pull-right">

		{{--================================================================================================================================================
		== USERS INDEX PAGE ONLY - will display the permissions and roles button if user has been granted the proper access
		================================================================================================================================================--}}
		@if($section_name == 'users')
			@ability('admin','admin,permissions_list_admin')
				<a class="btn btn-default btn-xs" href="{{ route('admin.permissions.index') }}">Permissions</a>
			@endability
			@ability('admin','roles_list_admin')
				<a class="btn btn-default btn-xs" href="{{ route('admin.roles.index') }}">Roles</a>
			@endability
		@endif

		{{--================================================================================================================================================
		== ROLES INDEX PAGE ONLY - will display the permissions and users button if user has been granted the proper access
		================================================================================================================================================--}}
		@if($section_name == 'roles')
			@ability('admin','admin,permissions_list_admin')
				<a class="btn btn-default btn-xs" href="{{ route('admin.permissions.index') }}">Permissions</a>
			@endability
			@ability('admin','users_list_admin')
				<a class="btn btn-default btn-xs" href="{{ route('admin.users.index') }}">Users</a>
			@endability
		@endif

		{{--================================================================================================================================================
		== PERMISSIONS INDEX PAGE ONLY - will display the roles and users button if user has been granted the proper access
		================================================================================================================================================--}}
		@if($section_name == 'permissions')
			@ability('admin','admin,users_list_admin')
				<a class="btn btn-default btn-xs" href="{{ route('admin.users.index') }}">Users</a>
			@endability
			@ability('admin','roles_list_admin')
				<a class="btn btn-default btn-xs" href="{{ route('admin.roles.index') }}">Roles</a>
			@endability
		@endif

		{{--================================================================================================================================================
		== Displays the Import/Export dropdown
		== Except for Orders page
		================================================================================================================================================--}}
		@if($section_name != 'orders')
			@ability('admin',$section_name.'_export_admin')
				<div class="btn-group">
					<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Import / Export <span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<li><a href="{{ route('admin.'.$section_name.'.import') }}">Import Data</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="{{ URL::to('admin/'.$section_name.'/downloadExcel/xls') }}">Download as XLS</a></li>
						<li><a href="{{ URL::to('admin/'.$section_name.'/downloadExcel/xlsx') }}">Download as XLSX</a></li>
						<li><a href="{{ URL::to('admin/'.$section_name.'/downloadExcel/csv') }}">Download as CSV</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="{{ URL::to('admin/'.$section_name.'/exportPDF') }}">Export to PDF</a></li>
					</ul>
				</div>
			@endability
		@endif

		{{--================================================================================================================================================
		== Will display the new button if user has been granted the proper access
		================================================================================================================================================--}}
		@if($section_name != 'orders')
			@ability('admin',$section_name.'_create_admin')
				{{-- Hide the new button for the modules listed below --}}
				@if(Route::currentRouteName() != 'admin.modules.index' &&
					Route::currentRouteName() != 'admin.tags.index' &&
					Route::currentRouteName() != 'admin.tasks.index'
					)

					<a href="{{ route('admin.'.$section_name.'.create') }}" class="btn btn-success btn-xs">
						<div class="text text-left">
							<i class="fa fa-plus-square" aria-hidden="true"></i> New {{ str_singular(ucfirst($section_name)) }}
						</div>
					</a>
					
				@endif
			@endability
		@endif
	</div>
</div>