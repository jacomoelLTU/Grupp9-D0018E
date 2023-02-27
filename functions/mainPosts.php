<div id="mainPost-content">
     <form method="post">
           <select name="filterOption" id="filterOption">
                <option value="me">Most Expensive</option>
                <option value="le">Least Expensive</option>
            </select>
     </form>
</div>

<?php 
showFiltered($conn);
function showFiltered($conn): void{
     ini_set('display_errors', 1);
     ini_set('display_startup_errors', 1);
     error_reporting(E_ALL);

     include 'config.php';
     $query = $_POST['filterOption'];
     echo $query;
     // $query = mysqli_query($conn, "SELECT post_id, post_title, post_description, post_type FROM post");
     // while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
     // if($row['post_type'] == "informative"){
     // $type = "<p style='color:goldenrod;'>[".$row['post_type']."]</p>"; 
     // }
     // else{
     //      $type = "<p style='color:lightseagreen;'>[".$row['post_type']."]</p>"; 
     // }
     // echo "<center>
     //           <div id='postItem'>"
     //                .$type." Click for post: ".$row['post_title']
     //                .": <a href ='pages/showPost.php?postId=".$row['post_id']
     //                ."&postTitle=".$row['post_title']."&postDescription="
     //                .$row['post_description']."'>Show post</a>
     //           </div>
     //      </center>";
     // }
}
?>