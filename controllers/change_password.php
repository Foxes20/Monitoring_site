<?php
namespace controllers;
use core\view;

class change_password
{
    public function logics_password_recovery()
    {
        $db = new \core\db();
        $mail = rtrim($_POST['mail']);
        $errors = [];
        $old = [];
        $bytes = openssl_random_pseudo_bytes(8);
        $key = bin2hex($bytes);

        $sqlQuery = "SELECT * FROM `registration` WHERE mail = '$mail'";
        $result = mysqli_query($db->connect, $sqlQuery) or die (mysqli_error($db->connect));
        $row = mysqli_fetch_assoc($result);
        $userId = $row['id'];
        $userMail = $row['mail'];

        if ($mail !== '') {
            $old['mail'] = $_POST['mail'];
            if($mail !== $userMail) {
                $errors['mail'] = 'Такой почты не существует';
                if (filter_var($mail, FILTER_VALIDATE_EMAIL) == false) {
                    $errors['mail'] = 'mail не корректный';
                }
            }
        } else {
            $errors['mail'] = 'Майл не может быть пустым';
        }
        if ($old !== []) {
            $_SESSION['old'] = $old;
        }
        if ($errors !== []) {
            $_SESSION['errors'] = $errors;
            header("Location: /show_password_recovery" );
            return;
        }
        $sqlQuery = "INSERT INTO `token` (`token`, `user_id`) VALUES ('".$key."', '".$userId."')";
        mysqli_query($db->connect, $sqlQuery) or die (mysqli_error($db->connect));

        $sqlQuery1 = "SELECT * FROM `token` WHERE token='".$key."'";
        $result1 = mysqli_query($db->connect, $sqlQuery1) or die(mysqli_error($db->connect));
        mysqli_fetch_assoc($result1);

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "To: <'$mail'>\r\n";
        $headers .= "From: <$mail>\r\n";
        $message = '
                <html>
                <head>
                <title>Подтвердите Email</title>
                </head>
                <body>
                <p>Что бы восстановить пароль перейдите по <a href="https://dev.trustik.ru/new_password?key='.$key.'">ссылка</a></p>
                </body>
                </html>
                ';
        if (mail($mail, "Восстановление пароля через Email", $message, $headers)) {
            $_SESSION['linkPas'] = 'Ссылка для восстановления пароля отправленная на вашу почту';
            header("location: /show_password_recovery");
        } else {
            $_SESSION['linkPas'] = 'Произошла какая то ошибка, письмо отправилось';
        }
    }

    public function show_password_recovery()
    {
        $linkPas = NULL;
        if (isset($_SESSION['linkPas'])) {
            $linkPas = $_SESSION['linkPas'];
            unset($_SESSION['linkPas']);
        }
        $errorMessage = NULL;
        if (isset($_SESSION['errors'])) {
            $errorMessage = $_SESSION['errors'];
            unset($_SESSION['errors']);
        }
        $old = NULL;
        if (isset($_SESSION['old'])) {
            $old = $_SESSION['old'];
            unset($_SESSION['old']);
        }
        $view = new \core\view('./password_recovery',['errorMessage' => $errorMessage, 'old'=>$old, 'linkPas'=>$linkPas] );
        $view->render();
    }

    public function change_password_method()
    {
        $db = new \core\db();
        $newPassword = rtrim($_POST['newPassword']);
        $confirmPassword = rtrim($_POST['confirmPassword']);
        $errors = [];
        $sqlQuery = "SELECT * FROM `token` WHERE token='".$_POST['key']."'";
        $result = mysqli_query($db->connect, $sqlQuery) or die(mysqli_error($db->connect));
        $row = mysqli_fetch_assoc($result);

        if ($newPassword !== '') {
            if ((strlen($newPassword) >= 3 && strlen($newPassword) <= 60) == false) {
                $errors['newPassword'] = 'password должен быть не менее 3 символов и не более 60';
            }
            if ($newPassword !== $confirmPassword) {
                $errors['newPassword'] = 'пароли не совпадают';
            }
        } else {
            $errors['newPassword'] = 'password не может быть пустым';
        }

        if ($errors !== []) {
            $_SESSION['errors'] = $errors;
            header("Location: ./new_password?key=" . urlencode($_POST['key']));
            return;
        }
        $hashNewPassword  = password_hash($newPassword, PASSWORD_DEFAULT);
        if ($row !== NULL) {
            $sql = "UPDATE `registration` SET password = '$hashNewPassword' WHERE id = '".$row['user_id']."'";
            mysqli_query($db->connect, $sql) or die (mysqli_error($db->connect));
            $_SESSION['update'] = 'Смена пароля прошла успешно';
            $queryDelete = "DELETE FROM `token` WHERE user_id = '".$row['user_id']."'";
            mysqli_query($db->connect, $queryDelete) or die (mysqli_error($db->connect));
            header("Location: ./new_password" );
        }
    }

    public function new_password()
    {
        $errorMessage = NULL;
        if (isset($_SESSION['errors'])) {
            $errorMessage = $_SESSION['errors'];
            unset($_SESSION['errors']);
        }
        $update = NULL;
        if (isset($_SESSION['update'])) {
            $update = $_SESSION['update'];
            unset($_SESSION['update']);
        }

        $view = new \core\view('./new_password', ['errorMessage'=>$errorMessage, 'update'=>$update]);
        $view->render();
    }

    public function change_password_users(){
        $db = new \core\db();
        $id = $_SESSION['auth'];
        $errors = [];
        $errorsAuth = [];

        $sql = "SELECT * FROM `registration` WHERE id = '$id'";
        $res = mysqli_query($db->connect, $sql) or die (mysqli_error($db->connect));
        $row = mysqli_fetch_assoc($res);

        $hash = $row['password'];//хеш старого пароля из бд
        $oldPassword = $_POST['old_password'];
        $newPassword = $_POST['new_password'];
        $confirmNewPassword = $_POST['confirm_new_password'];

         if (!unregisteredUser()) {
             return;
         }
         if ($oldPassword !== '') {
             if (password_verify($oldPassword, $hash) == false) {
                 $errors['old_password'] = 'Старый пароль не верный';
             }
         } else {
             $errors['old_password'] = 'Пароль не может быть пустым';
         }

         if ($newPassword !== '') {
             if ((strlen($newPassword) >= 3 && strlen($newPassword) <= 60) == false) {
                 $errors['new_password'] = 'password должен быть не менее 3 символов и не более 60';
             }
         } else {
             $errors['new_password'] = 'Пароль не может быть пустым';
         }
         if ($newPassword !== $confirmNewPassword) {
             $errors['comparePasswords'] = 'Пароли не совпадают';
         }
         if ($errors !== []) {
             $_SESSION['errors'] = $errors;
             header("Location: /show_change_password_users" );
             return;
         }
         if ($errorsAuth !== []) {
             $_SESSION['errorsAuth'] = $errorsAuth;
             header("Location: /show_change_password_users" );
             return;
         }

         $hashNewPassword  = password_hash($newPassword, PASSWORD_DEFAULT);
         if ($row !== NULL) {
             $sql = "UPDATE `registration` SET password = '$hashNewPassword' WHERE id = '$id'";
             mysqli_query($db->connect, $sql) or die (mysqli_error($db->connect));
             $_SESSION['update'] = 'Смена пароля прошла успешно';
             header("Location: /show_change_password_users" );
         }
     }

    public function show_change_password_users(){
        $errors = NULL;
        if (isset($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
        }
        $updateMessage = NULL;
        if (isset($_SESSION['update'])) {
            $updateMessage = $_SESSION['update'];
            unset($_SESSION['update']);
        }
        $errorsAuth = NULL;
        if (isset($_SESSION['errorsAuth'])) {
            $errorsAuth = $_SESSION['errorsAuth'];
            unset($_SESSION['errorsAuth']);
        }
        $view = new \core\view('./change_password', ['errors'=>$errors,'updateMessage'=>$updateMessage,'errorsAuth'=>$errorsAuth]);
        $view->render();
    }
}
