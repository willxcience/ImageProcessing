<?php
session_start();
if(!isset($_SESSION['user_id'])){
   header("location:login.php");
   die;
}
else if(!isset($_SESSION['admin'])){
   header("location:/");
   die;
}
?>






<html>
<!-- What is this line for? -->
<!-- ?php include 'upload.php';? -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
</style>

<body class="w3-light-grey">

<!-- Page Container -->
<div class="w3-content w3-margin-top" style="max-width:1500px;">

  <!-- The Grid -->
  <div class="w3-row-padding">
  
    <!-- Left Column -->
    <div class="w3-third">
    
      <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container">
          <img src="http://www.taylornoakes.com/wp-content/galleries/2011/12/Deer-In-Forest-Animal-Wallpaper.jpg" style="width:100%" alt="Avatar">
          <div class="w3-display-bottomleft w3-container w3-text-black">
            <font size="6" color="white">Image Processing for Animals</font>
          </div>
        </div>
        <div class="w3-container">
<br>







<form action="index.php" class="form-horizontal">
<fieldset>


<!-- Button -->
<div class="form-group" align="center">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-success">Home</button>
  </div>
</div>
</fieldset>
</form>



<form action="logout.php" class="form-horizontal">
<fieldset>


<!-- Button -->
<div class="form-group" align="center">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-success">Logout</button>
  </div>
</div>
</fieldset>
</form>



<form action="change_password.php" class="form-horizontal">
<fieldset>


<!-- Button -->
<div class="form-group" align="center">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-success">Change Password</button>
  </div>
</div>

</fieldset>
</form>


<form action="add_admin.php" class="form-horizontal">
<fieldset>


<!-- Button -->
<div class="form-group" align="center">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-success">Add Admin</button>
  </div>
</div>

</fieldset>
</form>

          
          
        
        </div>
      </div><br>

    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">
    
      <div class="w3-container w3-card-2 w3-white w3-margin-bottom">
        
        <div class="w3-container">







<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<br>
<br>

<body>




<!-- Upload a Folder -->
<form class="form-horizontal" name = "myForm" action="upload.php"  method="post" enctype="multipart/form-data" id="hell">
<fieldset>

<!-- Form Name -->
<legend>Upload All Files Under A Directory</legend>

<!-- Select a folder -->
<div class="form-group">
  <label class="col-md-4 control-label" for="foldername">Create a new project name</label>
  <div class="col-md-4">
    <input type='text' name='foldername' placeholder="unique project name">
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <button id="submit" name="submit_check" class="btn">Check this name!</button>
  </div>
</div>

<!-- new porject name -->
<div class="form-group">
  <label class="col-md-4 control-label" for="foldername">Create a new location</label>
  <div class="col-md-4">
    <input type='text' name='locaname'>
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
  <div class="col-md-4" id="hell2">
    <button id="submit" name="submit" class="btn btn-primary">submit</button>
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
<form action="clean2.php" class="form-horizontal"  method="post" onSubmit="return check()">
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


</div>

<!--End Right Column -->
    </div>

  <!-- End Grid -->
  </div>

  <!-- End Page Container -->
</div>

<footer class="w3-container w3-teal w3-center w3-margin-top">
  <p>Welcome!</p>

  <p>Brought to you by the ECS193 crew</p>
</footer>



</body>

<script type="text/javascript">

</script>

</html>
