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
        $email1 = $db->escape($_POST['email1']);
        $recipient = $email1;

        $mailheader = "Ответ: $message1 \r\n";

        mail($recipient, $message1, $mailheader) or die("Error!");
        $result['message'] = 'ответ отправлен';

        if ($result) {
            $result['status'] = 'ok';
        } else {
            $result['status'] = 'no';
        }
        $message1 = $db->escape($message1);

        $sql = mysqli_query($db->connect, "INSERT INTO `answers` (`content`) 
                                                         VALUES ('".$message1."')")  or die(mysqli_error($db->connect));

        echo json_encode($result);
    }
}
