<?php
namespace app\services;

// класс автозагрузчика
class Autoload
{
  // константа с названиями директорий,
  // из которых требуется подключение классов или файлов
  const DIRS = [
      'models', 'services'
  ];

  // функция загрузки с входящим параметром, получаемым от __autoload
  public function load1($className)
  {
    // проходимся циклом по константе с названиями директорий
    foreach (static::DIRS as $dir) 
    {
      // присваиваем  в переменную файл с путем до него
      $fileName = dirname(__DIR__) . "/{$dir}/{$className}.php";
      // проверяем файл на существование
      if (file_exists($fileName)) 
      {
        // подключаем существующий файл
        include $fileName;
        // прерываем цикл
        break;
      } 
    }
  }

  public function load($className)
  {
    $fileName = str_replace(
      ['app\\', '\\'],
      [dirname(__DIR__) . '/', '/'],
      $className
    );

    $fileName .= '.php';
    
    if(file_exists($fileName)) 
    {
      include $fileName;
    }
  }
}