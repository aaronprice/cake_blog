<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
	public $currentUser = null;
	
	public $components = array( 'Session', 'DebugKit.Toolbar' );

	public function beforeFilter() {
		parent::beforeFilter();
		
		$this->setCurrentUser();
	}
	
	public function setCurrentUser() {		
		$user_id = $this->Session->read( 'user_id' );
		if ( $user_id ) {
			$this->currentUser = ClassRegistry::init( 'User' )->readById( $user_id );
			unset( $this->currentUser->data[ 'User' ][ 'password' ] );
		}
		
		$this->set( 'currentUser', $this->currentUser );
	}
	
	public function authenticate() {
		if ( !$this->currentUser ) {
			$this->redirect( array( 'controller' => 'user_sessions', 'action' => 'add' ) );
		}
	}
}
