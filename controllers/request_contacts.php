<?php
namespace controllers;

class request_contacts {
    public function run() {
        $db = new \core\db();

        $result = [];

        if (isset($_POST['name']))
            $name = $_POST['name'];
        if (isset($_POST['email']))
            $email = $_POST['email'];
        if (isset($_POST['message']))
            $message = $_POST['message'];
        if (isset($_POST['subject']))
            $subject = $_POST['subject'];

        if ($name === '') {
            echo json_encode (["Name cannot be empty"]);
            die();
        }
        if ($email === '') {
            echo json_encode (["Email cannot be empty."]);
            die();
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode (["Email format invalid."]);
                die();
            }
        }
        if ($subject === '') {
            echo json_encode (["Subject cannot be empty."]);
            die();
        }
        if ($message === '') {
            echo json_encode (["Message cannot be empty."]);
            die();
        }
        $content = "From: $name \nEmail: $email \nMessage: $message" ;
        $recipient = "php@palgov.ru";
        $mailheader = "From: $email \r\n";
        mail($recipient, $subject, $content, $mailheader) or die("Error!");
        $result['message'] = 'mail sent';

        if($result) {
            $result['status'] = 'ok';
        } else {
            $result['status'] = 'no';
        }

        $name = mysqli_real_escape_string($db->connect, $_POST['name']);
        $email = mysqli_real_escape_string($db->connect, $_POST['email']);
        $message = mysqli_real_escape_string($db->connect, $_POST['message']);
        $subject = mysqli_real_escape_string($db->connect, $_POST['subject']);
        $sql = mysqli_query($db->connect, "INSERT INTO `feedback` ( `name`, `email`,`theme`, `message`)
                                                         VALUES ('".$name."', '".$email."','".$subject."','".$message."')");
       mail($recipient, $subject, $content, $mailheader);
       echo json_encode($result);
    }
}
