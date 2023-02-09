<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Include the database configuration file  
include 'config.php'; 
 
// Get image data from database 
$query = mysqli_query($conn,"SELECT * FROM post ORDER BY post_id DESC"); 

  while ($row=mysqli_fetch_array($query, MYSQLI_ASSOC)) {
      echo '<tr>';
      echo '<td>' . $row['post_id'] . '</td>';
      echo '<td>' . $row['post_title'] . '</td>';
      echo '<td>' .
      '<img src = "data:image/png;base64,' . base64_encode($row['post_img']) . '" width = "50px" height = "50px"/>'
      . '</td>';
      echo '</tr>';
  }
  ?>