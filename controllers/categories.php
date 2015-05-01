<?php

namespace Controllers;

class Categories_Controller extends Master_Controller {

    protected $message;

    public function __construct() {
        parent::__construct(get_class(),
            'category', '/views/categories/');

        $this->message = "";
    }

    // TODO Authorization
    public function admin()
    {
        $auth = \Lib\Auth::get_instance();

        $error_messages = array();

        if( !  $auth->is_admin() ) {
            header("Location: ". DX_URL. "posts/index");
            exit;
        }

        $categories = $this->model->find();

        if( empty( $categories ) ){
            $this->sorry("No categories were found!");
            exit;
        }

        $this->message = '';

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }

    public function add()
    {
        $auth = \Lib\Auth::get_instance();

        $error_messages = array();

        if( !  $auth->is_admin() ) {
            header("Location: ". DX_URL. "posts/index");
            exit;
        }

        if( ! empty( $_POST['name'] ) ) {
            $name = $_POST['name'];

            $category = array(
                'name' => $name,
            );

            $result = $this->model->add( $category );

            if($result > 0){
                $this->message = 'Successfully added category';

            } else {
                $this->message = 'An error has occurred!';
            }

        }

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }

    public function edit($id)
    {
        $auth = \Lib\Auth::get_instance();

        $error_messages = array();

        if( !  $auth->is_admin() ) {
            header("Location: ". DX_URL. "posts/index");
            exit;
        }

        $element = $this->model->get($id);
        $element = $element[0];

        if( empty( $element ) ){
            $this->sorry("Category was not found!");
            exit;
        }

        if( ! empty( $_POST['name'] ) && !empty ($_POST['id']) ) {
            $name = $_POST['name'];
            $id = $_POST['id'];

            $category = array(
                'id' => $id,
                'name' => $name,
            );

            $result = $this->model->update( $category );

            if($result > 0){
                $this->message = 'Successfully edited category';
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

        $error_messages = array();

        if( !  $auth->is_admin() ) {
            header("Location: ". DX_URL. "posts/index");
            exit;
        }

        $element = $this->model->get($id);

        if( empty( $element ) ){
            $this->sorry("Category was not found!");
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
