<?php
require_once './includes/inc.php';
require_once './layouts/forms.php';

// user signup
if(isset($_POST["signup"], $_POST["email"], $_POST["password"])
    && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)
    && (check_password($_POST["password"]))
  ){
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $password = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT);
    $sql = "SELECT email from user where email='" . $email ."' LIMIT 1;" ;
    $user = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    if(empty($user)){
      $sql = "INSERT INTO user (email, password) VALUES ('" . $email . "', '" . $password . "');";
      $db->exec($sql);
    }else{
      echo '<script type="text/javascript"> alert("Account Already Exists") </script>';
    }
  }

// user login
if(isset($_POST["login"], $_POST["email"], $_POST["password"])
   && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)
   && (check_password($_POST["password"]))
){
  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $password = trim($_POST["password"]);
  $sql = "SELECT * FROM user WHERE email='" . $email ."' LIMIT 1;" ;
  $user = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  if(empty($user)){
    echo '<script type="text/javascript"> alert("Account Credentials Are Incorrect") </script>';
  }else{
    if(password_verify($password, $user[0]["password"])){
      $_SESSION["is_loged_in"] = true;
      $_SESSION['user'] = $user[0]["userID"];
      header("Location: expenses.php");
    }else{
      echo '<script type="text/javascript"> alert("Account Credentials Are Incorrect") </script>';
    }
  }
}

// user logout
if(isset($_POST["logout"])){
  $_SESSION["is_loged_in"] = false;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <?php require_once './layouts/head.php'; ?>
  <body class="index-body">
    <?php require_once './layouts/nav.php'; ?>

    <div class="info-container">
      <div class="image">
          <img src="./images/logo.png" alt="Website Logo">
      </div>
    </div>
    <div class="about">
      <p>Our expense tracking web application will provide you with the
        ability to input your expenses and set budgets for different
        categories of expenses. The application will then provide you with a clean
        and easy-to-read report page; showing the user how much money was
        allocated to different expense categories, how much was spent, and if you
        went over or under or sticked to your budget. Login or signup to start.</p>
    </div>


    <?php if (!(isset($_SESSION["is_loged_in"]) && $_SESSION["is_loged_in"] == true)){ ?>
      <h1>Login or Signup</h1>

      <!-- user login form -->
      <?php echo $loginForm; ?>

      <br>
      <br>

      <!-- user signup form -->
      <?php echo $signupForm; ?>

    <?php }else{ ?>

         <br>
         <br>

         <!-- user logout form -->
         <?php echo $logoutForm; ?>

 <?php } ?>

  <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
  </script>

  </body>
</html>
