<?php
namespace controllers;

class requests_monitoring {
    public function run() {
        $db = new \core\db();
//  ************************************ monitoring ************************************
        function help($url, $protocol = "http") {
            $ch = curl_init($protocol.'://'.$url);//  Инициализирует сеанс cURL
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_HEADER, true);    //  we want headers    true для включения заголовков в вывод.
            curl_setopt($ch, CURLOPT_NOBODY, true);    //  we don't need body   true для исключения тела ответа из вывода. Метод запроса устанавливается в HEAD. Смена этого параметра в false не меняет его обратно в GET.
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//  true для возврата результата передачи в качестве строки из curl_exec() вместо прямого вывода в браузер.
            curl_setopt($ch, CURLOPT_TIMEOUT, 2);//  Максимально позволенное количество секунд для выполнения cURL-функций.
            $output = curl_exec($ch);//Выполняет запрос cURL
            $httpcode = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
            curl_close($ch);//закрываем сеанс
            return $httpcode;
        }
        $siteName = $_POST['saiteIP'];
        if (isset($siteName) && !empty($siteName)) {
            if (help($_POST['saiteIP']) == (200 <= 399)) {
                stream_context_set_default(
                    array(
                        'http' => array(
                            'method' => 'HEAD'
                        )
                    )
                );
                $headers = get_headers($siteName);
                echo json_encode([message => 'Все оки', 'status' => 'ok', 'siteName'=>$siteName, 'answer'=>implode('<br>', $headers)]);
            } else {
                echo json_encode([message=> 'Введите коректный адрес', 'status'=>'no']);
            }
        };
//  ****************************************************************************
        if ($_POST['saiteIP']) {
            $host = $_POST['saitePing'];
            if (isset($host) && !empty($host)){
                if ($host > 5) {
                    $protocol = $_POST['selectProtocol'];
                    $time_request = $_POST['selectTime_request'];
                    $mail = $_POST['mail'];
                    $mailIHiddenInp = $_POST['mailIHiddenInpName'];
                    $telega = $_POST['telega'];
                    $telegaIHiddenKey = $_POST['telegaIHiddenIpNameKey'];
                    $telegaIHiddenIp = $_POST['telegaIHiddenIpNameIp'];

                    if ($host > 5 && $protocol !== null && $time_request !== null && $mail == 'mail' && $telega == 'telegram') {
                        exec("ping -c 4 " . $host, $output, $result);//  ping -c 4 для Виндовс
                        if ($result == 0) {
                            echo json_encode([message => 'Ping successful!', 'status' => 'ok','output' => implode('<br>', $output) ]);
                        } else {
                            echo json_encode([message => 'Ping unsuccessful!', 'status' => 'no']);
                        }
                    }
                    echo json_encode(['host'=> $host, 'time_request' => $time_request, 'mail' => $mail, 'mailIHiddenInp' => $mailIHiddenInp, 'telega' => $telega, 'telegaIHiddenKey'=> $telegaIHiddenKey, 'telegaIHiddenIp'=> $telegaIHiddenIp, 'status' => 'ok', 'data' => date('d.m.Y H:i:s')]);
                } else {
                    echo json_encode([message => 'НЕ отправлено ', 'status' => 'no']);
                }
            }
        };
//  *****************из db*******
        if ($_POST['saitePing']) {
            $date = time();
            $name_site = mysqli_real_escape_string($db->connect, $_POST['saitePing']);
            $protocol_site = mysqli_real_escape_string($db->connect, $_POST['selectProtocol']);
            $time_check = mysqli_real_escape_string($db->connect, $_POST['selectTime_request']);
            $address_mail = mysqli_real_escape_string($db->connect, $_POST['mail']);
            $id_telegram = mysqli_real_escape_string($db->connect, $_POST['telegaIHiddenIpNameIp']);
            $key_telegram = mysqli_real_escape_string($db->connect, $_POST['telegaIHiddenIpNameKey']);

            $sql = "INSERT INTO forma (`name_site`, `protocol_site`, `time_check`, `address_mail`, `id_telegram`, `key_telegram`, `date_add`) 
                    VALUES ('".$name_site."', '".$protocol_site."', '".$time_check."', '".$address_mail."', '".$id_telegram."', '".$key_telegram."', '".$date."' )";

            if (mysqli_query($db->connect, $sql)) {
                echo json_encode(['message' => 'Записи успешно добавлены.', 'status' => 'ok' ]);
            } else {
                echo json_encode(['message' => "ERROR: Не удалось выполнить $sql. ". mysqli_error($db->connect), 'status' => 'no']);
            }
        }
    }
}
