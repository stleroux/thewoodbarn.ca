<!DOCTYPE html>
<html lang="en">

  @include ('layouts.head')

  <body>

    @if (Auth::check())
      <div class="{{ (Auth::user()->display == 'normal' ? 'container' : 'container-fluid') }}">
    @else
      <div class="container">
    @endif

        @include ('layouts.menus.nav')
        
        @include ('layouts.javascripts')
        {{-- @include ('layouts.messages') --}}

        @if (View::hasSection('breadcrumb'))
          <ol class="breadcrumb">
            @yield('breadcrumb')
            @include ('layouts.cart')
          </ol>
        @endif

        @if (View::hasSection('menubar'))
          <div class="well well-sm clearfix">
            <div class="pull-right">
              @yield('menubar')
            </div>
          </div>
        @endif
        
        @yield ('content')
      </div> <!-- end of container -->
    
    @include ('layouts.footer')
    @yield ('scripts')
    @include('layouts.common.confirmDelete')
  </body>
</html>