<?php
namespace controllers\admin;

class monitoring
{
    public function index()
    {
        $db = new \core\db();
        $connect = $db->connect;

        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        $count_query = mysqli_query($connect, "SELECT COUNT(`name_site`) FROM `forma`");
        $count_array = $count_query->fetch_array(MYSQLI_NUM);
        $count = $count_array[0];
        $limit = 10;
        $start = ($page * $limit) - $limit;
        $length = ceil($count / $limit);
        $queryRequest = "SELECT * FROM `forma` ORDER BY `id` DESC  LIMIT $start, $limit";
        $query = mysqli_query($connect, $queryRequest);
        $row = mysqli_fetch_all($query, MYSQLI_ASSOC);

        $view = new \core\view('monitoring', ['count' => $count, 'row' => $row, 'length' => $length, 'page' => $page]);
        $view->render();
    }

    public function delete()
    {
        $db = new \core\db();
        $id = $db->escape($_GET['id']);
        $query = "DELETE FROM `forma` WHERE id = $id";

        if (mysqli_query($db->connect, $query)) {
            header("Location: /admin/monitoring");
        } else {
            echo "Ошибка, не удалось удалить";
        }
    }

    public function show()
    {
        $db = new \core\db();
        $id = $db->escape($_GET['id']);
        $query = "SELECT * FROM `forma` WHERE id='".$id."'";
        $result = mysqli_query($db->connect, $query ) or die(mysqli_error($db->connect));
        $row = mysqli_fetch_assoc($result);
        $query1 = "SELECT * FROM `forma` WHERE id='".$id."'";
        $result1 = mysqli_query($db->connect, $query1);
        $row1 = mysqli_fetch_assoc($result1);

        $view = new \core\view('monitoring_view', ['row' => $row, 'row1'=>$row1]);
        $view->render();
    }

    public function edit()
    {
        $db = new \core\db();
        $id = $db->escape($_GET['id']);

        $query = "SELECT * FROM `forma` WHERE id='" . $id . "'";
        $result = mysqli_query($db->connect, $query) or die(mysqli_error($db->connect));
        $row = mysqli_fetch_assoc($result);

        $updateMessage = null;
        if (isset($_SESSION['update'])) {
            $updateMessage = $_SESSION['update'];
            unset($_SESSION['update']);
        }

        $view = new \core\view('monitoring_save', ['row'=> $row,'updateMessage'=>$updateMessage ]);
        $view->render();
    }

    public function update()
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
            mysqli_query($db->connect, $query);
            $_SESSION['update'] = 'успешно сохранилось';
            header("Location: /admin/monitoring_edit?id=".urlencode($id));
        } else {
            echo "Ошибка, не удалось редактировать";
        }
    }
}
