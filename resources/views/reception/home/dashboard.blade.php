@extends('reception.main')
@section('title','| Dashboard')
@section('stylesheet')
  {!! Html::style('css/dashboard.css') !!}
  {!! Html::style('css/circle.css') !!}
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
          <h1 class="page-header">Dashboard</h1>

           </div>
    </div>  
    <div class="col-md-6">
          <h2 class="sub-header text-center">Prospectus Sold</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Year</th>
                  <th>MCA</th>
                  <th>BCA</th>
                  <th>DCSE</th>
                  <th>DETE</th>
                  <th>Others</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
              @foreach($prospectus as $prospect)
                <tr>
                  <td>{{$prospect[0]}}</td>
                  <td>{{$prospect[1]}}</td>
                  <td>{{$prospect[2]}}</td>
                  <td>{{$prospect[3]}}</td>
                  <td>{{$prospect[4]}}</td>
                  <td>{{$prospect[5]}}</td>
                  <td>{{$prospect[6]}}</td>
                </tr>
                
              @endforeach
              
              </tbody>
            </table>
          </div>
          
</div>
</div>
          
@stop