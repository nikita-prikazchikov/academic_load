<?php

class Model_User {

    protected static $instance;  // object instance

	protected $_users = array();
	protected $_list;

    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}

	/**
	 * @static
	 * @return Model_User
	 */
    public static function getInstance() {
        if ( is_null(self::$instance) ) {
            self::$instance = new Model_User;
        }
        return self::$instance;
    }

    public function getUserName( $id ) {

	    if ( !isset ( $this->_users[ $id ])){
		    $mapper = Model_DB_User_Mapper::get_instance();
            $user = $mapper->find( $id );
		    if ( $user ){
			    $this->_users[ $id ] = $user->getName();
		    }
		    else {
			    $this->_users[ $id ] = "";
		    }
	    }
	    return $this->_users[ $id ];
    }

	public function getAllUsers() {
		if ( null === $this->_list ){
			$mapper = Model_DB_User_Mapper::get_instance();
			$this->_list = $mapper->getActiveUsersList();
		}
		return $this->_list;
	}
}
