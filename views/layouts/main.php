<?php /**@var string $content*/?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <ul>
    <li><a href="?c=user&a=one">Пользователь</a></li>
    <li><a href="?c=user&a=all">Все пользователи</a></li>
  </ul>
  <?= $content ?>
</body>
</html>