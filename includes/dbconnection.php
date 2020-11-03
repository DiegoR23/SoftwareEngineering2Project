<?php
require_once 'password.php';

try{
$dsn = "mysql:host=localhost; dbname=expensetracker";
$db = new PDO($dsn, "root", $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
 ?>
