<?php

/**
 * Description of Admin_model
 * @author Swati
 */
class Admin_model {

    public $db;

    public function __construct() {
        try {
            $this->db = new Database();
        } catch (Exception $ex) {
            echo "connection failed";
        }
    }

    //login user
    public function log_in($username, $password) {
        //user type 4 is Admin user
        $query = sprintf("SELECT * FROM Users WHERE Email='%s' AND password='%s' AND User_Types_idUser_Types='4' ", mysqli_real_escape_string($this->db->connection, $username), md5(mysqli_real_escape_string($this->db->connection, $password)));
        return mysqli_fetch_assoc($this->db->db_query($query));
    }

}
