<?php
namespace controllers;

class request_contacts {
    public function run() {
            if (isset($_POST['name']))
                $name = $_POST['name'];
            if (isset($_POST['email']))
                $email = $_POST['email'];
            if (isset($_POST['message']))
                $message = $_POST['message'];
            if (isset($_POST['subject']))
                $subject = $_POST['subject'];

            $content = "From: $name \n Email: $email \n Message: $message";
            $recipient = "php@palgov.ru";
            $mailheader = "From: $email \r\n";

            if (mail($recipient, $subject, $content, $mailheader)) {
               echo json_encode(['status'=>'ok']);
            } else {
              echo json_encode(['status'=>'no']);
            }
    }
}
