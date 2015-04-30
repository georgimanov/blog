<?php

namespace Admin\Controllers;

class Posts_Controller extends Admin_Controller {
	
	public function __construct() {
		parent::__construct( get_class(),
				 'post', '/views/admin/posts/' );
	}
	
	public function index() {
		$posts = $this->model->find();
		
		$template_name = DX_ROOT_DIR . $this->views_dir . 'index.php';
		
		include_once $this->layout;
	}
	
	public function edit( $id ) {
		if( ! empty( $_POST['name'] ) 
				&& ! empty( $_POST['year'] )
				&& ! empty( $_POST['id'] ) ) {
			$name = $_POST['name'];
			$year = $_POST['year'];
			$id = $_POST['id'];
			
			$post = array(
					'id' => $id,
					'name' => $name,
					'year' => $year
			);
			
			$this->model->update( $post );
		}
		
		$post = $this->model->get( $id );
		
		if( empty( $post ) ) {
			// die( 'Nothing to edit here.' );
			header( 'Location: ' . DX_URL );
			exit;
		}
		
		$post = $post[0];
		
		$template_name = DX_ROOT_DIR . $this->views_dir . 'edit.php';
		
		include_once $this->layout;
	}
	
	public function add() {
		if( ! empty( $_POST['name'] ) 
				&& ! empty( $_POST['year'] )
				&& ! empty( $_POST['artist_id'] ) ) {
			$name = $_POST['name'];
			$year = $_POST['year'];
			$artist_id = $_POST['artist_id'];
			
			$post = array(
				'name' => $name,
				'year' => $year,
				'artist_id' => $artist_id
			);
			
			$this->model->add( $post );
		}
		
		$template_name = DX_ROOT_DIR . $this->views_dir . 'add.php';
		
		include_once $this->layout;
	}
	
	public function view( $id ) {
		$posts = $this->model->get( $id );
		
		if( empty( $posts ) ) {
// 			die( 'No post to view here.' );
			header( 'Location: ' . DX_URL );
			exit;
		}
		
		$post = $posts[0];
		
		$artist_id = $post['artist_id'];
		include  DX_ROOT_DIR . '/models/artist.php';
		$artist_model = new \Models\Artist_Model();
		
		$artists = $artist_model->get( $artist_id );
		$artist = $artists[0];
		
		$template_name = DX_ROOT_DIR . $this->views_dir . 'view.php';
		
		include_once $this->layout;
	}
}