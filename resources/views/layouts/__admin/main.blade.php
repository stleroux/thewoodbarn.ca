<!DOCTYPE html>
<html lang="en">

  @include ('layouts.admin.head')

  <body>
  
    @include ('layouts.admin.menus.nav')
  
    @include ('layouts.admin.javascripts')
  
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">ADMIN CONTROL PANEL
              @include ('layouts.admin.messages')
            </div>
            <div class="panel-body">
              <div class="col-md-2">
                <ul class="list-group">
                  @include('layouts.admin.menus.nav_cp')
                </ul>
              </div>
              <div class="col-md-10">
                <ol class="breadcrumb">
                  @yield('breadcrumb')
                </ol>
                @yield('page_top_menu')
                @yield ('content')
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- end of container -->
    @include ('layouts.admin.footer')
    @yield ('scripts')
    @include('layouts.common.confirmDelete')
  </body>
</html>