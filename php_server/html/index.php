<?php
session_start();
if(!isset($_SESSION['user_id'])){
   header("location:login.php");
   die;
}									
?>

<html>
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







<form action="admin.php" class="form-horizontal">

<!-- Button -->
<div class="form-group" align="center">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-success">Start New Project</button>
  </div>
</div>
</form>



<form action="view3.php" class="form-horizontal">


<!-- Button -->
<div class="form-group" align="center">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-success">Animal Labelling</button>
  </div>
</div>


</form>


<form action="im_manage.php" class="form-horizontal">


<!-- Button -->
<div class="form-group" align="center">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-success">Image Manage</button>
  </div>
</div>


</form>


	</div>
      </div><br>


    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">

      <div class="w3-container w3-card-2 w3-white w3-margin-bottom">

        <div class="w3-container">

<p> Welcome to the Image Processing for Animals Project!
<br><br>
This application is the product of a project dedicated to assisting the Quail Ridge Reserve, located at the southern end of Lake Berryessa in Napa, California.
<br><br>
The team behind this project includes four students attending the University of California, Davis, as part of their senior design project. The purpose of the project is to use all of the skills learned from years of taking classes to create something to serve the community.
<br><br>
In order to navigate this website, please start by selecting one of the options to the left:
<br><br>
<b>Start New Project</b> will allow you to upload images to the database and process them to allow the AI to find animals and add labels to them. Additionally, you can manage images you've already uploaded to the database.
<br>
<b>Animal Labelling</b> will take you to an interface to manually add animal labels to photos that you have uploaded to the database.
<br>
<b>Image Manage</b> will allow you to manipulate certain aspects of the images you choose, such as the location within their directories or the labels attached to them.
</p>

        </div>
      </div>




    <!-- End Right Column -->
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
</html>
