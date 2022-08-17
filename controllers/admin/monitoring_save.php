<?php
/**
 * @var array $row
 * @var array $row1
 **/
namespace controllers\admin;

class monitoring_save
{
    public function run()
    {
        $db = new \core\db();
        $id = $db->escape($_GET['id']);
        $query = "SELECT * FROM `forma` WHERE id='" . $id . "'";
        $result = mysqli_query($db->connect, $query) or die(mysqli_error($db->connect));
        $row = mysqli_fetch_assoc($result);

        $view = new \core\view('monitoring_save', ['row'=> $row]);
        $view->render();
    }
}