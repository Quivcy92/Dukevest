<?php
    require_once("sort.php");

    class Fetch extends Sort {

        function fetchList($tableName, $sort=null){
            $current = "SELECT * FROM ".$tableName;
            $_SESSION['current_list'] = $current;

            if(is_null($sort)){
                if($query = mysqli_query($this->conn, $current)){
                    return $query;
                }else{ return false; }
            }else{
                return self::sorting($sort);
            }
        }

        function filterFetchList($filter, $tableName, $type, $style, $sort=null){
            $filters = array();

            foreach ($filter as $key => $value) {
                if($type == 'EXACT')array_push($filters, "".$key." = '".$value."'");
                if($type == 'KEYWORD')array_push($filters, "".$key." LIKE '%".$value."%'");
            }

            if($style == 'COMBINED')$query = "SELECT * FROM ".$tableName." WHERE ".implode(" AND ", $filters)."";
            if($style == 'SINGLE')$query = "SELECT * FROM ".$tableName." WHERE ".implode(" OR ", $filters)."";

            $_SESSION['current_list'] = $query;

            if(is_null($sort)){
                if($run = mysqli_query($this->conn, $query)){
                    return $run;
                }else{ return false; }
            }else{
                return self::sorting($sort);
            }
        }
    }
?>
