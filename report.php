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
      <h1>Your Expense Report:</h1>
   </body>
 </html>
