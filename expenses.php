<?php
require_once './includes/inc.php';

if(!(isset($_SESSION["is_loged_in"]) && $_SESSION["is_loged_in"] == true)){
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
    <h1>Expenses</h1>
    <br>
    <?php echo '<p> This is the usersID: '.$_SESSION['user'].'</p>'; ?>
   </body>
 </html>
