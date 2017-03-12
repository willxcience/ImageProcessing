<?php
    include "start.php";

    $query = "SELECT id, name FROM upload";
    $result = $mysqli->query($query) or die('Error, query failed');

    if($result->num_rows==0){
        echo "Database is empty <br>";
    }
    else{
        while(list($id, $name) = $result->fetch_array(MYSQLI_BOTH)){
           // echo "<a href=\"tem.php?link=' .$id. '">$id $name</a><br>";
              echo '<a href="tem.php?link=' . $id . '">$id $name</br>';
	    }
    }
?>