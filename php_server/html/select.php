<?php
session_start();
if(!isset($_SESSION['user_id'])){
   header("location:login.php");
   die;
}
else if(isset($_SESSION['admin'])){
   header("location:admin.php");
   die;
}
									
?>
<html>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<h1>Image Processing for Animals</h1>

<br>
<br>

<body>

<form action="logout.php" class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Logout</legend>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-success">Logout</button>
  </div>
</div>
</fieldset>
</form>

<form action="change_password.php" class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Change Password</legend>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-success">Change Password</button>
  </div>
</div>

</fieldset>
</form>


</body>
</html>
