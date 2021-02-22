<?php
include 'config.php';

if(isset($_FILES['fileToUpload'])){
$errors=array();

$file_name=$_FILES['fileToUpload']['name'];
$file_size=$_FILES['fileToUpload']['size'];

$file_tmp=$_FILES['fileToUpload']['tmp_name'];
$file_type=$_FILES['fileToUpload']['type'];
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

if(empty($errors)==true){ //if there is no errror 
 
    move_uploaded_file($file_tmp,$target);

}else{

    print_r($errors);

    die();
}

}

session_start();

$title= mysqli_real_escape_string($conn,$_POST['post_title']);
$description= mysqli_real_escape_string($conn,$_POST['postdesc']);
$category= mysqli_real_escape_string($conn,$_POST['category']);
$date=date('d','m','y');

$author=$_SESSION['user_id'];

$sql="INSERT INTO post(title,description,category,post_date,author,post_img) Values ('{$title}','{$description}','{$category}','{$date}','{$author}','{$new_name}');"; //multi query here
$sql.="UPDATE category SET post=post+1 WHERE category_id={$category}"; //update the post on a category 

if(mysqli_multi_query($conn,$sql)){
    header("location:post.php");
}else{
    echo "query failed";
}


?>