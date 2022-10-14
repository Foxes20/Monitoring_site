<?php
namespace controllers;

use core\view;

class methods_for_registration_controller
{
    public function userAccount()
    {
        $db = new \core\db();
        $id = $_SESSION['auth'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $login = $_POST['login'];
        $errors = [];
        $old = [];

        $sqlQuery = "SELECT `login` FROM `registration` WHERE login = '$login'";
        $result = mysqli_query($db->connect, $sqlQuery) or die (mysqli_error($db->connect));
        $row = mysqli_fetch_assoc($result);

        if ($name !== '') {
            if ((strlen($name) >= 2 && strlen($name) <= 30) == false) {
                $errors['name'] = 'Имя должно быть не менее 2 символов и не более 30';
                $old['name'] = $_POST['name'];
            }
        } else {
            $errors['name'] = 'Имя не может быть пустым';
        }
        if ($surname !== '') {
            if ((strlen($surname) >= 2 && strlen($surname) <= 30) == false) {
                $errors['surname'] = 'Имя должно быть не менее 2 символов и не более 30';
                $old['surname'] = $_POST['surname'];
            }
        } else {
            $errors['surname'] = 'Фамилия не может быть пустой';
        }
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
        if ($old !== []) {
            $_SESSION['old'] = $old;
        }
        if ($errors !== []) {
            $_SESSION['errors'] = $errors;
            header("Location: /showUserAccount" );
            return;
        }
        $query = "UPDATE `registration`
                          SET name = '$name', surname = '$surname',  login = '$login'
                          WHERE id='" . $id . "'";
        mysqli_query($db->connect, $query);
        $_SESSION['update'] = 'успешно сохранилось';
        header("Location: /showUserAccount");
    }

    public function showUserAccount()
    {
        if (!unregisteredUser()) {
            return;
        }
        $db = new \core\db();
//__________________
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
        $updateMessage = NULL;
        if (isset($_SESSION['update'])) {
            $updateMessage = $_SESSION['update'];
            unset($_SESSION['update']);
        }
        //_______________________
        $id = $_SESSION['auth'];

        $sql ="SELECT `login`, `name`, `surname` FROM `registration` WHERE id = '$id'";
        $result = mysqli_query($db->connect, $sql) or die (mysqli_error($db->connect));
        $row = mysqli_fetch_assoc($result);

        $view = new \core\view('./account',['row'=>$row,'old' => $old, 'errorMessage' => $errorMessage,'updateMessage'=> $updateMessage]);
        $view->render();
    }

    public function loginAuth()
    {
        $db = new \core\db();
        $login = $_POST['loginAuth'];
        $password = $_POST['passwordAuth'];
        $sql = "SELECT * FROM `registration` WHERE login = '$login'";
        $result = mysqli_query($db->connect, $sql) or die (mysqli_error($db->connect));
        $row = mysqli_fetch_assoc($result);
        $hashPas = $row['password'];

        if (password_verify($password, $hashPas)) {
            if (isset($row)) {
                $_SESSION['auth'] = $row['id'];
                header("Location: /service_ip" );
            }
        } else {
            $_SESSION['auth'] = NULL;
            header("Location: /service_ip" );
        }
    }

    public function login()
    {
        $auth = NULL;
        if (isset($_SESSION['auth'])) {
            $auth = $_SESSION['auth'];
        }
        $view = new \core\view('./login', ['auth'=>$auth]);
        $view->render();
    }

    public function register_user()
    {
        $db = new \core\db();
        $errors = [];
        $old = [];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $login = $_POST['login'];
        $mailPat = $_POST['mail'];
        $password = $_POST['password'];

        $sql = "SELECT `login` FROM `registration` WHERE login = '$login'";
        $result = mysqli_query($db->connect, $sql) or die (mysqli_error($db->connect));
        $row = mysqli_fetch_assoc($result);

        if ($name !== '') {
            $old['name'] = $_POST['name'];
            if ((strlen($name) >= 2 && strlen($name) <= 30) == false) {
                $errors['name'] = 'Имя должно быть не менее 2 символов и не более 30';
            }
        } else {
            $errors['name'] = 'Имя не может быть пустым';
        }
        if ($surname !== '') {
            $old['surname'] = $_POST['surname'];
            if ((strlen($surname) >= 2 && strlen($surname) <= 30) == false) {
                $errors['surname'] = 'Имя должно быть не менее 2 символов и не более 30';
            }
        } else {
            $errors['surname'] = 'Фамилия не может быть пустой';
        }
        if ($_POST['login'] !== '') {
            $old['login'] = $_POST['login'];
            if ((strlen($_POST['login']) >= 2 && strlen($_POST['login']) <= 30) == false) {
                $errors['login'] = 'login должен быть не менее 2 символов и не более 30';
            }
            if ($row !== NULL) {
                $errors['login'] = 'такой login уже существует';
            }
        } else {
            $errors['login'] = 'login не может быть пустым';
        }
//******************************************************

        if ($_POST['mail'] !== '') {
            $old['mail'] = $_POST['mail'];
            if (filter_var($mailPat, FILTER_VALIDATE_EMAIL) == false) {
                $errors['mail'] = 'mail не корректный';
            }
        } else {
            $errors['mail'] = 'mail не может быть пустым';
        }

//******************************************************
        if ($_POST['password'] !== '') {
            if ((strlen($_POST['password']) >= 3 && strlen($_POST['password']) <= 60) == false) {
                $errors['password'] = 'password должен быть не менее 3 символов и не более 60';
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
        $hashPassword  = password_hash($password, PASSWORD_DEFAULT);
        if ($row == NULL) {
            $insert = "INSERT INTO `registration`(`login`,`password`, `name`, `surname`, `mail`)
                                    VALUES('".$login."', '".$hashPassword."', '".$name."','".$surname."','".$mailPat."')";
            mysqli_query($db->connect, $insert)or die (mysqli_error($db->connect));
            $_SESSION['insert'] = 'Регистрация прошла успешно';
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
