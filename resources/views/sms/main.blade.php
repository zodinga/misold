<!DOCTYPE html>
<html lang="en">
  @include('sms.partials._head')
  <body>
    @include('sms.partials._nav')
    <div class="container">
      @include('sms.partials._messages')

      <!--{{ Auth::check()? "Logged in": "Logged Out" }}-->

      @yield('content')
      @include('sms.partials._footer')
    </div>
    @include('sms.partials._javascript')
    @yield('scripts')
  </body>
</html>