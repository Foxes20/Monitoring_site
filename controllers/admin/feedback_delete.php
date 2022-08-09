<?php
namespace controllers\admin;

class feedback_delete
{
    public function run()
    {
        $db = new \core\db();
        $connect =$db->connect;

        $userId = $db->escape($_GET['id']);

        $query = "DELETE FROM `feedback` WHERE id = $userId";

        if (mysqli_query($connect, $query)) {

            header("Location: /admin/feedback");
        } else {
            echo "Ошибка, не удалось удалить";
        }
    }
}
