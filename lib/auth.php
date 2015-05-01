<?php

namespace Lib;

class Auth {
	
	private static $is_logged_in = false;
    private static $is_admin = false;
	private static $logged_user = array();
	
	private function __construct() {
		session_set_cookie_params( 1800, "/" );
		session_start();
		
		if( ! empty( $_SESSION['username'] ) ) {
			self::$is_logged_in = true;
			
			self::$logged_user = array(
				'id' => $_SESSION['user_id'],
				'username' => $_SESSION['username'],
			);

            if( ! empty( $_SESSION['is_admin'] ) &&  $_SESSION['is_admin'] == 1 ) {
                self::$is_admin = true;

//                self::$logged_user = array(
//                    'id' => $_SESSION['user_id'],
//                    'username' => $_SESSION['username'],
//                    'is_admin' => true,
//                );
            }
		}
	}
	
	public static function get_instance() {
		static $instance = null;
		
		if( null === $instance ) {
			$instance = new static();
		}
		
		return $instance;
	}
	
	public function is_logged_in () {
		return self::$is_logged_in;
	}
	
	public function get_logged_user() {
		return self::$logged_user;
	}

    public function is_admin () {
        return self::$is_admin;
    }
	
	public function login( $username, $password ) {
		$db_object = \Lib\Database::get_instance();
		$db = $db_object->get_db();
		
		$statement = $db->prepare("SELECT id, username, is_admin
                FROM users AS u
            WHERE username = ? "
				. "AND password = md5(?)  LIMIT 1"
		);

		$statement->bind_param( 'ss', $username, $password );

		$statement->execute();
		
		$result_set = $statement->get_result();

		if( $row = $result_set->fetch_assoc() ) {
			$_SESSION['username'] = $row['username'];
			$_SESSION['user_id'] = $row['id'];
            $_SESSION['is_admin'] = $row['is_admin'];

			return true;
		}
		
		return false;
	}


}