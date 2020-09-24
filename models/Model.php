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
    return $this->getDB()->getObject($sql, static::class, $params);
  }

  // static::class возвращает строковое значение класса
  public function getAll()
  {
    $tableName = $this->getTableName();
    $sql = "SELECT * FROM {$tableName}";
    return $this->getDB()->getObjects($sql, static::class);
  }

  public function save()
  {
    if(empty($this->id))
    {
      $this->insert();
      return;
    }
    $this->update();
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
    $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)",
                    $this->getTableName(),
                    implode(', ', $fields),
                    implode(', ', array_keys($params)));
    return $this->getDB()->execute($sql, $params);
  }

  public function update()
  {
    $params = [];
    $fields = [];
    foreach($this as $fieldName => $value)
    {
      if($fieldName == 'id')
      {
        continue;
      }
      $fields[] = "{$fieldName} = :{$fieldName}";
      $params[":{$fieldName}"] = $value;
      
    }
    $sql = sprintf("UPDATE %s SET %s WHERE id = %s",
                    $this->getTableName(),
                  implode(', ', $fields),
                  $this->id);
            var_dump($sql);
    return $this->getDB()->execute($sql, $params);
  }

  public function delete($id)
  {
    $tableName = $this->getTableName();
    $sql = "DELETE FROM {$tableName} WHERE id = $id";
    return $this->getDB()->find($sql);
  }
}
