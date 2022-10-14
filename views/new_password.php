<?php
/**
 * @var array $errorMessage
 * @var string $update
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
        <h3>Смена пароля на новый</h3>

        <form action="/change_password_method" method="POST">
            <input type="hidden" name="key" value="<?=$_GET['key']?>">
            <input type="text" name="newPassword" placeholder="Новый пароль"><br>
            <? if (isset($errorMessage['newPassword'])): ?>
                <p><?= $errorMessage['newPassword'];?></p>
            <? endif; ?>
            <input type="text" name="confirmPassword" placeholder="Подтвердить пароль"><br>
            <input type="submit" value="Сменить">
        </form>
        <? if ($update): ?>
            <div><?= $update ?></div>
        <? endif; ?>
    </body>
</html>
