<!DOCTYPE html>
<html lang="en">
  @include('ems.partials._head')
  <body>
    @include('ems.partials._nav')
    <div class="container">
      @include('ems.partials._messages')

      <!--{{ Auth::check()? "Logged in": "Logged Out" }}-->

      @yield('content')
      @include('ems.partials._footer')
    </div>
    @include('ems.partials._javascript')
    @yield('scripts')
  </body>
</html>