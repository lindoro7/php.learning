<?php
namespace app\services;

class DB implements IDB
{
  // $link = new PDO("mysql:host=localhost;dbname=DB;charset=UTF8");
  // $dsn это параметр, который PDO принимает в качестве атрибута
  // выглядит так: "mysql:host=localhost;dbname=DB;charset=UTF8"
  
  // настройки для PDO
  private $config = [
    'driver' => "mysql",
    'host' => 'localhost',
    'db' => 'gbphp',
    'charset' => 'UTF8',
    'login' => 'root',
    'password' => 'root',
  ];

  // подключение к БД
  private $connection;

  //получение подключения к БД
  private function getConnection()
  {
    if(empty($this->connection))
    {
      // '\' перед PDO чтобы автолоад искал PDO в корневом пространстве имен,
      // в данном случае пространство имен app\services
      $this->connection = new \PDO(
        $this->getDsn(), 
        $this->config['login'],
        $this->config['password']
      );
      // Устанавливает атрибут объекту PDO
      // '\' перед PDO для корневого пространства имен
      $this->connection->setAttribute(
        \PDO::ATTR_DEFAULT_FETCH_MODE,
        \PDO::FETCH_ASSOC
      );
    }
    return $this->connection;
  }
/**
 * sprintf()
 * принимает первым аргументом строку с плейсхолдерами,
 * вторым и последующими: значения для подстановки на место плейсхолдеров
 */
  protected function getDsn()
  {
    return sprintf(
      "%s:host=%s;dbname=%s;charset=%s",
      $this->config['driver'],
      $this->config['host'],
      $this->config['db'],
      $this->config['charset']
    );
  }

  public function find($sql, $params)
  {
    $PDOStatement = $this->getConnection()->prepare($sql);
    $PDOStatement->execute($params);
    return $PDOStatement->fetch();
  }

  public function findAll($sql, $params = [])
  {
    //можем обращаться к константам интерфейса через self::
    // self::TEST_ERROR;
    $PDOStatement = $this->getConnection()->prepare($sql);
    $PDOStatement->execute($params);
    return $PDOStatement->fetchAll();
  }
}