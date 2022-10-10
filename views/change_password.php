<?php
/**
 * @var array $errors
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
<h2> Смена пароля </h2>
    <form action="/change_password_users" method="POST">
        <? if (isset($errors['auth'])): ?>
            <p><?= $errors['auth'];?></p>
        <? endif; ?>

        <input name="old_password" placeholder="Введите старый пароль"><br>
        <? if (isset($errors['old_password'])): ?>
            <p><?= $errors['old_password'];?></p>
        <? endif; ?>

        <input name="new_password" placeholder="Введите новый пароль"><br>
        <? if (isset($errors['new_password'])): ?>
            <p><?= $errors['new_password'];?></p>
        <? endif; ?>

        <input name="confirm_new_password" placeholder="Подтвердите новый пароль"><br>
        <? if (isset($errors['comparePasswords'])): ?>
            <p><?= $errors['comparePasswords'];?></p><br>
        <? endif; ?>
        <input type="submit" name="submit">
    </form>
<? if ($updateMessage): ?>
    <div><?= $updateMessage ?></div>
<? endif; ?>
</body>
</html>
