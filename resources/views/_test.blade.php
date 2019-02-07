<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>TheWoodBarn.ca - @yield ('title')</title>

	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	{{-- {{ Html::style('css/font-awesome.css') }} --}}
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/dt-1.10.13/r-2.1.0/datatables.min.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/plug-ins/1.10.13/integration/font-awesome/dataTables.fontAwesome.css"/>

	@if (Auth::user())
		{{ Html::style('css/bootstrap/' . Auth::user()->style . '.css') }}
	@else
		{{ Html::style('css/bootstrap/bootstrap.css') }}
	@endif

	{{-- {{ Html::style('css/styles.css') }} --}}
	{{-- {{ Html::style('css/megamenu.css') }} --}}

	@yield ('stylesheets')

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="navbar navbar-expand navbar-inverse" role="navigation">
				    {{-- <div class="container"> --}}
				        <div class="navbar-header">
				            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				                <span class="sr-only">Toggle navigation</span>
				                <span class="icon-bar"></span>
				                <span class="icon-bar"></span>
				                <span class="icon-bar"></span>
				            </button>
				            <a class="navbar-brand {{ Request::is('/') ? "active": "" }}" href="/">TheWoodBarn.ca</a>
				        </div>
				        <div class="collapse navbar-collapse">
				            <ul class="nav navbar-nav navbar-right">
				{{--                 <li>
				                    <a href="{{ route('product.shoppingCart') }}">
				                        <i class="fa fa-shopping-cart"></i> Shopping Cart
				                        <span class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
				                    </a>
				                </li> --}}


								@if (Auth::check())
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				                            @if(Auth::user()->role->name == 'guest')
				                                <i class="fa fa-user-o" aria-hidden="true"></i>
				                            @elseif(Auth::user()->role->name == 'user')
				                                <i class="fa fa-user" aria-hidden="true"></i>
				                            @elseif(Auth::user()->role->name == 'author')
				                                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
				                            @elseif(Auth::user()->role->name == 'timeTrack')
				                                <i class="fa fa-calendar" aria-hidden="true"></i>
				                            @elseif(Auth::user()->role->name == 'editor')
				                                <i class="fa fa-user-circle" aria-hidden="true"></i>
				                            @elseif(Auth::user()->role->name == 'publisher')
				                                <i class="fa fa-user-plus" aria-hidden="true"></i>
				                            @elseif(Auth::user()->role->name == 'manager')
				                                <i class="fa fa-user-times" aria-hidden="true"></i>
				                            @elseif(Auth::user()->role->name == 'admin')
				                                <i class="fa fa-user-md" aria-hidden="true"></i>
				                            @elseif(Auth::user()->role->name == 'superadmin')
				                                <i class="fa fa-user-secret" aria-hidden="true"></i>
				                            @endif
				                            {{-- {{ ucwords(Auth::user()->first_name) }}'s Account <span class="caret"></span> --}}
				                            My Account <span class="caret"></span>
				                        </a>
										<ul class="dropdown-menu">
											@include ('layouts.logged_in') 
											{{-- <li><a href="{{ route('logout') }}"><i class="fa fa-power-off"></i> Logout</a></li> --}}
										</ul>
									</li>
								@else
									@include ('layouts.not_logged_in')
								@endif

							</ul>
				            <ul class="nav navbar-nav">
				            	@include('layouts.menus.top_menu')
				                
				                {{-- @if(checkACL('manager'))
				                    <li class="dropdown">
				                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu 2 <b class="caret"></b></a>
				                        <ul class="dropdown-menu">
				                            <li><a href="#">Action</a></li>
				                            <li><a href="#">Another action</a></li>
				                            <li><a href="#">Something else here</a></li>
				                            <li class="divider"></li>
				                            <li><a href="#">Separated link</a></li>
				                            <li class="divider"></li>
				                            <li><a href="#">One more separated link</a></li>
				                            <li class="dropdown-submenu">
				                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
				                                <ul class="dropdown-menu">
				                                    <li><a href="#">Action</a></li>
				                                    <li><a href="#">Another action</a></li>
				                                    <li><a href="#">Something else here</a></li>
				                                    <li class="divider"></li>
				                                    <li><a href="#">Separated link</a></li>
				                                    <li class="divider"></li>
				                                    <li class="dropdown-submenu">
				                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
				                                        <ul class="dropdown-menu">
				                                            <li class="dropdown-submenu">
				                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
				                                                <ul class="dropdown-menu">
				                                                    <li><a href="#">Action</a></li>
				                                                    <li><a href="#">Another action</a></li>
				                                                    <li><a href="#">Something else here</a></li>
				                                                    <li class="divider"></li>
				                                                    <li><a href="#">Separated link</a></li>
				                                                    <li class="divider"></li>
				                                                    <li><a href="#">One more separated link</a></li>
				                                                </ul>
				                                            </li>
				                                        </ul>
				                                    </li>
				                                </ul>
				                            </li>
				                        </ul>
				                    </li>
				                @endif --}}
				            </ul>
				        </div><!--/.nav-collapse -->
				    {{-- </div> --}}
				</div>

			</div>
			<div class="panel-body">
				Content
			</div>
			<div class="panel-footer">
				Footer
			</div>
		</div>
		
	</div>
</body>
</html>