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
    echo "connection to database is failed";
}

$foldername =  $_POST['foldername'];


if (empty($foldername)){
    die("Please enter a name!\n");
}
$folderpath ="/mnt/data/IMAGEDATA/".$foldername;
function deleteDirectory($dir) {
    system('rm -rf ' . escapeshellarg($dir), $retval);
    return $retval == 0; // UNIX commands return zero on success
}
if(file_exists ( $folderpath ))
{
$sql ='delete from image where foldername ="' . $foldername . '"';
$mysqli->query($sql) or die('Error, query failed');
deleteDirectory($folderpath);
echo "remove directory successfully";
}
else {echo "directory does not exist";}


