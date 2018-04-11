<?php
require_once VIEWS.'shared/head.php';
require_once VIEWS.'shared/navigation.php';
?>

<!-- Page Start -->
<?php
    printf("<h1 style='color: #%x%x%x'>Cat's GuestBook</h1>", 165, 27, 45);
?>
<div class="grid-layout">
        <form class="cf" method = "POST">
            <div class="half left cf">
                <input  name="username" type="text" id="input-name" placeholder="Name">
                <input  name="email" type="email" id="input-email" placeholder="Email address">
            </div>
            <div class="half right cf">
              <textarea name="message" type="text" id="input-message" placeholder="Message"></textarea>
            </div>
            <input type="submit" value="Submit" id="input-submit">
        </form>
</div>
<!-- Page End -->
<div class="cf"></div>

<?php


// print_r($comments);


if ($rowCount>0) {
    echo "<h3>$rowCount comments:</h3> ";

    foreach ($comments as $row) {
      echo "<div class='top'><b>User ".$row["username"]."</b> <a href='mailto:".$row["email"]."'>".$row["email"]."</a> Added this </div>";
      echo "<div class='comment'>".strip_tags($row["comment"])."</div>";
      echo "<div class='added_at'> At: ".strip_tags($row["created_at"])."</div>";
    }
}
else {
  echo "No comments.... ";
}


?>

<?php require_once VIEWS.'shared/footer.php';
