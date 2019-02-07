<!DOCTYPE html>
<html lang="en">

	@include ('layouts.admin.head')

	<body>

		@include ('layouts.admin.nav')
		@include ('layouts.admin.javascripts')
		<div class="container-fluid">
			
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							ADMIN CONTROL PANEL
							@include ('layouts.admin.messages')
						</div>
						<div class="panel-body">
							<div class="col-md-2">
								<ul class="list-group">
									@include('layouts.admin.nav_cp')
								</ul>
							</div>
							<div class="col-md-10">
								@include('includes.admin.breadcrumb')
								@yield ('content')
								@include('includes.admin.actions.confirmDelete')
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- end of container -->

		
		@include ('layouts.admin.footer')
		
		@yield ('scripts')

	</body>
</html>