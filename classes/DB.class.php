<?php

//Insert, Update Usage:
/*Usage:
E.g.
$db = new DB();
$data = array(
    "column1" => "'$column1Value'",
    "column2" => "b",
);
$db->update($data, "table", "id = $id");
*/

class DB
{
    public $db_name = DB_NAME;
    public $db_user = DB_USERNAME;
    public $db_pass = DB_PSW;
    public $db_host = DB_HOST;

    //connect to database
    public function connect()
    {
        $connection = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
        return $connection;
    }

    //select with specific column, table and condition
    public function select($column, $table, $condition = "", $returnArray = true)
    {
        $link = $this->connect();
        $sql = "";
        if($condition == "") $sql = "SELECT $column FROM $table";            
        else $sql = "SELECT $column FROM $table WHERE $condition";

        $result = mysqli_query($link, $sql);
        return $returnArray ? $this->rowSetToArray($result) : $result;
    }

    //select with full sql statement
    public function selectFull($sql, $returnArray = true)
    {
        $link = $this->connect();
        $result = mysqli_query($link, $sql);
        return $returnArray ? $this->rowSetToArray($result) : $result;
    }

    public function update($data, $table, $where)
    {
        $link = $this->connect();

        foreach ($data as $column => $value) {
            $num = substr_count($value, "'");
            if ($num >= 3) {
                $value = addslashes($value);
                $value = substr($value, 2, -2);
                $sql = "UPDATE $table SET $column = '$value' WHERE $where";
            } else {
                $sql = "UPDATE $table SET $column = $value WHERE $where";
            }
            mysqli_query($link, $sql) or die(mysqli_error($link));
        }
        return $sql;
    }

    public function delete($table, $where)
    {
        $link = $this->connect();

        $sql = "DELETE FROM $table WHERE $where";
        mysqli_query($link, $sql) or die(mysqli_error($link));

        return true;
    }

    public function insert($data, $table)
    {
        $link = $this->connect();
        
        $columns = "";
        $values = "";
  
        foreach ($data as $column => $value) {
            $columns .= ($columns == "") ? "" : ", ";
            $columns .= $column;
            $values .= ($values == "") ? "" : ", ";
             
            $num = substr_count($value, "'");
            if ($num >= 3) {
                $value = addslashes($value);
                $value = substr($value, 2, -2);
                $values .= "'$value'";
            } else {
                $values .= $value;
            }
        }
  
        $sql = "insert into $table ($columns) values ($values)";
        mysqli_query($link, $sql) or die(mysqli_error($link));
        
        //return the ID of the user in the database.
        return mysqli_insert_id($link);
    }

    public function rowSetToArray($rowSet)  
    {  
        $resultArray = array();  
        while($row = mysqli_fetch_assoc($rowSet))  
        {  
            array_push($resultArray, $row);  
        }
        return $resultArray;
    }
}
