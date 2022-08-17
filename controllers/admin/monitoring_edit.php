<?php
namespace controllers\admin;

class monitoring_edit
{
    public function run()
    {
        $db = new \core\db();
        $id = $db->escape($_GET['id']);
        $query = "SELECT * FROM `forma` WHERE id='".$id."'";
        $result = mysqli_query($db->connect, $query ) or die(mysqli_error($db->connect));
        $row = mysqli_fetch_assoc($result);

        $query1 = "SELECT * FROM `forma` WHERE id='".$id."'";
        $result1 = mysqli_query($db->connect, $query1);
        $row1 = mysqli_fetch_assoc($result1);

        $view = new \core\view('monitoring_view', ['row' => $row, 'row1'=>$row1]);
        $view->render();
    }
}
