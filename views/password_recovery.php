<?php
/**
 * @var array $errorMessage
 * @var array $old
 * @var string $linkPas
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
        <h3>Запрос на смену пароля</h3>

        <form action="./logics_password_recovery" method="POST">
            Введите свою почту<br>
            <input type="text" name="mail" value="<?=isset($old['mail']) ? $old['mail'] : '';?>">
            <? if (isset($errorMessage['mail'])): ?>
                <p><?= $errorMessage['mail'];?></p>
            <? endif; ?>
            <br>
            <input type="submit" value="Запрос на смену пароля">
        </form>
        <? if ($linkPas): ?>
            <div><?= $linkPas ?></div>
        <? endif; ?>
    </body>
</html>
