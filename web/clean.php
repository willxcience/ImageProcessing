<?php
include "start.php";
$query = "DELETE FROM upload";
if($mysqli->query($query))
{echo"clean succeed";}
else{ die('Error, query failed');}

if(file_exists('test.zip'))
 {unlink('test.zip') or die('fail to delete zip file');}
?>