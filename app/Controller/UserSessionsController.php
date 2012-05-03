<?php

class UserSessionsController extends AppController {
	
	public function add() {
		
		Controller::loadModel( 'User' );
		
		if ( $this->request->is( 'post' ) ) {
			
			$User = $this->User->readByEmail( $this->request->data[ 'User' ][ 'email' ] );
			
			if ( $User && $User->isAuthentic( $this->request->data[ 'User' ][ 'password' ] ) ) {
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