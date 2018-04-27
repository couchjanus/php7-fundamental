<?php

/**
 *Контроллер для просмотра и управления списком всех товаров, имеющихся в базе
*/

class ProductsController extends Controller
{
    private $_resource = 'products';

    /**
     * Просмотр всех товаров
     * @return bool
    */
    public function index()
    {
        $data['products'] = Product::index();
        $data['title'] = 'Admin Product List Page ';
        $this->_view->render('admin/products/index', $data);
    }

    /**
     * Добавление товара
     *
     * @return bool
    */
    public function create()
    {
        $data['title'] = 'Admin Product Add New Product ';
        $data['categories'] = Category::index();
        $this->_view->render('admin/products/create', $data);
    }

    /**
     * Сохранение товара
     *
     * @return bool
    */
    public function store()
    {
        //Принимаем данные из формы
        $options['name'] = trim(strip_tags($_POST['name']));
        $options['price'] = trim(strip_tags($_POST['price']));
        $options['category'] = trim(strip_tags($_POST['category']));
        $options['brand'] = trim(strip_tags($_POST['brand']));
        $options['description'] = trim(strip_tags($_POST['description']));
        $options['is_new'] = trim(strip_tags($_POST['is_new']));
        $options['status'] = trim(strip_tags($_POST['status']));
      
        Product::store($options);
            
            if (isset($_FILES['image'])) {
                //Каталог загрузки картинок
                $uploadDir = 'media';
                    
                //Вывод ошибок
                $errors = array();
                // pathinfo — Возвращает информацию о пути к файлу
                $type = pathinfo($_FILES['image']['name']);
                $file_ext = strtolower($type['extension']);

                $expensions= array("jpeg","jpg","png",'gif');
                //Определяем типы файлов для загрузки
                $fileTypes = array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif'
                );

                //Проверяем пустые данные или нет
                if (empty($_FILES)) {
                    $errors[] = 'File name must have name';
                } elseif ($_FILES['image']['error'] > 0) {
                    // Проверяем на ошибки
                    $errors[] = $_FILES['image']['error'];
                } elseif ($_FILES['image']['size'] > 2097152) {
                    // если размер файла превышает 2 Мб
                    $errors[] = 'File size must be excately 2 MB';
                } elseif (in_array($file_ext, $expensions)=== false) {
                    $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
                } elseif (!in_array($_FILES['image']['type'], $fileTypes)) {
                    // Проверяем тип файла
                    $errors[] = 'Запрещённый тип файла';
                }
                
                if (empty($errors)) {
                
                    $type = pathinfo($_FILES['image']['name']);
                    $name = uniqid('files_') .'.'. $type['extension'];
                    move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir.'/'.$name);
                   
                    $opts['filename'] = $name;
                    $opts['resource_id'] = (int)Product::lastId();
                    $opts['resource'] = $this->_resource;
                    Picture::store($opts);
    
                } else {
                    print_r($errors);
                }
            }

            $this->redirect('/admin/products');
    }

    /**
     * Редатирование товара
     *
     * @param $id
     * @return bool
    */
    public function edit($vars)
    {
        //Получаем информацию о выбранном товаре
        extract($vars);
        $product = Product::getProductById($id);

        //Принимаем данные из формы
        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));
            $options['price'] = trim(strip_tags($_POST['price']));
            $options['category'] = trim(strip_tags($_POST['category']));
            $options['brand'] = trim(strip_tags($_POST['brand']));
            $options['description'] = trim(strip_tags($_POST['description']));
            $options['is_new'] = trim(strip_tags($_POST['is_new']));
            $options['status'] = trim(strip_tags($_POST['status']));
            Product::update($id, $options);
            header('Location: /admin/products');
        }
      
        $data['product'] = Product::getProductById($id);
        $data['categories'] = Category::index();
        $data['title'] = 'Admin Product Edit Page ';
        $this->_view->render('admin/products/edit', $data);
        
    }

    public function delete($vars)
    {
        extract($vars);

        if (isset($_POST['submit'])) {

            Product::destroy($id);
            $this->redirect('/admin/products');
          
        } elseif (isset($_POST['reset'])) {
            $this->redirect('/admin/products');            
        }

        $data['title'] = 'Admin Delete Product ';
        $data['product'] = Product::getProductById($id);
        $this->_view->render('admin/products/delete', $data);
    }

    public function show($vars)
    {
        extract($vars);
        $data['title'] = 'Admin Show Product ';
        $data['product'] = Product::getProductById($id);
        $data['picture'] = Picture::getPictureById($id, $this->_resource);
        $this->_view->render('admin/products/show', $data);

    }

}
