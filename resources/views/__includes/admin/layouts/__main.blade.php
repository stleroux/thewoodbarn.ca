<!DOCTYPE html>
<html lang="en">

	@include ('includes.admin.layouts.head')

	<body>

		@include ('includes.admin.layouts.menus.nav')
		@include ('includes.admin.layouts.javascripts')
		
		<div class="container-fluid">
			
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							ADMIN CONTROL PANEL
							@include ('includes.admin.layouts.messages')
						</div>
						<div class="panel-body">
							<div class="col-md-2">
								<ul class="list-group">
									@include('includes.admin.layouts.menus.nav_cp')
								</ul>
							</div>
							<div class="col-md-10">
								@include('includes.admin.layouts.breadcrumb')
								@yield ('content')
								{{-- @include('includes.admin.actions.confirmDelete') --}}
								@include('includes.common.confirmDelete')
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- end of container -->
		
		@include ('includes.admin.layouts.footer')
		
		@yield ('scripts')

	</body>
</html>