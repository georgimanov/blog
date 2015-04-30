<?php

namespace Admin\Controllers;

class Admin_Controller extends \Controllers\Master_Controller {
	
	public function __construct( 
			$class_name = '\Admin\Controllers\Admin_Controller',
			$model = 'master',
			$views_dir = 'views/admin/master' ) {
		
		parent::__construct( $class_name, $model, $views_dir );

		$this->layout = DX_ROOT_DIR . '/views/layouts/admin.php';
		
		$auth = \Lib\Auth::get_instance();
		$logged_user = $auth->get_logged_user();
		
		if( empty( $logged_user ) ) {
			die( 'No access allowed here.' );
		}
	}
	
}