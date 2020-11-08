<?php
require_once './includes/inc.php';

if(!(isset($_SESSION["is_loged_in"]) && $_SESSION["is_loged_in"] == true)){
  header("Location: index.php");
}
 ?>

 <?php

  // user variable
  $userID = $_SESSION['user'];

  // budget form
   $budgetform =
   '
   <div class="form-body">
     <form method="post" class="form-form">
       <h2>Budget</h2>
       <div class="form-container">
         <hr>
         <div class="expense-container">
           <label for="category"><strong>Category</strong></label>
           <select class="form-expense-input" name="category">
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
           <input class="form-expense-input" type="number" name="budget" placeholder="Budget" required>
         </div>
         <button class="form-button" type="submit" name="budgetbutton" >Add Budget</button>
       </div>
     </form>
   </div>
   ';

    // expense form
    $expenseform =
    '
    <div class="form-body">
      <form method="post" class="form-form">
        <h2>Expense</h2>
          <div class="form-container">
            <hr>
            <div class="expense-container">
              <label for="item"><strong>Item</strong></label>
              <input class="form-expense-input" type="text" name="item" placeholder="Item" required>
              <label for="cost"><strong>Cost</strong></label>
              <input class="form-expense-input" type="number" name="cost" placeholder="Cost" required>
              <label for="category"><strong>Category</strong></label>
              <select class="form-expense-input" name="category">
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
              <label for="date"><strong>Date</strong></label>
              <input class="form-expense-input" type="date" name="date" placeholder="Date" required>
            </div>
          <button class="form-button" type="submit" name="expensebutton">Add Expense</button>
        </div>
      </form>
    </div>
    ';
 ?>
 <?php

    if(isset($_POST["budgetbutton"], $_POST["category"], $_POST["budget"])
        && is_string($_POST["category"])
        && is_numeric($_POST["budget"])
      ){
        $category = filter_var(trim($_POST["category"]), FILTER_SANITIZE_STRING);
        $budget = filter_var(trim($_POST["budget"]), FILTER_SANITIZE_NUMBER_FLOAT);
        $sql = "SELECT category from budget where category='" . $category . "' and userID='" . $userID . "' LIMIT 1;";
        $check = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        if (empty($check)){
          $sql = "INSERT INTO budget (category, budget, userID) VALUES ('" . $category ."', '" . $budget . "', '" . $userID ."');";
          $db->exec($sql);
        }
        else {
          if($budget!=0.00){
            $sql = "UPDATE budget SET budget='" . $budget ."' WHERE category='" . $category ."' and userID='" . $userID . "';";
            $db->exec($sql);
          }
          else{
            $sql = "DELETE FROM budget WHERE category='" . $category ."' and userID='" . $userID . "';";
            $db->exec($sql);
          }
        }
      }

    if(isset($_POST["expensebutton"], $_POST["item"], $_POST["cost"], $_POST["category"], $_POST["date"])
        && is_string($_POST["item"])
        && is_numeric($_POST["cost"])
        && is_string($_POST["category"])
        && is_string($_POST["date"])
      ){
        $item = filter_var(trim($_POST["item"]),FILTER_SANITIZE_STRING);
        $cost = filter_var(trim($_POST["cost"]),FILTER_SANITIZE_NUMBER_FLOAT);
        $category = filter_var(trim($_POST["category"]),FILTER_SANITIZE_STRING);
        $date = filter_var(trim($_POST["date"]), FILTER_SANITIZE_STRING);
        $sql = "INSERT INTO expense (item, cost, category, dt, userID) VALUES ('" . $item ."', '" . $cost . "', '" . $category . "', '" . $date . "', '" . $userID ."');";
        $db->exec($sql);
      }

  ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <?php require_once './layouts/head.php'; ?>
   <body>
     <?php require_once './layouts/nav.php'; ?>

    <h1>Add Or Update Your Category Budgets:</h1>

    <?php echo $budgetform; ?>

    <br>

    <h1>Add Your Expenses:</h1>

    <?php echo $expenseform; ?>

    <br>

   </body>
 </html>
