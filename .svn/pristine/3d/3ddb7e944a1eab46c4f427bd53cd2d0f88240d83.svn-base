<?php

/**
 * Description of User_model
 * @author Swati
 */
class User_model {

    public $db;

    public function __construct() {
        try {
            $this->db = new Database();
        } catch (Exception $ex) {
            echo "connection failed";
        }
    }

    //login user
    public function log_in($username, $password, $user_type = '2') {
        //Default user type is Registered user- type 2
        $query = sprintf("SELECT * FROM Users WHERE Email='%s' AND password='%s' AND User_Types_idUser_Types='%s' ", mysqli_real_escape_string($this->db->connection, $username), md5(mysqli_real_escape_string($this->db->connection, $password)), $user_type);
        return mysqli_fetch_assoc($this->db->db_query($query));
    }

    public function register_user($first_name, $last_name, $email, $password, $user_type, $rest_id = -1) {

        $Sql = "INSERT INTO `Users`(`idUsers`, `First_Name`, `Last_Name`, `Email`, `Password`, `User_Types_idUser_Types`, `Restaurant_id`) "
                . " VALUES (NULL, '"
                . $first_name . "' , '"
                . $last_name . "' , '"
                . $email . "' , '"
                . md5($password) . "' , '"
                . $user_type . "' , '"
                . $rest_id . "' )";

        $result = $this->db->db_insert($Sql);

        // start session is user registered succesfully
        if ($result) {
            // When user create resturant, two account will be created(Owner, Host), do not
            // creat session for this scanerio.
            if ($user_type == "2") {
                $_SESSION['user_login'] = "1";
                $_SESSION['name'] = $first_name . " " . $last_name;
                $_SESSION['Email'] = $email;
                $_SESSION['User_type'] = $user_type;
                $_SESSION['idUsers'] = $result;
            }
            return array('data' => $result, 'msg' => "Successfully Registered"); // id of regietered user
        } else {
            $err_messsage = "Ops something went wrong Try signing in again or contact admin@tableforyou.com";
            return array('msg' => $err_messsage);
        }
    }

    /**
     * Returns the user with given user_id
     * @param type $user_id
     */
    public function get_user($user_id) {
        $query = "SELECT * FROM `Users` WHERE `idUsers`= $user_id ";
        $result = $this->db->db_query($query);
        return $result;
    }

}
