<?php
session_start();
if(!isset($_SESSION['user_id'])){
   header("location:login.php");
   die;
}
    /*** mysql hostname ***/
    $mysql_hostname = 'localhost';

    /*** mysql username ***/
    $mysql_username = 'mysql_username';

    /*** mysql password ***/
    $mysql_password = 'mysql_password';

    /*** database name ***/
    $mysql_dbname = 'phpro_auth';
	$id = $_SESSION['user_id'];
	$dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$stmt = $dbh->prepare("SELECT phpro_user_id FROM admins WHERE phpro_user_id = :id");
	$stmt->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_STR);
	$stmt->execute();
	$user_id = $stmt->fetchColumn();
									
/*	if($user_id == true){
		echo "ADMIN";
	}
	else{
		echo "Standard";
	}
*/
?>
<html>

<img src="IMAGEDATA/test/MDGC0015.JPG" alt="Mountain View" style="width:304px;height:228px;">

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




<!-- ADMIN CONTROLS -->
<?php if($user_id == true) : ?>


<!-- Upload a Folder -->
<form class="form-horizontal" name = "myForm" action="upload.php"  method="post" enctype="multipart/form-data">
<fieldset>

<!-- Form Name -->
<legend>Upload All Files Under A Directory</legend>

<!-- Select a folder -->
<div class="form-group">
  <label class="col-md-4 control-label" for="foldername">Create a new name</label>
  <div class="col-md-4">
    <input type='text' name='foldername'>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <button id="submit" name="submit_check" class="btn">Check this name!</button>
  </div>
</div>

<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="files">Select A Directory</label>
  <div class="col-md-4">
    <input type="file" name="files[]" id="files" multiple="" directory="" webkitdirectory="" mozdirectory="">
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <button id="submit" name="submit" class="btn btn-primary">submit</button>
  </div>
</div>

</fieldset>
</form>





<!-- Download a project -->
<form action="download.php" class="form-horizontal">
<fieldset>

<!-- Select a folder -->
<div class="form-group">
  <label class="col-md-4 control-label" for="foldername">Input the folder name</label>
  <div class="col-md-4">
    <input type='text' name='foldername'>
  </div>
</div>


<!-- Form Name -->
<legend>Download All Images</legend>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-success">Download </button>
  </div>
</div>

</fieldset>
</form>




<!-- Clean a folder -->
<form action="clean.php" class="form-horizontal"  method="post" onSubmit="return check()">
<fieldset>


<!-- Select a folder -->
<div class="form-group">
  <label class="col-md-4 control-label" for="foldername">Clean this folder</label>
  <div class="col-md-4">
    <input type='text' name='foldername'>
  </div>
</div>


<!-- Form Name -->
<legend>Clean The Database</legend>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <script>
    function check()
    {
        if (confirm("Warning! Data will be deleted!"))
          return true;
        else
          return false;
    }
    </script>
    <button id="singlebutton" name="singlebutton" class="btn btn-danger">Clean</button>
  </div>
</div>

</fieldset>
</form>




<!-- Processing Images -->
<form action="process.php" class="form-horizontal" method="post">
<fieldset>

<!-- Form Name -->
<legend>Process</legend>


<!-- Select a folder -->
<div class="form-group">
  <label class="col-md-4 control-label" for="foldername">Input the folder name</label>
  <div class="col-md-4">
    <input type='text' name='foldername'>
  </div>
</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-success">Process</button>
  </div>
</div>

</fieldset>
</form>

<?php endif; ?>

</body>
</html>
