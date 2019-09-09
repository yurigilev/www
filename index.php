<?php
//front controller

ini_set('display_errors', 0);
//error_reporting(E_ALL ^ E_NOTICE);
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 'on');




// подключение файлы
define('ROOT',dirname(__FILE__));
require_once(ROOT.'/components/router.php');
require_once(ROOT.'/components/db.php');



// вызов роутера
$router=new Router();
$router->run();

?>