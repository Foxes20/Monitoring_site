<?php
namespace controllers;

class methods_for_registration_controller
{
    public function register_user()
    {
        $db = new \core\db();
        $errors = [];
        $old = [];

        $login = $db->escape($_POST['login']);
        $password = $db->escape($_POST['password']);

        $sql = "SELECT `login` FROM `registration` WHERE login = '$login'";
        $result = mysqli_query($db->connect, $sql) or die(mysqli_error($db->connect));
        $row = mysqli_fetch_assoc($result);

        if ($_POST['login'] !== '') {
            if ((strlen($_POST['login']) >= 2 && strlen($_POST['login']) <= 30) == false) {
                $errors['login'] = 'login должен быть не менее 2 символов и не более 30';
                $old['login'] = $_POST['login'];
            }
            if ($row !== NULL) {
                $errors['login'] = 'такой login уже существует';
                $old['login'] = $_POST['login'];
            }
        } else {
            $errors['login'] = 'login не может быть пустым';
        }

        if ($_POST['password'] !== '') {
            if ((strlen($_POST['password']) >= 3 && strlen($_POST['password']) <= 10) == false) {
                $errors['password'] = 'password должен быть не менее 3 символов и не более 10';
            }
            if ($_POST['password'] !== $_POST['checkPassword']) {
                $errors['checkPassword'] = 'пароли не совпадают';
            }
        } else {
            $errors['password'] = 'password не может быть пустым';
        }

        if ($old !== []) {
            $_SESSION['old'] = $old;
        }
        if ($errors !== []) {
            $_SESSION['errors'] = $errors;
            header("Location: /show_registration_form" );
            return;
        }

        if ($row == NULL) {
            $insert = "INSERT INTO `registration`(`login`,`password`)VALUES('".$login."', '".$password."')";
            mysqli_query($db->connect, $insert);
            $_SESSION['insert'] = 'Авторизация прошла успешно';
            header("Location: /show_registration_form" );
        }
    }

    public function show_registration_form()
    {
        $old = NULL;
        if (isset($_SESSION['old'])) {
            $old = $_SESSION['old'];
            unset($_SESSION['old']);
        }

        $errorMessage = NULL;
        if (isset($_SESSION['errors'])) {
            $errorMessage = $_SESSION['errors'];
            unset($_SESSION['errors']);
        }

        $insertMessage = NULL;
        if (isset($_SESSION['insert'])) {
            $insertMessage = $_SESSION['insert'];
            unset($_SESSION['insert']);
        }

        $view = new \core\view('./register_controller', ['old' => $old, 'errorMessage' => $errorMessage,'insertMessage'=> $insertMessage]);
        $view->render();
    }
}
