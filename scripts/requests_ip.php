<?php
class requests_ip {
    public function run() {
        /**
         * @var object $connect это переменная из подключаемого файла db_service.php , в ней подключение к базе
         */
        require_once 'db_service.php';
        require_once 'requests_ip.php';

//*********************************  IP  ******************************
//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);// ключает вывод ошибок



        if($_POST['check_ip']){
            if(isset($_POST['check_ip']) && !empty($_POST['check_ip'])){

                $ip = $_POST['check_ip'];// Формируем массив для JSON ответа
                if( filter_var($ip, FILTER_VALIDATE_IP)){
                    require_once './SxGeo/SxGeo.php';
                    $sxGeo = new sxGeo('./SxGeo/SxGeoCity.dat', SXGEO_BATCH | SXGEO_MEMORY);
                    $city = $sxGeo->GetCityFull($ip);
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
                }else{
                    echo json_encode([message=>'Введите коректный адрес', 'status'=>'no']);
                }
            }
        };
    }
}
