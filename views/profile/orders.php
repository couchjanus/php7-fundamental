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
            
                    <div class="panel-body">
                    <?php if(count($orders)>0):?>
                      <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                <th>#</th>
                                <th>Дата оформления</th>
                                <th>Статус заказа</th>
                                <th>Action</th>
                                </tr>
                            </thead>

                          <tbody class="table-items">
                            <?php foreach ($orders as $order):?>
                              <tr>
                                <td><?= $order['id']?></td>
                                <td><?= $order['formated_date']?></td>

                                <td><?php echo Order::getStatusText($order['status']);?></td>

                                <td>
                                <a title="Show order" href="/profile/orders/view/<?= $order['id']?>">
                                <button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i> View</button></a>

                                <a title="Edit Order" href="/profile/orders/edit/<?= $order['id']?>">
                                <button class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i> Edit</button></a>

                                <a title="Delete Order" href="/profile/orders/delete/<?= $order['id']?>">
                                <button class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Delete</button></a></td>
                              </tr>
                            <?php endforeach;?>
                          </tbody>
                        </table>
                      </div>
                    <?php endif;?>
            
            </div>
    </div> <!-- Conatiner product end -->

<!-- Our product End -->
<div class="clearfix"></div>

<?php require_once VIEWS.'shared/footer.php';
