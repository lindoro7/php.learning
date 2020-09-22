<?php
namespace app\traits;

trait SingletoneTrait
{
   // переменная для экземпляра класса DB
   private static $item;
  
   // метод проверяет на существование $item, 
   // и при отсутствии значения $item присваивает ему
   // экземпляр класса DB. new static указывает на DB.
   public static function getInstance()
   {
     if(empty(static::$item))
     {
       static::$item = new static();
     }
     return static::$item;
   }
   // следующие методы записаны и им присвоены модификаторы protected для того, чтобы
   // обьект класса DB можно было создать только 
   // через getInstance()
   protected function __construct(){} // ytkmpz xthtp rjycnhernjh
   protected function __clone() {}
   protected function __wakeup() {}
}