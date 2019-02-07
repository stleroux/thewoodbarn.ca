@ability('admin','admin,admin_cp')
	<a href="{{ route('admin') }}" class="list-group-item lgi-reduce {{ Request::is('admin') ? "active": "" }}">Control Panel</a>
@endability

@ability('admin','articles_list_admin')
	<a href="{{ route('admin.articles.index') }}" class="list-group-item lgi-reduce {{ Request::is('admin/articles*') ? "active": "" }}">Articles</a>
@endability

@ability('admin','categories_list_admin')
	<a href="{{ route('admin.categories.index') }}"	class="list-group-item lgi-reduce {{ Request::is('admin/categories*') ? "active": "" }}">Categories</a>
@endability

@ability('admin','items_list_admin')
	<a href="{{ route('admin.items.index') }}" class="list-group-item lgi-reduce {{ Request::is('admin/items*') ? "active": "" }}">Items</a>
@endability

@ability('admin','log_list_admin')
	<a href="{{ route('logs') }}" class="list-group-item lgi-reduce">Log Viewer</a>
@endability

@ability('admin','modules_list_admin')
	<a href="{{ route('admin.modules.index') }}" class="list-group-item lgi-reduce {{ Request::is('admin/modules*') ? "active": "" }}">Modules</a>
@endability

{{-- @ability('admin','modules_list_admin') --}}
	<a href="{{ route('admin.orders.index') }}" class="list-group-item lgi-reduce {{ Request::is('admin/orders*') ? "active": "" }}">Orders</a>
{{-- @endability --}}

@ability('admin','permissions_list_admin')
	<a href="{{ route('admin.permissions.index') }}" class="list-group-item lgi-reduce {{ Request::is('admin/permissions*') ? "active": "" }}">Permissions</a>
@endability

@ability('admin','posts_list_admin')
	<a href="{{ route('admin.posts.index') }}" class="list-group-item lgi-reduce {{ Request::is('admin/posts*') ? "active": "" }}">Posts</a>
@endability

@ability('admin','products_list_admin')
	<a href="{{ route('admin.products.index') }}" class="list-group-item lgi-reduce {{ Request::is('admin/products*') ? "active": "" }}">Products</a>
@endability

@ability('admin','recipes_list_admin')
	<a href="{{ route('admin.recipes.index') }}" class="list-group-item lgi-reduce {{ Request::is('admin/recipes*') ? "active": "" }}">Recipes</a>
@endability

@ability('admin','roles_list_admin')
	<a href="{{ route('admin.roles.index') }}" class="list-group-item lgi-reduce {{ Request::is('admin/roles*') ? "active": "" }}">Roles</a>
@endability

@ability('admin','')
	<a href="{{ route('settings') }}" class="list-group-item lgi-reduce {{ Request::is('admin/settings*') ? "active": "" }}">Site Settings</a>
@endability

@ability('admin','tags_list_admin')
	<a href="{{ route('admin.tags.index') }}" class="list-group-item lgi-reduce {{ Request::is('admin/tags*') ? "active": "" }}">Tags</a>
@endability

@ability('admin','tasks_list_admin')
	<a href="{{ route('admin.tasks.index') }}" class="list-group-item lgi-reduce {{ Request::is('admin/tasks*') ? "active": "" }}">Tasks</a>
@endability

@ability('admin','tweets_list_admin')
	<a href="{{ route('admin.tweets.index') }}" class="list-group-item lgi-reduce {{ Request::is('admin/tweets*') ? "active": "" }}">Tweets</a>
@endability

@ability('admin','users_list_admin')
	<a href="{{ route('admin.users.index') }}" class="list-group-item lgi-reduce {{ Request::is('admin/users*') ? "active": "" }}">Users</a>
@endability

@ability('admin','admin_cp')
	<a href="{{ route('test1') }}" class="list-group-item lgi-reduce {{ Request::is('admin/test1*') ? "active": "" }}">Test1</a>
@endability
