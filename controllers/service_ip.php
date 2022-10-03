<?php
namespace controllers;

class service_ip
{
    public function index()
    {
            $ip = \getIp();
            $path = CUR_DIR . '/SxGeo/SxGeoCity.dat';
            $SxGeo = new \SxGeo(str_replace('\\', DIRECTORY_SEPARATOR, $path), SXGEO_BATCH | SXGEO_MEMORY);
            $city = $SxGeo->GetCityFull($ip);
            $port = $_POST['checkPort'];
            $server = $_POST['checkServer'];
            $fp = @fsockopen($server, $port, $errno, $errstr, 5);

            if (isset($_SESSION['auth'])) {
                $auth = $_SESSION['auth'];
            }

            $view = new \core\view('main', ['ip' => $ip, 'city' => $city,'auth'=>$auth]);
            $view->render();
        }

    public function rport()
    {
        //require_once './core/db.php';
        if ($_POST['checkPort']) {
            if (isset($_POST['checkPort']) && !empty($_POST['checkPort'])) {
                $port = $_POST['checkPort'];// Формируем массив для JSON ответа
            }
            if (isset($_POST['checkServer']) && !empty($_POST['checkServer'])) {
                $server = $_POST['checkServer'];// Формируем массив для JSON ответа
            }

            $fp = @fsockopen($server, $port, $errno, $errstr, 3);
            if ($fp === false) {
                echo json_encode(['port'=> $port, 'server'=> $server, 'status'=>'no']);
            } else {
                echo json_encode(['port'=> $port, 'server'=> $server, 'status'=>'ok']);
                fclose($fp);
            }
        }
    }

    public function rmonitoring()
    {
//        if (!empty($_SESSION['auth'])) {
//var_dump($_SESSION['auth']);die();
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
                    echo json_encode(['message' => 'Все оки', 'status' => 'ok', 'siteName' => $siteName, 'answer' => implode('<br>', $headers)]);
                } else {
                    echo json_encode(['message' => 'Введите коректный адрес', 'status' => 'no']);
                }
            }
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
                                echo json_encode(['message' => 'Ping successful!', 'status' => 'ok','output' => implode('<br>', $output) ]);
                            } else {
                                echo json_encode(['message' => 'Ping unsuccessful!', 'status' => 'no']);
                            }
                        }
                        echo json_encode(['host'=> $host, 'time_request' => $time_request, 'mail' => $mail, 'mailIHiddenInp' => $mailIHiddenInp, 'telega' => $telega, 'telegaIHiddenKey'=> $telegaIHiddenKey, 'telegaIHiddenIp'=> $telegaIHiddenIp, 'status' => 'ok', 'data' => date('d.m.Y H:i:s')]);
                    } else {
                        echo json_encode(['message' => 'НЕ отправлено ', 'status' => 'no']);
                    }
                }
            }
    //  *****************из db*******
            if ($_POST['saitePing']) {
                $date = time();
                $name_site = $db->escape($_POST['saitePing']);
                $protocol_site = $db->escape($_POST['selectProtocol']);
                $time_check = $db->escape($_POST['selectTime_request']);
                $address_mail = $db->escape($_POST['mailIHiddenInpName']);
                $id_telegram = $db->escape($_POST['telegaIHiddenIpNameIp']);
                $key_telegram = $db->escape($_POST['telegaIHiddenIpNameKey']);

                $sql = "INSERT INTO forma (`name_site`, `protocol_site`, `time_check`, `address_mail`, `id_telegram`, `key_telegram`, `date_add`) 
                        VALUES ('".$name_site."', '".$protocol_site."', '".$time_check."', '".$address_mail."', '".$id_telegram."', '".$key_telegram."', '".$date."' )";

                if (mysqli_query($db->connect, $sql)) {
                    echo json_encode(['message' => 'Записи успешно добавлены.', 'status' => 'ok' ]);
                } else {
                    echo json_encode(['message' => "ERROR: Не удалось выполнить $sql. ". mysqli_error($db->connect), 'status' => 'no']);
                }
            }
//        } else {
//            $_SESSION['authReg'] = 'Нужно авторизироваться для доступа к постановки сайта на мониторинг!';

            $view = new \core\view('register_controller');
            $view->render();
//        }
    }

    public function rip()
    {
        if ($_POST['check_ip']) {
            if (isset($_POST['check_ip']) && !empty($_POST['check_ip'])) {
                $ip = $_POST['check_ip'];// Формируем массив для JSON ответа
                if ( filter_var($ip, FILTER_VALIDATE_IP)) {

                    $path = CUR_DIR.'/SxGeo/SxGeoCity.dat';
                    $SxGeo = new \SxGeo(str_replace('\\', DIRECTORY_SEPARATOR, $path) , SXGEO_BATCH | SXGEO_MEMORY);

                    $city = $SxGeo->GetCityFull($ip);
                    $country = $city['country']['name_ru'];
                    $flagContr = '<img
                                    src="https://flagcdn.com/28x21/'.strtolower($city['country']['iso']).'.png"
                                    srcset="https://flagcdn.com/56x42/'.strtolower($city['country']['iso']).'.png 2x,https://flagcdn.com/84x63/'.strtolower($city['country']['iso']).'.png 3x"
                                    width="28"
                                    height="21"
                                    alt="South Africa">';
                    $town = $city['city']['name_ru'];
                    $region = $city['region']['name_ru'];
                    $latitude = $city['city']['lat'];
                    $longitude = $city['city']['lon'];
                    echo json_encode(['servIP'=> $ip, 'status'=>'ok','country'=>$country, 'town'=>$town, 'region'=>$region, 'latitude'=>$latitude, 'longitude'=>$longitude, 'flagContr'=>$flagContr]);
                } else {
                    echo json_encode(['message'=>'Введите коректный адрес', 'status'=>'no']);
                }
            }
        }
    }


    public function rcontacts()
    {
        $db = new \core\db();
        $result = [];

        if (isset($_POST['name']))
            $name = $_POST['name'];
        if (isset($_POST['email']))
            $email = $_POST['email'];
        if (isset($_POST['message']))
            $message = $_POST['message'];
        if (isset($_POST['subject']))
            $subject = $_POST['subject'];

        if ($name === '') {
            echo json_encode (["Name cannot be empty"]);
            die();
        }
        if ($email === '') {
            echo json_encode (["Email cannot be empty."]);
            die();
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode (["Email format invalid."]);
                die();
            }
        }
        if ($subject === '') {
            echo json_encode (["Subject cannot be empty."]);
            die();
        }
        if ($message === '') {
            echo json_encode (["Message cannot be empty."]);
            die();
        }
        $content = "From: $name \nEmail: $email \nMessage: $message" ;
        $recipient = "php@palgov.ru";
        $mailheader = "From: $email \r\n";
        mail($recipient, $subject, $content, $mailheader) or die("Error!");
        $result['message'] = 'mail sent';

        if ($result) {
            $result['status'] = 'ok';
        } else {
            $result['status'] = 'no';
        }
        $name = $db->escape($name);
        $email = $db->escape($email);
        $message = $db->escape($message);
        $subject = $db->escape($subject);

        $sql = mysqli_query($db->connect, "INSERT INTO `feedback` ( `name`, `email`,`theme`, `message`)
                                                         VALUES ('".$name."', '".$email."','".$subject."','".$message."')");
        echo json_encode($result);
    }
    public function contacts()
    {
        $view = new \core\view('contact');
        $view->render();
    }
}
