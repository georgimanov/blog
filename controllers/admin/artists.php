<?php

namespace Admin\Controllers;

class Artists_Controller extends Admin_Controller {
	
	public function __construct() {
		parent::__construct( get_class(),
				 'artist', '/views/admin/artists/' );
	}
	
	public function index() {
		$artists = $this->model->find();
		
		$template_name = DX_ROOT_DIR . $this->views_dir . 'index.php';
		
		include_once $this->layout;
	}
	
	public function edit( $id ) {
		if( ! empty( $_POST['name'] ) 
				&& ! empty( $_POST['country'] )
				&& ! empty( $_POST['id'] ) ) {
			$name = $_POST['name'];
			$country = $_POST['country'];
			$id = $_POST['id'];
			
			$artist = array(
					'id' => $id,
					'name' => $name,
					'country' => $country
			);
			
			$this->model->update( $artist );
		}
		
		$artist = $this->model->get( $id );
		
		if( empty( $artist ) ) {
			die( 'Nothing to edit here.' );
		}
		
		$artist = $artist[0];
		
		$template_name = DX_ROOT_DIR . $this->views_dir . 'edit.php';
		
		include_once $this->layout;
	}
	
	public function add() {
		if( ! empty( $_POST['name'] ) && ! empty( $_POST['country'] ) ) {
			$name = $_POST['name'];
			$country = $_POST['country'];
			
			$artist = array(
				'name' => $name,
				'country' => $country
			);
			
			$this->model->add( $artist );
		}
		
		$template_name = DX_ROOT_DIR . $this->views_dir . 'add.php';
		
		include_once $this->layout;
	}
	
	public function view( $id ) {
		$artists = $this->model->get( $id );
		
		var_dump($artists); die();
		
		$template_name = DX_ROOT_DIR . $this->views_dir . 'index.php';
		
		include_once $this->layout;
	}
}