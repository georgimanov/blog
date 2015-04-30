<?php

define( 'DX_ROOT_DIR', dirname( __FILE__ ) . '/' );
define( 'DX_ROOT_PATH', basename( dirname( __FILE__ ) ) . '/' );

include_once 'config/bootstrap.php';

$request = $_SERVER['REQUEST_URI'];
$request_home = '/' . DX_ROOT_PATH;

$controller = 'master';
$method = 'index';
$admin_routing = false;
$param = array();

foreach( glob( 'lib/*.php' ) as $file ) {
	include_once $file;	
} 

include_once 'controllers/master.php';
include_once 'models/master.php';


if ( ! empty( $request ) ) {
	if( 0 === strpos( $request, $request_home ) ) {
		$request = substr( $request, strlen( $request_home ) );
		
		if( 0 === strpos( $request, 'admin/' ) ) {
			$admin_routing = true;
			include_once 'controllers/admin/master.php';
			$request = substr( $request, strlen('admin/') );
		}

		$components = explode( '/', $request, 3 );

		if( 1 < count( $components ) ) {
			list( $controller, $method ) = $components;
			
			if( isset( $components[2] ) ) {
				$param = $components[2];
			}

			$admin_folder = $admin_routing ? 'admin/' : '';
			
			include_once 'controllers/' . $admin_folder . $controller . '.php';
		}
	}
}

$admin_namespace = $admin_routing ? '\Admin' : '';
$controller_class = $admin_namespace . '\Controllers\\' . ucfirst( $controller ) . '_Controller';

// \Controllers\Artist_Controller
$instance = new $controller_class();
if(strpos($method, "?") >= 0){
    $method = explode("?", $method)[0];
}

$controllers = array(
    'comments',
    'contacts',
    'master',
    'posts',
    'user'
);


if( method_exists( $instance, $method ) ) {
	call_user_func_array( array( $instance, $method ), array( $param ) );
}
elseif ( in_array( $instance, $controllers ) ) {
    call_user_func_array( array( 'master', 'index' ), array( $param ) );
}
elseif ( method_exists( $instance, 'index') ) {
    call_user_func_array( array( $instance, 'index' ), array( $param ) );
} else {
    header('Location: '. DX_URL_ERROR);
    exit;
}

$db_object = \Lib\Database::get_instance();

$db_conn = $db_object::get_db();

