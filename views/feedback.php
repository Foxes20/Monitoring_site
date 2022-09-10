<?php
/**
 * @var array $items
 * @var int $length
 * @var int $idPage
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
                <li><?= $row[ 'name'] ?> - <?= $row['email'] ?> -
                    <form action="/admin/feedback_delete?id=<?=$row['id']?>" method="POST" style="display:inline-block;">
                        <input type="submit" value="Удалить"> -
                    </form>
                    - <a href='/admin/feedback_edit?id=<?=$row['id']?>'>просмотр</a></li>
            <? endforeach;?>
        </ul>
        <? pagination($length, $idPage);?>
</body>
</html>
