<?php
namespace app\services;

use app\traits\SingletoneTrait;

class DB implements IDB
{
  use SingletoneTrait;

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
  /**
   * getDsn
   *
   * @return string
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
  
  /**
   *  query
   *
   * @param  string $sql
   * @param  array $params
   * @return $PDOStatement
   */
  private function query($sql, $params = [])
  {
    $PDOStatement = $this->getConnection()->prepare($sql);
    $PDOStatement->execute($params);
    return $PDOStatement;
  }
  
  /**
   * find
   *
   * @param  string $sql
   * @param  array $params
   * @return void
   */
  public function find($sql, $params = [])
  {
    return $this->query($sql, $params = [])->fetch();
  }
  
  /**
   * findAll
   *
   * @param  string $sql
   * @param  array $params
   * @return array
   */
  public function findAll($sql, $params = [])
  {
    //можем обращаться к константам интерфейса через self::
    // self::TEST_ERROR;
    return $this->query($sql, $params = [])->fetchAll();
  }
  
  /**
   * getObject
   *
   * @param  string $sql
   * @param  string $className
   * @param  array $params
   * @return object
   */
  public function getObject($sql, $className, $params = [])
  {
    $PDOStatement = $this->query($sql, $params);
    $PDOStatement->setFetchMode(\PDO::FETCH_CLASS, $className);
    return $PDOStatement->fetch();
  }

  public function getObjects($sql, $className, $params = [])
  {
    $PDOStatement = $this->query($sql, $params);
    $PDOStatement->setFetchMode(\PDO::FETCH_CLASS, $className);
    return $PDOStatement->fetchAll();
  }

  public function execute($sql, $params = [])
  {
    return $this->query($sql, $params);
  }

  public function getLastId()
  {
    return $this->getConnection()->lastInsertId();
  }
}