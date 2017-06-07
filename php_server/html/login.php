<?php

/*** begin our session ***/
session_start();

if(isset( $_SESSION['login_error'] ))
{
	if($_SESSION['login_error'] == 1){
		echo "User is already logged in";
		unset($_SESSION['login_error']);
	}
	else if($_SESSION['login_error'] == 2)
		echo "Please enter a valid username and password";
	else if($_SESSION['login_error'] == 3)
		echo "Incorrect Length for Username";
	else if($_SESSION['login_error'] == 4)
		echo "Incorrect Length for Password";
	else if($_SESSION['login_error'] == 5)
		echo "Username must be alpha numeric";
	else if($_SESSION['login_error'] == 6)
		echo "Password must be alpha numeric";
	else if($_SESSION['login_error'] == 7)
		echo "Login Failed";
	else
		echo "Unspecified error";
	
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

      </div><br>

    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">
    
      <div class="w3-container w3-card-2 w3-white w3-margin-bottom">
        
        <div class="w3-container">

	</div>
      </div>


	<title>Animal Processing Login</title>
</head>

<body>
<h2>Login</h2>
<form action="login_submit.php" method="post">
<fieldset>
<p>
<label for="phpro_username">Username</label>
<input type="text" id="phpro_username" name="phpro_username" value="" maxlength="20" />
</p>
<p>
<label for="phpro_password">Password</label>
<input type="password" id="phpro_password" name="phpro_password" value="" maxlength="20" />
</p>
<p>
<input type="submit" value="→ Login" />
</p>
</fieldset>
</form>

<form action="create_account.php" class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Create Account</legend>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-success">Create Account</button>
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
