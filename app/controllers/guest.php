<?php

class Guest extends Controller {

    public function __construct() {
        $this->user = $this->model('User_model');
    }

    public function index() {

        if (isset($_SESSION['user_login']) && $_SESSION['user_login'] == "1") {
            $this->view('Guest/login', array());
        }
        $this->view('Guest/login', array());
    }

    public function login() {
        if (filter_input(INPUT_POST, "submit") == "Login") {
            $login = false;
            // username and password sent from form 
            $username = stripslashes(filter_input(INPUT_POST, "u_name"));
            $password = stripslashes(filter_input(INPUT_POST, "password"));
            $result = $this->user->log_in($username, $password);

            if ($result) {

                $_SESSION['user_login'] = "1";
                $_SESSION['name'] = $result['First_Name'] . " " . $result['Last_Name'];
                $_SESSION['Email'] = $result['Email'];
                $_SESSION['User_type'] = $result['User_Types_idUser_Types'];
                $_SESSION['idUsers'] = $result['idUsers'];

                $login = true;
                // redirect to reservaion page after login redirect from reservation form
                if(isset($_SESSION['backURL']) && isset($_SESSION['rest_id'])){
                    // handle reservation page return
                    header('Location: '. PUBLIC_ROOT. $_SESSION['backURL'] . $_SESSION['rest_id']);
                    unset($_SESSION['backURL']);
                    unset($_SESSION['rest_id']);  
                }else{
                    header('Location: ' . PUBLIC_ROOT);
                }

                return;
            } else {
                $err_messsage = "You are not authorized! contact admin@tableforyou.com OR Try signing in again";
                $this->view('Guest/login', array('msg' => $err_messsage));
            }
        } else {
            $this->view('Guest/login', array());
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        $location = "Location: " . PUBLIC_ROOT;
        header($location);
    }

    public function add() {
        if (filter_input(INPUT_POST, "submit") == "Sign Up") {
            // get the submitted values from form
            $first_name = stripslashes(filter_input(INPUT_POST, "f_name"));
            $last_name = stripslashes(filter_input(INPUT_POST, "l_name"));
            $email = stripslashes(filter_input(INPUT_POST, "e_mail"));
            $username = stripslashes(filter_input(INPUT_POST, "u_name"));
            $password = stripslashes(filter_input(INPUT_POST, "p_word"));

            $result = $this->user->register_user($first_name, $last_name, $email, $password, "2");
            // send confirmation email
            if($result){
                $location = "Location: ". PUBLIC_ROOT ;
                header($location); 
            }else{
                $this->view('Guest/register');
            }
        } else {
            $this->view('Guest/register');
        }
    }

    public function forgot() {
        $this->view('Guest/forgot');
    }

    public function retrieve() {
        if (filter_input(INPUT_POST, "submit") == "Retrieve Password") {
            //TODO 
            $e_messsage = "An email has been sent to you.";
            $this->view('Guest/login', array('msg' => $e_messsage));
            // TODO
        } else {
            // redirect to index ??
            //test
            $this->view('Guest/forgot');
        }
    }

}
