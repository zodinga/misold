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
          <li class="{{ Request::is('sms/dashboard')?"active":"" }}"><a href="{{route('sms.dashboard')}}">SMS Dashboard</a></li>
          <li class="{{ Request::is('students')?"active":"" }}"><a href="{{route('sms.students.index')}} ">Students</a></li>
          <li class="{{ Request::is('registrations')?"active":"" }}"><a href="{{route('sms.registrations.index')}} ">Register</a></li>
          <li class="{{ Request::is('internals')?"active":"" }}"><a href="{{route('sms.internals.index')}}">Internal</a></li>
          <li class="{{ Request::is('attendances')?"active":"" }}"><a href="{{route('sms.attendances.index')}}">Attendance</a></li>
          <li class="{{ Request::is('results')?"active":"" }}"><a href="{{route('sms.results.index')}}">Result</a></li>


          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reports <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{route('sms.reports.student')}}">Student</a></li>
                <li><a href="{{route('sms.reports.subplan')}}">Sub Plan</a></li>
                <li><a href="{{route('sms.reports.registration')}}">Registration</a></li>
                <li><a href="{{route('sms.reports.internal')}}">Internal</a></li>
                <li><a href="{{route('sms.reports.result')}}">Result</a></li>
              </ul>
          </li>
          
         
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{route('sms.categories.index')}}">Category</a></li>
                <li><a href="{{route('sms.courses.index')}}">Course</a></li>
                <li><a href="{{route('sms.communities.index')}}">Community</a></li>
                <li><a href="{{route('sms.statuses.index')}}">Status</a></li>
                <li><a href="{{route('sms.subjects.index')}}">Subject</a></li>
              </ul>
          </li>
      @else
        <li class="{{ Request::is('/')?"active":"" }}"><a href="/">Home</a></li>
      @endif
        
      @if(Auth::check()==false)
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Students <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/public/1">Current</a></li>
            <li><a href="/public/2">Completed</a></li>
            <li><a href="/public/3">Dropout</a></li>
            <li><a href="/public/0">All</a></li>
          </ul>
      </li>
      <li>
      
      

        {!!Form::open(['route'=>'public.search','method'=>'get','class'=>'navbar-form navbar-right '])!!}
            <div class="form-group">
              <input type="text" id="name" name="name" class="form-control form-top input-sm" placeholder="Search by Name">
            {{Form::select('course_id', $courses ,null,['class'=>'form-control form-top input-sm','placeholder' => 'Pick a course...'])}}
              <input type="text" id="year" name="year" class="form-control form-top input-sm" placeholder="Year" style = "width:50px;">
            </div>
            <button type="submit" class="btn btn-default form-top input-sm" style="padding-top: 4px;">Search</button>
      {!!Form::close()!!}
      </li>
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