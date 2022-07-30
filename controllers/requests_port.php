<?php
namespace controllers;

class requests_port {
    public function run() {
        require_once './core/db.php';
        //****************************** Port ****************************************
        if ($_POST['checkPort']) {
            if (isset($_POST['checkPort']) && !empty($_POST['checkPort'])) {
                $port = $_POST['checkPort'];// Формируем массив для JSON ответа
            }

            if (isset($_POST['checkServer']) && !empty($_POST['checkServer'])) {
                $server = $_POST['checkServer'];// Формируем массив для JSON ответа
            }

            $fp = @fsockopen($server, $port, $errno, $errstr, 3);
            fclose($fp);

            if ($fp) {
                echo json_encode(['port'=> $port, 'server'=> $server, 'status'=>'ok']);
            } else {
                echo json_encode(['port'=> $port, 'server'=> $server, 'status'=>'no']);
            }
        };
    }
}
