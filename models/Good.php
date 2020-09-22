<?php
namespace app\models;

class Good extends Model
{
  // таким образом подключается трейт и становятся 
  // доступными методы трейта
  use calcTrait;

  public $id;
  public $name;
  public $price;
  public $info;

  protected function getTableName():string
  {
    // это метод трейта, который мы теперь можем использовать 
    // после подключения: $this->echoTest(); 
    // $this->echoTest();
    return 'products';
  }
}