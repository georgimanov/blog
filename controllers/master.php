<?php

namespace Controllers;

class Master_Controller {
	
	protected $layout;
	protected $views_dir;
    protected $message = array();
	
	public function __construct( $class_name = '\Controllers\Master_Controller', 
			$model = 'master',
			$views_dir = '/views/master/' ) {
		
		$this->views_dir = $views_dir;
		$this->class_name = $class_name;

		include_once DX_ROOT_DIR . "models/{$model}.php";
		$model_class = "\Models\\" . ucfirst( $model ) . "_Model";
		
		$this->model = new $model_class( array( 'table' => 'none' ) );
		
		$auth = \Lib\Auth::get_instance();
		$logged_user = $auth->get_logged_user();
		$this->logged_user = $logged_user;
        $is_admin = $auth->is_admin();
        $this->message = array(
            'error' => 'Something went wrong',
            'success' => 'Success',
            'successful_edit' => 'Successful edit',
            'delete' => 'Successful delete',
            'login' => 'Login successful',
            'successful_registration' => 'Registration successful',
            'user_exists' => 'User already exists'
        );
		$this->is_admin = $is_admin;
		$this->layout = DX_ROOT_DIR . '/views/layouts/default.php';
	}
	
	public function index() {
		$template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';;
		
		include_once $this->layout;
	}


    public function delete($id)
    {
        $auth = \Lib\Auth::get_instance();

        $error_messages = array();

        if( ! $auth->is_admin() ) {
            header("Location: ". DX_URL);
            exit;
        }

        $element = $this->model->get($id);

        if( empty( $element ) ){
            $this->index();
            exit;
        }

        $element = $element[0];

        if( !empty ($_POST['id']) ) {
            $id = $_POST['id'];

            $result = $this->model->delete( $id );

            if($result > 0){
                $message = 'Successfully deleted!';
            } else {
                $message = 'An error has occurred!';
            }
        }

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }

    public function error() {
        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';

        include_once $this->layout;
    }


    public function sorry($show_message){
        $message = $show_message;

        $template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';


        include_once $this->layout;
    }
}