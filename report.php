<?php
require_once './includes/inc.php';

if(!(isset($_SESSION["is_loged_in"]) && $_SESSION["is_loged_in"] == true)){
  header("Location: index.php");
}
 ?>
<?php
  $userID = $_SESSION['user'];

  if(isset($_POST["reportbutton"], $_POST["selectreport"])
    && is_string($_POST["selectreport"])
  ){
    $yearmonth = filter_var(trim($_POST["selectreport"]), FILTER_SANITIZE_STRING);
    $yearmonthsplit = explode(" ", $yearmonth);
    $_SESSION['year'] = $yearmonthsplit[0];
    $_SESSION['month'] = $yearmonthsplit[1];
    $sql2 = "SELECT category, SUM(cost) AS spent from expense WHERE userID='" . $userID . "' AND YEAR(dt)='" . $yearmonthsplit[0] . "' AND MONTH(dt)='" . $yearmonthsplit[1] . "' GROUP BY category;";
    $result2 = $db->query($sql2);
    $_SESSION['displayreport'] = true;
  }
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <?php require_once './layouts/reporthead.php'; ?>
   <body>
      <?php require_once './layouts/nav.php'; ?>

      <h1>Your Expense Report:</h1>

      <br>

    <div class="form-body">
     <form method="post" class="form-form">
       <h2>Expense Report</h2>
       <div class="form-container">
         <hr>
         <div class="expense-container">
           <label for="selectreport"><strong>Select A Report</strong></label>
           <select class="form-expense-input" name="selectreport">
             <option disabled selected value> -- select an option -- </option>
             <?php
               $sql = "SELECT DISTINCT YEAR(dt) AS year, MONTH(dt) as month FROM expense WHERE userID='" . $userID . "' ORDER BY dt DESC;";
               $result = $db->query($sql);
               while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                 if(!empty($row)){
                   echo '<option value="'.$row['year'].' '.$row['month'].'">'.$row['year'].' - '.$row['month'].'</option>';
                 }
               }
             ?>
           </select>
         </div>
         <button class="form-button" type="submit" name="reportbutton" >Get Report</button>
       </div>
      </form>
   </div>

      <br>
      <br>

      <?php if(isset($_POST['reportbutton'], $_SESSION['activatereport']) && $_SESSION['activatereport']==true) { ?>
        <div class="grid-body">
          <div class="grid-container">
            <div id="piechart"></div>
            <div class="expense-report">
              <?php
                $sql = "SELECT SUM(cost) AS total FROM expense WHERE userID='" . $userID . "' AND MONTH(dt)='" . $_SESSION['month'] . "' and YEAR(dt)='" . $_SESSION['year'] . "';";
                $result = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                $total = $result[0]['total'];
                echo "Total spent: $$total";
                echo "<br>";
                echo "<br>";
                echo "Category Budgets: ";
                echo "<br>";
                $sql = "SELECT category, budget FROM budget WHERE userID='" . $userID . "';";
                $result = $db->query($sql);
                if(empty($result)){
                  echo "No Category Budgets Have Been Set";
                  echo "<br>";
                }
                else{
                  while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    $category = $row["category"];
                    $budget = $row["budget"];
                    echo "$category - $$budget";
                    echo "<br>";
                  }
                }
                echo "<br>";
                echo "Category Expenses:";
                echo "<br>";
                $sql = "SELECT category, SUM(cost) AS spent from expense WHERE userID='" . $userID . "' AND YEAR(dt)='" . $_SESSION['year'] . "' AND MONTH(dt)='" . $_SESSION['month'] . "' GROUP BY category;";
                $result = $db->query($sql);
                if(empty($result)){
                  echo "No Expenses";
                }
                else{
                  while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    $category = $row["category"];
                    $spent = $row["spent"];
                    echo "$category - $$spent";
                    echo "<br>";
                  }
                }
                $sql = "SELECT a.category, b.budget, SUM(a.cost) AS spent FROM expense a INNER JOIN (SELECT budget.category, budget.budget FROM budget where userID='" . $userID . "') AS b ON a.category=b.category WHERE a.userID='" . $userID ."' AND YEAR(dt)='" . $_SESSION['year'] . "' AND MONTH(dt)='" . $_SESSION['month'] . "' GROUP BY a.category;";
                $result = $db->query($sql);
                if(!empty($result)){
                  echo "<br>";
                  while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    $category = $row["category"];
                    $budget = $row["budget"];
                    $spent = $row["spent"];
                    $diff = $budget - $spent;
                    if($diff>0){
                      echo "<p class='underspent'>";
                      echo "You underspent in $category by $$diff";
                      echo "</P>";
                    }
                    elseif($diff<0){
                      $diff = -($diff);
                      echo "<p class='overspent'>";
                      echo "You overspent in $category by $$diff";
                    }
                    else{
                      echo "You sticked to you budget for $category";
                    }
                  }
                }
              ?>
            </div>
          </div>
        </div>
      <?php $_SESSION['activatereport']=false; } ?>


   </body>
 </html>
