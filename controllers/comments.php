<?php

namespace Controllers;

class Comments_Controller extends Master_Controller {

    public function __construct() {
        parent::__construct(get_class(),
            'comment', '/views/comments/');
    }

    public function index()
    {
        $comments = $this->model->find();

        if( empty( $comments) ){
            $this->sorry("No comments were found!");
            exit;
        }
        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }

    public function add()
    {
        if( ! empty( $_POST['name'] ) && ! empty( $_POST['content'] ) && ! empty ( $_POST['post_id'] ) ) {
            $name = $_POST['name'];
            $content = $_POST['content'];
            $post_id = $_POST['post_id'];

            $email = null;
            if( ! empty ( $_POST['email'] ) ) {
                $email = $_POST['email'];
            }

            $comment = array(
                'name' => $name,
                'email' => $email,
                'content' => $content,
                'post_id' => $post_id,
            );

            $this->model->add( $comment );

            header("Location: ". DX_URL. "posts/view/" . $post_id);
            exit;
        }

        $template_name = DX_ROOT_DIR . 'posts/index.php';

        include_once $this->layout;
    }

    public function update()
    {
        $comments = $this->model->find();
        if( empty( $comments ) ){
            header( 'Location: ' . DX_URL);
            exit;
        }

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }

    public function delete()
    {
        $comments = $this->model->find();
        if( empty( $comments ) ){
            header( 'Location: ' . DX_URL);
            exit;
        }

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }
}
