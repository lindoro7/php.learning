<?php
namespace app\models;

use app\services\DB;

abstract class Model
{

  /**
   * Функция реализована абстрактной чтобы явным образом
   * указать на то, что ее нужно переопределить. 
   * Также указано значение string, которое она возвращает,
   * чтобы было понятно какой аргумент ждет пользователь этой функции
   */
  abstract protected function getTableName():string;

  /**
   * @return DB
   */

  protected function getDB()
  {
    return DB::getInstance();
  }

  public function getOne($id)
  {
    $tableName = $this->getTableName();
    $sql = "SELECT * FROM {$tableName} WHERE id = :id";
    $params = ['id' => $id];
    return $this->getDB()->find($sql, $params);
  }

  public function getAll()
  {
    $tableName = $this->getTableName();
    $sql = "SELECT * FROM {$tableName}";
    return $this->getDB()->findAll($sql);
  }

  public function save()
  {
    
  }

  public function insert()
  {

  }

  public function update()
  {

  }

  public function delete()
  {

  }
}
