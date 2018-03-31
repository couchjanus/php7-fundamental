<?php
        
    // phpinfo(); // include_path	.:/usr/share/php
       
    echo ini_get('include_path');
       
    // Пример использования get_include_path()   
    echo get_include_path();


    echo ("PATH_SEPARATOR: " . PATH_SEPARATOR);
    echo "<h2>__DIR__</h2>";
    echo realpath(__DIR__);

    // Получение временной зоны по умолчанию

    echo "<h2>Get date default timezone</h2>";

    echo date_default_timezone_get();

    echo "<h2>Set date default timezone</h2>";

    date_default_timezone_set('Europe/Kiev');
    
    if (date_default_timezone_get()) {
        echo 'date_default_timezone_set: ' . date_default_timezone_get() . '<br />';
    }
    echo "<h2>Get date timezone from php.ini</h2>";

    if (ini_get('date.timezone')) {
        echo 'date.timezone: ' . ini_get('date.timezone');
    }

    echo "<h2>Get display errors</h2>";

    echo ini_get('display_errors');
    
    echo "<h2>Set display errors</h2>";
    if (!ini_get('display_errors')) {
        ini_set('display_errors', '1');
    }    

    echo ini_get('display_errors');


    echo '<h3>DIRECTORY_SEPARATOR (string)</h3>';
    echo DIRECTORY_SEPARATOR;

    echo '<h3>PATH_SEPARATOR (string)</h3>';
    echo PATH_SEPARATOR;

    echo '<h3>SCANDIR_SORT_ASCENDING (integer)</h3>';
    echo SCANDIR_SORT_ASCENDING;    
    echo '<h3>SCANDIR_SORT_DESCENDING (integer)</h3>';
    echo SCANDIR_SORT_DESCENDING;    
    echo '<h3>SCANDIR_SORT_NONE (integer)</h3>';
    echo SCANDIR_SORT_NONE;
   

    // require_once ('Foo.class.php');
    // 127.0.0.1:36012 [500]: /- require_once(): 
    // Failed opening required 'Foo.class.php' 
    // (include_path='.:/usr/share/php') 
    // in /home/janus/www/php7-fundamental/public/index.php on line 15
    
    // require_once realpath(__DIR__).'/../bootstrap/bootstrap.php';
