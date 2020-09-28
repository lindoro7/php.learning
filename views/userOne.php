<?php
/**@var \app\models\User $user */
?>

<h2><?= $user->login?></h2>
<a href="?c=user&a=change&id=<?= $user->id?>">Изменить</a>
<hr>