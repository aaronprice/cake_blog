<?php

class Comment extends AppModel {
	
	public $name = 'Comment';
	
	public $belongsTo = array( 'User', 'Post' );
	
	public $whitelist = array( 'body', 'user_id', 'post_id' );
	
	public $validate = null;
	
	public function setupValidation() {
		$this->validate = array(
			'body' => array(
				'notEmpty' => array(
					'rule' => array( 'notEmpty', true ),
					'message' => __( 'cannot be empty' )
				)
			)
		);
	}
}