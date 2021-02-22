<?php

include 'config.php';
$post_ID=$_GET['id'];
$cat_id=$_GET['cat_id'];


$query1="SELECT FROM post WHERE post_id={$post_id}";

$result1=mysqli_query($conn,$query1);

$row=mysqli_fetch_assoc($result1);

unlink("upload/".$row['post_img']);
$query="DELETE FROM post WHERE post_id={$post_ID} ;";
$query.="UPDATE category SET post=post-1 WHERE category_id={$cat_id}; ";

$result=mysqli_multi_query($conn,$query) or die("query failed");

if($result){
header("location:../admin/post.php");
}









?>