<?php
require_once 'db.php';
$db = new db();

set_time_limit(0);
    $result = mysqli_query($db->connect, "SELECT * FROM `forma` ");
    $rows = mysqli_fetch_all($result,MYSQLI_ASSOC );

        foreach ($rows as $row =>$key) {
            $siteName = $key['name_site'];
            $protocol = $key['protocol_site'];
            $id_form = $key['id'];
            $timeCheck = $key['time_check'];
            $address_mail = $key['address_mail'];
            $id_telegram = $key['id_telegram'];
            $key_telegram = $key['key_telegram'];
            $dateAdd = $key['date_add'];

            if ($protocol == 1) {
                $protocol = 'http';
            } else if ($protocol == 2) {
                $protocol = 'https';
            } else if ($protocol == 3) {
                $protocol = 'ping';
            } else {
                $protocol = NULL;
            }

            $resultLog = mysqli_query($db->connect, "SELECT * FROM `log` ");
            $rows = mysqli_fetch_all($resultLog,MYSQLI_ASSOC );
            foreach ($rows as $row =>$key) {
                $dateLog = $key['date_log'];

                if ($timeCheck == 5 && $dateAdd % $dateLog == 0 ) {
                } else if ($timeCheck == 10 && $dateAdd % $dateLog == 0) {
                } else if ($timeCheck == 15 && $dateAdd % $dateLog == 0) {
                }
            }

            if (help($siteName, $protocol) == (200 <= 399)) {
                $status = 0;//"работает";
                $sql = mysqli_query($db->connect, "INSERT INTO `log` ( `date_log`, `status`,`id_form`) VALUES ('" . time() . "', '" . $status . "','" . $id_form . "' )");
                echo "INSERT INTO `log` (`name_site_log`, `date_log`, `status`) VALUES ('" . $siteName . "', '" . time() . "', 'работает' ).<br>";
            } else {
                $status = 1; //"не работает";
                $sql = mysqli_query($db->connect, "INSERT INTO `log` ( `date_log`, `status`,`id_form`) VALUES ('" . time() . "', '" . $status . "','" . $id_form . "' )");
                echo "INSERT INTO `log` (`name_site_log`, `date_log`, `status`) VALUES ('" . $siteName . "', '" . time() . "', 'не работает' ).<br>";
//  ************************** СКРИПТ бота для отправки сообщений
                $text="***";
                //  сюда нужно вписать токен вашего бота
                define('TELEGRAM_TOKEN', '$keyTelegram');
                //  сюда нужно вписать ваш внутренний айдишник
                define('TELEGRAM_CHATID', '$idTelegram');
                message_to_telegram('Сайт лежит ');
            }
        }

function message_to_telegram($text) {
    $ch = curl_init();
    curl_setopt_array(
        $ch,
        array (
            CURLOPT_URL => 'https://api.telegram.org/bot' . TELEGRAM_TOKEN . '/sendMessage',
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_POSTFIELDS => array(
                'chat_id' => TELEGRAM_CHATID,
                'text' => $text,
            ),
        )
    );
    curl_exec($ch);
}
//  ************************** СКРИПТ бота для отправки сообщений