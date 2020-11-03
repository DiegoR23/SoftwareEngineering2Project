<?php
require_once 'password.php';
$dsn = "mysql"host=127.0.0.1; dbname=expensetracker";
$db = new PDO($dsn, "root", $password);
 ?>
