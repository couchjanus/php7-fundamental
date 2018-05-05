<?php
include_once VIEWS.'shared/admin/header.php';
?>
    <div class="page-content">
      <div class="row">
      <div class="col-md-3">
        <?php
          include_once VIEWS.'shared/admin/_aside.php';
        ?>

      </div>
      <div class="col-md-9">
        <div class="content-box-large">
                <div class="panel-heading">
                    <div class="panel-title"><h3><?= $title;?></h3></div>
                    <a href="/admin/permissions/create"><button class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus-sign"></i> Add New</button></a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Action</th>
                            </tr>
                          </thead>


                          <tbody class="table-items">
                          <?php foreach ($permissions as $permission):?>
                            <tr>
                              <td><?php echo $permission['id']?></td>
                              <td><?php echo $permission['name']?></td>

                              <td>
                              <button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i> View</button>
                              <a href="/admin/permissions/edit/<?php echo $permission['id']?>"><button class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i> Edit</button></a>
                              <a href="/admin/permissions/delete/<?php echo $permission['id']?>"><button class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Delete</button></a></td>
                            </tr>
                            <?php endforeach;?>

                          </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
            </div>


<?php
include_once VIEWS.'shared/admin/footer.php';
