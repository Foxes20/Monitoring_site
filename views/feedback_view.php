<?php
/**
* @var array $output
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
    <h1>Просмотр записи</h1>
        <div><b>Имя:</b> <?= $output['name'] ?></div>
        <div><b>Почта:</b> <?= $output['email'] ?></div>
        <div><b>Тема:</b> <?= $output['theme'] ?></div>
        <div><b>Смс:</b> <?= $output['message'] ?></div>
        <input type="text">
        <input type="submit" value="Ответить">


    </body>
</html>
