<head>
  <meta charset="utf-8">
  <title>ExpenseTracker</title>
  <link rel="stylesheet" href="./frontend/master.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">

     google.charts.load('current', {'packages':['corechart']});
     <?php if(isset($_SESSION['displayreport']) && $_SESSION['displayreport']==true){ ?>
       google.charts.setOnLoadCallback(drawChart);
     <?php $_SESSION['displayreport']=false; $_SESSION['activatereport']=true; } ?>

     function drawChart(){

       var data = google.visualization.arrayToDataTable([
         ["Category", "Spent"],
         <?php
         if(!empty($result2)){
           while($row2 = $result2->fetch(PDO::FETCH_ASSOC)){
             echo "['" . $row2['category'] . "', " . $row2['spent'] . " ],";
           }
         }
         ?>
       ]);
       <?php
          if(isset($_SESSION['year']) && isset($_SESSION['month'])){
            $year = $_SESSION['year'];
            $month = $_SESSION['month'];
            $nameOfMonth = [
              "1" => "January",
              "2" => "Febuary",
              "3" => "March",
              "4" => "April",
              "5" => "May",
              "6" => "June",
              "7" => "July",
              "8" => "August",
              "9" => "September",
              "10" => "October",
              "11" => "November",
              "12" => "December",
            ];
          }
        ?>
       var options = {
         title: 'Expenses for <?php echo $nameOfMonth[$month] ?> of <?php echo $year ?>',
         // is3D: true,
         width: 800,
         height: 500,
         pieHole: 0.5,
         pieSliceTextSytel: {
           color: 'black',
         },
       };
       var chart = new google.visualization.PieChart(document.getElementById('piechart'));
       chart.draw(data, options);
     }
  </script>
</head>
