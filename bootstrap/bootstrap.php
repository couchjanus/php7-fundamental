<?php

// Общие настройки

// Устанавливаем временную зону по умолчанию

if (function_exists('date_default_timezone_set')) {
    date_default_timezone_set('Europe/Kiev');
}


ini_set('display_errors', 1);

// Ошибки и протоколирование
ini_set('error_log', dirname(__FILE__) . '/../logs/error_log.txt');

error_reporting(E_ALL);

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

require_once CORE.'Router.php';
