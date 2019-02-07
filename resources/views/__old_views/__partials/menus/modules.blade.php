<li class="dropdown">
    <a href="/dashboard" class="dropdown-toggle" data-toggle="dropdown">
   		<i class="fa fa-cubes" aria-hidden="true"></i> Modules <b class="caret"></b>
   	</a>

    <ul class="dropdown-menu">
		@ability('admin','admin,articles_list,articles_list_admin')
        	<li class="{{ (Auth::user()->ability('admin','admin,articles_create,articles_create_admin')) ? "dropdown-submenu" : "dropdown" }} {{ Request::is('articles*') ? "": "" }}">
				<a href="/articles"><i class="fa fa-list fa-fw" aria-hidden="true"></i> Articles</a>
				@ability('admin','admin,articles_create,articles_create_admin')
					<ul class="dropdown-menu">
    	            	<li>
        	        		<a href="{{ route('articles.create') }}"><i class="fa fa-plus-square-o fa-fw" aria-hidden="true"></i> Add Article</a>
            	    	</li>
            		</ul>
            	@endability
			</li>
		@endability

		{{-- @ability('admin','categories_list')
        	<li class="{{ (Auth::user()->ability('admin','categories_create')) ? "dropdown-submenu" : "dropdown" }} {{ Request::is('categories*') ? "": "" }}">
				<a href="{{ route('admin.categories.index') }}"><i class="fa fa-building fa-fw" aria-hidden="true"></i> Categories</a>
				@ability('admin','categories_create')
					<ul class="dropdown-menu">
    	            	<li>
        	        		<a href="{{ route('admin.categories.create') }}"><i class="fa fa-plus-square-o fa-fw" aria-hidden="true"></i> Add Category</a>
            	    	</li>
            		</ul>
            	@endability
			</li>
		@endability --}}

		@ability('admin','admin,items_list,items_list_admin')
			<li class="{{ (Auth::user()->ability('admin','admin,items_create,items_create_admin')) ? "dropdown-submenu" : "dropdown" }} {{ Request::is('items*') ? "": "" }}">
				<a href="/items"><i class="fa fa-shopping-basket fa-fw" aria-hidden="true"></i> Items</a>
				@ability('admin','admin,items_create,items_create_admin')
					<ul class="dropdown-menu">
		            	<li>
	    	        		<a href="{{ route('items.create') }}"><i class="fa fa-plus-square-o fa-fw" aria-hidden="true"></i> Add Item</a>
	        	    	</li>
	        		</ul>
	        	@endability
			</li>
		@endability

{{-- 		@ability('admin','')
			<li>
				<a href="{{ route('logs') }}" class="{{ Request::is('logs*') ? "": "" }}">
					<i class="fa fa-eye fa-fw" aria-hidden="true"></i> Log Viewer
				</a>
			</li>
		@endability --}}

{{-- 		@ability('admin','modules_list')
			<li class="{{ (Auth::user()->ability('admin','modules_create')) ? "dropdown-submenu" : "dropdown" }} {{ Request::is('modules*') ? "": "" }}">
				<a href="/modules"><i class="fa fa-cubes fa-fw" aria-hidden="true"></i> Modules</a>
				@ability('admin','modules_create')
					<ul class="dropdown-menu">
		            	<li>
	    	        		<a href="{{ route('modules.create') }}"><i class="fa fa-plus-square-o fa-fw" aria-hidden="true"></i> Add Module</a>
	        	    	</li>
	        		</ul>
	        	@endability
			</li>
		@endability --}}

{{-- 		@ability('admin','permissions_list')
			<li class="{{ (Auth::user()->ability('admin','permissions_create')) ? "dropdown-submenu" : "dropdown" }} {{ Request::is('permissions*') ? "": "" }}">
				<a href="/permissions"><i class="fa fa-bank fa-fw" aria-hidden="true"></i> Permissions</a>
				@ability('admin','permissions_create')
					<ul class="dropdown-menu">
		            	<li>
	    	        		<a href="{{ route('permissions.create') }}"><i class="fa fa-plus-square-o fa-fw" aria-hidden="true"></i> Add Permision</a>
	        	    	</li>
	        		</ul>
	        	@endability
			</li>
		@endability --}}

		@ability('admin','admin,posts_list,posts_list_admin')
			<li class="{{ (Auth::user()->ability('admin','admin,posts_create,posts_create_admin')) ? "dropdown-submenu" : "dropdown" }} {{ Request::is('posts*') ? "": "" }}">
				<a href="/posts"><i class="fa fa-newspaper-o fa-fw" aria-hidden="true"></i> Posts</a>
				@ability('admin','admin,posts_create,posts_create_admin')
					<ul class="dropdown-menu">
		            	<li>
	    	        		<a href="{{ route('posts.create') }}"><i class="fa fa-plus-square-o fa-fw" aria-hidden="true"></i> Add Post</a>
	        	    	</li>
	        		</ul>
	        	@endability
			</li>
		@endability

{{-- 		@ability('admin','')
			<li class="{{ (Auth::user()->ability('admin','')) ? "dropdown-submenu" : "dropdown" }} {{ Request::is('products*') ? "": "" }}">
				<a href="/products"><i class="fa fa-database" aria-hidden="true"></i></i> Products</a>
				@ability('admin','')
					<ul class="dropdown-menu">
		            	<li>
	    	        		<a href="{{ route('products.create') }}"><i class="fa fa-plus-square-o fa-fw" aria-hidden="true"></i> Add Product</a>
	        	    	</li>
	        		</ul>
	        	@endability
			</li>
		@endability --}}

{{-- 		@ability('admin','recipes_list')
			<li class="{{ (Auth::user()->ability('admin','recipes_create')) ? "dropdown-submenu" : "dropdown" }} {{ Request::is('recipes*') ? "": "" }}">
				<a href="/admin/recipes/index"><i class="fa fa-list-alt fa-fw" aria-hidden="true"></i> Recipes</a>
				@ability('admin','modules_create')
					<ul class="dropdown-menu">
		            	<li>
	    	        		<a href="{{ route('recipes.create') }}"><i class="fa fa-plus-square-o fa-fw" aria-hidden="true"></i> Add Recipe</a>
	        	    	</li>
	        		</ul>
	        	@endability
			</li>
		@endability --}}

{{-- 		@ability('admin','roles_list')
			<li class="{{ (Auth::user()->ability('admin','roles_create')) ? "dropdown-submenu" : "dropdown" }} {{ Request::is('roles*') ? "": "" }}">
				<a href="/roles"><i class="fa fa-circle fa-fw" aria-hidden="true"></i> Roles</a>
				@ability('admin','roles_create')
					<ul class="dropdown-menu">
		            	<li>
	    	        		<a href="{{ route('admin.roles.create') }}"><i class="fa fa-plus-square-o fa-fw" aria-hidden="true"></i> Add Role</a>
	        	    	</li>
	        		</ul>
	        	@endability
			</li>
		@endability --}}

{{-- 		@ability('admin','tags_list')
			<li class="{{ Request::is('tags*') ? "": "" }}">
				<a href="/tags"><i class="fa fa-tags fa-fw" aria-hidden="true"></i> Tags</a>
				@ability('admin','tags_create')
					<ul class="dropdown-menu">
		            	<li>
	    	        		<a href="{{ route('tags.create') }}"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add Tag</a>
	        	    	</li>
	        		</ul>
	        	@endability
			</li>
		@endability --}}

		@ability('admin','admin,tasks_list,tasks_list_admin')
			<li class="{{ Request::is('tasks*') ? "": "" }}">
				<a href="/tasks"><i class="fa fa-tasks fa-fw" aria-hidden="true"></i> Tasks</a>
				{{-- @ability('admin','tasks_create')
					<ul class="dropdown-menu">
		            	<li>
	    	        		<a href="{{ route('tasks.create') }}"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add Task</a>
	        	    	</li>
	        		</ul>
	        	@endability --}}
			</li>
		@endability

		@ability('admin','tweets_list')
			<li class="{{ (Auth::user()->ability('admin','admin,tweets_create,tweets_create_admin')) ? "dropdown-submenu" : "dropdown" }} {{ Request::is('tweets*') ? "": "" }}">
				<a href="/tweets"><i class="fa fa-twitch fa-fw" aria-hidden="true"></i> Tweets</a>
				@ability('admin','admin,tweets_create,tweets_create_admin')
					<ul class="dropdown-menu">
		            	<li>
	    	        		<a href="{{ route('tweets.create') }}"><i class="fa fa-plus-square-o fa-fw" aria-hidden="true"></i> Add Tweet</a>
	        	    	</li>
	        		</ul>
	        	@endability
			</li>
		@endability

{{-- 		@ability('admin','users_list')
			<li class="{{ (Auth::user()->ability('admin','users_create')) ? "dropdown-submenu" : "dropdown" }} {{ Request::is('users*') ? "": "" }}">
				<a href="/users"><i class="fa fa-users fa-fw" aria-hidden="true"></i> Users</a>
				@ability('admin','users_create')
					<ul class="dropdown-menu">
		            	<li>
	    	        		<a href="{{ route('admin.users.create') }}"><i class="fa fa-plus-square-o fa-fw" aria-hidden="true"></i> Add User</a>
	        	    	</li>
	        		</ul>
	        	@endability
			</li>
		@endability --}}



		@role('admin')
			<li role="separator" class="divider"></li>
			<li class=""><a href="/template">Template</a></li>
			<li class=""><a href="/test">Test</a></li>
		@endrole
 </ul>
       {{--  
   
</li> --}}


{{-- <li class="dropdown">
    <a href="#" class="dropdown-toggle disabled" data-toggle="dropdown">
    	<i class="fa fa-cubes" aria-hidden="true"></i> Modules <b class="caret"></b>
    </a>
    <ul class="dropdown-menu">
	    <li class="dropdown-submenu">
	        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
	        <ul class="dropdown-menu">
	            <li class="dropdown-submenu">
	            	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown</a>
	        		<ul class="dropdown-menu">
	            		<li><a href="#">Action</a></li>
	            	</ul>
	            </li>
	            <li><a href="#">Action</a></li>
	        </ul>
	    </li>
	</ul>
</li> --}}