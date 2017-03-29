<!DOCTYPE html>
<html lang="en">
  @include('systems.partials._head')
  <body>
    @include('systems.partials._nav')
    <div class="container">
      @include('systems.partials._messages')

      <!--{{ Auth::check()? "Logged in": "Logged Out" }}-->

      @yield('content')
      @include('systems.partials._footer')
    </div>
    @include('systems.partials._javascript')
    @yield('scripts')
  </body>
</html>