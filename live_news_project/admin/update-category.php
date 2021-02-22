<?php include "header.php"; 
//session_start();
if($_SESSION['role'] == '0' )  {
header("location:post.php");

}
if (isset($_POST['submit'])){
    include 'config.php';
$categoryid=mysqli_real_escape_string($conn,$_POST['category_id']);
$cat_name=mysqli_real_escape_string($conn,$_POST['cat_name']);

$query="UPDATE category SET category_name='{$cat_name}' WHERE category_id='{$categoryid}'"; //update category
$result1=mysqli_query($conn,$query) or die("query failed");

if($result1){
    header("location:category.php");
}
}
?>
<?php
$category_id=$_GET['id']; //receive the particular id
include 'config.php';
$query="SELECT*FROM category WHERE category_id='{$category_id}'";
$result=mysqli_query($conn,$query);
$count=mysqli_num_rows($result);
if ($count>0){
while($row=mysqli_fetch_assoc($result)){
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <form action="<?php $_SERVER['PHP_SELF']?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="category_id"  class="form-control" value="<?php echo $row['category_id']?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name']?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php
}
                  
}
                  ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
