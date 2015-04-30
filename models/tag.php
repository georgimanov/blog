<?php

namespace Models;

class Tag_Model extends Master_Model {

    public function __construct( $args = array() ) {
        parent::__construct( array( 'table' => 'tags' ) );
    }

    public function get_top_tags_with_count ( $limit = 5){

        $query = "SELECT DISTINCT (t.name), COUNT(pt.post_id) as occurances
                    FROM tags AS t
                  LEFT JOIN posts_have_tags AS pt
                    ON pt.tag_id = t.id
                  GROUP BY t.name
                  ORDER BY occurances
                    DESC";

        if( ! empty( $limit ) ) {
            $query .= " LIMIT {$limit}";
        }

        $result_set = $this->db->query( $query );
        $results = $this->process_results( $result_set );

        return $results;
    }

    public function get_tags_by_post_id ( $id ){

        $query = "SELECT * FROM tags
                    LEFT JOIN posts_have_tags AS pt
                        ON pt.tag_id = tags.id
                    LEFT join posts AS p
                        ON p.id = pt.post_id
                    WHERE p.id=$id";

        $result_set = $this->db->query( $query );
        $results = $this->process_results( $result_set );

        return $results;
    }
}