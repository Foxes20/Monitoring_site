<?php
namespace controllers;

class requests_ip {
    public function run() {
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
                    echo json_encode([message=>'Введите коректный адрес', 'status'=>'no']);
                }
            }
        };
    }
}
