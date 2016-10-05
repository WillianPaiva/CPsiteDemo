<?php
class CtrlListAteliers{

    var $conn;

    function __construct($servername, $username, $password, $dbname){
        $this->conn = new mysqli($servername, $username, $password, $dbname);
    }

    //create the connection
    function __destruct(){
        $this->conn->close();
    }

    //check connection
    function checkConnection(){
        return $this->conn->connect_error;
    }

    function getListAteliers($table, $row){
        $sql = "SELECT * FROM ".$table." ORDER BY ".$row.";";
	$result=$this->conn->query($sql);
        return $result;
}

}
?>
