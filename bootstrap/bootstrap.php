<?php

// Общие настройки

// Устанавливаем временную зону по умолчанию

if (function_exists('date_default_timezone_set')) {
    date_default_timezone_set('Europe/Kiev');    
}


ini_set('display_errors', 1);

// Ошибки и протоколирование

error_reporting(E_ALL);

require_once realpath(__DIR__).'/../config/app.php';
require_once CORE.'Router.php';
