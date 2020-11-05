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

    <h1>Add Or Update Your Category Budgets:</h1>
    <form method="post" class="form-form">
      <h2>Budget</h2>
      <div class="form-container">
        <hr>
        <div class="container">
          <label for="category"><strong>Category</strong></label>
          <select name="category" >
            <option value="Food & Drink">Food & Drink</option>
            <option value="Groceries">Groceries</option>
            <option value="Shopping & Entertainment">Shopping & Entertainment</option>
            <option value="Home & Utilities">Home & Utilities</option>
            <option value="Transportation">Transportation</option>
            <option value="Travel">Travel</option>
            <option value="Personal">Personal</option>
            <option value="Other">Other</option>
          </select>
          <label for="budget"><strong>Budget</strong></label>
          <input class="" type="number" name="budget" placeholder="Budget" required>
        </div>
        <button class="" type="submit" name="budget" >Add Budget</button>
      </div>
    </form>


    <h1>Add Your Expenses:</h1>
    <?php echo '<p> This is the usersID: '.$_SESSION['user'].'</p>'; ?>
   </body>
 </html>
