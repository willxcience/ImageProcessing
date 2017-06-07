<?php

/*** begin our session ***/
session_start();

if(isset( $_SESSION['create_account_error'] ))
{
	if($_SESSION['create_account_error'] == 2)
		echo "Please enter a valid username and password";
	else if($_SESSION['create_account_error'] == 3)
		echo "Invalid form submission";
	else if($_SESSION['create_account_error'] == 4)
		echo "Incorrect Length for Username";
	else if($_SESSION['create_account_error'] == 5)
		echo "Incorrect Length for Password";
	else if($_SESSION['create_account_error'] == 6)
		echo "Username must be alpha numeric";
	else if($_SESSION['create_account_error'] == 7)
		echo "Password must be alpha numeric";
	else if($_SESSION['create_account_error'] == 8)
		echo "Passwords do not match";	
	else
		echo "Unspecified error";
	
}

/*** set a form token ***/
$form_token = md5( uniqid('auth', true) );

/*** set the session form token ***/
$_SESSION['form_token'] = $form_token;
?>

<html>
<head>
<title>Create Account</title>
</head>

<body>
<h2>Add user</h2>
<form action="create_account_submit.php" method="post">
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
<label for="phpro_password">Retype Password</label>
<input type="password" id="phpro_password_retype" name="phpro_password_retype" value="" maxlength="20" />
</p>
<p>
<input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
<input type="submit" value="&rarr; Create Account" />
</p>
</fieldset>
</form>
</body>
</html>