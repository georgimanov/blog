<?php

namespace Models;

class Comment_Model extends Master_Model {

    public function __construct( $args = array() ) {
        parent::__construct( array( 'table' => 'comments' ) );
    }

    public function delete_comments_by_post_id($post_id){
        $query = "DELETE FROM {$this->table}
                    WHERE post_id=$post_id";

        $this->db->query( $query );

        return $this->db->affected_rows;
    }
}