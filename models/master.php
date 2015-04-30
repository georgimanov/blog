<?php

namespace Models;

class Master_Model {
	
	protected $table;
	protected $limit;
	protected $db;
		
	public function __construct( $args = array() ) {
		$defaults = array(
			'limit' => 0				
		);
		
		$args = array_merge( $defaults, $args );
		
		if( ! isset( $args['table'] ) ) {
			die( 'Table not defined.' );
		}
		
		extract( $args );
		
		$this->table = $table;
		$this->limit = $limit;
		
		$db_object = \Lib\Database::get_instance();
		$this->db = $db_object::get_db();
	}
	
	public function get( $id ) {
		return $this->find( array( 'where' => 'id = ' . $id ) );
	}
	
	public function get_by_name( $name ) {
		return $this->find( array( 'where' => "name= '" . $name . "'" ) );
	}	
	
	public function update( $element ) {
		if ( ! isset( $element['id'] ) ) die('Wrong model set.');
		
		$query = "UPDATE {$this->table} SET ";
		
		foreach( $element as $key => $value ) {
			if( $key === 'id' ) continue;
			$query .= "$key = '" . $this->db->real_escape_string($value) . "',";
		}
		
		$query = rtrim( $query, ',' );
		
		$query .= " WHERE id = {$element['id']}";
		
		$this->db->query( $query );
		
		return $this->db->affected_rows;
	}
	
	public function add( $element ) {
		$keys = array_keys( $element );
		$values = array();
		
		foreach( $element as $key => $value ) {
			$values[] = "'" . $this->db->real_escape_string($value) . "'";
		}
		
		$keys = implode( $keys, ',' );
		$values = implode( $values, ',' );
		
		$query = "INSERT INTO {$this->table}($keys) VALUES($values)";

        $this->db->query( $query );
		
		return $this->db->insert_id;
	}

    public function find( $args = array() ) {
        $defaults = array(
            'table' => $this->table,
            'limit' => $this->limit,
            'where' => '',
            'columns' => '*',
        );

        $args = array_merge( $defaults, $args );

        extract( $args );

        $query = "SELECT {$columns} FROM {$table}";

        if( ! empty( $where ) ) {
            $query .= " WHERE $where";
        }

        if( ! empty( $limit ) ) {
            $query .= " LIMIT $limit";
        }

        $result_set = $this->db->query( $query );

        $results = $this->process_results( $result_set );

        return $results;
    }

    public function distinct( $args = array() ) {
        $defaults = array(
            'table' => $this->table,
            'limit' => $this->limit,
            'column' => '*',
        );

        $args = array_merge( $defaults, $args );

        extract( $args );

        $query = "SELECT DISTINCT {$column} FROM {$table}";

        if( ! empty( $limit ) ) {
            $query .= " LIMIT $limit";
        }

        $result_set = $this->db->query( $query );

        $results = $this->process_results( $result_set );

        return $results;
    }
	
	protected function process_results( $result_set ) {
		$results = array(); 
		
		if( ! empty( $result_set ) && $result_set->num_rows > 0 ) {
			while( $row = $result_set->fetch_assoc() ) {
				$results[] = $row;
			}
		}
		
		return $results;
	}

	
	
	
	
	
	
	
	
	
	
	
}