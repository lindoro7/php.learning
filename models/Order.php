<?php

namespace app\models;

class Order extends Model
{
  public $id;
  public $user;
  public $order;
  public $paid;

  protected static function getTableName():string
  {
    return 'orders';
  }
}