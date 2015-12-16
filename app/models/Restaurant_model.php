<?php

class Restaurant_model {

    public $db;

    public function __construct() {
        try {
            $this->db = new Database();
        } catch (Exception $ex) {
            echo "connection failed" . $ex;
        }
    }
    
    /**
     * get all the restaurants in the database.
     * @return array of restaurants.
     */
    public function get_restaurants() {
        $results_array = array();
        $query = 'SELECT Restaurants.*,Restaurant_Hours.Start_Time,Restaurant_Hours.Close_Time FROM `Restaurants` inner join `Restaurant_Hours` where '
                . '`Approved` = 1 AND Restaurants.idRestaurants = Restaurant_Hours.Restaurants_idRestaurants group by idRestaurants';
        $result = $this->db->db_query($query);
        while ($row = $result->fetch_assoc()) {
            $results_array[] = $row;
        }
        return $results_array;
    }

    /**
     * Get all restaurants that need to be approved.
     */
    public function get_pending_restaurants() {
        $results_array = array();
        $query = 'SELECT * FROM `Restaurants` where `Approved` = 0';
        $result = $this->db->db_query($query);
        while ($row = $result->fetch_assoc()) {
            $results_array[] = $row;
        }
        return $results_array;
    }

    /**
     * get the profile image (thumbnail) of the given restaurant.
     * @param int $id
     * @return blob
     */
    public function get_thumbnail($id) {
        $query = "SELECT `Image` FROM `Restaurant_Images` where `idRestaurant_Images` = '$id'";
        $result = $this->db->db_query($query);
        $row = mysqli_fetch_array($result);
        return $row['Image'];
    }

    /**
     * Creates the database entry of the restaurant based on the details in input params.
     * @param string $name
     * @param int $add
     * @param string $city
     * @param string $stat
     * @param string $country
     * @param int $zip
     * @param int $phone
     * @param string $des
     * @param blob $profile_image
     * @return restaurant id that has been inserted
     */
    public function create_restaurant($name, $add, $city, $stat, $country, $zip, $phone, $des, $profile_image = "") {
        // TODO Use thumbnail as profile image
        $sql = "INSERT INTO `Restaurants`(`Name`, `Address`, `City`, `State`, `Country`, `ZipCode`, `Phone`, `Description`)"
                . " VALUES ('$name', '$add', '$city', '$stat', '$country', $zip, $phone, '$des')";
        $rest_id = $this->db->db_insert($sql);


        $sql = "INSERT INTO `Restaurant_Images`(`Title`, `Image`, `Restaurants_idRestaurants`)"
                . " VALUES ('profile', '$profile_image', '$rest_id')";
        $profile_id = $this->db->db_insert($sql);

        $sql = "UPDATE `Restaurants` SET `Restaurant_Images_idRestaurant_Images`=$profile_id"
                . " WHERE `idRestaurants` = '$rest_id'";
        $this->db->db_update($sql);
        return $rest_id;
    }

    /**
     * Add restaurant hours (open and close and days of the week) for the given restaurant.
     * @param int $restaurant_id
     * @param time $open_time
     * @param time $close_time
     * @param int $days
     * @return int 
     */
    public function add_restaurant_hours($restaurant_id, $open_time, $close_time, $days) {
        $sql = "INSERT INTO `Restaurant_Hours` (`Day_of_week`, `Start_Time`, `Close_Time`,
                `Restaurants_idRestaurants`) VALUES " . "('$days', '$open_time', '$close_time', '$restaurant_id')";

        $rest_id = $this->db->db_insert($sql);
        return $rest_id;
    }
    
    /**
     * Fetch restaurant hours from the database for given restaurant id
     * @param int $rest_id
     * @return array
     */
    public function get_hours($rest_id){
        $sql = "SELECT * FROM `Restaurant_Hours` WHERE `Restaurants_idRestaurants`= $rest_id";
        $result = $this->db->db_query($sql);
        while ($row = $result->fetch_assoc()) {
            $results_array[] = $row;
        }
        return $results_array;
    }
    
    /**
     * Inserts the table in the database for given rest.
     * @param int $restaurant_id
     * @param int $count
     * @param string $desc
     * @param int $seats
     * @return int restaurant id
     */
    public function add_table($restaurant_id, $count, $desc, $seats) {
        $sql = "INSERT INTO `Tables` (`Count`, `Restaurants_idRestaurants`, `Description`,
                `Seats`) VALUES " . "('$count', '$restaurant_id', '$desc', '$seats')";
        $rest_id = $this->db->db_insert($sql);
        return $rest_id;
    }

    /**
     * Search by city, address or name
     * @param string $search_string
     * @return array
     */
    public function search_restaurant($search_string) {
        $results_array = array();

        // break the search string
        $string_pieces = preg_split("/[\s,]+/", $search_string);
        $city_pieces = explode(",", $search_string); //to keep cities like San Francisco together
        // create query using pieces of name or city or addresses
        foreach ($string_pieces as $name) {
            $sql_names[] = "`Name` LIKE '%" . $name . "%'";
        }
        foreach ($city_pieces as $city) {
            $sql_addresses[] = "`Address` LIKE '%" . $city . "%'";
        }
        foreach ($city_pieces as $city) {
            $sql_city[] = "`City` LIKE '%" . $city . "%'";
        }

        
        $query = "SELECT Restaurants.*,Restaurant_Hours.Start_Time,Restaurant_Hours.Close_Time"
                . " FROM `Restaurants` inner join `Restaurant_Hours` "
                . "WHERE (" . implode(" OR ", $sql_names) . " OR " . implode(" OR ", $sql_addresses) . " OR " . implode(" OR ", $sql_city) . ") AND "
                . "`Approved` = 1 AND Restaurants.idRestaurants = Restaurant_Hours.Restaurants_idRestaurants group by idRestaurants";
        $result = $this->db->db_query($query);
        while ($row = $result->fetch_assoc()) {
            $results_array[] = $row;
        }
        return $results_array;
    }

    /**
     * Filters the result based on params
     * @param array $all_restaurants
     * @param int $people
     * @param time $time
     * @param date $date
     */
    public function filter_restaurant($all_restaurants, $people, $time, $date) {
        //TODO from result show the restaurants with available reservations- Priority 3
        foreach ($all_restaurants as $restaurant) {
            
        }
    }
    
    /**
     * Checks if the restaurant if open at the given time and date.
     * @param int $restaurant
     * @param time $time
     * @param date $date
     * @return boolean  true if open
     */
    public function is_restaurant_open($restaurant, $time, $date) {
        //$datetime = new DateTime($date);
        $week = date('w', strtotime($date));
        //$week = $datetime->format("W");
        $query = "SELECT * FROM `Restaurant_Hours` WHERE " .
                "`Restaurants_idRestaurants` = " . $restaurant . " AND " .
                "`Day_of_week` = " . $week . " AND " .
                "`Start_Time` < " . $time . " AND " .
                "`Close_Time` > " . $time;
        $result = $this->db->db_query($query);
        if ($result) {
            return true;
        }
        return false;
    }

    /*
     * Adds reservation to the database 
     */

    public function add_reservation($user_id, $table_id, $date, $time, $people, $slot = 1, $verified = false) {
        $sql = "INSERT INTO `Reservations` (`Users_idUsers`, `Tables_idTables`, `Date`,
                `Start_Time`, `People`, `Reserved_slots`, `Verified`) VALUES " . "('$user_id', '$table_id', '$date', '$time', '$people', '$slot', '$verified')";

        $reserv_id = $this->db->db_insert($sql);
        return $reserv_id;
    }

    /**
     * Used by the host/hostess to verify that the user with the resevation actually dined at the restaurant.
     * @param int $resv_id
     */
    public function verify_reservation($resv_id) {
        $sql = "UPDATE `Reservations` SET `Verified`= 1 WHERE `idReservations`= $resv_id ";
        $this->db->db_update($sql);
    }

    /**
     * Given a user id and restaurant id the function checkc id the use is verified visitor (dined at restaurant)
     * @param string $user
     * @param int $rest
     * @return boolean
     */
    public function is_verified($user, $rest) {

        $sql = "SELECT * FROM `Reservations` WHERE  "
                . "`Tables_idTables` IN (SELECT `idTables` FROM `Tables` WHERE `Restaurants_idRestaurants` = $rest)"
                . " AND `Users_idUsers` = $user "
                . " AND Verified = '1' ";

        $result = $this->db->db_query($sql);

        if (mysqli_num_rows($result) > 0) {
            return true;
        }
        return false;
    }

    /**
     * Gets the associative array of the tables for the given restaurant id
     * @param int $rest_id
     * @param int $people
     * @return array
     */
    public function get_tables($rest_id, $people) {
        $query = "SELECT `Count`, `idTables` FROM `Tables` WHERE "
                . "Restaurants_idRestaurants = '$rest_id' "
                . "AND `Seats` >= '$people'";
        $query_result = $this->db->db_query($query);
        $result = array();
        if ($query_result) {
            while ($row = mysqli_fetch_array($query_result)) {
                $result[$row['idTables']] = $row['Count'];
            }
        }
        return $result;
    }

    /*
     * Get the reseved tables for given restaurant id at given time and date for 
     */

    public function get_reserved_tables($people, $date, $time, $rest_id) {
        $table_id = $this->get_tableids($rest_id);
        $query = "SELECT COUNT(`idReservations`) as `Count` , `Tables_idTables` as `idTables`"
                . " FROM `Reservations` WHERE"
                . " Tables_idTables IN (" . implode(',', $table_id) . ")"
                . " AND `Date` = '$date' AND `Start_Time` = '$time' "
                . " GROUP BY `Tables_idTables` ";
        $query_result = $this->db->db_query($query);
        $res = array();
        if ($query_result) {
            while ($row = mysqli_fetch_array($query_result)) {
                $res[$row['idTables']] = $row['Count'];
            }
        }
        return $res;
    }
    
    /**
     * get the future dated reservations for a restaurant
     * @param int $rest_id
     * @return array
     */
    public function get_upcoming_reservations($rest_id) {
        $query = "SELECT * FROM `Reservations` WHERE `Tables_idTables` IN "
                . "(SELECT DISTINCT `idTables` FROM Tables WHERE `Restaurants_idRestaurants` = $rest_id ) AND "
                . "`Date` >= CURDATE() ORDER BY `DATE` ASC";
        $query_result = $this->db->db_query($query);
        return $query_result;
    }
    
    /**
     * get the past reservations for a given restaurant
     * @param int $rest_id
     * @return array
     */
    public function get_past_reservation($rest_id) {
        $query = "SELECT * FROM `Reservations` WHERE `Tables_idTables` IN "
                . "(SELECT DISTINCT `idTables` FROM Tables WHERE `Restaurants_idRestaurants` = $rest_id ) AND "
                . "`Date` < CURDATE() ORDER BY `DATE` ASC";

        $query_result = $this->db->db_query($query);
        return $query_result;
    }
    
    /**
     * get all the table ids that belong to a restaurant.
     * @param type $rest_id
     * @return array
     */
    public function get_tableids($rest_id) {
        $query = "SELECT DISTINCT `idTables` FROM `Tables` WHERE `Restaurants_idRestaurants` = '$rest_id'";
        $result = $this->db->db_query($query);
        $result_array = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($result_array, $row['idTables']);
        }
        return $result_array;
    }

    /**
     * Get restaurant fileds of the given restaurant.
     * @param int $id
     * @return array
     */
    public function get_restaurant_details($id) {
        $query = "SELECT * FROM `Restaurants` WHERE `idRestaurants` = '$id'";
        $query = "SELECT Restaurants.*,Restaurant_Hours.Start_Time,Restaurant_Hours.Close_Time"
                . " FROM `Restaurants` inner join `Restaurant_Hours` "
                . "WHERE `idRestaurants` = '$id' AND Restaurants.idRestaurants = Restaurant_Hours.Restaurants_idRestaurants group by idRestaurants";
        $result = mysqli_fetch_array($this->db->db_query($query));
        return $result;
    }

    /**
     * Update approved value
     * @id restaurant id
     * @return none
     */
    public function approve_restaurant($id) {
        $sql = "UPDATE `Restaurants` SET `Approved`= 1"
                . " WHERE `idRestaurants` = '$id'";
        $this->db->db_update($sql);
    }

}
