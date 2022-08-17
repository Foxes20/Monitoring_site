<?php
namespace controllers\admin;

class monitoring_show
{
    public function run()
    {
        $db = new \core\db();
        $connect = $db->connect;

        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        $count_query = mysqli_query($connect, "SELECT COUNT(`name_site`) FROM `forma`");
        $count_array = $count_query->fetch_array(MYSQLI_NUM);

        $count = $count_array[0];
        $limit = 10;
        $start = ($page * $limit) - $limit;
        $length = ceil($count / $limit);

        $queryRequest = "SELECT * FROM `forma` ORDER BY `id` DESC  LIMIT $start, $limit";
        $query = mysqli_query($connect, $queryRequest);
        $row = mysqli_fetch_all($query, MYSQLI_ASSOC);

        $view = new \core\view('monitoring', ['count' => $count, 'row' => $row, 'length' => $length, 'page' => $page]);
        $view->render();
    }
}
