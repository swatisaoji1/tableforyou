<?php

/**
 * Description of Review_model
 * @author Swati
 */
class Review_model {

    public $db;

    public function __construct() {
        try {
            $this->db = new Database();
        } catch (Exception $ex) {
            echo "connection failed" . $ex;
        }
    }

    /**
     * Gets all the reviews of the given restaurant
     * @param type $rest_if
     * @return type
     */
    public function get_reviews($rest_id) {
        $results_array = array();
        $query = "SELECT * FROM `Reviews` WHERE `Restaurants_idRestaurants` = $rest_id";
        $result = $this->db->db_query($query);

        return $result;
    }

    public function put_review($rest_id, $user_id, $review) {
        $sql = "INSERT INTO `Reviews`(`Text`, `Restaurants_idRestaurants`, `Users_idUsers`)"
                . " VALUES ('$review', '$rest_id', '$user_id')";
        $rest_id = $this->db->db_insert($sql);
    }

}
