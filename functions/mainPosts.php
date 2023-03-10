<div id="mainPost-content">
     <form method="post">
           <select name="filterOption" id="filterOption">
                <option value="pro">Product</option>
                <option value="pst">Post</option>
            </select>
            <input type="submit" name="filterSubmit" value="Filter!">
     </form>
</div>

<?php 
showFiltered($conn);
function showFiltered($conn): void{
     ini_set('display_errors', 1);
     ini_set('display_startup_errors', 1);
     error_reporting(E_ALL);
     session_start();
     if (!empty($_SESSION)){
          $userId = $_SESSION['userid'];
          $userRoleQuery = mysqli_query($conn, "SELECT user_role FROM user WHERE user_id=$userId");
          $userRoleRow=mysqli_fetch_array($userRoleQuery, MYSQLI_ASSOC);
     }    
     try{
          ini_set('display_errors', 1);
          ini_set('display_startup_errors', 1);
          error_reporting(E_ALL);

          include 'config.php';
          
          $option = $_POST['filterOption'] ?? NULL;
          if($option == NULL){ $option="";} //We let option be nothing which redierect to default option.
         
          switch($option){
               case "pro":
                    $query = mysqli_query($conn, "SELECT post_id, post_title, post_description, post_type FROM post ORDER BY post_type DESC");
               break;
               case "pst":
                    $query = mysqli_query($conn, "SELECT post_id, post_title, post_description, post_type FROM post ORDER BY post_type ASC");
               break;
               default:
                //$sortBy will be empty if no filter is given thus giving it case default 
               //   $sortBy ="";
                    $query = mysqli_query($conn, "SELECT post_id, post_title, post_description, post_type FROM post");
               break;
          }

          while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
          if($row['post_type'] == "informative"){
          $type = "<p style='color:goldenrod;'>[".$row['post_type']."]</p>"; 
          }
          else{
               $type = "<p style='color:lightseagreen;'>[".$row['post_type']."]</p>"; 
          }
          if ($userRoleRow['user_role']=="admin"){
               echo "<center>
                         <div id='postItem'>"
                              .$type." Logged in as ADMIN: Click for post: ".$row['post_title']
                              .": <a href ='pages/showPost.php?postId=".$row['post_id']
                              ."&postTitle=".$row['post_title']."&postDescription="
                              .$row['post_description']."'>Show post</a> 

                              <form action='../functions/deletePost.php' method='post'>
                                   <input type='hidden' name='post_id' value='$row[post_id]' />
                                   <input type='submit' class='delete_button' value='DELETE POST'/><br>
                              </form>

                         </div>
                    </center>";
          }else {
               echo "<center>
                         <div id='postItem'>"
                              .$type." Click for post: ".$row['post_title']
                              .": <a href ='pages/showPost.php?postId=".$row['post_id']
                              ."&postTitle=".$row['post_title']."&postDescription="
                              .$row['post_description']."'>Show post</a>
                         </div>
                    </center>";
               }
          }
     }catch(Exception $e){
           echo'<script>alert("Chosen filter option not provided...");</script>';        
          throw $e;
     }
}
?>