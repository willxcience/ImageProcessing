<?php
error_reporting(E_ALL); ini_set('display_errors', '1');

$host= "localhost";
$username="root";
$userpass="usbw";
$databasew="test";
$mysqli = new mysqli($host,$username,$userpass,$databasew);
if ($mysqli->connect_errno){
    echo "huston we have a problem";
}

$foldername =  $_POST['foldername'];


if (empty($foldername)){
    die("Please enter a name!\n");
}


$sql ='select path,folderpath from upload where foldername ="' . $foldername . '"';
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

rmdir($folderpath);

$sql = 'DELETE FROM upload WHERE foldername ="' . $foldername . '"';

$result = $mysqli->query($sql) or die('Error, clean failed');


echo "Clean completed!";

//if(file_exists('tmp.zip'))
 //{unlink('tmp.zip') or die('fail to delete zip file');}

?>