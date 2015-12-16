<?php

/**
 * Description of Host
 * @author Swati Patel <swatisaoji1@gmail.com>
 * 
 */
class Host extends Controller {

    protected $restaurant;
    protected $user;

    public function __construct() {
        $this->restaurant = $this->model('Restaurant_model');
        $this->user = $this->model('User_model');
    }

    public function index() {

        if ($this->is_logged_in()) {
            $reservation_data = $this->get_upcoming_reservations($_SESSION['rest_id']);
            $old_reservations = $this->get_past_reservations($_SESSION['rest_id']);
            $this->view('/Host/home', array('new_data' => $reservation_data));
        } else {
            $this->view('/Host/login', array());
        }
    }

    public function login() {
        if ($this->is_logged_in()) {
            $reservation_data = $this->get_upcoming_reservations($_SESSION['rest_id']);
            $old_reservations = $this->get_past_reservations($_SESSION['rest_id']);
            $this->view('Host/home', array('new_data' => $reservation_data,
                'old_data' => $old_reservations));
        } elseif (filter_input(INPUT_POST, "submit") == "Login") {
            $login = false;
            // username and password sent from form 
            $username = stripslashes(filter_input(INPUT_POST, "u_name"));
            $password = stripslashes(filter_input(INPUT_POST, "password"));
            $result = $this->user->log_in($username, $password, '3');
            $restaurant_id = $result['Restaurant_id'];

            if ($result) {

                $_SESSION['user_login'] = "1";
                $_SESSION['name'] = $result['First_Name'] . " " . $result['Last_Name'];
                $_SESSION['Email'] = $result['Email'];
                $_SESSION['User_type'] = $result['User_Types_idUser_Types'];
                $_SESSION['idUsers'] = $result['idUsers'];
                $_SESSION['rest_id'] = $result['Restaurant_id'];
                $_SESSION['login'] = "1";
                $login = true;

                // get all reservations
                $reservation_data = $this->get_upcoming_reservations($restaurant_id);
                $old_reservations = $this->get_past_reservations($restaurant_id);
                $this->view('Host/home', array('new_data' => $reservation_data,
                    'old_data' => $old_reservations));
                return;
            } else {
                $err_messsage = "<strong>Unauthorized!</strong> You are not authorized! contact xxx@tableforyou.com OR Try signing in again";
                $this->view('Host/login', array('msg' => $err_messsage));
            }
        } else {
            $this->view('Host/login', array());
        }
    }

    public function get_upcoming_reservations($restaurant_id) {
        $reservations = $this->restaurant->get_upcoming_reservations($restaurant_id);
        return $this->make_reservation_data($reservations);
    }

    public function get_past_reservations($restaurant_id) {
        $reservations = $this->restaurant->get_past_reservation($restaurant_id);
        return $this->make_reservation_data($reservations);
    }

    public function make_reservation_data($reservations) {
        //$reservations = $this->restaurant->get_all_reservations($restaurant_id);
        $data = array();
        if ($reservations) {
            while ($row = mysqli_fetch_array($reservations)) {
                $reservation = array();
                $reservation['id'] = $row["idReservations"];
                $reservation['Verified'] = $row["Verified"];
                $reservation['Start_Time'] = $row['Start_Time'];
                $reservation['verified'] = $row['Verified'];
                $reservation['Date'] = $row['Date'];
                $reservation['People'] = $row['People'];
                $user_s = $this->user->get_user($row['Users_idUsers']);
                $user = $user_s->fetch_assoc();
                $reservation['Name'] = $user['First_Name'] . " " . $user['Last_Name'];
                $reservation['Email'] = $user['Email'];
                array_push($data, $reservation);
            }
        }

        return $data;
    }

    public function verify($reservation_id) {
        $this->restaurant->verify_reservation($reservation_id);
        $reservation_data = $this->get_upcoming_reservations($_SESSION['rest_id']);
        $old_reservations = $this->get_past_reservations($_SESSION['rest_id']);
        $this->view('Host/home', array('msg' => "Guest is Successfully Verified",
            'new_data' => $reservation_data,
            'old_data' => $old_reservations));
    }

    public function home() {
        if ($this->is_logged_in()) {
            $reservation_data = $this->get_upcoming_reservations($_SESSION['rest_id']);
            $old_reservations = $this->get_past_reservations($_SESSION['rest_id']);
            $this->view('Host/home', array('new_data' => $reservation_data,
                'old_data' => $old_reservations));
        } else {
            $this->view('Host/login', array());
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        $this->view('Host/login', array());
    }

    public function is_logged_in() {
        if (isset($_SESSION['user_login']) && $_SESSION['user_login'] == "1" && $_SESSION['User_type'] == "3") {
            return true;
        } else {
            return false;
        }
    }

    public function forgot() {
        $this->view('Host/forgot', array());
    }

    public function retrieve() {
        if (filter_input(INPUT_POST, "submit") == "Retrieve Password") {
            $e_messsage = "An email has been sent to the Restaurant Owner. Please contact the Restaurant Owner for login information.";
            $this->view('Host/login', array('msg' => $e_messsage));
        } else {
            $this->view('Host/forgot', array());
        }
    }

}
