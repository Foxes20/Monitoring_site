<?php
namespace controllers\admin;

class feedback_edit
{
    public function run()
    {
        $db = new \core\db();
        $connect = $db->connect;

        $id = $db->escape($_GET['id']);
        $query = "SELECT * FROM feedback WHERE id='".$id."'";
        $result = mysqli_query($connect, $query ) or die(mysqli_error($connect));
        $output = mysqli_fetch_assoc($result) or die(mysqli_error($connect));

        $sql1 = "SELECT content FROM answers WHERE feedback_id=$id";
        $query1 = mysqli_query($db->connect, $sql1);
        $row1 = mysqli_fetch_all($query1);

        $view = new \core\view('feedback_view', ['output' => $output, 'row1' => $row1]);
        $view->render();
    }
}
