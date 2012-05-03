<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	
	public function __construct() {
		parent::__construct();
		$this->setupValidation();
	}
	
	public function __call( $method, $params ) {
		
		if ( substr( $method, 0, 6 ) == 'readBy' ) {
			return $this->_readBy( substr( $method, 6 ), $params[ 0 ] );
		}
		
		return parent::__call( $method, $params );
	}
	
	private function _readBy( $column, $value ) {
		
		$this->recursive = -1;
		
		$method = 'findBy'.$column;
		$result = $this->$method( $value );
		
		if ( is_array( $result ) && isset( $result[ $this->alias ][ 'id' ] ) ) {
			$this->id = $result[ $this->alias ][ 'id' ];
			$this->read();
		}
		
		return $this;
	}
}
