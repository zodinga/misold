<!--default bootstrap navbar-->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">NIELIT MIS</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
          @if(Auth::check())
              <li class="{{ Request::is('dashboard')?"active":"" }}"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
              <li class="{{ Request::is('sms/dashboard')?"active":"" }}"><a href="{{route('sms.dashboard')}}">SMS</a></li>
              <li class="{{ Request::is('reception/dashboard')?"active":"" }}"><a href="{{route('reception.dashboard')}}">Reception</a></li>
              <li class="{{ Request::is('ems/dashboard')?"active":"" }}"><a href="{{route('ems.dashboard')}}">EMS</a></li>
              <li class="{{ Request::is('registrations')?"active":"" }}"><a href="{{route('systems.dashboard')}}">Systems</a></li>
              <li class="{{ Request::is('internals')?"active":"" }}"><a href="{{route('account.dashboard')}}">Accounts</a></li>
              <li class="{{ Request::is('results')?"active":"" }}"><a href="{{route('inventory.dashboard')}}">Inventory</a></li>
              <li class="{{ Request::is('results')?"active":"" }}"><a href="{{route('hostel.dashboard')}}">Hostel</a></li>
              <li class="{{ Request::is('users')?"active":"" }}"><a href="{{route('users.index')}}">Users</a></li>

          @else
            <li class="{{ Request::is('/')?"active":"" }}"><a href="/">Home</a></li>
         @endif
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="{{ Request::is('contact')?"active":"" }}"><a href="{{route('contact')}}">Contact</a></li>
        <li class="{{ Request::is('about')?"active":"" }}"><a href="{{route('about')}}">About</a></li>
      @if(Auth::check())
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello {{Auth::user()->name}}<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li role="separator" class="divider"></li>
            <li><a href="{{route('logout')}}">Logout</a></li>
          </ul>
        </li>

        @else
          <ul class="nav navbar-nav">
            <li class=""><a href="{{route('login')}}">Login</a></li>
            <!--Register link here-->
          </ul>
         <!--<a href="{{route('login')}}" class="btn btn-default ">Login</a>-->
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>