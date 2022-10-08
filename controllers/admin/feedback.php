<?php
namespace controllers\admin;

class feedback
{
    public function index()
    {
        if (!unregisteredUser()) {
            return;
        }
        $db = new \core\db();
        $connect = $db->connect;

        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        $count_query = mysqli_query($connect, "SELECT COUNT(`message`) FROM `feedback` ");
        $count_array = $count_query->fetch_array(MYSQLI_NUM);
        $count = $count_array[0];
        $limit = 10;
        $start = ($page * $limit) - $limit;
        $length = ceil($count / $limit);
        $queryRequest = "SELECT * FROM `feedback` ORDER BY `id` DESC  LIMIT $start, $limit";
        $query = mysqli_query($connect, $queryRequest);
        $row = mysqli_fetch_all($query, MYSQLI_ASSOC);

        $view = new \core\view('feedback', ['total' => $count, 'rows' => $row, 'length' => $length, 'page' => $page]);
        $view->render();
    }

    public function answers()
    {
        if (!unregisteredUser()) {
            return;
        }
        $db = new \core\db();
        $result = [];

        if (isset($_POST['message1']))
            $message1 = $_POST['message1'];

        if ($message1 === '') {
            echo json_encode(["Message cannot be empty."]);
            die();
        }
        $id = $db->escape($_GET['id']);
        $message1 = $db->escape($message1);
        $sqlEmail = "SELECT `email` FROM `feedback` WHERE id = $id";
        $query = mysqli_query($db->connect, $sqlEmail);
        $row = mysqli_fetch_assoc($query);
        $recipient = $row['email'];
        $mailheader = "Ответ: $message1 \r\n";
        $mail = mail($recipient, $message1, $mailheader) or die("Error!");

        if ($mail) {
            $result['message'] = 'mail sent';
        } else {
            $result['message'] = 'mail not sent';
        }

        if ($result != 'mail not sent') {
            $result['status'] = 'ok';
        } else {
            $result['status'] = 'no';
        }
        $sql = mysqli_query($db->connect, "INSERT INTO `answers` (`feedback_id`, `content`) 
                                                         VALUES ('" . $id . "','" . $message1 . "')") or die(mysqli_error($db->connect));
        echo json_encode($result);
    }

    public function edit()
    {
        if (!unregisteredUser()) {
            return;
        }
        $db = new \core\db();
        $connect = $db->connect;
        $id = $db->escape($_GET['id']);
        $query = "SELECT * FROM `feedback` WHERE id='" . $id . "'";
        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
        $output = mysqli_fetch_assoc($result) or die(mysqli_error($connect));
        $sql1 = "SELECT content FROM `answers` WHERE feedback_id=$id";
        $query1 = mysqli_query($db->connect, $sql1);
        $row1 = mysqli_fetch_all($query1);

        $view = new \core\view('feedback_view', ['output' => $output, 'row1' => $row1]);
        $view->render();
    }

    public function delete()
    {
        if (!unregisteredUser()) {
            return;
        }
        $db = new \core\db();
        $connect = $db->connect;
        $userId = $db->escape($_GET['id']);
        $query = "DELETE FROM `feedback` WHERE id = $userId";

        if (mysqli_query($connect, $query)) {
            header("Location: /admin/feedback");
        } else {
            echo "Ошибка, не удалось удалить";
        }
    }
}
