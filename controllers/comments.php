<?php

namespace Controllers;

use Lib\Verify;

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

    public function post($id)
    {
        $auth = \Lib\Auth::get_instance();

        if( !  $auth->is_admin() ) {
            header("Location: ". DX_URL. "posts/index");
            exit;
        }

        include  DX_ROOT_DIR . '/models/post.php';
        $post_model = new \Models\Post_Model();
        $comments = $post_model->get_comments($id);

        if( empty( $comments) ){
            $this->sorry("No comments were found!");
            exit;
        }

        $post = $post_model->get_post($id)[0];

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

    public function edit($id)
    {
        $auth = \Lib\Auth::get_instance();

        if( !  $auth->is_admin() ) {
            header("Location: ". DX_URL. "posts/index");
            exit;
        }

        $element = $this->model->get($id);

        if( empty( $element ) ){
            header( 'Location: ' . DX_URL);
            exit;
        }

        if( ! empty( $_POST['id'] ) &&
            ! empty ($_POST['name']) &&
            ! empty ($_POST['content'])
             ) {

            $id = $_POST['id'];
            $name = $_POST['name'];
            $content = $_POST['content'];
            $email = $_POST['email'];

            $comment = array(
                'id' => $id,
                'name' => $name,
                'content' => $content,
            );

            if( Verify::is_mail_valid( $email ) ){
                $comment['email'] = $email;
            } else {
                $comment['email'] = '';
            }

            $result = $this->model->update( $comment );

            if($result > 0){
                $message = $this->message['successful_edit'];
            } else {
                $message = $this->message['error'];
            }
        }

        $element = $element[0];

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }
}
