<?php

// login form
  $loginForm =
  '
  <div class="form-body">
    <form method="post" class="form-form">
      <h2>Login</h2>
      <div class="form-container">
        <hr>
        <div class="container">
          <label for="email"><strong>Email</strong></label>
          <input class="form-input" type="email" name="email" placeholder="Email" required>
          <label for="password"><strong>Password</strong></label>
          <input class="form-input" type="password" name="password" placeholder="Password (Must not be empty or all spaces)" required>
        </div>
        <button class="form-button" type="submit" name="login" >Login</button>
      </div>
    </form>
  </div>
  ';

// signup form
  $signupForm =
  '
  <div class="form-body">
    <form method="post" class="form-form">
      <h2>Signup</h2>
      <div class="form-container">
        <hr>
        <div class="container">
          <label for="email"><strong>Email</strong></label>
          <input class="form-input" type="email" name="email" placeholder="Email" required>
          <label for="password"><strong>Password</strong></label>
          <input class="form-input" type="password" name="password" placeholder="Password (Must not be empty or all spaces)" required>
        </div>
        <button class="form-button" type="submit" name="signup" >Signup</button>
      </div>
    </form>
  </div>
  ';

// logout form
  $logoutForm =
  '
  <div class="form-body">
    <form method="post" class="form-form-logout">
        <h2>Logout</h2>
          <div class="form-container">
            <hr>
            <button class="form-button-logout" type="submit" name="logout">Logout</button>
          </div>
    </form>
  </div>
  ';

// budget form
 $budgetForm =
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
  $expenseForm =
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
