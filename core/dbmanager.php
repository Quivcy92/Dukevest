<?php
    require_once("connection.php");

    class DbManager {

        public $cols, $vals, $searchQuery, $searchResult, $page, $updateMessage;
        protected $conn;

        //Connects to Database
        function __construct(){ $this->conn = Db::getInstance(); }//End

        function newData($table, $values){
            $values = self::setValues($values);
            return self::insert($table, $values);
        }

        function newDataReturnId($table, $values){
            $values = self::setValues($values);
            return self::insertReturnId($table, $values);
        }
        
        
        function updateData($table, $values, $arr){
            $values = self::setValues($values);
            $arr = self::setValues($arr);
            return self::update($table, $values, $arr);
        }

        function deleteData($table, $values){
            $values = self::setValues($values);
            return self::delete($table, $values);
        }

        //Checks if user with email exists
        function checkIfUserExists($email){
            $userCount = mysqli_num_rows(mysqli_query($this->conn, "SELECT * FROM user WHERE email = '$email'"));
            $userExists =  ($userCount > 0 ? true : false);

            return $userExists;
        }// End

        //returns value given a condition
        function fetchData($tableName, $values){
            $value = array();

            foreach ($values as $key => $val) { array_push($value, "`".$key."`='".$val."'"); }
            $found = $this->conn->query("SELECT * FROM $tableName WHERE ".implode("AND ", $value)."");

            return $found;
        }// End

        //returns value given a condition
        function fetchSingleData($tableName, $values){
            $found = DbManager::fetchData($tableName, $values);
            return mysqli_fetch_assoc($found);
        }// End

        function stringEscape($string){
            return htmlspecialchars(mysqli_real_escape_string($this->conn, stripslashes(trim($string))), ENT_QUOTES, 'UTF-8');
        }

        //Function to Insert into table
        function insert($tableName, $values){
            $this->cols = "( `".implode("`, `", array_keys($values))."` )";
            $this->vals = "( '".implode("', '", $values)."' )";
            $run = mysqli_query($this->conn, "INSERT INTO ".$tableName." ".$this->cols." VALUES ".$this->vals);
            $last_id = $this->conn->insert_id;
            return $run;
        }//End

        function insertReturnId($tableName, $values){
            $this->insert($tableName, $values);
            $last_id = $this->conn->insert_id;
            return $last_id;
        }//End

		//Function to Update Rows in Table
		function update($tableName, $valuesToUpdate, $identifier){
			foreach($valuesToUpdate as $key=>$value){
				$this->values[] = "`".$key."`='".$value."'";
			}
			return $run = mysqli_query($this->conn, "UPDATE ".$tableName." SET ".implode(", ", $this->values)." WHERE ".array_keys($identifier)[0]."='".$identifier[array_keys($identifier)[0]]."'");
		}

        //Function to delete from table
        function delete($tableName, $identifier){
            if(mysqli_query( $this->conn, "DELETE FROM $tableName WHERE `".array_keys($identifier)[0]."` = '".$identifier[array_keys($identifier)[0]]."'")){
                return true;
            }else{ return false; }
        }//End

        //function to set values
        function setValues($list){
            $values = array();
            foreach ($list as $key => $value) { $values[$key] = self::stringEscape($value); }
            return $values;
        }

        function checkIfProductExists($productName){
            $productCount = mysqli_num_rows(mysqli_query($this->conn, "SELECT * FROM product WHERE ProductName = '$productName'"));
            $productExists =  ($productCount > 0 ? true : false);
            return $productExists;
        }
    }

?>
