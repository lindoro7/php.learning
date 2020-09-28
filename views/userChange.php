<?php 
  /**@var \app\models\User $user */
?>
<form method="POST">
  <input type="text" name="name" placeholder="<?= $user->name ?>">
  <input type="text" name="login" placeholder="<?= $user->login ?>">
  <input type="submit" value="Отправить">
</form>