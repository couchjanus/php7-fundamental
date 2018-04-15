<?php

class ProductsController extends Controller 
{

    public function index()
    {
      $pdo = Connection::makeConnection();
      $products = [];
      $stmt = $pdo->query("SELECT * FROM products");
      $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $rowCount = $stmt->rowCount();
      $data['rowCount'] = $rowCount;
      $data['products'] = $products;
      $data['title'] = 'Admin products Page ';

      $this->_view->render('admin/products/index', $data);
    }


    public function create()
    {
      //Принимаем данные из формы
      if (isset($_POST) and !empty($_POST)) {

        $pdo = Connection::makeConnection();
        // sql
        $stmt = $pdo->prepare("INSERT INTO products (name, category_id, status, price, brand, description) VALUES (?, ?, ?, ?, ?, ?)");
        ## Повторяющиеся вставки в базу с использованием подготовленных запросов
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $category_id);
        $stmt->bindParam(3, $status);
        $stmt->bindParam(4, $price);
        $stmt->bindParam(5, $brand);
        $stmt->bindParam(6, $description);
        // $stmt->bindParam(7, $is_new);

        $name = trim(strip_tags($_POST['name']));
        $category_id = trim($_POST['category_id']);
        $status = trim(strip_tags($_POST['status']));
        $price = trim(strip_tags($_POST['price']));
        $brand = trim($_POST['brand']);
        $description = trim(strip_tags($_POST['description']));
        $is_new = $_POST['is_new'];

        $stmt->execute();
        header('Location: /admin/products');
      }
      $data['title'] = 'Admin Add products ';
      $this->_view->render('admin/products/create', $data);
  }

}
