<?php
require_once VIEWS.'shared/head.php';
require_once VIEWS.'shared/navigation.php';

printf("<h1 style='color: #%x%x%x'>%s</h1>", 165, 27, 45, $title);

?>

<div class="grid-layout">
  <?php
    if ($rowCount>0) {
        echo "<h3>$rowCount posts found:</h3> ";


        foreach ($posts as $row) {
          echo "<div class='top'>".$row["title"]."</div>";
          echo "<div class='content'>".strip_tags($row["content"])."</div>";
          echo "<div class='added_at'> At: ".strip_tags($row["created_at"])."</div>";
        }
    }
    else {
      echo "No posts found.... ";
    }
?>

</div>
<!-- Page End -->
<div class="cf"></div>
<?php require_once VIEWS.'shared/footer.php';
