<?php

class Post extends AppModel {
	
	public $name = 'Post';
	
	public $hasOne = array(
		'User' => array( 
			'className' => 'User', 
			'dependent' => true 
		)
	);
	
	public $whitelist = array( 'title', 'body' );
	
	public $validate = null;
	
	public function setupValidation() {
		$this->validate = array(
			'title' => array(
				'maxLength' => array(
					'rule' => array( 'maxLength', 50 ),
					'message' => __( 'cannot be more than 50 characters' )
				),
				'notEmpty' => array(
					'rule' => array( 'notEmpty', true ),
					'message' => __( 'cannot be empty' )
				)
			), 
			'body' => array(
				'notEmpty' => array(
					'rule' => array( 'notEmpty', true ),
					'message' => __( 'cannot be empty' )
				)
			)
		);
	}
}