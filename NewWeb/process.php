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

$sql = 'SELECT path FROM upload WHERE foldername ="' . $foldername . '" ORDER by path';
$result = $mysqli->query($sql) or die("Error, query failed" . mysqli_error($mysqli));

if (mysqli_num_rows($result) == 0){
    die("Cannot find the folder!");
} else {
    echo "Processing folder " . $foldername . "\n";
}


while($row = $result->fetch_row()) {
    $temp =array();
    array_push($temp,$row[0]);
    $row = $result->fetch_row();
    array_push($temp,$row[0]);
    $row = $result->fetch_row();
    array_push($temp,$row[0]);

    $output=shell_exec("/home/will/Desktop/temp/Background ".$temp[0]." ".$temp[1]." ".$temp[2]);

    if ($output != -1) {
        foreach($temp as $i) {
            $sql = 'UPDATE upload SET backgroundProcessed = 1 Where path = "' . $i . '"';
            $mysqli->query($sql);
            $sql = 'UPDATE upload SET isBackground = ' .$output . ' Where path = "' . $i . '"';
            $mysqli->query($sql);
        }
    }
}
?>
