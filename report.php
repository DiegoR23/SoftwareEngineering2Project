<?php
require_once './includes/inc.php';
if(!(isset($_SESSION["is_signed_in"]) && $_SESSION["is_signed_in"] == true)){
  header("Location: index.php");
}
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>ExpenseTracker</title>
   </head>
   <body>
      <?php require_once './layouts/nav.php'; ?>
      <h1>Report</h1>
   </body>
 </html>
