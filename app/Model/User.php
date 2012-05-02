<?php

class User extends AppModel {
	
	public $name = 'User';
	
	public $hasMany = array(
		'Posts' => array(
			'className' => 'Post'
		)
	);
	
	public $whitelist = array( 'email', 'password', 'first_name', 'last_name' );
	
	public $validate = array( 
						'email' => array( 
							'email' => array( 
								'rule' => 'email', 
								'message' => 'must be a valid email address' 
							), 
							'maxLength' => array(
								'rule' => array( 'maxLength', 60 ),
								'message' => 'must be less than 60 characters'
							)
						),
						'password' => array(
							'minLength' => array( 
								'rule' => array( 'minLength', 5 ),
								'message' => 'must be at least 5 characters'
							 )
						),
						'first_name' => array(
							'maxLength' => array( 
								'rule' => array( 'maxLength', 30 ),
								'message' => 'must be less than 30 characters'
							 ),
							'notEmpty' => array(
								'rule' => array( 'notEmpty', true ),
								'message' => 'cannot be empty'
							)
						),
						'last_name' => array(
							'maxLength' => array( 
								'rule' => array( 'maxLength', 30 ),
								'message' => 'must be less than 30 characters'
							 ),
							'notEmpty' => array(
								'rule' => array( 'notEmpty', true ),
								'message' => 'cannot be empty'
							)
						),
					   );
}