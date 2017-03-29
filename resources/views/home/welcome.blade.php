@extends('main')
@section('title','| Homepage')
@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="jumbotron">
      <h2>Welcome to NIELIT MIS!</h2>
         <img src="<?= asset('img/poster.jpg')?>" height="50%" width="100%" alt="logo">
    </div>
  </div>
  <div class="col-md-6">
    <div class="jumbotron">
      <p class="lead">
      <p>The thrust area of NIELIT, Aizawl is Information, Electronics and Information Technology (IECT)</p>
      <p>Objectives</p>
      <ul>
        <li>Disseminate knowledge on all aspects of IT and Electronics.</li>
        <li>Provide Quality Education and Training to prepare individuals for technology driven business environment effectively.</li>
        <li>Provide quality education to participants for upgrading their technical skills in an environment that is conducive to learning by providing good infrastructure.</li>
        <li>Provide continuing support to learners and trainers through design and development of innovative curricula for meeting the dynamically changing IECT scenarios.</li>
        <li>To impart continuing education for upgradation of knowledge and skills in view of high obsolesce in the area of IECT. </li>
      </ul>
      </p>
    </div>
  </div>
</div>
      


 @stop
