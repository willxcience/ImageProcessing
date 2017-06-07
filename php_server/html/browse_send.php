<?php
session_start();
if(isset($_SESSION['user_id'])){
//echo $_SESSION['user_id']; 
if(isset($_SESSION['admin'])){
//echo $_SESSION['user_id']; 
}
}

error_reporting(E_ALL); ini_set('display_errors', '1');
include "start.php";

//update label for image
if(isset($_POST['label'])){
//$rpp = preg_replace('#[^0-9]#', '', $_POST['rpp']);
//$last = preg_replace('#[^0-9]#', '', $_POST['last']);
$label = $_POST['label'];
$image = $_POST['image'];
$sql = 'UPDATE image SET label = "'.$label.'" Where path = "'.$image.'"';
if($mysqli->query($sql))
	{echo "success";}
else{echo $sql."failed ";}
}

//update new labels
if(isset($_POST['addlabel'])){
$label = $_POST['addlabel'];
$sql = 'insert into label (labelname, page, pos) values("'.$label.'",1,1)';
if($mysqli->query($sql))
	{echo "success";}
else{echo $sql."failed ";}
}

//get project labelled image
if(isset($_POST['project'])){
$name = $_POST['project'];
$sql = 'SELECT label, path FROM image WHERE foldername = "'.$name.'" and label <> "unlabelled"';
$result=$mysqli->query($sql) or die("project query fail");
$totalpath="";
while(list($label,$path) = $result->fetch_row())
{$totalpath=$totalpath."||".$label."--".$path;}

$sql = 'SELECT DISTINCT label FROM image WHERE foldername = "'.$name.'" and label <> "unlabelled"';
$result=$mysqli->query($sql) or die("project query fail");
$totalpath=$totalpath."$$";
while($label = $result->fetch_row())
{$totalpath=$totalpath."||".$label[0];}
echo $totalpath;
}

// Get image query
if(isset($_POST['request'])&&$_POST['request']=="getim"&&isset($_SESSION['img_query'])){
$label = $_SESSION['img_query'];
$sql = 'SELECT path FROM image WHERE label = "'.$label.'" ORDER BY path';
$result=$mysqli->query($sql) or die("query fail");
$row=$result->num_rows;
$totalpath="";
while($path = $result->fetch_row())
{$totalpath=$totalpath."||".$path[0];}
echo $totalpath;

//echo "getim receive";
}
// Get image project
else if(isset($_POST['request'])&&$_POST['request']=="getim"&&isset($_SESSION['img_project'])){
$project = $_SESSION['img_project'];
$sql = 'SELECT path FROM image WHERE foldername = "'.$project.'" ORDER BY path';
$result=$mysqli->query($sql) or die("query fail");
$row=$result->num_rows;
$totalpath="";
while($path = $result->fetch_row())
{$totalpath=$totalpath."||".$path[0];}
echo $totalpath;

//echo "getim receive";
}                  
//get image
else if(isset($_POST['request'])&&$_POST['request']=="getim"){

$sql = 'SELECT path FROM image ORDER BY path';
$result=$mysqli->query($sql) or die("query fail");
$row=$result->num_rows;
$totalpath="";
while($path = $result->fetch_row())
{$totalpath=$totalpath."||".$path[0];}
echo $totalpath;
//echo "getim receive";
}
//get label
if(isset($_POST['request'])&&$_POST['request']=="getlabel"){

$sql = 'SELECT labelname FROM label';
$result=$mysqli->query($sql) or die("query fail");
$row=$result->num_rows;
$totalpath2="";
while($path = $result->fetch_row())
{
$totalpath2=$totalpath2."||".$path[0];}
echo $totalpath2;
}

//get project
if(isset($_POST['request'])&&$_POST['request']=="getpro"){

$sql = 'SELECT DISTINCT foldername FROM image';
$result=$mysqli->query($sql) or die("query fail");
$row=$result->num_rows;
$totalpath2="";
while($path = $result->fetch_row())
{
$totalpath2=$totalpath2."||".$path[0];}
echo $totalpath2;
}

//download image
if(isset($_POST['filepath'])){
$filepath=$_POST['filepath'];
echo $filepath;
}


?>
