<?php
namespace app\models;

use app\services\DB;

/**
 * Class Model
 * @package app\models
 * @property int id
 * @method
 */
abstract class Model
{

  /**
   * Функция реализована абстрактной чтобы явным образом
   * указать на то, что ее нужно переопределить. 
   * Также указано значение string, которое она возвращает,
   * чтобы было понятно какой аргумент ждет пользователь этой функции
   */
  abstract protected static function getTableName():string;

  /**
   * @return DB
   */

  protected static function getDB()
  {
    return DB::getInstance();
  }

  public static function getOne($id)
  {
    $tableName = static::getTableName();
    $sql = "SELECT * FROM {$tableName} WHERE id = :id";
    $params = ['id' => $id];
    return static::getDB()->getObject($sql, static::class, $params);
  }

  // static::class возвращает строковое значение класса
  public static function getAll()
  {
    $tableName = static::getTableName();
    $sql = "SELECT * FROM {$tableName}";
    return static::getDB()->getObjects($sql, static::class);
  }

  
  public function save()
  {
    if(empty($this->id))
    {
      $this->insert();
      return;
    }
    $this->update($this->id);
  }
  
  
  public function insert()
  {
    $params = [];
    $fields = [];
   
    foreach($this as $fieldName => $value)
    {
      if($fieldName == 'id')
      {
        continue;
      }
      $fields[] = $fieldName;
      $params[":{$fieldName}"] = $value;
      
    }
    $sql = sprintf(
      "INSERT INTO %s (%s) VALUES (%s)",
      $this->getTableName(),
      implode(', ', $fields),
      implode(', ', array_keys($params))
    );
    $this->getDB()->execute($sql, $params);
    $this->id = $this->getDB()->getLastId;
  }

  public function update($id)
  {
    $params = [];
    $fields = [];
    foreach($this as $fieldName => $value)
    {
      
      if($fieldName == 'id')
      {
        continue;
      }
      if($fieldName == 'password')
      {
        continue;
      }
      $params[":{$fieldName}"] = $value;
      $fields[] = "{$fieldName} = :{$fieldName}";
    }
    
    $sql = sprintf("UPDATE %s  SET %s WHERE id = %s",
            $this->getTableName(),
            implode(', ', $fields),
            $id
    );
    return $this->getDB()->execute($sql, $params);
  }

  public function delete($id)
  {
    $sql = sprintf("DELETE FROM %s WHERE id = %s",
                    $this->getTableName(),
                    $id);
    $this->getDB()->execute($sql);
  }
}
