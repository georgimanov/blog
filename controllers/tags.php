<?php

namespace Controllers;

class Tags_Controller extends Master_Controller {

    protected $message;

    public function __construct() {
        parent::__construct(get_class(),
            'tag', '/views/tags/');

        $this->message = "";
    }

    public function admin()
    {
        $auth = \Lib\Auth::get_instance();

        if( !  $auth->is_admin() ) {
            header("Location: ". DX_URL. "posts/index");
            exit;
        }

        $tags = $this->model->find();

        if( empty( $tags ) ){
            $this->sorry("No tags were found!");
            exit;
        }

        $this->message = '';

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }

    public function clear(){
        $auth = \Lib\Auth::get_instance();

        if( !  $auth->is_admin() ) {
            header("Location: ". DX_URL. "posts/index");
            exit;
        }

        $this->model->clear();

        header("Location: ". DX_URL. "tags/admin");
        exit;
    }

    public function edit($id)
    {
        $auth = \Lib\Auth::get_instance();

        if( !  $auth->is_admin() ) {
            header("Location: ". DX_URL. "posts/index");
            exit;
        }

        $element = $this->model->get($id);
        $element = $element[0];

        if( empty( $element ) ){
            $this->sorry("Tag was not found!");
            exit;
        }

        if( ! empty( $_POST['name'] ) && !empty ($_POST['id']) ) {
            $name = $_POST['name'];
            $id = $_POST['id'];

            $tag = array(
                'id' => $id,
                'name' => $name,
            );

            $result = $this->model->update( $tag );

            if($result > 0){
                $this->message = 'Successfully edited tag';
            } else {
                $this->message = 'An error has occurred!';
            }

        }

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }

    public function delete($id)
    {
        $auth = \Lib\Auth::get_instance();

        if( !  $auth->is_admin() ) {
            header("Location: ". DX_URL. "posts/index");
            exit;
        }

        $element = $this->model->get($id);

        if( empty( $element ) ){
            $this->sorry("Tag was not found!");
            exit;
        }

        $element = $element[0];

        if( ! empty( $_POST['name'] ) && !empty ($_POST['id']) ) {
            $name = $_POST['name'];
            $id = $_POST['id'];

            $result = $this->model->delete( $id );

            if($result > 0){
                $this->admin();
            } else {
                $this->message = 'An error has occurred!';
            }

        }

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }
}
