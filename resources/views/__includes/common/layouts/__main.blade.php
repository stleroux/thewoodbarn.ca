<!DOCTYPE html>
<html lang="en">

  @include ('includes.frontend.partials._head')

  <body>

    @include ('includes.frontend.menus.nav')

    
    @if (Auth::check())
      <div class="{{ (Auth::user()->display == 'normal' ? 'container' : 'container-fluid') }}">
    @else
      <div class="container">
    @endif
      
      @include ('includes.frontend.partials._javascripts')
      @include ('includes.frontend.partials._messages')
      @include ('includes.frontend.partials._cart')
      @yield ('content')
    </div> <!-- end of container -->

    <!-- Used in admin.recipes.index -->
    <div class="container-fluid">
      @yield ('full')
    </div>
    <!-- -->
    
    @include ('includes.frontend.partials._footer')

    @yield ('scripts')

  </body>
</html>