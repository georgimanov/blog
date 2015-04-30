<?php

namespace Controllers;

class User_Controller extends Master_Controller {
	
	public function __construct() {
		parent::__construct( get_class(),
				 'user', '/views/user/' );
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
            }
        } else {
            $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

            include_once $this->layout;
        }
	}

    public function register() {

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

	public function logout() {
		session_destroy();

        header("Location: ". DX_URL);
        exit;
    }
}