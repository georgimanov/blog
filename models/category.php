<?php

namespace Models;

class Category_Model extends Master_Model {

	public function __construct( $args = array() ) {
		parent::__construct( array( 'table' => 'categories' ) );
	}

    public function get_categories_with_posts_count(){

        $query = "SELECT c.id as id, c.name as name, count(p.category_id) as count
                    FROM `categories` as c
                  LEFT JOIN posts as p
                    ON c.id = p.category_id
                  GROUP BY (p.category_id)
                  ORDER BY count(p.category_id) DESC";

        $result_set = $this->db->query( $query );
        $results = $this->process_results( $result_set );

        return $results;
    }
}