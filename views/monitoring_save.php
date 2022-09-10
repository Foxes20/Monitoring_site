<?php
/**
 * @var array $row
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
                <input type="text" id="name_site" name="name_site" value="<?=$row['name_site']?>">
            </div><br>
            <div>
                <label for="protocol_site">protocol_site:</label>
                <input type="text" id="protocol_site" name="protocol_site" value="<?=$row['protocol_site']?>">
            </div><br>
            <div>
                <label for="time_check">time_check:</label>
                <input type="text" id="time_check" name="time_check" value="<?=$row['time_check']?>">
            </div><br>
            <div>
                <label for="address_mail">address_mail:</label>
                <input type="text" id="address_mail" name="address_mail" value="<?=$row['address_mail']?>">
            </div><br>
            <div>
                <label for="id_telegram">id_telegram:</label>
                <input type="text" id="id_telegram" name="id_telegram" value="<?=$row['id_telegram']?>">
            </div><br>
            <div>
                <label for="key_telegram">key_telegram:</label>
                <input type="text" id="key_telegram" name="key_telegram" value="<?=$row['key_telegram']?>">
            </div><br>

            <button type="submit" id="edit_mon">Изменить данные</button>
            <div class="txt"></div>
        </form>
        </body>
</html>
