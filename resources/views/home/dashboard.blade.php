@extends('main')
@section('title','| Dashboard')
@section('stylesheet')

@stop
@section('content')
<hr>
<div class="row">
   <div class="col-sm-6 col-md-3">
    <a href="{{route('sms.dashboard')}}" class="btn btn-primary btn-lg btn-block" role="button">
    <div class="thumbnail">
      <img src="images/students.png" alt="..." height="auto" width="100%">
      <div class="caption">
        <h3>SMS <span class="badge"></span></h3>
        <p></p>
        
      </div>
    </div>
    </a>
  </div>
  <div class="col-sm-6 col-md-3">
    <a href="{{route('systems.dashboard')}}" class="btn btn-primary btn-lg btn-block" role="button">
    <div class="thumbnail">
      <img src="images/systems.png" alt="..." height="auto" width="100%">
      <div class="caption">
        <h3>Systems <span class="badge"></span></h3>
        <p></p>
      </div>
    </div>
  </a>
  </div>
  <div class="col-sm-6 col-md-3">
    <a href="{{route('account.dashboard')}}" class="btn btn-primary btn-lg btn-block" role="button">
    <div class="thumbnail">
      <img src="images/accounts.jpg" alt="..." height="auto" width="100%">
      <div class="caption">
        <h3>Accounts <span class="badge"></span></h3>
        <p></p>
      </div>
    </div>
  </a>
  </div>
  <div class="col-sm-6 col-md-3">
    <a href="{{route('inventory.dashboard')}}" class="btn btn-primary btn-lg btn-block" role="button">
    <div class="thumbnail">
      <img src="images/inventory.png" alt="..." height="auto" width="100%">
      <div class="caption">
        <h3>Inventory <span class="badge"></span></h3>
        <p></p>
      </div>
    </div>
  </a>
  </div>
</div>     
<hr>
<div class="row">
   <div class="col-sm-6 col-md-3">
    <a href="{{route('reception.dashboard')}}" class="btn btn-primary btn-lg btn-block" role="button">
    <div class="thumbnail">
      <img src="images/reception.jpg" alt="..." height="50%" width="100%">
      <div class="caption">
        <h3>Reception <span class="badge"></span></h3>
        <p></p>
        
      </div>
    </div>
    </a>
  </div>

   <div class="col-sm-6 col-md-3">
    <a href="{{route('ems.dashboard')}}" class="btn btn-primary btn-lg btn-block" role="button">
    <div class="thumbnail">
      <img src="images/ems.png" alt="..." height="auto" width="100%">
      <div class="caption">
        <h3>EMS <span class="badge"></span></h3>
        <p></p>
        
      </div>
    </div>
    </a>
    </div>
 

   <div class="col-sm-6 col-md-3">
    <a href="{{route('users.index')}}" class="btn btn-primary btn-lg btn-block" role="button">
    <div class="thumbnail">
      <img src="images/users.png" alt="..." height="auto" width="100%">
      <div class="caption">
        <h3>Users <span class="badge"></span></h3>
        <p></p>
        
      </div>
    </div>
    </a>
  </div>
  <div class="col-sm-6 col-md-3">
    <a href="{{route('hostel.dashboard')}}" class="btn btn-primary btn-lg btn-block" role="button">
    <div class="thumbnail">
      <img src="images/hostel.jpg" alt="..." height="auto" width="100%">
      <div class="caption">
        <h3>Hostel <span class="badge"></span></h3>
        <p></p>
      </div>
    </div>
  </a>
  </div>
</div>
@stop