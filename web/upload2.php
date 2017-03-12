<?php
error_reporting(E_ALL); ini_set('display_errors', '1');
$target_dir = "uploads/";
$host= "localhost";
$username="root";
$userpass="usbw";
$databasew="test";
$mysqli = new mysqli($host,$username,$userpass,$databasew);
if ($mysqli->connect_errno){
    echo "huston we have a problem";
 }
$count = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo $_FILES['files']['name'][1];
    foreach ($_FILES['files']['name'] as $i => $name) {
        if (strlen($_FILES['files']['name'][$i]) > 1) {
              $fileName = $_FILES['files']['name'][$i];
              $tmpName  = $_FILES['files']['tmp_name'][$i];
              $fileSize = $_FILES['files']['size'][$i];
              $fileType = $_FILES['files']['type'][$i];

	      $target_file = $target_dir . basename($fileName);
 	      if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $target_file)) {
        echo "The SP file ". basename( $_FILES['files']['name'][$i]). " has been uploaded.";
    }
else {echo "The SP file failed";}

              
              $fp      = fopen($tmpName, 'r');
              $content = fread($fp, filesize($tmpName));
              $content = addslashes($content);
              fclose($fp);
              
              if(!get_magic_quotes_gpc())
              {
                  $fileName = addslashes($fileName);
              }
              $query = "INSERT INTO upload (name, size, type, content ) ".
              "VALUES ('$fileName', '$fileSize', '$fileType', '$content')";
              
              $mysqli->query($query) or die('Error, query failed'); 
              
              echo "<br>File $fileName uploaded<br>";
        }
    }
}
?>
