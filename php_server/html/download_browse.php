<?php
//error_reporting(E_ALL); ini_set('display_errors', '1');
if(isset($_GET['filepath'])){
	//{
	$path=$_GET['filepath'];
	//echo $path;
	//$path="/mnt/data/IMAGEDATA/test/IMG_0009.JPG";
	$files = explode(",", $path);;
	$img_name = substr($path,strrpos($path,'/') + 1);
	header('Content-Type: application/image');
	header('Content-disposition: attachment; filename='.$img_name);
	header('Content-Length: ' . filesize($path));
	readfile($path);
	//unlink('_animal_processing.zip');
	exit;
}
else {echo "aa";}
?>
