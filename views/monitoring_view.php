<?php
/**
 * @var array $row
 * @var array $row1
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
        <h1>Просмотр и редактирование записи</h1>
        <form action="/admin/monitoring_upd?id=<?=$row['id']?>" method="POST" name="view" id="formMonitoring">

            <div><b>Имя сайта:</b> <?= $row['name_site'] ?></div>
            <div><b>Протокол сайта:</b> <?= $row['protocol_site'] ?></div>
            <div><b>Временной интервал:</b> <?= $row['time_check'] ?></div>
            <div><b>Почта:</b> <?= $row['address_mail'] ?></div>
            <div><b>ид телеграм:</b> <?= $row['id_telegram'] ?></div>
            <div><b>ключ телеграм:</b> <?= $row['key_telegram'] ?></div><br>

            <button type="submit" id="edit_monitoring">Редактировать</button>
            <div class="txt"></div>

        </form>
    </body>
</html>
