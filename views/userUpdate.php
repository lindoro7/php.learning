<?php 
  /**@var \app\models\User $user */ 
?>
<form method="POST">
  <input type="text" name="name" value="<?= $user->name ?>">
  <input type="text" name="login" value="<?= $user->login ?>">
  <input type="submit" value="Отправить">
</form>