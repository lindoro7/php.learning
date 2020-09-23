<?php
namespace app\traits;
// создаем трейт, и прописываем в нем функции,
// к которым мы сможем обращаться из классов при
// подключении трейта к классам 
trait calcTrait
{
  public function echoTest()
  {
    echo '<hr>TEST<hr>';
  }
}