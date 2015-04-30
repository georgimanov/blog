<?php

namespace Controllers;

class Master_Controller {
	
	protected $layout;
	protected $views_dir;
	
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
			
		$this->layout = DX_ROOT_DIR . '/views/layouts/default.php';
	}
	
	public function index() {
		$template_name = DX_ROOT_DIR . $this->views_dir . (__FUNCTION__). '.php';;
		
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