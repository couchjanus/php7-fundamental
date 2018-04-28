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
                    <div class="panel-title"><h3><?= $title;?></h3></div>
                    <a href="/admin/roles/create"><button class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus-sign"></i> Add New</button></a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Role Name</th>
                              <th>Action</th>
                            </tr>
                          </thead>

                          <tbody class="table-items">
                          <?php foreach ($roles as $role):?>
                            <tr>
                              <td><?php echo $role['id']?></td>
                              <td><?php echo $role['name']?></td>
                              <td>
                              <button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i> View</button>
                              <a href="/admin/roles/edit/<?= $role['id']?>">
                                <button class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i> Edit</button>
                              </a>
                              
                              <a href="/admin/roles/delete/<?= $role['id']?>">
                                <button class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Delete</button>
                              </a>
                              </td>
                            </tr>
                            <?php endforeach;?>
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
<?php
require_once VIEWS.'shared/admin/footer.php';
