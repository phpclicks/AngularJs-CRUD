<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<!-- Latest compiled and minified JavaScript -->

<!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
--> <!-- LOAD JQUERY -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <!-- LOAD ANGULAR -->
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.0/angular.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <!-- PROCESS FORM WITH AJAX (NEW) -->
  <script src="angular_crud.js" type="text/javascript"></script>
</head>

<!-- apply the module and controller to our body so angular is applied to that -->
<body ng-app="formApp" ng-controller="mainController" >
<div class="col-md-10"><a href="javascript:void(0)" ng-click="addFormToggle()" id="addStudentForm">Add</a></div>

<br /><br />
<!--<a href="javascript:void(0)" id="editStudentForm">Edit</a>-->
<div id="messages" class="alert-success" style="height:30px" ng-show="message">{{ message }}</div>

<div class="col-md-6"  ng-hide="addformtoggle">



<form ng-submit="processForm()" method="post">

  <div id="name-group" class="form-group" ng-class="{ 'has-error' : errorFirstName }"> 
    <label>First Name</label> 
    <input type="text" name="first_name" class="form-control" placeholder="First Name" ng-model="formData.first_name"> 
    <span class="help-block" ng-show="errorFirstName">{{ errorFirstName }}</span> 
  </div>


  <div id="superhero-group" class="form-group" ng-class="{ 'has-error' : errorLastName }"> 
      <label>Last Name</label> 
      <input type="text" name="last_name" class="form-control" ng-model="formData.last_name" placeholder="Last Name"> 
      <span class="help-block" ng-show="errorLastName">{{ errorLastName }}</span> 
  </div>
  
    <div id="superhero-group" class="form-group" ng-class="{ 'has-error' : errorEmail }"> 
      <label>Email</label> 
      <input type="text" name="email" class="form-control" ng-model="formData.email" placeholder="Email"> 
      <span class="help-block" ng-show="errorEmail">{{ errorEmail }}</span> 
  </div>

 
  <button type="submit" class="btn btn-success btn-lg btn-block">
      <span class="glyphicon glyphicon-flash"></span> Submit!
  </button>
</form>
<!-- SHOW DATA FROM INPUTS AS THEY ARE BEING TYPED -->
<pre>
    {{ formData }}
</pre>

</div>

<div class="col-md-6" id="hideshowformEdit" ng-hide="eidtformtoggle">

<form ng-submit="processEditForm()" method="post">
<input type="hidden" name="student_id" ng-model="student_id" />
<!-- NAME --> 
  <div id="name-group" class="form-group" ng-class="{ 'has-error' : errorFirstName }"> 
    <label>First Name</label> 
    <input type="text" name="first_name"  class="form-control"  placeholder="First Name" ng-model="first_name"> 
    <span class="help-block" ng-show="errorFirstName">{{ errorFirstName }}</span> 
  </div>

  <!-- SUPERHERO NAME -->
  <div id="superhero-group" class="form-group" ng-class="{ 'has-error' : errorLastName }"> 
      <label>Last Name</label> 
      <input type="text" name="last_name" class="form-control" ng-model="last_name" placeholder="Last Name"> 
      <span class="help-block" ng-show="errorLastName">{{ errorLastName }}</span> 
  </div>
  
    <div id="superhero-group" class="form-group" ng-class="{ 'has-error' : errorEmail }"> 
      <label>Email</label> 
      <input type="text" name="email" class="form-control" ng-model="email" placeholder="Email"> 
      <span class="help-block" ng-show="errorEmail">{{ errorEmail }}</span> 
  </div>

  <!-- SUBMIT BUTTON -->
  <button type="submit" class="btn btn-success btn-lg btn-block">
      <span class="glyphicon glyphicon-flash"></span> Update!
  </button>
</form>
<!-- SHOW DATA FROM INPUTS AS THEY ARE BEING TYPED -->
<pre>
    {{ formData }}
</pre>

</div>



<div class="col-md-10">
<div class="table-responsive" >
<div style="color:#F00" ng-show="successmessage">{{ successmessage }}</div>
<table class="table table-bordered">
<thead>
<tr>
<th>First Name</th>
<th>Last Name</th>
<th>Email</th>
<th>Username</th>
<th>Action</th>
</tr>
</thead>

<tbody ng-init="GetStudents()">


<tr ng-repeat="student in students">
<td>{{student.first_name}}</td>
<td>{{student.last_name}}</td>
<td>{{student.email}}</td>
<td>{{student.user_name}}</td> 
<td><a class="btn" href="javascript:void(0)" ng-click="editStudent(student.student_id)"><i class="icon-pencil"></i> Edit</a> | <a class="btn" ng-click="deleteStudent(student.student_id)" href="javascript:void(0)">Delete</a></td>
</tr>

</tbody>

</table>
</div>
</div>



</body>
</html>
