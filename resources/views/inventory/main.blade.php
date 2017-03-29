<!DOCTYPE html>
<html lang="en">
  @include('inventory.partials._head')
  <body>
    @include('inventory.partials._nav')
    <div class="container">
      @include('inventory.partials._messages')

      <!--{{ Auth::check()? "Logged in": "Logged Out" }}-->

      @yield('content')
      @include('inventory.partials._footer')
    </div>
    @include('inventory.partials._javascript')
    @yield('scripts')
  </body>
</html>