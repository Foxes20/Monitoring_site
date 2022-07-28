<?php
class DB {
    public function DB() {

        $servername = "Localhost";
        $username   = "service_dev_user";
        $password   = "bR3gX4uX0jtV2n";
        $dbname     = "service_dev";

        $connect = mysqli_connect($servername, $username, $password, $dbname);
        mysqli_set_charset($connect , "utf8");
        if (!$connect) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }
}
 // mysqli_close($connect);
?>