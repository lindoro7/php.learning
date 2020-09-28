<?php
/**@var \app\models\Good[] $goods */
?>
<a href="?c=good&a=add">Добавить товар</a>
<?php foreach($goods as $good) :?>
  <h2><?= $good->title?></h2>
  <p><?= $good->description?></p>
  <a href="?c=good&a=one&id=<?=$good->id?>">Подробнее</a>
  <hr>
<?php endforeach; ?>