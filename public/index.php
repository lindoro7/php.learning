<?php
// используем неймспейс для подключения автолоадера
use app\services\Autoload;
use app\models\User;
use app\services\RenderServices;

include dirname(__DIR__) . "/services/Autoload.php";

spl_autoload_register([(new Autoload()), 'load']);

$controllerName = 'user';
if(!empty($_GET['c']) && !empty(trim($_GET['c'])))
{
  $controllerName = trim($_GET['c']);
}

$actionName = '';
if(!empty($_GET['a']) && !empty(trim($_GET['a'])))
{
  $actionName = trim($_GET['a']);
}

$controllerClass = 'app\\controllers\\' . ucfirst($controllerName) . 'Controller';

if(class_exists($controllerClass))
{
  $renderer = new RenderServices();
  /**@var \app\controllers\Controller $controller */
  $controller = new $controllerClass($renderer);
  echo $controller->run($actionName);
} else {
  echo '404';
}

// var_dump($controller);
