{{-- <li class="{{ Request::is('/') ? "active": "" }}">
	<a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>
</li> --}}

<li class="{{ Request::is('blog*') ? "active": "" }}">
	<a href="/blog" style="padding-left: 7px; padding-right: 7px" class="fa fa-th-list" aria-hidden="true"></i> Blog</a>
</li>

<li class="{{ Request::is('recipes*') ? "active": "" }}" style="padding-left: 0px; padding-right: 0px">
	<a href="/recipes/index/all" style="padding-left: 7px; padding-right: 7px"><i class="fa fa-book" aria-hidden="true"></i> Recipes</a>
</li>

<li class="{{ Request::is('shop*') ? "active": "" }}">
	<a href="/shop/index/all" style="padding-left: 7px; padding-right: 7px"><i class="fa fa-wpforms" aria-hidden="true"></i> Shop</a>
</li>

{{-- @if(Auth::check())
    <li class="{{ Request::is('posts*') ? "active": "" }}">
        <a href="{{ route('posts.index') }}"><i class="fa fa-list" aria-hidden="true"></i> Posts</a>
    </li>

    <li class="{{ Request::is('articles*') ? "active": "" }}">
        <a href="/articles"><i class="fa fa-list" aria-hidden="true"></i> Articles</a>
    </li>
@endif --}}
{{-- @if (Auth::check())
    @include('layouts.common.modules')
@endif --}}

<li><a href="/about" style="padding-left: 7px; padding-right: 7px"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> About Us</a></li>
<li><a href="/contact" style="padding-left: 7px; padding-right: 7px"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> Contact Us</a></li>

{{-- <li class="dropdown">
    <a href="#" class="dropdown-toggle disabled" data-toggle="dropdown">
    	<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> 
    	About 
    	<b class="caret"></b>
    </a>

	<ul class="dropdown-menu">
    	<li><a href="/about"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> About Us</a></li>
		<li><a href="/contact"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> Contact Us</a></li>
	</ul>
</li> --}}