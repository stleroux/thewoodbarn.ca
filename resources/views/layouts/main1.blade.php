{{-- Used for pages that do not bisplay the breadcrumb --}}
<!DOCTYPE html>
<html lang="en">

  @include ('layouts.head')

  <body>

    @include ('layouts.menus.nav')
    
    @if (Auth::check())
      <div class="{{ (Auth::user()->display == 'normal' ? 'container' : 'container-fluid') }}">
    @else
      <div class="container">
    @endif
      
      @include ('layouts.javascripts')
      @include ('layouts.messages')
      
      @yield('page_top_menu')
      
{{--       <ol class="breadcrumb">
        @yield('breadcrumb')
        @include ('layouts.cart')
      </ol> --}}
      
      @yield ('content')
    </div> <!-- end of container -->
    
    @include ('layouts.footer')

    @yield ('scripts')
    {{-- @include('layouts.admin.confirmDelete') --}}
  </body>
</html>