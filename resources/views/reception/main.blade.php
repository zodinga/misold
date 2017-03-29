<!DOCTYPE html>
<html lang="en">
  @include('reception.partials._head')
  <body>
    @include('reception.partials._nav')
    <div class="container">
      @include('reception.partials._messages')

      <!--{{ Auth::check()? "Logged in": "Logged Out" }}-->

      @yield('content')
      @include('reception.partials._footer')
    </div>
    @include('reception.partials._javascript')
    @yield('scripts')
  </body>
</html>