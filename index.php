<?php
require_once './includes/inc.php';

if(isset($_POST["signup"], $_POST["email"], $_POST["password"])
    && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)
    && (check_password($_POST["password"]))
    && $_POST["signup"] == $_SESSION["rand"]
  ){
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $password = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT);
    $sql = "INSERT INTO user (email, password) VALUES ('" . $email . "', '" . $password . "');";
    $db->exec($sql);
    $alert_message = "Account Created";
}else{
  $alert_message = "Account Not Created";
}

$rand = $_SESSION["rand"] = rand(100000, 999999);

if(isset($_POST["login"], $_POST["email"], $_POST["password"])
   && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)
   && (check_password($_POST["password"]))
){
  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $password = trim($_POST["password"]);
  $sql = "SELECT * FROM user WHERE email='" . $email ."' LIMIT 1;" ;
  $user = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  if(empty($user)){
    $_SESSION["alert_message"] = "User not found";
  }else{
    $result = password_verify($password, $user[0]["password"]);
    echo "<pre>";
    var_dump($_SESSION);
    echo "<br>";
    var_dump($result);
    echo "</pre>";
    if(password_verify($password, $user[0]["password"])){
      $_SESSION["is_loged_in"] = true;
      header("Location: expenses.php");
      echo "<pre>";
      var_dump($_SESSION);
      echo "</pre>";
    }else{
      $_SESSION["alert_message"] = "User not found";
    }
  }
}
if(isset($_POST["logout"])){
  $_SESSION["is_loged_in"] = false;
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

  <?php if (!(isset($_SESSION["is_loged_in"]) && $_SESSION["is_loged_in"] == true)){ ?>
    <h1>Login or Signup</h1>
    <h2>Signup</h2>
    <form method="post">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password (Must not be Empty or all spaces)" required>
      <button type="submit" name="signup" value="<?php echo $rand; ?>" >Signup</button>
    </form>
    <hr>
    <h2>Login</h2>
    <form method="post">
    <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password (Must not be Empty or all spaces)" required>
      <button type="submit" name="login" >Login</button>
    </form>
  <?php }else{ ?>
    <h1>Logout</h1>
      <form method="post">
        <button type="submit" name="logout">Logout</button>
      </form>
  <?php } ?>
  <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
  </script>

  </body>
</html>
