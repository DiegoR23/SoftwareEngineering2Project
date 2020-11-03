<?php
require_once './includes/inc.php';

// code to signup user
if(isset($_POST["signup"], $_POST["username"], $_POST["password"])
    && is_string($_POST["username"])
    && (check_password($_POST["password"]))
    && $_POST["signup"] == $_SESSION["rand"]
  ){
    $username = filter_var(trim($_POST["username"]), FILTER_SANITIZE_STRING);
    $password = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT);
    $sql = "INSERT INTO user (username, password) VALUES ('" . $username . "', '" . $password . "');";
    $db->exec($sql);
    $alert_message = "Account Created";
    echo "<pre>";
    var_dump($_SESSION);
    echo "</pre>";
}
else{
  $alert_message = "Account not created";
}

$rand = $_SESSION["rand"] = rand(100000, 999999);
if(isset($_POST["login"], $_POST["username"], $_POST["password"])
   && filter_var($_POST["username"])
   && (check_password($_POST["password"]))
){
  $username = filter_var(trim($_POST["username"]), FILTER_SANITIZE_STRING);
  $password = trim($_POST["password"]);
  $sql = "SELECT * FROM user WHERE username='" . $username ."' LIMIT 1;" ;
  echo $sql;
  $user = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  if(empty($user)){
    $_SESSION["alert_message"] = "User not found";
  }else{
    echo "<pre>";
    var_dump($_SESSION);
    echo "</pre>";
    if(password_verify($password, $user[0]["password"])){
      $_SESSION["is_signed_in"] = true;
      header("Location: expenses.php");
    }
    else {
      $_SESSION["alert_message"] = "User not found";
    }
  }
}
if(isset($_POST["logout"])){
  $_SESSION["is_signed_in"] = false;
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
  <h1>Login or Signup</h1>
  <?php if (!(isset($_SESSION["is_signed_in"]) && $_SESSION["is_signed_in"] == true)){ ?>
    <h2>Signup</h2>
    <form method="post">
      <input type="text" name="username" placeholder="UserName" required>
      <input type="password" name="password" placeholder="Password (Must not be Empty or all spaces)" required>
      <button type="submit" name="signup" value="<?php echo $rand; ?>" >Signup</button>
    </form>
    <hr>
    <h2>Login</h2>
    <form method="post">
      <input type="text" name="username" placeholder="UserName" required>
      <input type="password" name="password" placeholder="Password (Must not be Empty or all spaces)" required>
      <button type="submit" name="login" >Login</button>
    </form>
  <?php }else{ ?>
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
