<?php
namespace controllers\admin;

class monitoring_upd
{
    public function run()
    {
        $db = new \core\db();
        $id = $db->escape($_GET['id']);

        if (isset($_POST['name_site'])) {
            $name_site = $db->escape($_POST['name_site']);
            $protocol_site = $db->escape($_POST['protocol_site']);
            $time_check = $db->escape($_POST['time_check']);
            $address_mail = $db->escape($_POST['address_mail']);
            $id_telegram = $db->escape($_POST['id_telegram']);
            $key_telegram = $db->escape($_POST['key_telegram']);

            $query = "UPDATE `forma`
                      SET name_site = '$name_site', protocol_site= '$protocol_site', time_check = '$time_check', address_mail = '$address_mail', id_telegram = '$id_telegram', key_telegram = '$key_telegram'
                      WHERE id='" . $id . "'";

            if (mysqli_query($db->connect, $query)) {
                header("Location: /admin/monitoring_save", $id);
            } else {
                echo "Ошибка, не удалось редактировать1";
            }
        } else {
            echo "Ошибка, не удалось редактировать2";
        }
    }
}
