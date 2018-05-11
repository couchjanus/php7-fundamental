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

require_once realpath(__DIR__).'/../config/app.php';

// require_once CORE.'View.php';
// require_once CORE.'Controller.php';
// require_once CORE.'Slug.php';
// require_once CORE.'Session.php';
// require_once MODELS.'Post.php';
// require_once MODELS.'Category.php';
// require_once MODELS.'Product.php';
// require_once MODELS.'Picture.php';
// require_once MODELS.'Role.php';
// require_once MODELS.'User.php';
// require_once MODELS.'Order.php';
// require_once MODELS.'Permission.php';
// require_once CORE.'Connection.php';

// require_once CORE.'Request.php';
// require_once CORE.'Router.php';


require_once realpath(__DIR__).'/./autoload.php';

// Регистрируем автозагрузчик
spl_autoload_register("autoloadsystem");

$app = new App();
$app->init();

// Запускаем сессию
// Session::init();

// Router::load(CONFIG.'routes.php')
//     ->directPath(Request::uri(), Request::method());
