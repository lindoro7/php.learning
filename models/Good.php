<?php
namespace app\models;

use app\traits\calcTrait;

class Good extends Model
{
  // таким образом подключается трейт и становятся 
  // доступными методы трейта
  use calcTrait;

  public $id;
  public $title;
  public $price;
  public $description;

  protected static function getTableName():string
  {
    // это метод трейта, который мы теперь можем использовать 
    // после подключения: $this->echoTest(); 
    // $this->echoTest();
    return 'products';
  }
}