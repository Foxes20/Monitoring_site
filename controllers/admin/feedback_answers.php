<?php
namespace controllers\admin;

class feedback_answers
{
    public function run()
    {
        $db = new \core\db();
        $result = [];

        if (isset($_POST['message1']))
            $message1 = $_POST['message1'];

        if ($message1 === '') {
            echo json_encode (["Message cannot be empty."]);
            die();
        }
        $id = $db->escape($_GET['id']);
        $message1 = $db->escape($message1);

        $sqlEmail = "SELECT `email` FROM `feedback` WHERE id = $id";
        $query = mysqli_query($db->connect, $sqlEmail);
        $row = mysqli_fetch_assoc($query);

        $recipient = $row['email'];
        $mailheader = "Ответ: $message1 \r\n";
        $mail = mail($recipient, $message1, $mailheader)or die("Error!");

        if ($mail){
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
                                                         VALUES ('".$id."','".$message1."')")  or die(mysqli_error($db->connect));
        echo json_encode($result);
    }
}
