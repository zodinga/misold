<!DOCTYPE html>
<html lang="en">
  @include('hostel.partials._head')
  <body>
    @include('hostel.partials._nav')
    <div class="container">
      @include('hostel.partials._messages')

      <!--{{ Auth::check()? "Logged in": "Logged Out" }}-->

      @yield('content')
      @include('hostel.partials._footer')
    </div>
    @include('hostel.partials._javascript')
    @yield('scripts')
  </body>
</html>