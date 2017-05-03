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
<title>Change Password</title>
</head>

<body>
<h2>Change Password</h2>
<form action="change_password_submit.php" method="post">
<fieldset>
<p>
<label for="phpro_password">Current Password</label>
<input type="password" id="phpro_password" name="phpro_password" value="" maxlength="20" />
</p>
<p>
<label for="phpro_new_password">New Password</label>
<input type="password" id="phpro_new_password" name="phpro_new_password" value="" maxlength="20" />
</p>
<p>
<label for="phpro_new_password_retype">Retype New Password</label>
<input type="password" id="phpro_new_password_retype" name="phpro_new_password_retype" value="" maxlength="20" />
</p>
<p>
<input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
<input type="submit" value="&rarr; Submit New Password" />
</p>
</fieldset>
</form>
</body>
</html>