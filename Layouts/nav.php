<?php
  $this_page = basename($_SERVER["PHP_SELF"]);
  $html =
  '
  <a href="index.php">Home</a>
  <a href="about.php">About</a>
  <a href="privatecontents.php">Private</a>
  <a href="me.php">Me</a>
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
