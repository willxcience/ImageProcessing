<?php
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
    foreach ($_FILES['files']['name'] as $i => $name) {
        if (strlen($_FILES['files']['name'][$i]) > 1) {
              $fileName = $_FILES['files']['name'][$i];
              $tmpName  = $_FILES['files']['tmp_name'][$i];
              $fileSize = $_FILES['files']['size'][$i];
              $fileType = $_FILES['files']['type'][$i];
              
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