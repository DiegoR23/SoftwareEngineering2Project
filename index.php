<?php
//require_once './includes/inc.php';

if(isset($_POST["signup"], $_POST["username"], $_POST["password"])
    && is_string($_POST["username"])
    && (check_password($_POST["password"]))
    && $_POST["signup"] == $_SESSION["rand"]
  ){
    $username = filter_var(trim($_POST["username"]), FILTER_SANITIZE_STRING);
    $password = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password) VALUES ('" . $username . "', '" . $password . "');";
    $db->exec($sql);
    $alert_message = "Account Created";
}
else{
  $alert_message = "Account not created";
}

$rand = $_SESSION["rand"] = rand(100000, 999999);
if(isset($_POST["signin"], $_POST["username"], $_POST["password"])
   && filter_var($_POST["username"])
   && (check_password($_POST["password"]))
){
  $username = filter_var(trim($_POST["username"]);
  $password = trim($_POST["password"]);
  $sql = "SELECT * FROM user WHERE username='" . $username ."' LIMIT 1;" ;
  $user = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  if(empty($user)){
    $_SESSION["alert_message"] = "User not found";
  }else{
    if(password_verify($password, $user[0]["password"])){
      $_SESSION["is_signed_in"] = true;
      header("Location: expenses.php");
    }else{
      $_SESSION["alert_message"] = "User not found";
    }
  }
}
if(isset($_POST["signout"])){
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


  </body>
</html>
