<?php

class User extends AppModel {
	
	public $name = 'User';
	
	public $hasMany = array(
		'Posts' => array(
			'className' => 'Post'
		)
	);
	
	public $whitelist = array( 'email', 'password', 'first_name', 'last_name' );
	
	public $validate = null;
	
	public function setupValidation() {
		$this->validate = array( 
			'email' => array( 
				'email' => array( 
					'rule' => 'email', 
					'message' => __( 'must be a valid email address' )
				), 
				'maxLength' => array(
					'rule' => array( 'maxLength', 60 ),
					'message' => __( 'must be less than 60 characters' )
				)
			),
			'password' => array(
				'minLength' => array( 
					'rule' => array( 'minLength', 5 ),
					'message' => __( 'must be at least 5 characters' )
				 )
			),
			'first_name' => array(
				'maxLength' => array( 
					'rule' => array( 'maxLength', 30 ),
					'message' => __( 'must be less than 30 characters' )
				 ),
				'notEmpty' => array(
					'rule' => array( 'notEmpty', true ),
					'message' => __( 'cannot be empty' )
				)
			),
			'last_name' => array(
				'maxLength' => array( 
					'rule' => array( 'maxLength', 30 ),
					'message' => __( 'must be less than 30 characters' )
				 ),
				'notEmpty' => array(
					'rule' => array( 'notEmpty', true ),
					'message' => __( 'cannot be empty' )
				)
			),
		);
	}
	
	public function beforeSave() {
		if ( isset( $this->data[ $this->alias ][ 'password' ] ) ) {
			$this->data[ $this->alias ][ 'password' ] = md5( $this->data[ $this->alias ][ 'password' ] );
		}
		return true;
	}
	
	public function isAuthentic( $password ) {
		if ( isset( $this->data[ $this->alias ][ 'password' ] ) ) {
			return ( $this->data[ $this->alias ][ 'password' ] == md5( $password ) );
		} else {
			return false;
		}
	}
	
	public function readByEmail( $email ) {
		
		$User = null;
		
		$result = $this->findByEmail( $email );
		
		if ( is_array( $result ) && isset( $result[ 'User' ][ 'id' ] ) ) {
			$this->id = $result[ 'User' ][ 'id' ];
			$this->read();
		}
		
		return $this;
	}
	
	public function readById( $id ) {
		$User = null;
		
		$result = $this->findById( $id );
		
		if ( is_array( $result ) && isset( $result[ 'User' ][ 'id' ] ) ) {
			$this->id = $result[ 'User' ][ 'id' ];
			$this->read();
		}
		
		return $this;
	}
}