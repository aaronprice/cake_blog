<?php

class Post extends AppModel {
	
	public $name = 'Post';
	
	public $belongsTo = array( 'User' );
	
	public $hasMany = array(
		'Comments' => array(
			'className' => 'Comment'
		)
	);
	
	public $whitelist = array( 'title', 'body', 'user_id' );
	
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