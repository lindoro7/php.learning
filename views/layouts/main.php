<?php 
  /**@var string $content
   * @var string $title
  */
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
</head>
<body>
  <ul>
    <li><a href="?c=order&a=all">Заказы</a></li>
    <li><a href="?c=good&a=all">Товары</a></li>
    <li><a href="?c=user&a=all">Пользователи</a></li>
  </ul>
  <?= $content ?>
</body>
</html>