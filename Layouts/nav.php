<?php
  $this_page = basename($_SERVER["PHP_SELF"]);
  $html =
  '
  <a id="login" href="index.php">Login</a>
  <a href="expenses.php">Expenses</a>
  <a href="report.php">Report</a>
  ';
  $dom = new DOMDocument();
  $dom->loadHTML($html);
  $anchor_tags = $dom->getElementsByTagName("a");
  foreach ($anchor_tags as $anchor_tag) {
    if($anchor_tag->getAttribute("href") == $this_page){
      $anchor_tag->setAttribute("class", "this-page");
      break;
    }
  }
  if($_SESSION["is_loged_in"]==true){
    $login = $dom->getElementbyId("login");
    $login->textContent = "Logout";
  }
  $html = $dom->saveHTML();
?>
<div class="navigation">
  <nav>
    <?php echo $html; ?>
  </nav>
</div>
