<?php

session_start();
error_reporting(E_ALL); ini_set('display_errors', '1');

if(!isset($_SESSION['user_id'])){
   header("location:login.php");
   die;
}

echo '<img src="/mnt/data/IMAGEDATA/MDGC0001.JPG">';


exit(0);

$host= "localhost";
$username="root";
$userpass="usbw";
$databasew="test";
$mysqli = new mysqli($host,$username,$userpass,$databasew);
 if ($mysqli->connect_errno){
    echo "huston we have a problem";
 }
$query = "SELECT name, type, size, content FROM upload WHERE animal = 1"; 
$result = $mysqli->query($query) or die('Error, query failed');
if($result->num_rows==0){
        echo "Database is empty <br>";
		exit;
    }

$zip = new ZipArchive;
$res = $zip->open('test.zip', ZipArchive::CREATE);
if ($res === TRUE) {
    while(list($name, $type, $size, $content) = $result->fetch_row())
      {
	    $zip->addFromString($name,$content) or die('failed');
	    //echo "name: ".$content."\n";
      }  
    $zip->close();
	
    header("Content-type: application/zip"); 
    header("Content-Disposition: attachment; filename=test.zip"); 
    header("Pragma: no-cache"); 
    header("Expires: 0"); 
    readfile("test.zip");
    exit;
} else {
    echo 'failed';
}
?>
