<?php
require_once VIEWS.'shared/head.php';
require_once VIEWS.'shared/navigation.php';
?>

<!-- Conatiner profile Start -->
<div class="grid-container">
    <div class="column row">
        <h2 class="feature_title"><?= $title;?></h2>
        <h4 class="feature_sub"><?= $subtitle; ?></h4>
    </div> 
    <div class="column">
        <?php
            require_once VIEWS.'profile/_aside.php';
        ?>
    </div>
    <div class="column">
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Дата заказа</th>
                    <th>Статус</th>
                    <th>Товары в заказе</th>
                </tr>
            </thead>
            <tbody class="table-items">
                <tr>
                    <td><?php echo $order['id']?></td>
                    <td><?php echo $order['order_date']?></td>
                    <td><?php echo Order::getStatusText($order['status']);?></td>
                    <td><?php 
                    $totalValue = 0;
                    foreach ((array)$products as $product) :
                        echo "<a href=/catalog/".$product['Id'].">".$product['Product']."</a></br>";
                        echo "<span>Кол-во: </span>" . $product['Quantity'].'</br>';
                        echo '<span>Цена: </span>' . $product['Price']. ' грн</br>';
                        echo '<span>Picture: </span><img src="' . $product['Picture']. '"></br>';
                        //подсчитываем сумму по каждому товару и пишем в массив
                        $arr[] = $product['Price'] * $product['Quantity'];

                        //считаем общую сумму всех товаров в заказе, с учетом их кол-ва
                        $totalValue = array_sum($arr);
                                
                    endforeach; 
                    ?>
                    </td>
                </tr>
                    
                <tr class="total_price">
                    <td colspan="4"><?php echo '<span>Сумма заказа: ' . $totalValue.' грн</span>';?></td>
                </tr>
                <?php
                    //Очищаем массив
                    $arr = array();
                ?>
            </tbody>
        </table>
    </div>
</div> <!-- Conatiner product end -->

<!-- Our product End -->
<div class="clearfix"></div>

<?php require_once VIEWS.'shared/footer.php';
