<?php
error_reporting(E_ALL); ini_set('display_errors', '1');
include "start.php";
$query = "SELECT name, type, size, content FROM upload ORDER by name"; 
$result = $mysqli->query($query) or die('Error, query failed');
if($result->num_rows==0){
        echo "Database is empty <br>";
		exit;
    }
$i=0;
//$output = shell_exec('echo hello') or die("failed");
//echo "<pre>$output</pre>";
//$output=shell_exec("/home/houlor/temp/Background IMG_0001.JPG IMG_0002.JPG IMG_0003.JPG") or die("failed one");
//echo "<pre>$output</pre>";
while(list($name) = $result->fetch_row() )
{
$temp =array();
array_push($temp,$name);
list($name) = $result->fetch_row();
array_push($temp,$name);
list($name) = $result->fetch_row();
array_push($temp,$name);
//echo $i.": ".$temp[0]." ".$temp[1]." ".$temp[2]."<br>";
//$i=$i+1;
$output=shell_exec("/home/houlor/temp/Background ".$temp[0]." ".$temp[1]." ".$temp[2]) or die("failed");
echo "<pre>$output</pre>";
//echo "/home/houlor/temp/Background ".$temp[0]." ".$temp[1]." ".$temp[2]." >debug.txt";
}
//exec(process.out) ;
?>
