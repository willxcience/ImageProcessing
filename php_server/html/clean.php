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


$sql ='select path,folderpath from image where foldername ="' . $foldername . '"';
//echo $sql;
$result = $mysqli->query($sql) or die('Error, query failed');

if (mysqli_num_rows($result) == 0) {
    die("Cannot find the folder ".$foldername."!\n");
}

$folderpath = '';

while($row = $result->fetch_row()) {
    $folderpath = $row[1];
    if (file_exists($row[0]))
        unlink($row[0]);
}
function deleteDirectory($dir) {
    system('rm -rf ' . escapeshellarg($dir), $retval);
    return $retval == 0; // UNIX commands return zero on success
}
echo $folderpath;
if(deleteDirectory($folderpath)==0)
{
echo "remove directory success";
}
//rmdir($folderpath);

$sql = 'DELETE FROM image WHERE foldername ="' . $foldername . '"';

$result = $mysqli->query($sql) or die('Error, clean failed');


echo "Clean completed!";

//if(file_exists('tmp.zip'))
 //{unlink('tmp.zip') or die('fail to delete zip file');}

?>
