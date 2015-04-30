<?php

namespace Models;

class Poststags_Model extends Master_Model {

    public function __construct( $args = array() ) {
        parent::__construct( array( 'table' => 'posts_have_tags' ) );
    }

    public function add_relation($post_id, $tag_id){

        $query = "INSERT INTO {$this->table}(post_id, tag_id) VALUES($post_id, $tag_id)";


        $this->db->query( $query );

       return $this->db->affected_rows;
    }

    public function delete_relation($post_id){
        $query = "DELETE FROM {$this->table}
                    WHERE post_id=$post_id";

        $this->db->query( $query );

        return $this->db->affected_rows;
    }
}