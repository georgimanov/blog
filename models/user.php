<?php

namespace Models;

class User_Model extends Master_Model {

    public function __construct( $args = array() ) {
        parent::__construct( array( 'table' => 'users' ) );
    }

    public function user_already_exist($username){
        $query = "SELECT COUNT(*) AS 'exists'
                    FROM users
                    WHERE users.username = '$username'";

        $result_set = $this->db->query( $query );
        $results = $this->process_results( $result_set );

        if( $results[0]['exists'] == 1 ){
            return true;
        }

        return false;
    }
}