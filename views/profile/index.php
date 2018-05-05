<?php
require_once VIEWS.'shared/head.php';
require_once VIEWS.'shared/navigation.php';
?>
<!-- Conatiner profile Start -->
    <div class="grid-container">
        <div class="column row">
            <h2 class="feature_title"><?=$title;?></h2>
            <h4 class="feature_sub">Hello There <?= $user['name']; ?>!</h4>
        </div> 
        <div class="column">
            <?php
                require_once VIEWS.'profile/_aside.php';
            ?>
        </div>
        <div class="column">
            <div class="panel-title"><h2><?= $subtitle;?></h2></div>
        </div>
    </div> 
<!-- Conatiner profile End -->
<div class="clearfix"></div>

<?php require_once VIEWS.'shared/footer.php';
