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
            <?php if ($data['res']) :?>
                <h4>Данные успешно изменены!</h4>
            <?php else: ?>
                <?php if (isset($data['errors']) && is_array($data['errors'])) :?>
                    <ul class="errors">
                        <?php foreach($data['errors'] as $error) :?>
                            <li> - <?php echo $error;?></li>
                        <?php endforeach;?>
                    </ul>
                <?php endif;?>

              <form action="#" method="post">
                <h2>Редактирование данных</h2>
                
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input  class="form-controll" required type="text" name="first_name" value="<?= $user['first_name'] ?>">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input  class="form-controll" required type="text" name="last_name" value="<?= $user['last_name'] ?>">
                </div>

                <div class="form-group">
                  <label for="phone_number">Phone Number</label>
                  <input required class="form-control" type="text" name="phone_number" value="<?= $user['phone_number'] ?>">
                </div>
                <div class="form-group">
                  <input type=submit name="submit" value="Сохранить" class="btn btn-primary">
                </div>
              </form>
            <?php endif;?>
        </div>
    </div> 
<!-- Conatiner profile End -->
<div class="clearfix"></div>
<?php
require_once VIEWS.'shared/footer.php';
