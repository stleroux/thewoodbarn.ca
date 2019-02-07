{{-- @ability('admin','admin,admin_cp') --}}
{{-- 	<a href="{{ route('admin') }}" class="list-group-item lgi-reduce {{ Request::is('admin') ? "active": "" }}">Control Panel</a> --}}
{{-- @endability --}}

{{-- @ability('admin','articles_list_admin') --}}

	<a href="{{ route('articles.index') }}" class="list-group-item lgi-reduce {{ Request::is('articles*') ? "active": "" }}">
		<i class="fa fa-list" aria-hidden="true"></i> Articles
		{{-- <span class="badge">{{ $totals['articles'] }}</span> --}}
    <span class="badge">{{ \App\Article::count() }}</span>
	</a>

  <a href="{{ route('audits.index') }}" class="list-group-item lgi-reduce {{ Request::is('audits*') ? "active": "" }}">
    <i class="fa fa-list" aria-hidden="true"></i> Audits
    {{-- <span class="badge">{{ $totals['articles'] }}</span> --}}
    <span class="badge">{{ \App\Audit::count() }}</span>
  </a>

{{-- @ability('admin','categories_list_admin') --}}
	<a href="{{ route('categories.index') }}"	class="list-group-item lgi-reduce {{ Request::is('categories*') ? "active": "" }}">
    <i class="fa fa-building" aria-hidden="true"></i> Categories
    <span class="badge">{{ \App\Category::count() }}</span>
  </a>
{{-- @endability --}}

{{-- @ability('admin','items_list_admin') --}}
	<a href="{{ route('items.index') }}" class="list-group-item lgi-reduce {{ Request::is('items*') ? "active": "" }}">
    <i class="fa fa-shopping-basket" aria-hidden="true"></i> Items
    <span class="badge">{{ \App\Item::count() }}</span>
  </a>
{{-- @endability --}}

{{-- @ability('admin','log_list_admin') --}}
	<a href="{{ route('logs') }}" class="list-group-item lgi-reduce">
    <i class="fa fa-eye" aria-hidden="true"></i> Log Viewer</a>
{{-- @endability --}}

{{-- @ability('admin','modules_list_admin') --}}
	<a href="{{ route('modules.index') }}" class="list-group-item lgi-reduce {{ Request::is('modules*') ? "active": "" }}">
    <i class="fa fa-cubes" aria-hidden="true"></i> Modules
    <span class="badge">{{ \App\Module::count() }}</span>
  </a>
{{-- @endability --}}

{{-- @ability('admin','modules_list_admin') --}}
	<a href="{{ route('orders.index') }}" class="list-group-item lgi-reduce {{ Request::is('orders*') ? "active": "" }}">
    <i class="fa fa-keyboard-o" aria-hidden="true"></i> Orders
    <span class="badge">{{ \App\Order::count() }}</span>
  </a>
{{-- @endability --}}

{{-- @ability('admin','permissions_list_admin') --}}
	{{-- <a href="{{ route('permissions.index') }}" class="list-group-item lgi-reduce {{ Request::is('permissions*') ? "active": "" }}"> --}}
    {{-- <i class="fa fa-bank" aria-hidden="true"></i> Permissions --}}
    {{-- <span class="badge">{{ \App\Permission::count() }}</span> --}}
  {{-- </a> --}}
{{-- @endability --}}

{{-- @ability('admin','posts_list_admin') --}}
	<a href="{{ route('posts.index') }}" class="list-group-item lgi-reduce {{ Request::is('posts*') ? "active": "" }}">
    <i class="fa fa-newspaper-o" aria-hidden="true"></i> Posts
    <span class="badge">{{ \App\Post::count() }}</span>
  </a>
{{-- @endability --}}

{{-- @ability('admin','products_list_admin') --}}
{{-- 	<a href="{{ route('products.index') }}" class="list-group-item lgi-reduce {{ Request::is('products*') ? "active": "" }}">
    <i class="fa fa-database" aria-hidden="true"></i></i></i> Products
    <span class="badge">{{ \App\Product::count() }}</span>
  </a> --}}
{{-- @endability --}}

{{-- @ability('admin','recipes_list_admin') --}}
	<a href="{{ route('recipes.index','all') }}" class="list-group-item lgi-reduce {{ Request::is('recipes*') ? "active": "" }}">
    <i class="fa fa-list-alt" aria-hidden="true"></i> Recipes
    <span class="badge">{{ \App\Recipe::count() }}</span>
  </a>
{{-- @endability --}}

{{-- @ability('admin','roles_list_admin') --}}
	<a href="{{ route('roles.index') }}" class="list-group-item lgi-reduce {{ Request::is('roles*') ? "active": "" }}">
    <i class="fa fa-circle" aria-hidden="true"></i> Roles
    <span class="badge">{{ \App\Role::count() }}</span>
  </a>
{{-- @endability --}}

{{-- @ability('admin','') --}}
	<a href="{{ route('settings') }}" class="list-group-item lgi-reduce {{ Request::is('settings*') ? "active": "" }}">
    <i class="fa fa-cog" aria-hidden="true"></i> Site Settings
  </a>
{{-- @endability --}}

{{-- @ability('admin','tags_list_admin') --}}
	<a href="{{ route('tags.index') }}" class="list-group-item lgi-reduce {{ Request::is('tags*') ? "active": "" }}">
    <i class="fa fa-tags" aria-hidden="true"></i> Tags
    <span class="badge">{{ \App\Tag::count() }}</span>
  </a>
{{-- @endability --}}

{{-- @ability('admin','tasks_list_admin') --}}
	<a href="{{ route('tasks.index') }}" class="list-group-item lgi-reduce {{ Request::is('tasks*') ? "active": "" }}">
    <i class="fa fa-tasks" aria-hidden="true"></i> Tasks
    <span class="badge">{{ \App\Task::count() }}</span>
  </a>
{{-- @endability --}}

{{-- @ability('admin','tweets_list_admin') --}}
	<a href="{{ route('tweets.index') }}" class="list-group-item lgi-reduce {{ Request::is('tweets*') ? "active": "" }}">
    <i class="fa fa-retweet" aria-hidden="true"></i> Tweets
    <span class="badge">{{ \App\Tweet::count() }}</span>
  </a>
{{-- @endability --}}

{{-- @ability('admin','users_list_admin') --}}
	<a href="{{ route('users.index') }}" class="list-group-item lgi-reduce {{ Request::is('users*') ? "active": "" }}">
    <i class="fa fa-users" aria-hidden="true"></i> Users
    <span class="badge">{{ \App\User::count() }}</span>
  </a>
{{-- @endability --}}

{{-- @ability('admin','admin_cp') --}}
	<a href="{{ route('test1') }}" class="list-group-item lgi-reduce {{ Request::is('test1*') ? "active": "" }}">Test1</a>
{{-- @endability --}}
