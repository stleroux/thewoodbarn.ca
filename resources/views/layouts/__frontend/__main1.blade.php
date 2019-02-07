{{-- Removed breadcrumb section since it caused issues on some pages like Login and Register --}}
<!DOCTYPE html>
<html lang="en">

  @include ('layouts.frontend.head')

  <body>

    @include ('layouts.frontend.menus.nav')
    
    @if (Auth::check())
      <div class="{{ (Auth::user()->display == 'normal' ? 'container' : 'container-fluid') }}">
    @else
      <div class="container">
    @endif
      
      @include ('layouts.frontend.javascripts')
      @include ('layouts.frontend.messages')
      @yield('page_top_menu')
      @yield ('content')
    </div> <!-- end of container -->
    
    @include ('layouts.frontend.footer')

    @yield ('scripts')

  </body>
</html>