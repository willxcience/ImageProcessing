<?php
/*** begin our session ***/
session_start();

/*** first check that all of the fields and form token have been sent ***/
if(!isset( $_POST['phpro_password'], $_POST['phpro_new_password'], $_POST['phpro_new_password_retype'], $_POST['form_token']))
{
    $message = 'Please enter a valid username and password';
}
/*** check the form token is valid ***/
elseif( $_POST['form_token'] != $_SESSION['form_token'])
{
    $message = 'Invalid form submission';
}
/*** check the password is the correct length ***/
elseif (strlen( $_POST['phpro_new_password']) > 20 || strlen($_POST['phpro_password']) < 4)
{
    $message = 'Incorrect Length for Password';
}
/*** check the password has only alpha numeric characters ***/
elseif (ctype_alnum($_POST['phpro_password']) != true)
{
        /*** if there is no match ***/
        $message = "Password must be alpha numeric";
}
elseif($_POST['phpro_new_password'] != $_POST['phpro_new_password_retype']){
	$message = "Passwords do not match";
}
else
{
    /*** if we are here the data is valid and we can insert it into database ***/
    $phpro_password = filter_var($_POST['phpro_password'], FILTER_SANITIZE_STRING);
    $phpro_new_password = filter_var($_POST['phpro_new_password'], FILTER_SANITIZE_STRING);
	$phpro_new_password_retype = filter_var($_POST['phpro_new_password_retype'], FILTER_SANITIZE_STRING);


    /*** now we can encrypt the password ***/
    $phpro_new_password = sha1( $phpro_new_password );
    
    /*** connect to database ***/
    /*** mysql hostname ***/
    $mysql_hostname = 'localhost';

    /*** mysql username ***/
    $mysql_username = 'mysql_username';

    /*** mysql password ***/
    $mysql_password = 'mysql_password';

    /*** database name ***/
    $mysql_dbname = 'animal';

    try
    {
		// First, verify that the password is correct
		$dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        /*** $message = a message saying we have connected ***/

        /*** set the error mode to excptions ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** prepare the select statement ***/
        $stmt = $dbh->prepare("SELECT phpro_user_id, phpro_username, phpro_password FROM phpro_users 
                    WHERE phpro_user_id = :phpro_user_id AND phpro_password = :phpro_password");

        /*** bind the parameters ***/
        $stmt->bindParam(':phpro_password', $phpro_password, PDO::PARAM_STR);
		$stmt->bindParam(':phpro_user_id', $_SESSION['user_id'], PDO::PARAM_STR);

        /*** execute the prepared statement ***/
        $stmt->execute();

        /*** check for a result ***/
        $user_id = $stmt->fetchColumn();

        /*** if we have no result then fail boat ***/
        if($user_id == false)
        {
                $message = 'Error: Incorrect Password';
        }
			
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        /*** $message = a message saying we have connected ***/

        /*** set the error mode to excptions ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** prepare the insert ***/
        $stmt = $dbh->prepare("UPDATE phpro_users SET phpro_password=:phpro_new_password WHERE phpro_user_id = :phpro_user_id");

        /*** bind the parameters ***/
        $stmt->bindParam(':phpro_new_password', $phpro_new_password, PDO::PARAM_STR);
        $stmt->bindParam(':phpro_user_id', $_SESSION['user_id'], PDO::PARAM_STR, 40);

        /*** execute the prepared statement ***/
        $stmt->execute();

        /*** unset the form token session variable ***/
        unset( $_SESSION['form_token'] );

	/* Redirect browser */
	header("Location: /");
 
	/* Make sure that code below does not get executed when we redirect. */
	exit;
    }
    catch(Exception $e)
    {
        /*** check if the username already exists ***/
        if( $e->getCode() == 23000)
        {
            $message = 'Username already exists';
        }
        else
        {
            /*** if we are here, something has gone wrong with the database ***/
            $message = $e->getMessage();
        }
    }
}
?>

<html>
<head>
<title>PHPRO Login</title>
</head>
<body>
<p><?php echo $message; ?>
</body>
</html>