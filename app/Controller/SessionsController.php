<?php
App::uses('AppController', 'Controller');

class SessionsController extends AppController {
	
	public function add() {
		
		Controller::loadModel( 'User' );
		
		if ( $this->request->is( 'post' ) ) {
			
			$User = $this->User->findByEmail( $this->request->data[ 'email' ] );
			
			if ( $User && $User->isAuthentic( $this->request->data[ 'password' ] ) ) {
				$this->redirect('/');
			} else {
				$this->Session->setFlash(__('Invalid username or password, try again'));
			}
		}
	}
	
	public function delete() {
		$this->Session->destroy();
		$this->redirect('/');
	}
}