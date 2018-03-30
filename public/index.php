<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <?php
    /** 
     * Hello World
    */
    
       echo ("Hello World");
    ?>

    <h1>Это <?php # echo "простой";?> пример</h1>
    <p>Заголовок вверху выведет 'Это пример'.</p>
    'C'-комментарии заканчиваются при первой же обнаруженной последовательности */.
    <?php
        echo "Это тест\n"; /* Этот комментарий вызовет проблему */
    /* 
        
    */
    // phpinfo();
    echo "<br>Имя сервера - ".$_SERVER['SERVER_NAME']."<br />"; 
    echo "IP-адрес сервера - ".$_SERVER['REMOTE_ADDR']."<br />"; 
    echo "Порт сервера - ".$_SERVER['SERVER_PORT']."<br />"; 
    echo "Web-сервер - ".$_SERVER['SERVER_SOFTWARE']."<br />"; 
    echo "Версия HTTP-протокола - ".$_SERVER['SERVER_PROTOCOL']."<br />"; 

    // $_SERVER['DOCUMENT_ROOT']	/home/janus/www/php7-fundamental/public
    
    
    // $_SERVER['SERVER_SOFTWARE']	PHP 7.2.3-1+ubuntu16.04.1+deb.sury.org+1 Development Server
    // $_SERVER['SERVER_PROTOCOL']	HTTP/1.1
    
    // $_SERVER['REQUEST_URI']	/
    // $_SERVER['REQUEST_METHOD']	GET
    // $_SERVER['SCRIPT_NAME']	/index.php
    // $_SERVER['SCRIPT_FILENAME']	/home/janus/www/php7-fundamental/public/index.php
    // $_SERVER['PHP_SELF']	/index.php
    // $_SERVER['HTTP_HOST']	127.0.0.1:8000
    // $_SERVER['HTTP_USER_AGENT']	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:59.0) Gecko/20100101 Firefox/59.0
    // $_SERVER['HTTP_ACCEPT']	text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8
    // $_SERVER['HTTP_ACCEPT_LANGUAGE']	en-US,en;q=0.5
    // $_SERVER['HTTP_ACCEPT_ENCODING']	gzip, deflate
    


    echo("<br> SERVER_NAME: ");
    echo "http://".$_SERVER['SERVER_NAME']; 
    echo("<br> REQUEST_URI: ");
    echo $_SERVER['REQUEST_URI']; 
    echo("<br> URL: ");
    echo "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; 
    echo("<br>");


    if ($_SERVER['REQUEST_URI']=='/') {
        echo "<h1>Home Page</h1>";
        echo $_SERVER['REQUEST_URI'];
    }
    else if ($_SERVER['REQUEST_URI']=='/about') {
        echo "<h1>About Page</h1>";
    }
    else {
        echo $_SERVER['REQUEST_URI'];
        echo "<h1>404</h1>";
    }

    // switch ($_SERVER['REQUEST_URI']) {
    //     case '/':
    //         # code...
    //         require_once 'home.php';
    //         break;
    //     case '/about':
    //         # code...
    //         require_once 'about.php';
    //         break;
    //     default:
    //         # code...
    //         echo $_SERVER['REQUEST_URI'];
    // }

    
    echo ($_SERVER['REQUEST_URI']=='/') ? "<h1>Home Page</h1>" : "<h1>404</h1>";

    
    ?>

    <?php if ($_SERVER['REQUEST_URI']=='/') : ?>
        <h1>Home Page</h1>
    <?php elseif ($_SERVER['REQUEST_URI']=='/about') : ?>
        <h1>About Page</h1>
    <?php else : ?>
        <h1>404</h1>
    <?php endif;?>
    
</body>
</html>

