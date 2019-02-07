<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>TheWoodBarn.ca - @yield ('title')</title>

	<!-- Bootstrap -->
	<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	{{ Html::style('css/font-awesome.css') }}
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/dt-1.10.13/r-2.1.0/datatables.min.css"/>	
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/plug-ins/1.10.13/integration/font-awesome/dataTables.fontAwesome.css"/>

{{-- 	@if (Auth::user())
		{{ Html::style('css/bootstrap/' . Auth::user()->style . '.css') }}
	@else --}}
		{{ Html::style('css/bootstrap/bootstrap.css') }}
{{-- 	@endif --}}

	{{ Html::style('css/styles.css') }}

	@yield ('stylesheets')

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>