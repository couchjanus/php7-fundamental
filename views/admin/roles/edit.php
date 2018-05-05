<?php
require_once VIEWS.'shared/admin/header.php';
?>
<div class="page-content">
  <div class="row">
    <div class="col-md-3">
      <?php
        require_once VIEWS.'shared/admin/_aside.php';
      ?>
    </div>
    <div class="col-md-9">
      <div class="content-box-large">
        <div class="panel-heading">
          <div class="panel-title"><?= $title;?></div>
          <div class="panel-options">
            <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
            <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
          </div>
        </div>

        <form class="form-horizontal" role="form" method="POST">
          <div class="panel-body">
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">Role Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="title" name="name" value="<?= $role['name']?>">
              </div>
            </div>

            <div class="form-group">
                <?php foreach ($permissions as $permission):?>
                    <input type="checkbox" class="form-control" name="check_list[]" value="<?=$permission['id']?>" <?=in_array($permission['id'], $perms)?'checked':'';?>><label class="col-sm-2 control-label" ><?=$permission['name']?></label>
                <?php endforeach;?>
            </div>
           
            <hr>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button id="save" type="submit" class="save btn btn-primary">Update Role</button>
              </div>
            </div>
          </form>
        </div>
    </div>
  </div>
</div>

<?php
require_once VIEWS.'shared/admin/footer.php';
