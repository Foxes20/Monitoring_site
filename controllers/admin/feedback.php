<?php
namespace controllers\admin;

class feedback
{
    public function run()
    {
        $db = new \core\db();
        $sql = $db->connect;

        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        $count_query = mysqli_query($sql, "SELECT COUNT(`message`) FROM `feedback` ");
        $count_array = $count_query->fetch_array(MYSQLI_NUM);

        $count = $count_array[0];
        $limit = 10;
        $start = ($page * $limit) - $limit;
        $length = ceil($count / $limit);

        $sqlRequest = "SELECT `message` FROM `feedback` ORDER BY `id` DESC  LIMIT $start, $limit";
        $query = mysqli_query($db->connect, $sqlRequest);
        $rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

        $view = new \core\view('feedback', ['total' => $count, 'items' => $rows, 'length' => $length, 'page' => $page]);
        $view->render();
    }
}
