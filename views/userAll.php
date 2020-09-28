<?php
/**@var \app\models\User[] $users */
?>
<a href="?c=user&a=add">Добавить пользователя</a>
<?php foreach($users as $user) :?>
  <h2><?= $user->login?></h2>
  <p><?= $user->name?></p>
  <p><?= $user->id?></p>
  <a href="?c=user&a=one&id=<?=$user->id?>">Подробнее</a>
  <a href="?c=user&a=del&id=<?=$user->id?>">Удалить</a>
  <hr>
<?php endforeach; ?>