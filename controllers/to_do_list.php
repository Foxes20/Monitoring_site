<?php
namespace controllers;

class to_do_list
{
    public function write_to_do()
    {
        $db = new \core\db();
        $id = $_SESSION['auth'];
        $title = $_POST['title'];
        $errors = [];

        if ($title == '') {
            $errors['errorMessage'] = 'Поле не может быть пустым';
        }
        if ($errors !== []) {
            $_SESSION['errors'] = $errors;
            header("Location: /show_to_do");
            return;
        }
        $queryTitle = "INSERT INTO `to_do` (`user_id`, `title`) 
                                                         VALUES ('" . $id . "','" . $title . "')";
        $resultToDo = mysqli_query($db->connect, $queryTitle) or die(mysqli_error($db->connect));
        mysqli_fetch_all($resultToDo, MYSQLI_ASSOC);

        if ($resultToDo) {
            $_SESSION['message_added'] = 'Запись успешно добавлена';
        }

        header("Location: /show_to_do");
    }

    public function delete_to_do()
    {
        $db = new \core\db();
        $idTitle = $_POST['id'];
        $errorsDel = [];
        $query = "DELETE FROM `to_do` WHERE id = '" . $idTitle . "'";

        if (mysqli_query($db->connect, $query)) {
            $errorsDel['delMessage'] = 'Успешно удалено';
        }

        if ($errorsDel !== []) {
            $_SESSION['errorsDel'] = $errorsDel;
            header("Location: /show_to_do");
            return;
        }
    }
    public function update_to_do()
    {
        $db = new \core\db();

        $title_upd = $_POST['title_upd'];
        $id = $_POST['record_id'];
        $errors = [];

        if ($title_upd == '') {
            $errors['title_err'] = 'Поле не может быть пустым';
        }

        if ($errors !== []) {
            $_SESSION['errors'] = $errors['title_err'];
            header('location: /preparing_to_edit_to_do?id=' . urlencode($id));
            return;
        }
        $update_record_in_to_do = "UPDATE `to_do` 
                                    SET title = '$title_upd' 
                                    WHERE id = '" . $id . "'";
        if (mysqli_query($db->connect, $update_record_in_to_do)) {
            $_SESSION['message_ok'] = 'Запись успешно изменена';
        }

        header('location: /preparing_to_edit_to_do?id=' . urlencode($id));
    }

    public function preparing_to_edit_to_do()
    {
        $db = new \core\db();
        $user_id = $_SESSION['auth'];
        $id = $_GET['id'];

        $message_ok = NULL;
        if (isset($_SESSION['message_ok'])) {
            $message_ok = $_SESSION['message_ok'];
            unset($_SESSION['message_ok']);
        }

        $errors = NULL;
        if (isset($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
        }

        $query = "SELECT * FROM `to_do` WHERE user_id = '".$user_id."' AND id = $id";
        $result = mysqli_query($db->connect, $query);
        $dataTitle = mysqli_fetch_assoc($result);


        $view = new \core\view('/show_edit_to_do',['dataTitle'=>$dataTitle, 'errors'=>$errors, 'message_ok'=>$message_ok]);
        $view->render();
    }

    public function show_to_do()
    {
        $db = new \core\db();
        if (!unregisteredUser()) {
            return;
        }
        $id = $_SESSION['auth'];

        $message_added = NULL;
        if (isset($_SESSION['message_added'])) {
            $message_added = $_SESSION['message_added'];
//            var_dump($message_added);die();
            unset($_SESSION['message_added']);
        }

        $errorsDel = NULL;
        if (isset($_SESSION['errorsDel'])) {
            $errorsDel = $_SESSION['errorsDel'];
            unset($_SESSION['errorsDel']);
        }
        $errors = NULL;
        if (isset($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
        }

            $query = "SELECT * FROM `to_do` WHERE user_id = '".$id ."'";
            $result = mysqli_query($db->connect, $query);
            $outputData = mysqli_fetch_all($result, MYSQLI_ASSOC) or die(mysqli_error($db->connect));

            $view = new \core\view('/to_do_list', ['outputData'=>$outputData,'errors'=>$errors, 'errorsDel'=>$errorsDel,  'message_added'=>$message_added]);
            $view->render();
    }
}
