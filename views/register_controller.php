<?php
/**
* @var array $old
* @var string $insertMessage
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
    <link rel="stylesheet" href="../css/reg.css">
</head>
    <body>

        <form action="/register_user" method="POST">
            <label for="">Логин</label>
            <input type="text" name="login" value="<?=isset($old['login']) ? $old['login'] : '';?>">

            <? if (isset($errorMessage['login'])): ?>
                <p><?= $errorMessage['login'];?></p>
            <? endif; ?>
            <br>
            <label for="">Пароль</label>
            <input type="password" name="password" value="">
            <? if (isset($errorMessage['password'])): ?>
                <p><?= $errorMessage['password'];?></p>
            <? endif; ?>
            <br>
            <label for="">Подтвердить пароль</label>
            <input type="password" name="checkPassword" value="">
            <? if (isset($errorMessage['checkPassword'])): ?>
                <p><?= $errorMessage['checkPassword'];?></p>
            <? endif; ?>
            <br>
            <input type="submit" value="Войти">
        </form>

        <? if ($insertMessage): ?>
            <div><?= $insertMessage ?></div>
        <? endif; ?>

    </body>
</html>
