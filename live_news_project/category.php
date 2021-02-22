<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">


                <?php
                include 'admin/config.php';
                if(isset($_GET['catid'])){
                  $cat_id=$_GET['catid'];
                
                $query_cat="SELECT*FROM category WHERE category_id={$cat_id}";
                $result_cat=mysqli_query($conn,$query_cat)or die("query failed");
                $row_cat=mysqli_fetch_assoc($result_cat);
                ?>
                  <h2 class="page-heading"><?php echo strtoupper($row_cat['category_name'])?></h2>
                   
            <?php
             
              //$rcv_cat=$_GET['catid'];
            
              $limit=3;
              if(isset($_GET['page'])){
                $page_number=$_GET['page'];

              }

              else{
                $page_number=1; 
              }
              
              $offset=($page_number-1)*$limit;

              
               
                $query="SELECT post.post_id,post.title,post.description,post.post_img,post.post_date,post.category,category.category_name,user.username,post.author FROM post LEFT JOIN category ON post.category=category.category_id 
               LEFT JOIN user ON post.author=user.user_id WHERE post.category={$cat_id} ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
              
              // from where clause we can show the specific post of a particular category
               
          
              $result=mysqli_query($conn,$query)or die ("mysqli failed");
              $count=mysqli_num_rows($result);
              if ($count>0){

                while($row=mysqli_fetch_assoc($result))
                {
                  
                 
              ?>

                        <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?id=<?php echo $row['post_id']?>"> <img src="admin/upload/<?php echo $row['post_img']?>" height="150px"></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href="single.php?id=<?php echo $row['post_id']?>"><?php echo $row['title']?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?catid=<?php echo $row['category']?>'><?php echo $row['category_name']?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?author_id=<?php echo $row['author']?>'><?php echo $row['username']?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row['post_date']?>
                                        </span>
                                    </div>
                                    <p class="description">
                                    <?php echo substr($row['description'],0,150)."..."?>
                                    </p>
                                    <a class='read-more pull-right' href="single.php?id=<?php echo $row['post_id']?>">read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
<?php
  }
}
else{
    echo "no record found";
}



            $query2="SELECT*FROM post WHERE post.category={$cat_id}";
                  $result2=mysqli_query($conn,$query2) or die("connection failed");
                 if(mysqli_num_rows($result2)) {

                    $total_records=mysqli_num_rows($result2);
                    $total_page=ceil($total_records/$limit);
                   echo "<ul class='pagination admin-pagination'>";

                   if($page_number>1){
             
              echo '<li ><a href="author.php?catid='.$cat_id.'&page='.($page_number-1).'">Prev</a></li>';
                   }
                 for($i=1;$i<=$total_page;$i++)
                 {
                    
                  if($i==$page_number)
                  {
                      $active="active";
                  }
                  else{
                      $active="";
                  }
                  echo '<li class='.$active.'><a href="category.php?catid='.$cat_id.'&page='.$i.'">'.$i.'</a></li>';
                 }
                 
                 if($total_page>$page_number){
                    echo '<li ><a href="category.php?catid='.$cat_id.'&page='.($page_number+1).'">Next</a></li>';
                  }
                 echo "</ul>";
                }
              }else{
                echo"<h2>No  found</h2>";
              }
             
?>

                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
