<?php require_once VIEWS.'shared/admin/header.php'; ?>
<div class="page-content">
    <div class="row">
        <div class="col-md-3">
            <?php require_once VIEWS.'shared/admin/_aside.php';?>
        </div>
        <div class="col-md-9">
            <div class="content-box-large">
                <div class="panel-heading">
                    <div class="panel-title"><h3><?= $title;?></h3></div>
                    <a href="/admin/orders"><button class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus-sign"></i> Go Back</button></a>
                </div>

                <div class="panel-body">
                    <div class="table-responsive">
                    <h3>Просмотр заказа #<?php echo $order['id'];?></h3>
                    <h4>Информация о заказе</h4>

        <table class="table">
        <tbody class="table-items">
            <tr>
                <td>Номер заказа :</td>
                <td><?php echo $order['id'];?></td>
            </tr>

            <tr>
                <td>Имя клиента:</td>
                <td><?php echo $user['first_name'].' '.$user['last_name'];?></td>
            </tr>

            <tr>
                <td>Телефон клиента :</td>
                <td><?php echo $user['phone_number'];?></td>
            </tr>

            <tr>
                <td>ID клиента :</td>
                <td><?php echo $order['user_id'];?></td>
            </tr>

            <tr>
                <td>Дата заказа :</td>
                <td><?php echo $order['order_date'];?></td>
            </tr>

            <tr>
                <td>Статус заказа :</td>
                <td><?php echo Order::getStatusText($data['order']['status']);?></td>
            </tr>
            </tbody>
        </table>

        <h3>Товары в заказе</h3>

        <table class="table">

            <tr>
                <th>ID товара</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Количество</th>
            </tr>
            <tbody class="table-items">
            <?php $i=0; foreach ($data['products'] as $product):?>
                <tr>
                    <td><?php echo $product['id']?></td>
                    <td><?php echo $product['name'];?></td>
                    <td><?php echo $product['price'];?></td>
                    <td><?php echo $data['pQuantity'][$i][$product['id']]; $i++;?></td>
                    <td><?php print_r($data['pQuantity']);?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
                        
                        
                        
                    </div>
                </div>
            </div>
            </div>
        </div>
      </div>
<?php
require_once VIEWS.'shared/admin/footer.php';


