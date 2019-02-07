<div class="navbar navbar-expand navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container">
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
							@include ('layouts.common.logged_in') 
							{{-- <li><a href="{{ route('logout') }}"><i class="fa fa-power-off"></i> Logout</a></li> --}}
						</ul>
					</li>
				@else
					@include ('layouts.common.not_logged_in')
				@endif

			</ul>
            <ul class="nav navbar-nav">
            	@include('layouts.frontend.menus.top_menu')
                
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
    </div>
</div>
