<?php
namespace app\services;

class DB implements IDB
{
  public function find($sql)
  {
    return 'find' . $sql;
  }

  public function findAll($sql)
  {
    //можем обращаться к константам интерфейса через self::
    // self::TEST_ERROR;
    return 'findAll' . $sql;
  }
}