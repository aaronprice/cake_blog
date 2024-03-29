<?php
App::uses( 'AppController', 'Controller' );
/**
 * Posts Controller
 *
 * @property Post $Post
 */
class PostsController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		
		if ( !in_array( $this->action, array( 'index', 'view' ) ) ) {
			$this->authenticate();
		}
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Post->recursive = 0;
		$this->set( 'posts', $this->paginate() );
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view( $id = null ) {
		$this->Post->id = $id;
		if ( !$this->Post->exists() ) {
			throw new NotFoundException( __( 'Invalid post' ) );
		}
		
		$this->loadModel( 'Comment' );
		$this->set( 'post', $this->Post->read( null, $id ) );
		$this->set( 'current_user', $this->currentUser );
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ( $this->request->is( 'post' ) ) {
			$this->Post->create();
			$this->Post->set( 'user_id', $this->currentUser->id );
			if ( $this->Post->save( $this->request->data ) ) {
				$this->Session->setFlash( __( 'The post has been saved' ) );
				$this->redirect( array( 'action' => 'index' ) );
			} else {
				$this->Session->setFlash( __( 'The post could not be saved. Please, try again.' ) );
			}
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit( $id = null ) {
		$this->Post->id = $id;
		if ( !$this->Post->exists() ) {
			throw new NotFoundException( __( 'Invalid post' ) );
		}
		if ( $this->request->is( 'post' ) || $this->request->is( 'put' ) ) {
			if ( $this->Post->save( $this->request->data ) ) {
				$this->Session->setFlash( __( 'The post has been saved' ) );
				$this->redirect( array( 'action' => 'index' ) );
			} else {
				$this->Session->setFlash( __( 'The post could not be saved. Please, try again.' ) );
			}
		} else {
			$this->request->data = $this->Post->read( null, $id );
		}
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete( $id = null ) {
		if ( !$this->request->is( 'post' ) ) {
			throw new MethodNotAllowedException();
		}
		$this->Post->id = $id;
		if ( !$this->Post->exists() ) {
			throw new NotFoundException( __( 'Invalid post' ) );
		}
		if ( $this->Post->delete() ) {
			$this->Session->setFlash( __( 'Post deleted' ) );
			$this->redirect( array( 'action' => 'index' ) );
		}
		$this->Session->setFlash( __( 'Post was not deleted' ) );
		$this->redirect( array( 'action' => 'index' ) );
	}
}
