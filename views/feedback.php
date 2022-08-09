<?php
/**
 * @var array $items
 * @var int $length
 * @var int $page
 * @var int $rows
 **/
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
        <ul>
            <? foreach ($rows as $row): ?>
                <li><?= $row[ 'name'] ?> - <?= $row['email'] ?> - <a href='/admin/feedback_delete?id=<?=$row['id']?>'>удалить</a> - <a href='/admin/feedback_edit?id=<?=$row['id']?>'>просмотр</a></li>

            <? endforeach;?>
        </ul>
        <? pagination($length, $page);?>
</body>
</html>
