<?php
/**
 * @var array $auth
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
        <form action="/loginAuth" method="POST">
            <input type="text" placeholder="login" name="loginAuth">
            <input type="password" placeholder="password" name="passwordAuth">
            <input type="submit" value="Авторизироваться">

            <? if ($auth): ?>
                <div><?= $auth ?></div>
            <? endif; ?>
        </form>
    </body>
</html>
