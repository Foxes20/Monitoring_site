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
    <form action="/admin/feedback_answers?id=<?=$output['id']?>" method="POST" name="view" id="formId">
        <div><b>Имя:</b> <?= $output['name'] ?></div>
        <div><b>Почта:</b> <?= $output['email'] ?></div>
        <div><b>Тема:</b> <?= $output['theme'] ?></div>
        <div><b>Смс:</b> <?= $output['message'] ?></div>

        <textarea type="text" rows="10" cols="45" id="message1" name="message1"></textarea>
        
        <button type="submit" id="view">Ответить</button>
        <div class="mess"></div>
    </form>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="../feedback_view.js"></script>
    </body>
</html>
