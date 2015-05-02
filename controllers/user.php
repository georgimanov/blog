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
        if( ! empty( $_POST['username'] ) && ! empty( $_POST['password'] ) ) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $auth = \Lib\Auth::get_instance();
            $is_logged_in = $auth->login( $username, $password );

            if($is_logged_in ){
                header("Location: ". DX_URL. "posts/index");
                exit;
            } else {
                $message = "wrong username or password!";
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

            $user_exists = $this->model->user_already_exist($username);

            if ( ! $user_exists )  {
                $new_user = array(
                    'username' => $username,
                    'password' => md5($password)
                );

                if( ! empty( $_POST['email'] ) ) {
                    $new_user['email'] = $_POST['email'];
                }

                $user = $this->model->add($new_user);

                header("Location: ". DX_URL. "user/login");
                exit;

            } else {
                $message  = "user already exists";
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