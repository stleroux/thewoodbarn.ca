@extends ('layouts.main')

@section ('title', 'Dashboard')

@section ('stylesheets')
  {{ Html::style('css/admin.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li>Dashboard</li>
@stop

@section ('content')

  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-default">
        <div class="panel-heading">What's been happening while you were away</div>
        <div class="panel-body">
          @if (count($newUsers) > 0)
            <div class="panel panel-default">
              <div class="panel-heading">Inactive Users</div>
              <div class="panel-body">
                <table class="table table-striped table-condensed table-hover table-responsive">
                  <thead>
                    <tr>
                      <th class="hidden-xs">Username</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email Address</th>
                      <th>Requested</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($newUsers as $newUser)
                      <tr>
                        <td class="hidden-xs">{{ $newUser->username }}</td>
                        <td>{{ $newUser->first_name }}</td>
                        <td>{{ $newUser->last_name }}</td>
                        <td>{{ $newUser->email }}</td>
                        <td>@include('layouts.dateFormat', ['model'=>$newUser, 'field'=>'created_at'])</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          @endif

          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingOne">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="no_decoration">
                  <h4 class="panel-title">
                    Latest Articles
                    <i class="fa fa-plus-square pull-right" aria-hidden="true"></i>
                  </h4>
                </a>
              </div>
              <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                {{-- Add in to class to make the panel opened by default --}}
                <div class="panel-body">
                  <table class="table table-striped table-condensed table-hover table-responsive">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Created</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($latestArticles as $article)
                        <tr>
                          <td>
                            <a href="{{ route('articles.show', $article->id) }}">
                              {{ str_limit($article->title, $limit = 40, $end = '...') }}
                            </a>
                          </td>
                          <td>@include('layouts.author', ['model'=>$article, 'field'=>'user'])</td>
                          <td>@include('layouts.dateFormat', ['model'=>$article, 'field'=>'created_at'])</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingTwo">
                <a class="collapsed no_decoration" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  <h4 class="panel-title">
                    Latest Recipes
                    <i class="fa fa-plus-square pull-right" aria-hidden="true"></i>
                  </h4>
                </a>
              </div>
              <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                  <table class="table table-striped table-condensed table-hover table-responsive">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Author</th>
                        <th>Created</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($latestRecipes as $recipe)
                        <tr>
                          <td>
                            <a href="{{ route('recipes.show', $recipe->id) }}">
                              {{ str_limit($recipe->title, $limit = 40, $end = '...') }}
                            </a>
                          </td>
                          <td>@include('layouts.author', ['model'=>$recipe, 'field'=>'user'])</td>
                          <td>@include('layouts.dateFormat', ['model'=>$recipe, 'field'=>'created_at'])</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingThree">
                <a class="collapsed no_decoration" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  <h4 class="panel-title">
                    Latest Tweets
                    <i class="fa fa-plus-square pull-right" aria-hidden="true"></i>
                  </h4>
                </a>
              </div>
              <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                  <table class="table table-striped table-condensed table-hover">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Author</th>
                        <th>Created</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($latestTweets as $tweet)
                        <tr>
                          <td>
                            <a href="{{ route('tweets.show', $tweet->id) }}">
                              {{ str_limit($tweet->title, $limit = 40, $end = '...') }}
                            </a>
                          </td>
                          <td>@include('layouts.author', ['model'=>$tweet, 'field'=>'user'])</td>
                          <td>@include('layouts.dateFormat', ['model'=>$tweet, 'field'=>'created_at'])</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{--================================================================================================================================================
  == Access modules as a regular user
  ================================================================================================================================================--}}
  @if(checkACL('user'))

<div class="row">
  <div class="col-xs-12">
    <div class="panel panel-default">
      <div class="panel-heading">Select the section you wish to access</div>
      <div class="panel-body">

        {{-- Articles --}}
        <div class="col-xs-4 col-sm-3 col-md-2">
          <div class="panel panel-default">
            <div class="panel-heading text-center">Articles</div>
            <a href="{{ route('articles.index') }}">
              <div class="panel-body" id="panel-hov">
                <div class="text-center">
                  <i class="fa fa-list fa-3x" aria-hidden="true"></i>
                </div>
              </div>
              <div class="panel-footer">
                @if(checkACL('author'))
                  <div class="hidden-xs">
                    <a href="{{ route('articles.create') }}" class="btn btn-default btn-xs btn-block">New Article</a>
                  </div>
                  <div class="hidden-sm hidden-md hidden-lg">
                    <a href="{{ route('articles.create') }}" class="btn btn-default btn-xs btn-block">New</a>
                  </div>
                @else
                  <a href="#" class="btn btn-default btn-xs btn-block disabled">&nbsp;</a>
                @endif
              </div>
            </a>
          </div>
        </div>

        {{-- Audit --}}
        @if(checkACL('admin'))
          <div class="col-xs-4 col-sm-3 col-md-2">
            <div class="panel panel-default">
              <div class="panel-heading text-center">Audits</div>
              <a href="{{ route('audits.index') }}">
                <div class="panel-body" id="panel-hov">
                  <div class="text-center">
                   <i class="fa fa-headphones fa-3x" aria-hidden="true"></i>
                  </div>
                </div>
                <div class="panel-footer">
                  <a href="#" class="btn btn-default btn-xs btn-block disabled">&nbsp;</a>
                </div>
              </a>
            </div>
          </div>
        @endif

        {{-- Blog --}}
{{--         <div class="col-xs-4 col-sm-3 col-md-2">
          <div class="panel panel-default">
            <div class="panel-heading text-center">Blog</div>
            <a href="{{ route('blog.index') }}">
              <div class="panel-body" id="panel-hov">
                <div class="text-center">
                  <i class="fa fa-th-list fa-3x" aria-hidden="true"></i>
                </div>
              </div>
              <div class="panel-footer">
                <a href="#" class="btn btn-default btn-xs btn-block disabled">&nbsp;</a>
              </div>
            </a>
          </div>
        </div> --}}

        {{-- Categories --}}
        @if(checkACL('manager'))
          <div class="col-xs-4 col-sm-3 col-md-2">
            <div class="panel panel-default">
              <div class="panel-heading text-center">Categories</div>
              <a href="{{ route('categories.index') }}">
                <div class="panel-body" id="panel-hov">
                  <div class="text-center">
                    <i class="fa fa-building fa-3x" aria-hidden="true"></i>
                  </div>
                </div>
                <div class="panel-footer">
                  <div class="hidden-xs">
                    <a href="{{ route('categories.create') }}" class="btn btn-default btn-xs btn-block">New Category</a>
                  </div>
                  <div class="hidden-sm hidden-md hidden-lg">
                    <a href="{{ route('categories.create') }}" class="btn btn-default btn-xs btn-block">New</a>
                  </div>
                </div>
              </a>
            </div>
          </div>
        @endif

        {{-- Items --}}
        @if(checkACL('author'))
          <div class="col-xs-4 col-sm-3 col-md-2">
            <div class="panel panel-default">
              <div class="panel-heading text-center">Items</div>
              <a href="{{ route('items.index') }}">
                <div class="panel-body" id="panel-hov">
                  <div class="text-center">
                    <i class="fa fa-shopping-basket fa-3x" aria-hidden="true"></i>
                  </div>
                </div>
                <div class="panel-footer">
                  <div class="hidden-xs">
                    <a href="{{ route('items.create') }}" class="btn btn-default btn-xs btn-block">New Item</a>
                  </div>
                  <div class="hidden-sm hidden-md hidden-lg">
                    <a href="{{ route('items.create') }}" class="btn btn-default btn-xs btn-block">New</a>
                  </div>
                </div>
              </a>
            </div>
          </div>
        @endif

        {{-- Log Viewer --}}
        @if(checkACL('manager'))
          <div class="col-xs-4 col-sm-3 col-md-2">
            <div class="panel panel-default">
              <div class="panel-heading text-center">LogViewer</div>
              <a href="{{ route('logs') }}">
                <div class="panel-body" id="panel-hov">
                  <div class="text-center">
                    <i class="fa fa-eye fa-3x" aria-hidden="true"></i>
                  </div>
                </div>
                <div class="panel-footer">
                <a href="#" class="btn btn-default btn-xs btn-block disabled">&nbsp;</a>
              </div>
              </a>
            </div>
          </div>
        @endif

        {{-- Modules --}}
        @if(checkACL('manager'))
          <div class="col-xs-4 col-sm-3 col-md-2">
            <div class="panel panel-default">
              <div class="panel-heading text-center">Modules</div>
              <a href="{{ route('modules.index') }}">
                <div class="panel-body" id="panel-hov">
                  <div class="text-center">
                    <i class="fa fa-cubes fa-3x" aria-hidden="true"></i>
                  </div>
                </div>
                <div class="panel-footer">
                  <div class="hidden-xs">
                    <a href="{{ route('modules.create') }}" class="btn btn-default btn-xs btn-block">New Module</a>
                  </div>
                  <div class="hidden-sm hidden-md hidden-lg">
                    <a href="{{ route('modules.create') }}" class="btn btn-default btn-xs btn-block">New</a>
                  </div>
                </div>
              </a>
            </div>
          </div>
        @endif

        {{-- Orders --}}
        @if(checkACL('admin'))
          <div class="col-xs-4 col-sm-3 col-md-2">
            <div class="panel panel-default">
              <div class="panel-heading text-center">Orders</div>
              <a href="{{ route ('orders.index') }}">
                <div class="panel-body" id="panel-hov">
                  <div class="text-center">
                    <i class="fa fa-money fa-3x" aria-hidden="true"></i>
                  </div>
                </div>
                <div class="panel-footer">
                  <a href="#" class="btn btn-default btn-xs btn-block disabled">&nbsp;</a>
                </div>
              </a>
            </div>
          </div>
        @endif

        {{-- Profile --}}
        <div class="col-xs-4 col-sm-3 col-md-2">
          <div class="panel panel-default">
            <div class="panel-heading text-center hidden-xs">My Profile</div>
            <div class="panel-heading text-center hidden-sm hidden-md hidden-lg">Profile</div>
            <a href="{{ route ('profile.show', Auth::user()->id) }}">
              <div class="panel-body" id="panel-hov">
                <div class="text-center">
                  <i class="fa fa-user fa-3x" aria-hidden="true"></i>
                </div>
              </div>
              <div class="panel-footer">
                <a href="#" class="btn btn-default btn-xs btn-block disabled">&nbsp;</a>
              </div>
            </a>
          </div>
        </div>

        {{-- Posts --}}
        @if(checkACL('author'))
          <div class="col-xs-4 col-sm-3 col-md-2">
            <div class="panel panel-default">
              <div class="panel-heading text-center">Posts</div>
              <a href="{{ route('posts.index') }}">
                <div class="panel-body" id="panel-hov">
                  <div class="text-center">
                    <i class="fa fa-newspaper-o fa-3x" aria-hidden="true"></i>
                  </div>
                </div>
                <div class="panel-footer">
                  <div class="hidden-xs">
                    <a href="{{ route('posts.create') }}" class="btn btn-default btn-xs btn-block">New Post</a>
                  </div>
                  <div class="hidden-sm hidden-md hidden-lg">
                    <a href="{{ route('posts.create') }}" class="btn btn-default btn-xs btn-block">New</a>
                  </div>
                </div>
              </a>
            </div>
          </div>
        @endif

        {{-- Products --}}
        @if(checkACL('manager'))
          <div class="col-xs-4 col-sm-3 col-md-2">
            <div class="panel panel-default">
              <div class="panel-heading text-center">Products</div>
              <a href="{{ route('products.index') }}">
                <div class="panel-body" id="panel-hov">
                  <div class="text-center">
                    <i class="fa fa-wpforms fa-3x" aria-hidden="true"></i>
                  </div>
                </div>
                <div class="panel-footer">
                  <div class="hidden-xs">
                    <a href="{{ route('products.create') }}" class="btn btn-default btn-xs btn-block">New Product</a>
                  </div>
                  <div class="hidden-sm hidden-md hidden-lg">
                    <a href="{{ route('products.create') }}" class="btn btn-default btn-xs btn-block">New</a>
                  </div>
                </div>
              </a>
            </div>
          </div>
        @endif

        {{-- Recipes --}}
        <div class="col-xs-4 col-sm-3 col-md-2">
          <div class="panel panel-default">
            <div class="panel-heading text-center">Recipes</div>
            <a href="{{ route('recipes.index','all') }}">
              <div class="panel-body" id="panel-hov">
                <div class="text-center">
                  <i class="fa fa-list-alt fa-3x" aria-hidden="true"></i>
                </div>
              </div>
              <div class="panel-footer">
                <div class="hidden-xs">
                  <a href="{{ route('recipes.create') }}" class="btn btn-default btn-xs btn-block">New Recipe</a>
                </div>
                <div class="hidden-sm hidden-md hidden-lg">
                  <a href="{{ route('recipes.create') }}" class="btn btn-default btn-xs btn-block">New</a>
                </div>
              </div>
            </a>
          </div>
        </div>

        {{-- Roles --}}
        @if(checkACL('manager'))
          <div class="col-xs-4 col-sm-3 col-md-2">
            <div class="panel panel-default">
              <div class="panel-heading text-center">Roles</div>
              <a href="{{ route('roles.index') }}">
                <div class="panel-body" id="panel-hov">
                  <div class="text-center">
                    <i class="fa fa-circle fa-3x" aria-hidden="true"></i>
                  </div>
                </div>
                <div class="panel-footer">
                  <div class="hidden-xs">
                    <a href="{{ route('roles.create') }}" class="btn btn-default btn-xs btn-block">New Role</a>
                  </div>
                  <div class="hidden-sm hidden-md hidden-lg">
                    <a href="{{ route('roles.create') }}" class="btn btn-default btn-xs btn-block">New</a>
                  </div>
                </div>
              </a>
            </div>
          </div>
        @endif

        {{-- Shop --}}
        <div class="col-xs-4 col-sm-3 col-md-2">
          <div class="panel panel-default">
            <div class="panel-heading text-center">Shop</div>
            <a href="{{ route('shop.index','all') }}">
              <div class="panel-body" id="panel-hov">
                <div class="text-center">
                  <i class="fa fa-shopping-cart fa-3x" aria-hidden="true"></i>
                </div>
              </div>
              <div class="panel-footer">
                <a href="#" class="btn btn-default btn-xs btn-block disabled">&nbsp;</a>
              </div>
            </a>
          </div>
        </div>

        {{-- Time Tracker --}}
        @if (checkACL('timeTrack'))
          <div class="col-xs-4 col-sm-3 col-md-2">
            <div class="panel panel-default">
              <div class="panel-heading text-center hidden-xs">Time Tracker</div>
              <div class="panel-heading text-center hidden-sm hidden-md hidden-lg">Tracker</div>
              <a href="#">
                <div class="panel-body" id="panel-hov">
                  <div class="text-center">
                    <i class="fa fa-calendar fa-3x" aria-hidden="true"></i>
                  </div>
                </div>
                <div class="panel-footer">
                  <div class="hidden-xs">
                    <a href="#" class="btn btn-default btn-xs btn-block">New Job</a>
                  </div>
                  <div class="hidden-sm hidden-md hidden-lg">
                    <a href="#" class="btn btn-default btn-xs btn-block">New</a>
                  </div>
                </div>
              </a>
            </div>
          </div>
        @endif

        {{-- Tags --}}
        @if(checkACL('manager'))
          <div class="col-xs-4 col-sm-3 col-md-2">
            <div class="panel panel-default">
              <div class="panel-heading text-center">Tags</div>
              <a href="{{ route('tags.index') }}">
                <div class="panel-body" id="panel-hov">
                  <div class="text-center">
                    <i class="fa fa-tags fa-3x" aria-hidden="true"></i>
                  </div>
                </div>
                <div class="panel-footer">
                  <div class="hidden-xs">
                    <a href="{{ route('tags.create') }}" class="btn btn-default btn-xs btn-block">New Tag</a>
                  </div>
                  <div class="hidden-sm hidden-md hidden-lg">
                    <a href="{{ route('tags.create') }}" class="btn btn-default btn-xs btn-block">New</a>
                  </div>
                </div>
              </a>
            </div>
          </div>
        @endif

        {{-- Tasks --}}
        <div class="col-xs-4 col-sm-3 col-md-2">
          <div class="panel panel-default">
            <div class="panel-heading text-center">Tasks</div>
            <a href="{{ route('tasks.index') }}">
              <div class="panel-body" id="panel-hov">
                <div class="text-center">
                  <i class="fa fa-tasks fa-3x" aria-hidden="true"></i>
                </div>
              </div>
              <div class="panel-footer">
                <div class="hidden-xs">
                  <a href="{{ route('tasks.create') }}" class="btn btn-default btn-xs btn-block">New Task</a>
                </div>
                <div class="hidden-sm hidden-md hidden-lg">
                  <a href="{{ route('tasks.create') }}" class="btn btn-default btn-xs btn-block">New</a>
                </div>
              </div>
            </a>
          </div>
        </div>

        {{-- Tweets --}}
        <div class="col-xs-4 col-sm-3 col-md-2">
          <div class="panel panel-default">
            <div class="panel-heading text-center">Tweets</div>
            <a href="{{ route('tweets.index') }}">
              <div class="panel-body" id="panel-hov">
                <div class="text-center">
                  <i class="fa fa-retweet fa-3x" aria-hidden="true"></i>
                </div>
              </div>
              <div class="panel-footer">
                <div class="hidden-xs">
                  <a href="{{ route('tweets.create') }}" class="btn btn-default btn-xs btn-block">New Tweet</a>
                </div>
                <div class="hidden-sm hidden-md hidden-lg">
                  <a href="{{ route('tweets.create') }}" class="btn btn-default btn-xs btn-block">New</a>
                </div>
              </div>
            </a>
          </div>
        </div>

        {{-- Users --}}
        @if(checkACL('admin'))
          <div class="col-xs-4 col-sm-3 col-md-2">
            <div class="panel panel-default">
              <div class="panel-heading text-center">Users</div>
              <a href="{{ route('users.index') }}">
                <div class="panel-body" id="panel-hov">
                  <div class="text-center">
                    <i class="fa fa-users fa-3x" aria-hidden="true"></i>
                  </div>
                </div>
                <div class="panel-footer">
                  <div class="hidden-xs">
                    <a href="{{ route('users.create') }}" class="btn btn-default btn-xs btn-block">New User</a>
                  </div>
                  <div class="hidden-sm hidden-md hidden-lg">
                    <a href="{{ route('users.create') }}" class="btn btn-default btn-xs btn-block">New</a>
                  </div>
                </div>
              </a>
            </div>
          </div>
        @endif

        <div class="col-xs-4 col-sm-3 col-md-2"></div>
        <div class="col-xs-4 col-sm-3 col-md-2"></div>
        <div class="col-xs-4 col-sm-3 col-md-2"></div>
        <div class="col-xs-4 col-sm-3 col-md-2"></div>
      </div>
{{--       <div class="panel-footer">Footer</div> --}}
    </div>
  </div>
</div>




  @endif

  {{--================================================================================================================================================
  == Access modules as an administrator
  ================================================================================================================================================--}}
  

@stop

@section ('scripts')

@stop
