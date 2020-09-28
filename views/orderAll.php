<?php
/**@var \app\models\Order[] $orders */
?>
<a href="?c=order&a=add">Добавить заказ</a>
<?php foreach($orders as $order) :?>
  <h2>Заказ №:<?= $order->id?></h2>
  <a href="?c=order&a=one&id=<?=$order->id?>">Подробнее</a>
  <hr>
<?php endforeach; ?>