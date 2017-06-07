<?php
//error_reporting(E_ALL); ini_set('display_errors', '1');
if(isset($_GET['filepath'])){
	$raw =$_GET['filepath'];
	$files = explode("||", $raw);
	unset($files[0]);
	unset($files[(count($files))]);
	$zipname = 'animal_processing.zip';
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
	unlink('animal_processing.zip');
	exit;
}
else {echo "download failed";}
?>
