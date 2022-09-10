<?php
/**
 * @var array $row
 * @var int $length
 * @var int $page
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
    <div>
        <ul>
            <?foreach($row as $key):?>
                <li>
                    <?= $key['name_site'] ?> - <?= $key['protocol_site'] ?> - <?= $key['time_check'] ?> - <?= $key['address_mail'] ?> -
                    <?= $key['id_telegram'] ?> - <?= $key['key_telegram'] ?> - <?= $key['date_add'] ?> -
                        <form action="/admin/monitoring_delete?id=<?=$row[0]['id']?>" method="POST" name="formDel" id="formDel" style="display:inline-block;">
                            <input type="submit" value="Удалить"> -
                        </form>
                        <a href="/admin/monitoring_show?id=<?=$key['id']?>" style="display:inline-block;">просмотр</a>
                </li>
            <?endforeach;?>
        </ul>
    </div>
    <? pagination($length, $page);?>
</body>
</html>
