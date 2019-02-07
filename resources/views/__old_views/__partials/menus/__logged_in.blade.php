<li>
    <div class="navbar-content">
        <div class="row">
            <div class="col-sm-4">
                @if (Auth::user()->image)
                    {{ Html::image("images/profiles/" . Auth::user()->image, "", array('height'=>'120','width'=>'100')) }}
                @else
                    <i class="fa fa-5x fa-user" aria-hidden="true"></i>
                @endif
                <p> </p>
            </div>
            <div class="col-sm-8">
                <span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                <p class="text-muted small">{{ Auth::user()->email }}</p>
                <div class="divider"></div>
                <a href="{{ route('profile.show', Auth::user()->id) }}" class="btn btn-default btn-sm btn-block">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    View Profile
                </a>
                <a href="{{ route('dashboard') }}" class="btn btn-default btn-sm btn-block">
                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                    My Dashboard
                </a>
                <br />
            </div>
        </div>
    </div>

    <div class="navbar-footer clearfix">
        <div class="navbar-footer-content">
            <div class="row">
                <div class="col-xs-6">
                    <a href="{{ route('profile.changePassword', Auth::user()->id) }}" class="btn btn-default btn-sm">
                        <i class="fa fa-key" aria-hidden="true"></i>
                        Change Passowrd
                    </a>
                </div>
                <div class="col-xs-6">
                    <a href="{{ route('logout') }}" class="btn btn-default btn-sm pull-right">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                        Log Out
                    </a>
                </div>
            </div>
        </div>
    </div>
</li>
