<?php
//error_reporting(E_ALL); ini_set('display_errors', '1');
if(isset($_GET['filepath'])){
	//{
	$path=$_GET['filepath'];
	//echo $path;
	//$path="/mnt/data/IMAGEDATA/test/IMG_0009.JPG";
	$files = explode(",", $path);;
	$zipname = $_GET['label'];
	$zipname .= '_animal_processing.zip';
	$zip = new ZipArchive;
	$zip->open($zipname, ZipArchive::CREATE);
	foreach ($files as $file) {
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
}
else {echo "download failed";}
?>
