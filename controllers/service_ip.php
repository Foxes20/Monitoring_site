<?php
namespace controllers;

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
class service_ip {
    public function run() {

        $ip = \getIp();
        $path = CUR_DIR.'/SxGeo/SxGeoCity.dat';
        $SxGeo = new \SxGeo(str_replace('\\', DIRECTORY_SEPARATOR, $path) , SXGEO_BATCH | SXGEO_MEMORY);
        $city = $SxGeo->GetCityFull($ip);
        $port = $_POST['checkPort'];
        $server = $_POST['checkServer'];
        $fp = @fsockopen($server,$port,$errno,$errstr,5);

        include_once CUR_DIR.'/views/main.php';
     }
}
