<?php
$host= "localhost";
$username="root";
$userpass="usbw";
$databasew="test";
 $mysqli = new mysqli($host,$username,$userpass,$databasew);
 if ($mysqli->connect_errno){
    echo "huston we have a problem";
 }
 echo $mysqli->host_info ."<br>";
 echo "<br>";

if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
{
$fileName = $_FILES['userfile']['name'];
$tmpName  = $_FILES['userfile']['tmp_name'];
$fileSize = $_FILES['userfile']['size'];
$fileType = $_FILES['userfile']['type'];

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


?>