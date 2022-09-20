<?php
/**
 * @var array $row
 * @var string $updateMessage
 * @var array $errorMessage
 * @var array $old
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
    <head>
    <body>
    <h1>Просмотр и редактирование записи</h1>
        <form action="/admin/monitoring_update?id=<?=$row['id']?>" method="POST" name="view" id="formMonitoring">
            <div>
                <label for="name_site">name_site: </label>
                <input type="text" id="name_site" name="name_site" value="<?=isset($old['name_site']) ? $old['name_site'] : $row['name_site'];?>">
                <? if (isset($errorMessage['name_site'])): ?>
                    <p><?= $errorMessage['name_site'];?></p>
                <? endif; ?>
            </div><br>
            <div>
                <label for="protocol_site">protocol_site:</label>
                <input type="text" id="protocol_site" name="protocol_site" value="<?=isset($old['protocol_site']) ? $old['protocol_site'] : $row['protocol_site'];?>">
                <? if (isset($errorMessage['protocol_site'])): ?>
                    <p><?= $errorMessage['protocol_site'];?></p>
                <? endif; ?>
            </div><br>
            <div>
                <label for="time_check">time_check:</label>
                <input type="text" id="time_check" name="time_check" value="<?=isset($old['time_check']) ? $old['time_check'] : $row['time_check'];?>">
                <? if (isset($errorMessage['time_check'])): ?>
                    <p><?= $errorMessage['time_check'];?></p>
                <? endif; ?>
            </div><br>
            <div>
                <label for="address_mail">address_mail:</label>
                <input type="text" id="address_mail" name="address_mail" value="<?=isset($old['address_mail']) ? $old['address_mail'] : $row['address_mail'];?>">
                <? if (isset($errorMessage['address_mail'])): ?>
                    <p><?= $errorMessage['address_mail'];?></p>
                <? endif; ?>
            </div><br>
            <div>
                <label for="id_telegram">id_telegram:</label>
                <input type="text" id="id_telegram" name="id_telegram" value="<?=isset($old['id_telegram']) ? $old['id_telegram'] : $row['id_telegram'];?>">
                <? if (isset($errorMessage['id_telegram'])): ?>
                    <p><?= $errorMessage['id_telegram'];?></p>
                <? endif; ?>
            </div><br>
            <div>
                <label for="key_telegram">key_telegram:</label>
                <input type="text" id="key_telegram" name="key_telegram" value="<?=isset($old['key_telegram']) ? $old['key_telegram'] : $row['key_telegram'];?>">
                <? if (isset($errorMessage['key_telegram'])): ?>
                    <p><?= $errorMessage['key_telegram'];?></p>
                <? endif; ?>
            </div><br>
            <button type="submit" id="edit_mon">Изменить данные</button>
            <div class="txt"></div>
        </form>
            <? if ($updateMessage): ?>
                <div><?= $updateMessage ?></div>
            <? endif; ?>
        </body>
</html>
