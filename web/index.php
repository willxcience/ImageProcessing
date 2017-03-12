<html>
<head>
</head>
<body>
<h1>Animal Images Process </h1>

<!--
<form action="search.php" method="post">
Pls enter ur key:
<input type="text" name="key"><br>
<input type="submit">
</form>
-->

<!--
<form action="upload.php" method="post" enctype="multipart/form-data">
<table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
<tr> 
<td width="246">
<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
<input name="userfile" type="file" id="userfile"> 
</td>
<td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Upload "></td>
</tr>
</table>
</form>
-->


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- original upload file
<form action="upload2.php" method="post" enctype="multipart/form-data">
     Upload Files :
    <input type="file" name="files[]" id="files" multiple="" directory="" webkitdirectory="" mozdirectory="">
    <input class="button" type="submit" value="Upload" />
</form>
-->


<form class="form-horizontal" action="upload2.php"  method="post" enctype="multipart/form-data">
<fieldset>

<!-- Form Name -->
<legend>Upload All Files Under A Directory</legend>

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




<form action="download2.php" class="form-horizontal">
<fieldset>

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





<form action="clean.php" class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Clean The Database</legend>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-danger">Clean</button>
  </div>
</div>

</fieldset>
</form>


<form action="process.php" class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Process</legend>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-success">Process</button>
  </div>
</div>

</fieldset>
</form>


<form action="test.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

<!--
<?php
echo '<a href="download2.php">Download All Images</br>';
echo '<a href="clean.php">Clean the database</br>';
?>
-->
</body>
</html>
