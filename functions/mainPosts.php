<div id="mainPost-content">
     <?php
     ini_set('display_errors', 1);
     ini_set('display_startup_errors', 1);
     error_reporting(E_ALL);
     include 'config.php';
     $query = mysqli_query($conn, "SELECT * FROM post");
     while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
     if($row['post_type'] == "informative"){
     $type = "<p style='color:goldenrod;'>[".$row['post_type']."]</p>"; 
     }
     else{
          $type = "<p style='color:lightseagreen;'>[".$row['post_type']."]</p>"; 
     }
     echo "<center>
               <div id='postItem'>"
                    .$type." Click for post: ".$row['post_title']
                    .": <a href ='pages/showpost.php?postId=".$row['post_id']
                    ."&postTitle=".$row['post_title']."&postDescription="
                    .$row['post_description']."'>Show post</a>
               </div>
          </center>";
     }
     ?>
</div>