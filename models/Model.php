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

  public function insert()
  {
    $tableName = $this->getTableName();
    $params = [];
    $queryKeys = [];
    $queryValues = [];
    foreach($this as $fieldName => $value)
    {
      if(empty($value))
      {
        continue;
      }
      $params[$fieldName] = $value;
      $queryKeys[] = $fieldName;
      $queryValues[] = ":{$fieldName}";
    }
    $sql = "INSERT INTO {$tableName} (" . implode(', ', $queryKeys ) . ") 
            VALUES (" . implode(', ', $queryValues) .")";
            var_dump($sql);
    return $this->getDB()->find($sql, $params);
  }

  public function update($id)
  {
    $tableName = $this->getTableName();
    $params = [];
    foreach($this as $fieldName => $value)
    {
      if(empty($value))
      {
        continue;
      }
      $params[$fieldName] = $value;
    }
    $queryString = [];
    foreach($params as $field => $value)
    {
      $queryString[] = "{$field} = :{$field}";
    }
    $sql = "UPDATE {$tableName} 
            SET " . implode(', ',$queryString) .
            " WHERE id = $id";

            var_dump($sql);
          
    return $this->getDB()->find($sql, $params);
  }

  public function delete($id)
  {
    $tableName = $this->getTableName();
    $sql = "DELETE FROM {$tableName} WHERE id = $id";
    return $this->getDB()->find($sql);
  }
}
