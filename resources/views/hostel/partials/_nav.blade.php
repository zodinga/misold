<?php 
use App\Course; 
$courses=Course::pluck('name','id');
?>

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
          <li class="{{ Request::is('hostel/dashboard')?"active":"" }}"><a href="{{route('hostel.dashboard')}}">Hostel Dashboard</a></li>
          <li class="{{ Request::is('projects')?"active":"" }}"><a href="">Room</a></li>
          <li class="{{ Request::is('funds')?"active":"" }}"><a href="">Mess Fee</a></li>

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reports <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="">Room</a></li>
                <li><a href="">Mess Fee</a></li>
              </ul>
          </li>
          
         

      @else
        <li class="{{ Request::is('/')?"active":"" }}"><a href="/">Home</a></li>
      @endif
        
      @if(Auth::check()==false)
       
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