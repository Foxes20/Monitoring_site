<?php
namespace controllers\admin;

class monitoring_delete
{
    public function run()
    {
        $db = new \core\db();
        $id = $db->escape($_GET['id']);

        $query = "DELETE FROM `forma` WHERE id = $id";

        if (mysqli_query($db->connect, $query)) {
            header("Location: /admin/monitoring_show");
        } else {
            echo "Ошибка, не удалось удалить";
        }
    }
}
