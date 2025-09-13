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

<table>
    <tr>
        <td>Название</td>
        <td>Дата</td>
        <td>Количество мест</td>
    </tr>
    <?php foreach ($events as $event): ?>
        <tr>
            <td><?= $event['name'] ?></td>
            <td><?= $event['date'] ?></td>
            <td><?= $event['places_diff'] ?? $event['places'] ?></td>
            <td><a href="/event/<?= $event['id'] ?>">Подробнее</a></td>
            <td><a href="/event/<?=$event['id']?>/book">Забронировать</a></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>