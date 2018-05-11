<?php 
require_once VIEWS.'shared/head.php';
require_once VIEWS.'shared/navigation.php';
;?>
<div class="cf"></div>
<div class="breadcrumb"><?= $breadcrumb;?></div>

<div class="content-wrap">
  <?php
  printf("<h1 style='color: #%x%x%x'>%s</h1>", 165, 27, 45, $title);
  ?>
        <?php if(!empty($data['emailSent'])): ?>
            <div class="col-6">
                <div class="alert alert-success text-center"><?php echo $data['form']->get('messages.success'); ?></div>
            </div>
        <?php else: ?>
            <?php if(!empty($data['hasError'])): ?>
            <div class="col-6">
                <div class="alert alert-danger text-center"><?php echo $data['form']->get('messages.error'); ?></div>
            </div>
            <?php endif; ?>

        <div class="col-12">
            <form action="" enctype="application/x-www-form-urlencoded" id="contact-form" class="form-horizontal" method="post">
                <div class="form-group col-12">
                    <label for="form-name" class="col-2 control-label"><?php echo $data['form']->get('fields.name'); ?></label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="form-name" name="form-name" placeholder="<?php echo $data['form']->get('fields.name'); ?>" required>
                    </div>
                </div>
                <div class="form-group col-12">
                    <label for="form-email" class="col-2 control-label"><?php echo $data['form']->get('fields.email'); ?></label>
                    <div class="col-10">
                        <input type="email" class="form-control" id="form-email" name="form-email" placeholder="<?php echo $data['form']->get('fields.email'); ?>" required>
                    </div>
                </div>
                <div class="form-group col-12">
                    <label for="form-phone" class="col-2 control-label"><?php echo $data['form']->get('fields.phone'); ?></label>
                    <div class="col-10">
                        <input type="tel" class="form-control" id="form-phone" name="form-phone" placeholder="<?php echo $data['form']->get('fields.phone'); ?>">
                    </div>
                </div>
                <div class="form-group col-12">
                    <label for="form-subject" class="col-2 control-label"><?php echo $data['form']->get('fields.subject'); ?></label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="form-subject" name="form-subject" placeholder="<?php echo $data['form']->get('fields.subject'); ?>" required>
                    </div>
                </div>
                <div class="form-group col-12">
                    <label for="form-message" class="col-2 control-label"><?php echo $data['form']->get('fields.message'); ?></label>
                    <div class="col-10">
                        <textarea class="form-control" rows="3" id="form-message" name="form-message" placeholder="<?php echo $data['form']->get('fields.message'); ?>" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-10">
                        <button type="submit" class="submit"><?php echo $data['form']->get('fields.btn-send'); ?></button>
                    </div>
                </div>
            </form>
        </div>
        <?php endif; ?>


</div>

<!-- Page End -->
<div class="cf"></div>

<script src="/js/contact-form.js"></script>
<script type="text/javascript">
    new ContactForm('#contact-form');
</script>

<?php 
require_once VIEWS.'shared/aside.php';
require_once VIEWS.'shared/footer.php';
require_once VIEWS.'shared/scripts.php';

?>

</body>
</html>
