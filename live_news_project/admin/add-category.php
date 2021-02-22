<?php include "header.php"; 
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->

                 <?php
                 if (isset($_POST['submit'])){
                    include 'config.php';
                    $category_name=mysqli_real_escape_string($conn,$_POST['cat_name']);
                   

                 $query="SELECT category_name from category where category_name='$category_name'"; // if same category_name  exists
                 $result=mysqli_query($conn,$query)or die("query failed");
                 $count=mysqli_num_rows($result);
                 if ($count>0){
                   print("category already exist");
                 }
                 else{
                    $query1="INSERT INTO category (category_name) VALUE ('$category_name')";
                    $result=mysqli_query($conn,$query1);
                    
                 }
                 if($result){
                    header("location:category.php");
                 }

                 }
                 
                ?>


                <form  action="<?php $_SERVER['PHP_SELF']?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" placeholder="Category Name" required>
                      </div>
                         
                     <input type="submit"  name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
