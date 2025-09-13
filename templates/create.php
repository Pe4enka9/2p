<?php
/** @var Slim\Flash\Messages $flash */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="/event/<?= $event['id'] ?>/book" method="post">
    <input type="text" name="user_name" id="user_name" placeholder="Имя">
    <input type="email" name="email" id="email" placeholder="email">
    <input type="number" name="places" id="places" placeholder="Количество мест">

    <?= $flash->getMessage('error')[0] ?? '' ?>

    <button type="submit">Забронировать</button>
</form>
</body>
</html>