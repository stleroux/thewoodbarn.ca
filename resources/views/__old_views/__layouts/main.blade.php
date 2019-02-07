<!DOCTYPE html>
<html lang="en">

  @include ('partials._head')

  <body>

    @include ('partials.nav')

    
    @if (Auth::check())
      <div class="{{ (Auth::user()->display == 'normal' ? 'container' : 'container-fluid') }}">
    @else
      <div class="container">
    @endif
      
      @include ('partials._javascripts')
      @include ('partials._messages')
      @include ('partials._cart')
      @yield ('content')
    </div> <!-- end of container -->

    <!-- Used in admin.recipes.index -->
    <div class="container-fluid">
      @yield ('full')
    </div>
    <!-- -->
    
    @include ('partials._footer')

    @yield ('scripts')

  </body>
</html>