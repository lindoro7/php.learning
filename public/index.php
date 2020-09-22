<?php
// используем неймспейс для подключения автолоадера
use app\services\Autoload;

// подключение класса автозагрузки
include dirname(__DIR__) . "/services/Autoload.php";

// регистрировать автолоадер нужно до вызова классов
// (new Autoload()) юзают для вызова метода без создания класса
//аргументом передается массив, 
// первым элементом массива передается экземпляр класса,
// вторым элементом в виде строки передается название метода класса
spl_autoload_register([(new Autoload()), 'load']);


/**
 * так же может использоватся такой вариант,
 * где в качестве аргумента передается анонимная функция
 * 
 * spl_autoload_register(
 *  function ($name)
 *  {
 *    (new Autoload())->load($name);
 *  }
 * );
 */
// создаем класс DB и сохраняем в переменную
$db = new app\services\DB();

// создаем инстанс класса Good и 
// передаем инстанс DB в конструктор Good чтоб использовать 
// один инстанс DB, а не плодить их через new DB();
$good = new app\models\Good($db);
$user = new app\models\User($db);
$order = new app\models\Order($db);
$goodModel =  $good->getAll();
var_dump($goodModel);
echo $order->getOne(1);

//после подключения трейта доступна и такая запись
// функция echoTest реализована в трейте calcTrait
// echo $good->echoTest();

