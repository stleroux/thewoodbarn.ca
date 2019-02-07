@extends ('layouts.main')

@section ('title', '')

@section ('stylesheets')
	{{ Html::style('css/admin.css') }}
@stop

@section('breadcrumb')
  <li><a href="/">Home</a></li>
  <li>Control Panel</li>
@stop

@section ('content')
  <div class="row">
    <div class="col-sm-3 col-md-2">
      <div class="panel-group" id="accordion">
  
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseContent" style="display: block; text-decoration: none;">
                <span class="glyphicon glyphicon-folder-close"></span>
                Content
              </a>
            </h4>
          </div>

          <div id="collapseContent" class="panel-collapse collapse in">
            <table class="table table-hover">
              <tr>
                <td>
                  <a href="{{ route('articles.index') }}" style="display: block; text-decoration: none;">
                    <span class="glyphicon glyphicon-pencil text-primary"></span>
                    Articles
                  </a>
                </td>
              </tr>
              <tr>
                <td>
                  <a href="{{ route('items.index') }}" style="display: block; text-decoration: none;">
                    <span class="glyphicon glyphicon-flash text-success"></span>
                    Items
                  </a>
                </td>
              </tr>
              <tr>
                <td>
                  <a href="{{ route('items.index') }}" style="display: block; text-decoration: none;">
                    <span class="glyphicon glyphicon-flash text-success"></span>
                    Recipes
                  </a>
                </td>
              </tr>
              <tr>
                <td>
                  <a href="{{ route('items.index') }}" style="display: block; text-decoration: none;">
                    <span class="glyphicon glyphicon-flash text-success"></span>
                    Posts
                  </a>
                </td>
              </tr>
              <tr>
                <td>
                  <a href="{{ route('items.index') }}" style="display: block; text-decoration: none;">
                    <span class="glyphicon glyphicon-flash text-success"></span>
                    Users
                  </a>
                </td>
              </tr>
              <tr>
                <td>
                  <a href="#" style="display: block; text-decoration: none;">
                    <span class="glyphicon glyphicon-file text-info"></span>
                    Newsletters
                  </a>
                </td>
              </tr>
              <tr>
                <td>
                  <a href="#" style="display: block; text-decoration: none;">
                    <span class="glyphicon glyphicon-comment text-success"></span>
                    Comments
                    <span class="badge pull-right">42</span>
                  </a>
                </td>
              </tr>
            </table>
          </div> {{-- End of CollapseContent --}}
        </div> {{-- End of Panel --}}

        <div class="panel panel-primary">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseModules" style="display: block; text-decoration: none;">
                <span class="glyphicon glyphicon-th"></span>
                Modules
              </a>
            </h4>
          </div>
          <div id="collapseModules" class="panel-collapse collapse">
            <table class="table table-hover">
              <tr>
                <td>
                  <a href="#" style="display: block; text-decoration: none;">
                    Orders
                    <span class="label label-success">$ 320</span>
                  </a>
                </td>
              </tr>
              <tr>
                <td>
                  <a href="#" style="display: block; text-decoration: none;">Invoices</a>
                </td>
              </tr>
              <tr>
                <td>
                  <a href="#" style="display: block; text-decoration: none;">Shipments</a>
                </td>
              </tr>
              <tr>
                <td>
                  <a href="#" style="display: block; text-decoration: none;">Tex</a>
                </td>
              </tr>
            </table>
          </div> {{-- End of CollpaseModules --}}
        </div>

        @if(Auth::check())
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseAccount" style="display: block; text-decoration: none;">
                  <span class="glyphicon glyphicon-user"></span>
                  My Account
                </a>
              </h4>
            </div>

            <div id="collapseAccount" class="panel-collapse collapse">
              <table class="table table-hover">
                <tr>
                  <td>
                    <a href="#" style="display: block; text-decoration: none;">Change Password</a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <a href="#" style="display: block; text-decoration: none;">
                      Notifications
                      <span class="label label-info pull-right">5</span>
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <a href="#" style="display: block; text-decoration: none;">Import/Export</a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <a href="#" class="text-danger" style="display: block; text-decoration: none;">
                      <span class="glyphicon glyphicon-trash text-danger"></span>
                      Disable Account
                    </a>
                  </td>
                </tr>
              </table>
            </div> {{-- End of CollapseAccount --}}
          </div> {{-- End of Panel --}}
        @endif

        <div class="panel panel-primary">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseReports" style="display: block; text-decoration: none;">
                <span class="glyphicon glyphicon-file"></span>
                Reports
              </a>
            </h4>
          </div>

          <div id="collapseReports" class="panel-collapse collapse">
            <table class="table table-hover">
              <tr>
                <td>
                  <a href="#" style="display: block; text-decoration: none;">
                    <span class="glyphicon glyphicon-usd"></span>
                    Sales
                  </a>
                </td>
              </tr>
              <tr>
                <td>
                  <a href="#" style="display: block; text-decoration: none;">
                    <span class="glyphicon glyphicon-user"></span>
                    Customers
                  </a>
                </td>
              </tr>
              <tr>
                <td>
                  <a href="#" style="display: block; text-decoration: none;">
                    <span class="glyphicon glyphicon-tasks"></span>
                    Products
                  </a>
                </td>
              </tr>
              <tr>
                <td>
                  <a href="#" style="display: block; text-decoration: none;">
                    <span class="glyphicon glyphicon-shopping-cart"></span>
                    Shopping Cart
                  </a>
                </td>
              </tr>
            </table>
          </div> {{-- End of CollapseReports --}}
        </div>
      </div>
    </div>
{{--     <div class="col-md-6">
        <div class="panel panel-info">
        <div class="panel-heading">Welcome to the Control Panel of the website.</div>
        <div class="panel-body">
          Please make a selection in the left hand menu.
        </div>
        <div class="panel-footer">
          This is a work in progress.
        </div>
      </div>
    </div> --}}
    <div class="col-sm-9 col-md-10">
      <div class="panel panel-default with-nav-tabs">
        <div class="panel-heading">
          <ul class="nav nav-tabs">
              <li class="active"><a href="#tab1default" data-toggle="tab">Articles</a></li>
              <li><a href="#tab2default" data-toggle="tab">Recipes</a></li>
              <li><a href="#tab3default" data-toggle="tab">Posts</a></li>
              <li><a href="#tab4default" data-toggle="tab">Users</a></li>
          </ul>
        </div>
        <div class="panel-body">
          <div class="tab-content">
            <div class="tab-pane fade in active" id="tab1default">@include('__admin._latestArticles')</div>
            <div class="tab-pane fade" id="tab2default">@include('__admin._latestRecipes')</div>
            <div class="tab-pane fade" id="tab3default">@include('__admin._latestPosts')</div>
            <div class="tab-pane fade" id="tab4default">@include('__admin._inactiveUsers')</div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@section ('scripts')
@stop