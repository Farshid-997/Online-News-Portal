<?php 

$cat_id=$_GET['ID'];
include 'config.php';

$query="DELETE from category WHERE category_id='{$cat_id}'";

$result=mysqli_query($conn,$query);

if($result){
    header(" location: category.php");
   }
   else{
       echo "cant delete category";
   }
   
   mysqli_close($conn);

?>