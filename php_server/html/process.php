<?php

session_start();
if(!isset($_SESSION['user_id'])){
   header("location:login.php");
   die;
}

error_reporting(E_ALL); ini_set('display_errors', '1');

$host= "localhost";
$username="root";
$userpass="usbw";
$databasew="animal";
$mysqli = new mysqli($host,$username,$userpass,$databasew);
if ($mysqli->connect_errno){
    echo "huston we have a problem";
}

$foldername =  $_POST['foldername'];

if (empty($foldername)){
    die("Please enter a name!\n");
}

$sql = 'SELECT path FROM image WHERE foldername ="' . $foldername . '" ORDER by path';
$result = $mysqli->query($sql) or die("Error, query failed" . mysqli_error($mysqli));

if (mysqli_num_rows($result) == 0){
    die("Cannot find the folder!");
} else {
    echo "Processing folder " . $foldername . "\n";
}


while($row = $result->fetch_row()) {
    $temp =array();
    array_push($temp,$row[0]);
    $row = $result->fetch_row();
    array_push($temp,$row[0]);
    $row = $result->fetch_row();
    array_push($temp,$row[0]);

    $output=shell_exec("/home/applications/Background ".$temp[0]." ".$temp[1]." ".$temp[2]);
	echo $output;
        foreach($temp as $i) {
            $sql = 'UPDATE image SET backgroundProcessed = 1 Where path = "' . $i . '"';
            $mysqli->query($sql);

	    	if ($output > 1) {
            	$sql = 'UPDATE image SET isBackground = ' .$output . ' Where path = "' . $i . '"';
            	$mysqli->query($sql);
		} else if ($output == -1) {
            	$sql = 'UPDATE image SET isBackground = ' . '1000' . ' Where path = "' . $i . '"';
            	$mysqli->query($sql);
		}

        }
}
//header("location:/");
echo "Process Finished";
?>
