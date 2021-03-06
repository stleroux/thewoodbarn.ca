<div class="navbar navbar-default navbar-fixed-top" role="navigation">
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
            <ul class="nav navbar-nav">
            	@include('includes.admin.layouts.menus.top_menu')
                {{-- @include('layouts.admin.nav_dd_sample') --}}
            </ul>

            <ul class="nav navbar-nav navbar-right">
                {{-- @include('layouts.admin.nav_dd_cp') --}}
                @if (Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> {{ ucwords(Auth::user()->first_name) }}'s Account <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            @include ('includes.common.menus.logged_in')
                            {{-- <li><a href="{{ route('logout') }}"><i class="fa fa-power-off"></i> Logout</a></li> --}}
                        </ul>
                    </li>
                @else
                    @include ('includes.common.menus.not_logged_in')
                @endif
            </ul>

        </div><!--/.nav-collapse -->
    </div>
</div>
<br />
<br />
<br />
<br />