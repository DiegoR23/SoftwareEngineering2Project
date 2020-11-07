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

      <?php if(isset($_POST['reportbutton'], $_SESSION['activatereport']) && $_SESSION['activatereport']==true) { ?>
        <div class="grid-body">
          <div class="grid-container">
            <div id="piechart"></div>
          </div>
        </div>
      <?php $_SESSION['activatereport']=false; } ?>


   </body>
 </html>
