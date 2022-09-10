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

        <form action="/admin/monitoring_update?id=<?=$row['id']?>" method="POST" name="view" id="formMonitoring">

            <div><input name="name_site" type="hidden" value="<?= $row['name_site'] ?>"><b>Имя сайта:</b> <?= $row['name_site'] ?></div>
            <div><input name="protocol_site" type="hidden" value="<?= $row['protocol_site'] ?>"><b>Протокол сайта:</b> <?= $row['protocol_site'] ?></div>
            <div><input name="time_check" type="hidden" value="<?= $row['time_check'] ?>"><b>Временной интервал:</b> <?= $row['time_check'] ?></div>
            <div><input name="address_mail" type="hidden" value="<?= $row['address_mail'] ?>"><b>Почта:</b> <?= $row['address_mail'] ?></div>
            <div><input name="id_telegram" type="hidden" value="<?= $row['id_telegram'] ?>"><b>ид телеграм:</b> <?= $row['id_telegram'] ?></div>
            <div><input name="key_telegram" type="hidden" value="<?= $row['key_telegram'] ?>"><b>ключ телеграм:</b> <br><?= $row['key_telegram'] ?></div>

            <div class="txt"></div>
            <input type="submit" value="Редактировать">
        </form>
    </body>
</html>
