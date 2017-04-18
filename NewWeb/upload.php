<?php

error_reporting(E_ALL); ini_set('display_errors', '1');

$target_dir = "/home/will/Desktop/uploads/";
$host= "localhost";
$username="root";
$userpass="usbw";
$databasew="test";
$mysqli = new mysqli($host,$username,$userpass,$databasew);

if ($mysqli->connect_errno){
    echo "huston we have a problem";
 }



if (isset($_POST['submit'])){

    $foldername =  $_POST['foldername'];

    if (!$foldername)
        die("Please enter a name!");

    $sql ='select * from upload where foldername ="' . $foldername . '"';
    $result = $mysqli->query($sql) or die('Error, query failed');

    if (mysqli_num_rows($result)){
        die("Project name already exists!");
    } else {
        echo "Uploading images to " . $foldername . "\n";
    }

    //make a new directory for the database
    if (!mkdir($target_dir . basename($foldername), 0777, true)) {
        echo("This folder has already been created!\n");
    }
    chmod($target_dir . basename($foldername),0777);

    foreach ($_FILES['files']['name'] as $i => $name ) {
        
        if ($_FILES['files']['error'][$i] == 0) {
            $fileName = $_FILES['files']['name'][$i];
            $tmpName  = $_FILES['files']['tmp_name'][$i];
            $fileSize = $_FILES['files']['size'][$i];
            $fileType = $_FILES['files']['type'][$i];


	        $target_file = $target_dir . basename($foldername) . "/" . basename($fileName);

            

            $folderpath = $target_dir . basename($foldername);

            $sql = "INSERT INTO upload (foldername, size, type, path, folderpath) ".
            "VALUES ('$foldername', '$fileSize', '$fileType', '$target_file', '$folderpath')";
            
            $mysqli->query($sql) or die("Error, updating query failed" . mysqli_error($mysqli));

            if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $target_file)) {
                echo "The SP file ". basename( $_FILES['files']['name'][$i]). " has been uploaded.\n";
            }
            else {echo "The SP file failed\n";}

            chmod($target_file, 0777);

        } else {
            echo basename($_FILES['files']['name'][$i]) . "failed\n";
        }
    }

} else {
    echo "Request failed";
}


?>

