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
$label = $_POST['label'];
$image = $_POST['image'];
$sql = 'UPDATE image SET label = "'.$label.'" Where path = "'.$image.'"';
if($mysqli->query($sql))
	{echo "label success";}
else{echo $sql."label failed ";}
}

//update location for image
if(isset($_POST['loca'])&&isset($_POST['image'])){
$loca = $_POST['loca'];
$image = $_POST['image'];
$sql = 'UPDATE image SET location = "'.$loca.'" Where path = "'.$image.'"';
if($mysqli->query($sql))
	{echo "label success";}
else{echo $sql."label failed ";}
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

//remove label
if(isset($_POST['removelabel'])){
$label = $_POST['removelabel'];
$sql = 'DELETE FROM label WHERE labelname= "'.$label.'" ';
if($mysqli->query($sql))
	{echo "success";}
else{echo $sql."failed ";}
}


//get image
if(isset($_POST['request'])&&$_POST['request']=="getim"){

$sql = 'SELECT path FROM image WHERE isBackground = 0 and label = "unlabelled" ORDER BY path';
$result=$mysqli->query($sql) or die("query fail");
$row=$result->num_rows;
$totalpath="";
while($path = $result->fetch_row())
{$totalpath=$totalpath."||".$path[0];}
echo $totalpath;
//echo "getim receive";
}

//get all distinct labels
if(isset($_POST['request'])&&$_POST['request']=="get_all_label"){
$totalpath="";
$sql = 'SELECT DISTINCT label FROM image WHERE label <> "unlabelled"';
$result=$mysqli->query($sql) or die("project query fail");
while($label = $result->fetch_row())
{$totalpath=$totalpath."||".$label[0];}
echo $totalpath;
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

//get project with image with isbackground = 0
if(isset($_POST['request'])&&$_POST['request']=="getpro2"){

$sql = 'SELECT DISTINCT foldername FROM image WHERE backgroundProcessed = 1 and label = "unlabelled"';
$result=$mysqli->query($sql) or die("query fail");
$row=$result->num_rows;
$totalpath2="";
while($path = $result->fetch_row())
{
$totalpath2=$totalpath2."||".$path[0];}
echo $totalpath2;
}

// get location 
if(isset($_POST['request'])&&$_POST['request']=="getloca"){

$sql = 'SELECT DISTINCT location FROM image';
$result=$mysqli->query($sql) or die("query fail");
$row=$result->num_rows;
$totalpath2="";
while($path = $result->fetch_row())
{
	$totalpath2=$totalpath2."||".$path[0];
}
echo $totalpath2;
}

//download image
if(isset($_POST['filepath'])){
$filepath=$_POST['filepath'];
echo $filepath;
}

//predict label
if(isset($_POST['predict'])){
$filepath=$_POST['predict'];
//sleep(13);
$output=shell_exec("/home/applications/darknet/darknet " . $filepath);

//echo $output;

//echo $output;

if ($output)
    echo $output;
}
//get project filtered image
if(isset($_POST['getpro_im'])){
$pro_name=$_POST['getpro_im'];
if($pro_name=="all projects")
{$sql = 'SELECT path FROM image Where isBackground = 0 ORDER BY path';}
else
{$sql = 'SELECT path FROM image Where isBackground = 0 and foldername = "'.$pro_name.'" ORDER BY path';}
$result=$mysqli->query($sql) or die("query fail");
$row=$result->num_rows;
$totalpath="";
while($path = $result->fetch_row())
{$totalpath=$totalpath."||".$path[0];}
echo $totalpath;
}
//given proname and label name
if(isset($_POST['p_name'])&&isset($_POST['l_name'])&&isset($_POST['upper'])&&isset($_POST['lower'])&&isset($_POST['loca'])&&isset($_POST['process'])){
$pro_name=$_POST['p_name'];
$label_name=$_POST['l_name'];
$upper=$_POST['upper'];
$lower=$_POST['lower'];
$loca_name =$_POST['loca'];
$sql = 'SELECT path FROM image ';
$boo = 0;
$sql = $sql.'Where ';
if($pro_name!="all projects")
{
	$boo +=1; $sql = $sql.'foldername = "'.$pro_name.'" ';
}
if($label_name!="all labels")
{
	$boo +=1;
	if($boo>=2)
	{$sql = $sql.' and ';}
	$sql = $sql.'label = "'.$label_name.'" ';
}
if($loca_name!="all locations")
{
	$boo +=1;
	if($boo>=2)
	{$sql = $sql.' and ';}
	$sql = $sql.'location = "'.$loca_name.'" ';	
}
if($_POST['process']=="yes")
{
	$sql = $sql.' and backgroundProcessed = 1 ';	
}

if($boo>=1)
{$sql = $sql.' and ';}
//add num
$sql = $sql.' isBackground > '.$lower.' and isBackground <= '.$upper;
//
$sql = $sql." ORDER BY isBackground , path";
//echo $sql;
$result=$mysqli->query($sql) or die("query fail");
$row=$result->num_rows;
$totalpath="";
while($path = $result->fetch_row())
{$totalpath=$totalpath."||".$path[0];}
echo $totalpath;

}

//delete certain im
if(isset($_POST['delete'])){
$im_name=$_POST['delete'];
unlink($im_name);
$sql = 'delete from image where path ="'.$im_name.'"';
if($mysqli->query($sql))
	{echo "delete success";}
else{echo $sql."delete failed ";}

}

//move image from a project to another one
if(isset($_POST['move_im'])&&isset($_POST['dest'])){
$im=$_POST['move_im'];
$dest=$_POST['dest'];
$tem = explode("/", $im);
$dest_path='/mnt/data/IMAGEDATA/'.$dest.'/'.$tem[(count($tem))-1];
if(file_exists ($dest_path))
{
	$tem2 = explode(".jpg", $dest_path);
	$dest_path=$tem2[0].'__1.jpg';
}
//echo $im.' to '.$dest_path;
$sql = 'update image set foldername ="'.$dest.'" where path = "'.$im.'"';
$sql2 ='update image set folderpath ="'.' /mnt/data/IMAGEDATA/'.$dest.'" where path = "'.$im.'"';
$sql3 ='update image set path ="'.$dest_path.'" where path = "'.$im.'"';
rename($im, $dest_path);
if($mysqli->query($sql)&&$mysqli->query($sql2)&&$mysqli->query($sql3))
	{echo "move success";}
else{echo $sql."----------".$sql2."----------".$sql3."move failed ";}

}

//get sp_label
if(isset($_POST['sp_label'])&&isset($_POST['type'])){
$str1=$_POST['sp_label'];
$type=$_POST['type'];
$sql = 'SELECT DISTINCT label FROM image Where ';
if($type==1)
{$sql =$sql.'foldername= "'.$str1.'"';}
//echo $sql."---";
$result=$mysqli->query($sql) or die("query fail");
$row=$result->num_rows;
$totalpath2="";
while($path = $result->fetch_row())
	{
		$totalpath2=$totalpath2."||".$path[0];
	}
echo $totalpath2;
}

//get sp_pro
if(isset($_POST['sp_pro'])&&isset($_POST['type'])){
$str1=$_POST['sp_pro'];
$type=$_POST['type'];
$sql = 'SELECT DISTINCT foldername FROM image Where ';
if($type==1)
{$sql =$sql.'label= "'.$str1.'"';}
//echo $sql."---";
$result=$mysqli->query($sql) or die("query fail");
$row=$result->num_rows;
$totalpath2="";
while($path = $result->fetch_row())
	{
		$totalpath2=$totalpath2."||".$path[0];
	}
echo $totalpath2;
}
?>
