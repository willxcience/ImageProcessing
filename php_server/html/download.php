<?php

session_start();
//error_reporting(E_ALL); ini_set('display_errors', '1');

if(!isset($_SESSION['user_id'])){
   header("location:login.php");
   die;
}

//echo '<img src="/mnt/data/IMAGEDATA/MDGC0001.JPG">';


//exit(0);

$host= "localhost";
$username="root";
$userpass="usbw";
$databasew="animal";
$mysqli = new mysqli($host,$username,$userpass,$databasew);
 if ($mysqli->connect_errno){
    echo "huston we have a problem";
 }

$folder =  $_GET['foldername'];
//echo "good".$folder;
$query = 'SELECT path FROM image WHERE isBackground < 1000 and foldername = "'.$folder.'" order by path'; 
$result = $mysqli->query($query) or die('Error, query failed');
if($result->num_rows==0){
        echo "This project is empty or not processed <br>";
		exit;
    }

$zip = new ZipArchive;
$res = $zip->open('test.zip', ZipArchive::CREATE);
if ($res === TRUE) {
    $pathArray=array();
    while($path = $result->fetch_row())
      {
	array_push($pathArray,$path[0]);
	//$pathArray.push()
	    //$zip->addFromString($name,$content) or die('failed');
	    //echo "name: ".$content."\n";
      } 
	//print_r($pathArray);
	$zipname .= '_animal_processing.zip';
	$zip = new ZipArchive;
	$zip->open($zipname, ZipArchive::CREATE);
	foreach ($pathArray as $file) {
		$new_filename = substr($file,strrpos($file,'/') + 1);
		$zip->addFile($file,$new_filename);
	}
	$zip->close();
	header('Content-Type: application/zip');
	header('Content-disposition: attachment; filename='.$zipname);
	header('Content-Length: ' . filesize($zipname));
	readfile($zipname);
	unlink('_animal_processing.zip');
    exit;
} else {
    echo 'failed';
}
?>
