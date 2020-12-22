<?php

session_start();

ini_set('display_errors', true);

define('ROOT', str_replace("public/index.php", "", $_SERVER["SCRIPT_FILENAME"]));
define('BASE_URL', '');
define('PUBLIC_PATH', BASE_URL . '');

require ROOT . 'autoload.php';
require ROOT . 'App/helpers.php';

use Core\Dispatcher;

$dispatch = new Dispatcher();

$dispatch->dispatch();
