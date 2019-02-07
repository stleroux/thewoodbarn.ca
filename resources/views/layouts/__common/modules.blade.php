<li class="dropdown">
    <a href="/dashboard" class="dropdown-toggle" data-toggle="dropdown">
   		<i class="fa fa-cubes" aria-hidden="true"></i> Modules <b class="caret"></b>
   	</a>

    <ul class="dropdown-menu">
    	@if(checkACL('author'))
	       	<li class="dropdown-submenu {{ Request::is('articles*') ? "": "" }}">
		       	<a href="/articles"><i class="fa fa-list fa-fw" aria-hidden="true"></i> Articles</a>
				@if(checkACL('author'))
					<ul class="dropdown-menu">
	   	            	<li>
	       	        		<a href="{{ route('articles.create') }}"><i class="fa fa-plus-square-o fa-fw" aria-hidden="true"></i> Add Article</a>
	           	    	</li>
	           		</ul>
	           	@endif
			</li>
		@endif

		@if(checkACL('author'))
        	<li class="dropdown-submenu {{ Request::is('categories*') ? "": "" }}">
				<a href="{{ route('admin.categories.index') }}"><i class="fa fa-building fa-fw" aria-hidden="true"></i> Categories</a>
				@if(checkACL('author'))
					<ul class="dropdown-menu">
   		    	       	<li>
       		        		<a href="{{ route('admin.categories.create') }}"><i class="fa fa-plus-square-o fa-fw" aria-hidden="true"></i> Add Category</a>
           		   		</li>
           			</ul>
           		@endif
			</li>
		@endif

		@if(checkACL('author'))
			<li class="dropdown-submenu {{ Request::is('items*') ? "": "" }}">
				<a href="/items"><i class="fa fa-shopping-basket fa-fw" aria-hidden="true"></i> Items</a>
				@if(checkACL('author'))
					<ul class="dropdown-menu">
		            	<li>
	    	        		<a href="{{ route('items.create') }}"><i class="fa fa-plus-square-o fa-fw" aria-hidden="true"></i> Add Item</a>
	        	    	</li>
	        		</ul>
	        	@endif
			</li>
		@endif

		@if(checkACL('admin'))
			<li>
				<a href="{{ route('logs') }}" class="{{ Request::is('logs*') ? "": "" }}">
					<i class="fa fa-eye fa-fw" aria-hidden="true"></i> Log Viewer
				</a>
			</li>
		@endif

		@if(checkACL('author'))
			<li class="dropdown-submenu {{ Request::is('modules*') ? "": "" }}">
				<a href="/modules"><i class="fa fa-cubes fa-fw" aria-hidden="true"></i> Modules</a>
				@if(checkACL('author'))
					<ul class="dropdown-menu">
		            	<li>
	    	        		<a href="{{ route('modules.create') }}"><i class="fa fa-plus-square-o fa-fw" aria-hidden="true"></i> Add Module</a>
	        	    	</li>
	        		</ul>
	        	@endif
			</li>
		@endif

		@if(checkACL('author'))
			<li class="dropdown-submenu {{ Request::is('permissions*') ? "": "" }}">
				<a href="/permissions"><i class="fa fa-bank fa-fw" aria-hidden="true"></i> Permissions</a>
				@if(checkACL('author'))
					<ul class="dropdown-menu">
		            	<li>
	    	        		<a href="{{ route('permissions.create') }}"><i class="fa fa-plus-square-o fa-fw" aria-hidden="true"></i> Add Permision</a>
	        	    	</li>
	        		</ul>
	        	@endif
			</li>
		@endif

		@if(checkACL('author'))
			<li class="dropdown-submenu {{ Request::is('posts*') ? "": "" }}">
				<a href="/posts"><i class="fa fa-newspaper-o fa-fw" aria-hidden="true"></i> Posts</a>
				@if(checkACL('author'))
					<ul class="dropdown-menu">
		            	<li>
	    	        		<a href="{{ route('posts.create') }}"><i class="fa fa-plus-square-o fa-fw" aria-hidden="true"></i> Add Post</a>
	        	    	</li>
	        		</ul>
	        	@endif
			</li>
		@endif

		@if(checkACL('admin'))
			<li class="dropdown-submenu {{ Request::is('products*') ? "": "" }}">
				<a href="/products"><i class="fa fa-database" aria-hidden="true"></i></i> Products</a>
				@if(checkACL('admin'))
					<ul class="dropdown-menu">
		            	<li>
	    	        		<a href="{{ route('products.create') }}"><i class="fa fa-plus-square-o fa-fw" aria-hidden="true"></i> Add Product</a>
	        	    	</li>
	        		</ul>
	        	@endif
			</li>
		@endif

		@if(checkACL('author'))
			<li class="dropdown-submenu {{ Request::is('recipes*') ? "": "" }}">
				<a href="/admin/recipes/index"><i class="fa fa-list-alt fa-fw" aria-hidden="true"></i> Recipes</a>
				@if(checkACL('author'))
					<ul class="dropdown-menu">
		            	<li>
	    	        		<a href="{{ route('recipes.create') }}"><i class="fa fa-plus-square-o fa-fw" aria-hidden="true"></i> Add Recipe</a>
	        	    	</li>
	        		</ul>
	        	@endif
			</li>
		@endif

		@if(checkACL('author'))
			<li class="dropdown-submenu {{ Request::is('roles*') ? "": "" }}">
				<a href="/roles"><i class="fa fa-circle fa-fw" aria-hidden="true"></i> Roles</a>
				@if(checkACL('author'))
					<ul class="dropdown-menu">
		            	<li>
	    	        		<a href="{{ route('admin.roles.create') }}"><i class="fa fa-plus-square-o fa-fw" aria-hidden="true"></i> Add Role</a>
	        	    	</li>
	        		</ul>
	        	@endif
			</li>
		@endif

		@if(checkACL('author'))
			<li class="dropdown-submenu {{ Request::is('tags*') ? "": "" }}">
				<a href="/tags"><i class="fa fa-tags fa-fw" aria-hidden="true"></i> Tags</a>
				@if(checkACL('author'))
					<ul class="dropdown-menu">
		            	<li>
	    	        		<a href="{{ route('admin.tags.create') }}"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add Tag</a>
	        	    	</li>
	        		</ul>
	        	@endif
			</li>
		@endif

		@if(checkACL('author'))
			<li class="dropdown-submenu {{ Request::is('tasks*') ? "": "" }}">
				<a href="/tasks"><i class="fa fa-tasks fa-fw" aria-hidden="true"></i> Tasks</a>
				@if(checkACL('author'))
					<ul class="dropdown-menu">
		            	<li>
	    	        		<a href="{{ route('admin.tasks.create') }}"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add Task</a>
	        	    	</li>
	        		</ul>
	        	@endif
			</li>
		@endif

		@if(checkACL('author'))
			<li class="dropdown-submenu {{ Request::is('tweets*') ? "": "" }}">
				<a href="/tweets"><i class="fa fa-twitch fa-fw" aria-hidden="true"></i> Tweets</a>
				@if(checkACL('author'))
					<ul class="dropdown-menu">
		            	<li>
	    	        		<a href="{{ route('tweets.create') }}"><i class="fa fa-plus-square-o fa-fw" aria-hidden="true"></i> Add Tweet</a>
	        	    	</li>
	        		</ul>
	        	@endif
			</li>
		@endif

		@if(checkACL('author'))
			<li class="dropdown-submenu {{ Request::is('users*') ? "": "" }}">
				<a href="/users"><i class="fa fa-users fa-fw" aria-hidden="true"></i> Users</a>
				@if(checkACL('author'))
					<ul class="dropdown-menu">
		            	<li>
	    	        		<a href="{{ route('admin.users.create') }}"><i class="fa fa-plus-square-o fa-fw" aria-hidden="true"></i> Add User</a>
	        	    	</li>
	        		</ul>
	        	@endif
			</li>
		@endif



		@if(checkACL('admin'))
			<li role="separator" class="divider"></li>
			<li class=""><a href="/template">Template</a></li>
			<li class=""><a href="/test">Test</a></li>
		@endif
 
 	</ul>
        
</li>


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