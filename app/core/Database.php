<?php

class Database {

    // Connection
    public $connection;

    public function __construct() {
        $this->connection = new mysqli('sfsuswe.com', "f15g14", "group14", "student_f15g14");
        if ($this->connection->connect_errno) {
            die("Connection failed: " . $conn->connect_error);
        }
    }

    // common functions

    public function db_insert($sql) {
        if ($this->connection->query($sql) !== TRUE) {
            echo "ERROR";
            printf($this->connection->error);
        }
        return $this->connection->insert_id;
    }

    public function db_query($sql) {
        $result = $this->connection->query($sql);
        return $result;
    }

    public function db_update($sql) {
        if ($this->connection->query($sql) !== TRUE) {
            echo "ERROR";
            printf($this->connection->error);
        }
    }

}
