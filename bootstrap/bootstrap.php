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

function makeConnection()
{
  $db = include CONFIG.'db.php';

  $config = $db['database'];

  try {
    return new PDO(
      $config['connection'].';dbname='.$config['name'],
      $config['username'],
      $config['password'],
      $config['options']
    );
  }
  catch(PDOException $e) {
      echo "SQL, у нас проблемы.\n" . $e->getMessage();
      file_put_contents('PDOErrors.log', $e->getMessage(), FILE_APPEND);
  }
}

function render($path, $data = [])
{
    extract($data);

    return require VIEWS."/{$path}.php";
}


require_once realpath(__DIR__).'/../config/app.php';

require_once CORE.'View.php';
require_once CORE.'Controller.php';
require_once CORE.'Connection.php';

require_once CORE.'Router.php';
