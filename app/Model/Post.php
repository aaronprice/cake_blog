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
	
	public $validation = array(
		'title' => array(
			'maxLength' => array(
				'rule' => array( 'maxLength', 50 ),
				'message' => 'cannot be more than 50 characters'
			),
			'notEmpty' => array(
				'rule' => array( 'notEmpty', true ),
				'message' => 'cannot be empty'
			)
		), 
		'body' => array(
			'notEmpty' => array(
				'rule' => array( 'notEmpty', true ),
				'message' => 'cannot be empty'
			)
		)
	);
}