<?php

// Общие настройки
declare(strict_types=1);
// Устанавливаем временную зону по умолчанию

if (function_exists('date_default_timezone_set')) {
    date_default_timezone_set('Europe/Kiev');
}

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

// Ошибки и протоколирование
ini_set('error_log', dirname(__FILE__) . '/../logs/errors.log');

// function redirect($path){
// 	header("Location: /{$path}");
// }

require_once realpath(__DIR__).'/../config/app.php';

require_once CORE.'View.php';
require_once CORE.'Controller.php';
require_once CORE.'Slug.php';
require_once MODELS.'Post.php';
require_once MODELS.'Post.php';
require_once MODELS.'Category.php';
require_once MODELS.'Product.php';
require_once CORE.'Connection.php';
require_once CORE.'App.php';
require_once CORE.'QueryBuider.php';

// App::bind('config', require CONFIG.'db.php');

// App::bind('database', new QueryBuider(
// 	Connection::make(App::get('config')['database'])
// 	)
// );

require_once CORE.'Router.php';
