<head>
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


</body>
</html>