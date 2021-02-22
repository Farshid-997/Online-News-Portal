<?php

include 'config.php';
$rece_id=$_GET['id'];

$query="DELETE FROM user WHERE user_id='{$rece_id}'";

$result=mysqli_query($conn,$query);

if($result){
 header(" location: users.php");
}
else{
    echo "cant delete user";
}

mysqli_close($conn);
?>