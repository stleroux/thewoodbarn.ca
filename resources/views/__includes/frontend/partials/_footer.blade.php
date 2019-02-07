<br /><br /><br />

{{-- @include('partials/delete_confirm') --}}

<footer class="footer">
	<nav class="navbar navbar-default navbar-fixed-bottom">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4 text-center">Copyright Stephane Leroux <br /> All rights reserved</div>
				<div class="col-md-4 text-right">
					@php
						printf("%s", Carbon\Carbon::now()->toDateTimeString());
					@endphp
				</div>
			</div>
		</div>	
	</nav>
</footer>
