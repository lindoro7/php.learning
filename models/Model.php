<?php
namespace app\models;

use app\services\DB;

abstract class Model
{
  protected $db;

  /**
   * Функция реализована абстрактной чтобы явным образом
   * указать на то, что ее нужно переопределить. 
   * Также указано значение string, которое она возвращает,
   * чтобы было понятно какой аргумент ждет пользователь этой функции
   */
  abstract protected function getTableName():string;

  // в конструкторе перед аргументом можем указать класс,
  // инстанс которого мы ожидаем, при несоответствии будет fatal error 
  // например это может быть __construct(DB $db)
  // также можем указать интерфейс IDB
  public function __construct(DB $db)
  {
    $this->db = $db;
  }

  public function getOne($id)
  {
    $tableName = $this->getTableName();
    $sql = "SELECT * FROM {$tableName} WHERE id = " . $id;
    return $this->db->find($sql);
  }

  public function getAll()
  {
    $tableName = $this->getTableName();
    $sql = "SELECT * FROM {$tableName}";
    return $this->db->findAll($sql);
  }
}