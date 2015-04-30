<?php

namespace Models;

class Post_Model extends Master_Model {

    public function __construct( $args = array() ) {
        parent::__construct( array( 'table' => 'posts' ) );
    }

    public function get_posts(){
        $query = "SELECT p.id, p.title, p.content, p.date_pubslished, p.visits_count, u.id AS user_id, u.username
                    FROM posts AS p
                    LEFT JOIN users AS u
                      ON p.user_id = u.id
                    ORDER BY p.date_pubslished
                      DESC";

        $result_set = $this->db->query( $query );
        $results = $this->process_results( $result_set );

        return $results;
    }

    //TODO: Add validation of input data
    public function add_post ( $post, $tags_string ) {

        $added_post_id = $this->add($post);

        if ( count($tags_string) > null ){
            $tags_names = explode(',', $tags_string);

            $tag_model = new \Models\Tag_Model();
            $posts_have_tag_model = new \Models\Poststags_Model();


            foreach($tags_names as $tag_name){

                $tag_name = trim($tag_name);

                if( ! empty ($tag_name) ){

                    $tag_exists = $tag_model->get_by_name ( $tag_name );

                    $tag_id = 0;
                    if( empty ($tag_exists) ) {
                        $tag_element = array(
                            'name' => $tag_name
                        );

                        $tag_id = $tag_model->add($tag_element);
                    } else {
                        $tag_id = $tag_exists[0]['id'];
                    }

                    $posts_have_tag_model->add_relation($added_post_id, $tag_id);
                }
            }
        }

        return $this->db->affected_rows;
    }

    public function delete ( $id ) {
        $tags = $this->get_tags_by_post_id( $id );

        if( count($tags) > 0 ) {

        }
    }

    public function update_visits($post){

        $visits = $post['visits_count'] + 1;

        $query = "UPDATE {$this->table}
                    SET visits_count = {$visits} WHERE id = {$post['id']}";

        $this->db->query( $query );

        return $this->db->affected_rows;
    }


    // TODO: Move to Master
    public function posts_count(){

        $query = "SELECT COUNT(*) as count FROM `posts`";

        $result_set = $this->db->query( $query );
        $results = $this->process_results( $result_set );

        return $results;
    }

    public function get_posts_by_category( $category_name ) {

        $query = " SELECT p.id, p.title, p.content, p.date_pubslished, p.visits_count, u.id AS user_id, u.username
                        FROM POSTS as p";

        $query .= " LEFT JOIN categories
                        ON p.category_id=categories.id
                    LEFT JOIN users AS u
                        ON p.user_id = u.id";

        if( ! empty( $category_name ) ) {
            $query .= " WHERE categories.name ='{$category_name}'";
        }

        $query .= " ORDER BY p.date_pubslished
                      DESC";

        $result_set = $this->db->query( $query );
        $results = $this->process_results( $result_set );

        return $results;
    }

    public function get_posts_by_tag( $tag_name ) {

        $query = " SELECT p.id, p.title, p.content, p.date_pubslished, p.visits_count, u.id AS user_id, u.username
                        FROM POSTS as p";

        $query .= " LEFT JOIN posts_have_tags AS pt
                        ON pt.post_id = p.id
                    LEFT JOIN tags AS t
                        ON t.id = pt.tag_id
                    LEFT JOIN users AS u
                        ON p.user_id = u.id";

        if( ! empty( $tag_name ) ) {
            $query .= " WHERE t.name ='{$tag_name}'";
        }

        $query .= " ORDER BY p.date_pubslished
                      DESC";

        $result_set = $this->db->query( $query );
        $results = $this->process_results( $result_set );

        return $results;
    }

    public function get_posts_by_date($year, $month){
        $query = "SELECT p.id, p.title, p.content, p.date_pubslished, p.visits_count, u.id AS user_id, u.username
                    FROM POSTS as p
                  LEFT JOIN users AS u
                      ON p.user_id = u.id
                  WHERE
                    year(p.date_pubslished)=". $year ."
                      AND
                    month(p.date_pubslished)=". $month ."
                  ORDER BY p.date_pubslished
                      DESC";

        $result_set = $this->db->query( $query );
        $results = $this->process_results( $result_set );

        return $results;
    }

    // DATES
    // FILTER
    public function get_dates_list(){
        $query = "SELECT MONTH(a.date_pubslished) AS month, YEAR(a.date_pubslished) AS year
                    FROM `posts` AS a
                  LEFT JOIN `posts` AS p
                      ON a.id = p.id
                  GROUP BY(month)
                  ORDER BY YEAR(a.date_pubslished) DESC,
                  MONTH(a.date_pubslished) DESC";

        $result_set = $this->db->query( $query );
        $results = $this->process_results( $result_set );

        return $results;
    }

    public function get_posts_by_dates()  {
        $dates = $this->get_dates_list();
        $posts = $this->get_posts();
        $result = array();

        foreach ($dates as $date) {
            $current_post = array();
            foreach($posts as $post) {
                if ($date['month'] == date("m",strtotime($post['date_pubslished']))
                    && $date['year'] == date("Y",strtotime($post['date_pubslished']) ) ) {
                    array_push($current_post, [
                        'id' => $post['id'],
                        'title' => $post['title']
                    ]);
                }
            }
            array_push($result,[
                'date' => $date,
                'posts' => $current_post
            ]);
        }
        return $result;
    }

    // USERS
    public function get_user($id){
        $user_model = new \Models\User_Model();
        $users = $user_model->get( $id );
        $user = $users[0];

        return $user;
    }

    // CATEGORIES
    // FILTER
    public function get_categories_count(){
        $category_model = new \Models\Category_Model();
        $categories = $category_model->get_categories_with_posts_count( );

        return $categories;
    }

    // COMMENTS
    public function get_comments($id){
        $comment_model = new \Models\Comment_Model();
        $comments = $comment_model->find( array(
            'where' => "post_id = $id"
        ) );

        return $comments;
    }

    // TAGS
    // FILTER
    public function get_top_tags_with_count( $limit  ){
        $tag_model = new \Models\Tag_Model();
        $tags = $tag_model->get_top_tags_with_count( $limit );

        return $tags;
    }

    public function get_tags_by_post_id ( $id ){
        $tag_model = new \Models\Tag_Model();
        $tags = $tag_model->get_tags_by_post_id( $id );

        return $tags;
    }

    public function list_all_tags(){
        $tag_model = new \Models\Tag_Model();
        $tags = $tag_model->find();

        return $tags;
    }
}