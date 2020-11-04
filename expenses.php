<?php
require_once './includes/inc.php';

if(!(isset($_SESSION["is_loged_in"]) && $_SESSION["is_loged_in"] == true)){
  header("Location: index.php");
}
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <?php require_once './layouts/head.php'; ?>
   <body>
     <?php require_once './layouts/nav.php'; ?>
    <h1>Add Your Expenses:</h1>
    <?php echo '<p> This is the usersID: '.$_SESSION['user'].'</p>'; ?>
   </body>
 </html>
