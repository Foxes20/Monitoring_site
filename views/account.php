<?php
/**
 * @var array $row
 * @var string $updateMessage
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
    <h2>Личный кабинет пользователя <?=$row['name']?></h2>
    <form action="/userAccount" method="POST">

        name:<input type="text" name="name" value="<?=$row['name']?>" placeholder="name"><br>
        <? if (isset($errorMessage['name'])): ?>
            <p><?= $errorMessage['name'];?></p>
        <? endif; ?>

        surname:<input type="text" name="surname" value="<?=$row['surname']?>" placeholder="surname"><br>
        <? if (isset($errorMessage['surname'])): ?>
            <p><?= $errorMessage['surname'];?></p>
        <? endif; ?>

        login:<input type="text" name="login" value="<?=$row['login']?>" placeholder="login"><br><br>
        <? if (isset($errorMessage['login'])): ?>
            <p><?= $errorMessage['login'];?></p>
        <? endif; ?>

        <input type="submit" value="Изменить личные данные">
    </form>
    <? if ($updateMessage): ?>
        <div><?= $updateMessage ?></div>
    <? endif; ?>
    </body>
</html>
