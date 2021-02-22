<?php
include 'config.php';

if(empty($_FILES['new-image']['name'])){
    $new_name=$_POST['old-image'];
 }else{
    $errors=array();

 }


$file_name=$_FILES['new-image']['name'];
$file_size=$_FILES['new-image']['size'];

$file_tmp=$_FILES['new-image']['tmp_name'];
$file_type=$_FILES['new-image']['type'];
$tmp=explode('.',$file_name);  //separate the image name into two with explode function and recive the last one with end
$file_ext=strtolower(end($tmp));
$extension=array("jpg","jpeg","png");

if(in_array($file_ext,$extension)===false){ //search in array that the file extension of a image file belongs to these three format
$errors[]="file extension file not allowed";
}

if($file_size>2097152){
  
    $errors[]="file size must be 2mb or lower";
}
$new_name=time()."-".$file_name; //new name of the file

$target='upload/'.$new_name; //where the file uploaded
$image_name=$new_name;
if(empty($errors)==true){ //if there is no errror 
 
    move_uploaded_file($file_tmp,$target);

}else{

    print_r($errors);

    die();
}
$query="UPDATE post SET 
title='{$_POST["post_title"]}',
description='{$_POST["postdesc"]}',
category='{$_POST["category"]}',
post_img='{$image_name}'
WHERE post_id={$_POST['post_id']} ;";

if($_POST['old_category']!=$_POST['category']){

    $query.="UPDATE category SET post=post-1 WHERE category_id={$_POST['old_category']};";

    $query.="UPDATE category SET post=post+1 WHERE category_id={$_POST['category']};";
}

  $result=mysqli_multi_query($conn,$query)or die("query failed");

  if($result){
   header("location:../admin/post.php");
  }
  else{
     echo "query failed";
  }





?>