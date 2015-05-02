<?php

namespace Controllers;

class Posts_Controller extends Master_Controller {

    public function __construct() {
        parent::__construct( get_class(),
            'post', '/views/posts/' );

        //TODO: MOVE? to where
        include  DX_ROOT_DIR . '/models/category.php';
        include  DX_ROOT_DIR . '/models/tag.php';
        include  DX_ROOT_DIR . '/models/comment.php';
        include  DX_ROOT_DIR . '/models/user.php';
        include  DX_ROOT_DIR . '/models/poststags.php';
    }

    public function index() {
        if ( !empty ( $_GET["category"] ) ) {
            $category_name = $_GET["category"];
            $posts = $this->model->get_posts_by_category($category_name);
        } elseif ( !empty ( $_GET["tag"] ) ){
            $tag_name = $_GET["tag"];
            $posts = $this->model->get_posts_by_tag($tag_name);
        }elseif ( !empty ( $_GET["year"] ) && !empty ( $_GET["month"] ) ) {
            $month = $_GET["month"];
            $year = $_GET["year"];
            $posts = $this->model->get_posts_by_date($year, $month);
        } else {
            $posts = $this->model->get_posts();
        }

        if( empty( $posts) ){
            $this->sorry("There are no blog posts!");
            exit;
        }

        $all_categories = $this->model->posts_count()[0];
        $categories_list = $this->model->get_categories_count();
        $tags_list = $this->model->get_top_tags_with_count( 5 );
        $dates_list = $this->model->get_posts_by_dates();

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }


    public function admin() {
        $posts = $this->model->get_posts();

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';
        include_once $this->layout;
    }



    public function view( $id ) {
        $posts = $this->model->get_post($id);
        if( empty( $posts) ){
            $this->sorry( "Post was not found!" );
            exit;
        }

        $post = $posts[0];

        $this->model->update_visits($post);

        $tags = $this->model->get_tags_by_post_id($id);
        $user = $this->model->get_user( $post['user_id'] );
        $comments = $this->model->get_comments( $id );

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }


    public function add( ) {
        $auth = \Lib\Auth::get_instance();

        $error_messages = array();

        if( ! $auth->is_admin() ) {
            header("Location: ". DX_URL. "posts/index");
            exit;
        }

        if ( $_SERVER['REQUEST_METHOD'] != "POST") {
            $number = rand(1, 100);
            $token_addition = $number;
            $_SESSION['CSRFToken'] = "OWY4NmQwODE4ODRjN2Q2NTlhMmZlYWEwYzU1YWQwMTVhM2JmNGYxYjJiMGI4MjJjZDE1ZDZMGYwMGEwOA" . $token_addition;
        } else {
            if ($_POST ['CSRFToken'] != $_SESSION['CSRFToken'] ) {
                die;
            }
        }


        if( ! empty( $_POST['title'] ) && ! empty( $_POST['category_id'] )  && ! empty( $_POST['content'] )  ) {
            $title = $_POST['title'];
            $category = $_POST['category_id'];
            $content = $_POST['content'];
            $user_id = $auth->get_logged_user()['id'];

            $error_messages['title']= "title must be max 200 chars";

            $post = array(
                'title' => $title,
                'category_id' => $category,
                'content' => $content,
                'user_id' => $user_id
            );

            $tags = null;
            if( ! empty ( $_POST['tags'] ) ) {
                $tags = $_POST['tags'];
            }

            $this->model->add_post( $post, $tags );

            header("Location: ". DX_URL. "posts/index");
            exit;
        }

        $categories_list = $this->model->get_all_categories();

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }

    public function edit($id)
    {
        $auth = \Lib\Auth::get_instance();

        if( !  $auth->is_admin() ) {
            header("Location: ". DX_URL. "posts/index");
            exit;
        }

        $post = $this->model->get($id);
        $post = $post[0];
        if( empty( $post ) ){
            $this->sorry("Post was not found!");
            exit;
        }

        $display_tags = $this->model->get_tags_by_post_id($id);

        $tags_string = "";

        if( ! empty ($display_tags) ){
            foreach($display_tags as $current_tag){

                $tags_string .= $current_tag['name'] . ', ' ;
            }

            $tags_string = rtrim( $tags_string, ', ' );
        }

        $categories_list = $this->model->get_all_categories();

        if( ! empty( $_POST['id'] ) && ! empty( $_POST['title'] ) && ! empty( $_POST['category_id'] )  && ! empty( $_POST['content'] ) && ! empty( $_POST['date_pubslished'] ) ) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $category_id = $_POST['category_id'];
            $content = $_POST['content'];
            $date_pubslished = $_POST['date_pubslished'];

            $post = array(
                'id' => $id,
                'title' => $title,
                'category_id' => $category_id,
                'content' => $content,
                'date_pubslished' => $date_pubslished
            );

            $tags = null;
            if( ! empty ( $_POST['tags'] ) ) {
                $tags = $_POST['tags'];
            }

            $result = $this->model->update_post( $post , $tags );

            if($result > 0){
                $post = $this->model->get($id);
                $post = $post[0];
                $message = 'Successfully edited post!';
            } else {
                $message = 'An error has occurred!';
            }

        }

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }

    public function delete ( $id ){

        $auth = \Lib\Auth::get_instance();

        $error_messages = array();

        if( !  $auth->is_admin() ) {
            header("Location: ". DX_URL. "posts/index");
            exit;
        }

        if( ! empty( $_POST['id'] ) ) {
            $result = $this->model->delete_post($id);

            if($result > 0){
                $this->admin();
            } else {
                $this->message = 'An error has occurred!';
            }
        }

        $post = $this->model->get($id);
        if( empty( $post ) ){
            $this->sorry("Post was not found!");
            exit;
        }

        $post = $post[0];

        $display_tags = $this->model->get_tags_by_post_id($id);

        $tags_string = "";

        if( ! empty ($display_tags) ){
            foreach($display_tags as $current_tag){

                $tags_string .= $current_tag['name'] . ', ' ;
            }

            $tags_string = rtrim( $tags_string, ', ' );
        }

        $categories_list = $this->model->get_all_categories();

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }

}