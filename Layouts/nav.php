<?php
  $this_page = basename($_SERVER["PHP_SELF"]);
  $html =
  '
  <a href="index.php">Login</a>
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
  $html = $dom->saveHTML();
?>
<nav>
  <?php echo $html; ?>
</nav>
