<?php

/*** begin our session ***/
session_start();
if(!isset($_SESSION['user_id'])){
   header("location:login.php");
   die;
}
else if(!isset($_SESSION['admin'])){
   header("location:/");
   die;
}

/*** set a form token ***/
$form_token = md5( uniqid('auth', true) );

/*** set the session form token ***/
$_SESSION['form_token'] = $form_token;
?>

<html>
<head>
<title>Add a New Admin</title>
</head>

<body>
<h2>Add a New Admin</h2>
<form action="add_admin_submit.php" method="post">
<fieldset>
<p>
<label for="phpro_admin_username">Username of New Admin</label>
<input type="text" id="phpro_admin_username" name="phpro_admin_username" value="" maxlength="20" />
</p>
<p>
<label for="phpro_password">Your Password</label>
<input type="password" id="phpro_password" name="phpro_password" value="" maxlength="20" />
</p>
<p>
<label for="phpro_password_retype">Retype Password</label>
<input type="password" id="phpro_password_retype" name="phpro_password_retype" value="" maxlength="20" />
</p>
<p>
<input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
<input type="submit" value="&rarr; Submit" />
</p>
</fieldset>
</form>
</body>
</html>