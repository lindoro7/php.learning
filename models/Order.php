<?php

namespace app\models;

class Order extends Model
{
  public $id;
  public $products;
  public $totalPrice;
  public $deliveryTime;

  protected function getTableName():string
  {
    return 'orders';
  }
}