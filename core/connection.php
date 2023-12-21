<?php
    session_start();
    date_default_timezone_set("Europe/London");
    class Db {
        private function __construct() {}
        private function __clone() {}
        public static function getInstance() {
            return mysqli_connect("localhost", "dukevest", "dukevest", "dukevest_db");
                                   //host        username     password      database
        }
    }

    $conn = Db::getInstance();
?>
