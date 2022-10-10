<?php
namespace controllers;
use core\view;

class change_password
{
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
//        ----------
         $newPassword = $_POST['new_password'];
         $confirmNewPassword = $_POST['confirm_new_password'];
//         -------------------------------------------------------------------------
//         if ($_SESSION['auth'] == NULL) {
//             $errorsAuth['errorsAuth'] = 'Необходимо авторизироваться';
//         }
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
             $sql = "UPDATE registration SET password = '$hashNewPassword' WHERE id = '$id'";
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
