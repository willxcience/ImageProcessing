<?php

/*** begin our session ***/
session_start();

/*** check if the users is already logged in ***/
if(isset( $_SESSION['user_id'] ))
{
	header("location:index.php");
	die;
}
/*** check that both the username, password have been submitted ***/
if(!isset( $_POST['phpro_username'], $_POST['phpro_password']))
{
	$_SESSION['login_error'] = 2;
	header("location:login.php");
	die;
}
/*** check the username is the correct length ***/
elseif (strlen( $_POST['phpro_username']) > 20 || strlen($_POST['phpro_username']) < 4)
{
	$_SESSION['login_error'] = 3;
	header("location:login.php");
	die;
}
/*** check the password is the correct length ***/
elseif (strlen( $_POST['phpro_password']) > 20 || strlen($_POST['phpro_password']) < 4)
{
	$_SESSION['login_error'] = 4;
	header("location:login.php");
	die;
}
/*** check the username has only alpha numeric characters ***/
elseif (ctype_alnum($_POST['phpro_username']) != true)
{
    /*** if there is no match ***/
	$_SESSION['login_error'] = 5;
	header("location:login.php");
	die;
}
/*** check the password has only alpha numeric characters ***/
elseif (ctype_alnum($_POST['phpro_password']) != true)
{
     /*** if there is no match ***/
	$_SESSION['login_error'] = 6;
	header("location:login.php");
	die;
}
else
{
	if(isset( $_SESSION['login_error'] )){
		unset($_SESSION['login_error']);
	}
    /*** if we are here the data is valid and we can insert it into database ***/
    $phpro_username = filter_var($_POST['phpro_username'], FILTER_SANITIZE_STRING);
    $phpro_password = filter_var($_POST['phpro_password'], FILTER_SANITIZE_STRING);

    /*** now we can encrypt the password ***/
    $phpro_password = sha1( $phpro_password );
    
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
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        /*** $message = a message saying we have connected ***/

        /*** set the error mode to excptions ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** prepare the select statement ***/
        $stmt = $dbh->prepare("SELECT phpro_user_id, phpro_username, phpro_password FROM phpro_users 
                    WHERE phpro_username = :phpro_username AND phpro_password = :phpro_password");

        /*** bind the parameters ***/
        $stmt->bindParam(':phpro_username', $phpro_username, PDO::PARAM_STR);
        $stmt->bindParam(':phpro_password', $phpro_password, PDO::PARAM_STR);

        /*** execute the prepared statement ***/
        $stmt->execute();

        /*** check for a result ***/
        $user_id = $stmt->fetchColumn();

        /*** if we have no result then fail boat ***/
        if($user_id == false)
        {
				$_SESSION['login_error'] = 7;
				header("location:login.php");
				die;
        }
        /*** if we do have a result, all is well ***/
        else
        {
			session_start();
			
				/*** set the session user_id variable ***/
                $_SESSION['user_id'] = $user_id;
				$_SESSION['username'] = $phpro_username;
				

                /*** tell the user we are logged in ***/
                $message = 'You are now logged in';
				
				
				// Test if user is ADMIN
				/*** database name ***/
				$mysql_dbname = 'animal';
				$id = $_SESSION['user_id'];
				$dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
				$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$stmt = $dbh->prepare("SELECT phpro_user_id FROM admins WHERE phpro_user_id = :id");
				$stmt->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_STR);
				$stmt->execute();
				$is_admin = $stmt->fetchColumn();
				if($is_admin == true){
					$_SESSION['admin'] = $user_id;
				}

				/* Redirect browser */
				header("Location: index.php");
		 
				/* Make sure that code below does not get executed when we redirect. */
					exit;		
				}

    }
    catch(Exception $e)
    {
        /*** if we are here, something has gone wrong with the database ***/
        $message = 'We are unable to process your request. Please try again later"';
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