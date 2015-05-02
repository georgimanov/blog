<?php

namespace Controllers;

class User_Controller extends Master_Controller {


    public function __construct() {
        parent::__construct( get_class(),
            'user', '/views/user/' );
    }

    public function index() {
        $this->login();
    }

    public function login() {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            if( ! empty( $_POST['username'] ) && ! empty( $_POST['password'] ) ) {
                $username = empty($_POST['username']) ? "" : $_POST['username'];
                $password = empty($_POST['password']) ? "" : $_POST['password'];

                $auth = \Lib\Auth::get_instance();
                $is_logged_in = $auth->login( $username, $password );

                if($is_logged_in ){
                    header("Location: ". DX_URL. "posts/index");
                    exit;
                } else {
                    $message = "wrong username or password!";
                }
            }


        }
        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;

    }


    public function register() {
        $auth = \Lib\Auth::get_instance();
        if($auth->is_logged_in() ){
            header("Location: ". DX_URL. "posts/index");
            exit;
        }

        if( ! empty( $_POST['username'] ) && ! empty( $_POST['password'] ) ) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = (empty($_POST['email'])) ? "" : ($_POST['email']) ;


            $user_input = array(
                'username'=>$username,
                'password'=>$password,
                'email'=> $email
            );

            $return_message = array();
            if (ctype_alnum($user_input['username'])) {
                $return_message['username'] = 'OK';
            } else {
                $return_message['username'] = "Username does not consist of all letters or digits</br>";
            }

            if(strlen($user_input['username'])<2 || strlen($user_input['username'])>45){
                $return_message['username'] = "Username should be between [2 - 45] chars long</br>";
            }

            if (ctype_alnum($user_input['password'])) {
                $return_message['password'] = 'OK';
            } else {
                $return_message['password'] = "Password does not consist of all letters or digits</br>";
            }

            if(strlen($user_input['password'])<6 || strlen($user_input['password'])>45){
                $return_message['password'] = "Password should be between [6 - 45] chars long</br>";
            }

            if(strlen($user_input['email'])<6 || strlen($user_input['email'])>45){
                $return_message['email'] = "Email should be between [6 - 45] chars long</br>";
            }

            if( ! empty( $user_input['email'] ) ) {

                $email = $user_input['email'];
                // regular expression for email check
                $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';

                if(preg_match($regex, $email)) {
                    $return_message['email'] = 'OK';
                } else {
                    $return_message['email'] = "Mail does not match criteria";
                }
            }

            $user_exists = $this->model->user_already_exist($username);

            if ( ! $user_exists &&
                $return_message['username'] === 'OK' &&
                $return_message['password'] === 'OK')  {
                $new_user = array(
                    'username' => $username,
                    'password' => md5($password)
                );

                if( $return_message['email'] === 'OK' ){
                    $new_user['email'] = $user_input['email'];
                }

                $new_user_id = $this->model->add($new_user);

                if($new_user_id > 0){
                    $message = $this->message['successful_registration'];
                }

                if($return_message['email'] !== 'OK') {
                    $message .= "<br>Email did not match criteria";
                }

                if(strlen($user_input['email']) == 0) {
                    $message .= "<br>Email not provided";
                }

            } else if ( $user_exists ) {
                $message  = $this->message['user_exists'];
            } else {
                $message = "Username: ". $return_message['username'] . "<br>"
                    . "Password: " . $return_message['password'] . "<br>"
                    . "Mail: " . $return_message['email'];
            }
        }

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }

    public function profile($id) {

        $user = $this->model->get($id);

        if( empty( $user) ){
            header( 'Location: ' . DX_URL);
            exit;
        }
        $user = $user[0];

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }

    // TODO: Move to lib/auth
    public function logout() {
        session_start();

        // Delete all data in $_SESSION[]
        session_destroy();

        // Remove the PHPSESSID cookie
        $params = session_get_cookie_params();

        setcookie(session_name(), '', time() - 42000,

            $params["path"], $params["domain"],

            $params["secure"], $params["httponly"]

        );

        header("Location: ". DX_URL);
        exit;
    }
}