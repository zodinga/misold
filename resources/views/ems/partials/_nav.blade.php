<?php 
use App\Course; 
use App\Employee;
use App\Emp_leave;
use App\Emp_outpass;
$eid = Auth::user()->id;

$test=Employee::where('eid', '=', $eid)->count('id');
$employee=Employee::where('eid', '=', $eid )->pluck('id');
$noti=Emp_leave::where('status', '=', 'Pending')->count('status');

$notis=Emp_outpass::where('status', '=', 'Pending')->count('status');


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
          <li class="{{ Request::is('ems/dashboard')?"active":"" }}"><a href="{{route('ems.dashboard')}}">EMS Dashboard</a></li> 
          <li class="{{ Request::is('employees')?"active":"" }}"><a href="{{route('ems.employees.index')}}">Employees</a></li>

          <li class="dropdown">
               <?php if(Auth::user()->hasRole('Admin') != 'Admin') {
                      $type = "caret";
                      $style = "";
                      $count = "";
                    }
                    elseif($noti==0){
                      $type = "caret";
                      $style = "";
                      $count = "";
                    }
                    else
                    {
                      $type = "badge";
                      $style = "background-color: red;";
                      $count = $noti;
                    }
                ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Leave <span class="{{$type}}" style="{{$style}}">{{$count}}</span></a>
              <ul class="dropdown-menu">
<?php if($test == 0){?>
  <li class="{{ Request::is('results')?"active":"" }}"><a href="{{route('ems.employees.create')}}">Enter details of employee</a></li>
<?php }
else{ ?>
               <li class="{{ Request::is('results')?"active":"" }}"><a href="{{route('ems.leave.show', $employee->all())}}">Application</a></li>
              
                  <?php if(Auth::user()->hasRole('Admin') == 'Admin') {?>
                    <li class="{{ Request::is('results')?"active":"" }}"><a href="{{route('ems.leave.pending', $employee->all())}}">Pending [<?php echo $noti; ?>]</a></li>
                  <?php } ?>
                     <li class="{{ Request::is('results')?"active":"" }}"><a href="{{route('ems.leave.view', $employee->all())}}">Status</a></li>

 <?php } ?>             




               
          </ul>
          </li>


          <li class="dropdown">
               <?php if(Auth::user()->hasRole('Admin') != 'Admin') {
                      $type = "caret";
                      $style = "";
                      $count = "";
                    }
                    elseif($notis==0){
                      $type = "caret";
                      $style = "";
                      $count = "";
                    }
                    else
                    {
                      $type = "badge";
                      $style = "background-color: red;";
                      $count = $notis;
                    }
                ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Outpass <span class="{{$type}}" style="{{$style}}">{{$count}}</span></a>
              <ul class="dropdown-menu">
<?php if($test == 0){?>
  <li class="{{ Request::is('results')?"active":"" }}"><a href="{{route('ems.employees.create')}}">Enter details of employee</a></li>
<?php }
else{ ?>
               <li class="{{ Request::is('results')?"active":"" }}"><a href="{{route('ems.outpass.show', $employee->all())}}">Application</a></li>
               
                  <?php if(Auth::user()->hasRole('Admin') == 'Admin') {?>
                    <li class="{{ Request::is('results')?"active":"" }}"><a href="{{route('ems.outpass.pending', $employee->all())}}">Pending [<?php echo $notis; ?>]</a></li>
                  <?php } ?>
                     <li class="{{ Request::is('results')?"active":"" }}"><a href="{{route('ems.outpass.view', $employee->all())}}">Status</a></li>

 <?php } ?>             




               
          </ul>
          </li>


          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reports <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="">Employee</a></li>
                <li><a href="">Leave</a></li>
                <li><a href="">Outpass</a></li>
 
              </ul>
          </li>
          
          
      @else
        <li class="{{ Request::is('/')?"active":"" }}"><a href="/">Home</a></li>
      @endif
        
      @if(Auth::check()==false)
       
      </li>
      @endif
      </ul>
      



      <ul class="nav navbar-nav navbar-right">
        <li class="{{ Request::is('contact')?"active":"" }}"><a href="/contact">Contact</a></li>
        <li class="{{ Request::is('about')?"active":"" }}"><a href="/about">About</a></li>
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