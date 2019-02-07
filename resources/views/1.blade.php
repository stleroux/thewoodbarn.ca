@extends('layouts.1')


<div class="container">
  <div class="row">
    <div class="well-sm">
      <h2 class="text-center">The WoodBarn.ca</h2>
    </div> {{-- End of well --}}
  </div> {{-- End of row --}}

  <div class="row">
    <div class="col-sm-3 col-md-2"> {{-- Sidebar --}}
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

          <div id="collapseContent" class="panel-collapse collapse">
            <table class="table table-hover">
              <tr>
                <td>
                    <a href="{{ route('articles.index') }}" style="display: block; text-decoration: none;">
                      <span class="glyphicon glyphicon-pencil text-primary"></span>
                      Articles
                    </a>
                </td>
              </tr>
              @if(checkACL('admin'))
                <tr>
                  <td>
                    <a href="{{ route('items.index') }}" style="display: block; text-decoration: none;">
                      <span class="glyphicon glyphicon-flash text-success"></span>
                      Items
                    </a>
                  </td>
                </tr>
              @endif
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
    </div> {{-- End of sidebar --}}

    {{-- <div class="row"> --}}
      <div class="col-sm-9 col-md-10">
        <div class="well-sm text-center">Messages go here</div>
      </div>
    {{-- </div> --}}

    {{-- <div class="row"> --}}
      <div class="col-sm-9 col-md-10">
        <div class="panel panel-default">
            <div class="panel-heading">Tilte of section being viewed</div>
            <div class="panel-body">
              Content goes here
              <br />
              Content goes here
            </div>
            <div class="panel-footer">Panel Footer Content</div>
        </div>
      {{-- </div> --}}
    </div> {{-- End of content --}}
  </div> {{-- End of row --}}
</div> {{-- End of container --}}
