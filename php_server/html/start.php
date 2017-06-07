<?php
$host= "localhost";
$username="root";
$userpass="usbw";
$databasew="animal";
 $mysqli = new mysqli($host,$username,$userpass,$databasew);
 if ($mysqli->connect_errno){
    echo "huston we have a problem";
 }
 /*echo $mysqli->host_info;
 */
?>
