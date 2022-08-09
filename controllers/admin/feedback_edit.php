<?php
namespace controllers\admin;

class feedback_edit
{
    public function run()
    {
        $db = new \core\db();
        $connect = $db->connect;

        $q = mysqli_query($connect, "SELECT * FROM feedback WHERE id='".mysqli_real_escape_string($connect, $_GET['id'])."'") or die(mysqli_error($connect));
        $output = mysqli_fetch_assoc($q) or die(mysqli_error($connect));

        $view = new \core\view('feedback_view', ['output' => $output]);
        $view->render();
    }
}
