<?php

class hierarchy {
    //put your code here
    protected $table;
    protected $conn;
    
    public function __construct($table, $connection) {
        $this->table = $table;
        $this->conn = $connection;
    }
    
    public function updateLftPlus($lft)
    {
        $sql = "UPDATE $this->table  SET lft=lft+2 WHERE lft>=$lft";
        $this->conn->query($sql);
    }
    
    public function updateRgtPlus($rgt)
    {
        $sql = "UPDATE $this->table  SET rgt=rgt+2 WHERE rgt>=$rgt";
        $this->conn->query($sql);
    }
    
    public function updateLftMinus($lft)
    {
        $sql = "UPDATE $this->table  SET lft=lft-2 WHERE lft>=$lft";
        $this->conn->query($sql);
    }
    
    public function updateRgtMinus($rgt)
    {
        $sql = "UPDATE $this->table  SET rgt=rgt-2 WHERE rgt>=$rgt";
        $this->conn->query($sql);
    }
    
    public function getLastRgt()
    {
        $sql = "SELECT rgt FROM $this->table order by rgt desc limit 1";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc()['rgt'];
        }
        return 0;
    }
}
