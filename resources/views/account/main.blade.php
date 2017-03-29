<!DOCTYPE html>
<html lang="en">
  @include('account.partials._head')
  <body>
    @include('account.partials._nav')
    <div class="container">
      @include('account.partials._messages')

      <!--{{ Auth::check()? "Logged in": "Logged Out" }}-->

      @yield('content')
      @include('account.partials._footer')
    </div>
    @include('account.partials._javascript')
    @yield('scripts')
  </body>
</html>