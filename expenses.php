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
     <<?php $user = $_SESSION['user'] ?>

    <h1>Add Or Update Your Category Budgets:</h1>

    <div class="form-body">
      <form method="post" class="form-form">
        <h2>Budget</h2>
        <div class="form-container">
          <hr>
          <div class="container">
            <label for="category"><strong>Category</strong></label>
            <select name="category">
              <option disabled selected value> -- select an option -- </option>
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
    </div>

    <h1>Add Your Expenses:</h1>

    <div class="form-body">
      <form method="post" class="form-form">
        <h2>Expense</h2>
        <div class="form-container">
          <hr>
          <div class="container">
            <label for="item"><strong>Item</strong></label>
            <input class="" type="text" name="item" placeholder="Item" required>
            <label for="cost"><strong>Cost</strong></label>
            <input class="" type="number" name="cost" placeholder="Cost" required>
            <label for="category"><strong>Category</strong></label>
            <select class="" name="category">
              <option disabled selected value> -- select an option -- </option>
              <option value="Food & Drink">Food & Drink</option>
              <option value="Groceries">Groceries</option>
              <option value="Shopping & Entertainment">Shopping & Entertainment</option>
              <option value="Home & Utilities">Home & Utilities</option>
              <option value="Transportation">Transportation</option>
              <option value="Travel">Travel</option>
              <option value="Personal">Personal</option>
              <option value="Other">Other</option>
            </select>
          </div>
          <button class="form-expense-button" type="submit" name="expense">Add Expense</button>
        </div>
      </form>
    </div>

    <?php echo '<p> This is the usersID: '.$_SESSION['user'].'</p>'; ?>
   </body>
 </html>
