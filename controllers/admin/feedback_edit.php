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

        $view = new \core\view('feedback_view', ['output' => $output]);
        $view->render();
    }
}
