<?php
require_once("dbmanager.php");

class Sort extends DbManager {
    function sorting($sort){
        $query = $_SESSION['current_list']." ORDER BY ".array_keys($sort)[0]." ".$sort[array_keys($sort)[0]];

        if($run = mysqli_query($this->conn, $query)){
            return $run;
        }else{ return false; }
    }
}
?>
