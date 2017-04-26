<?php

/*** begin our session ***/
session_start();

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