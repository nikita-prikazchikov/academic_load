<?php

class Model_User_List extends Model_Abstract_List {

    private $_userViewList;

	public function __construct( $filter = null ){
		if ( null === $filter ){
			$filter = new Model_User_Filter();
		}
		$this->setFilter( $filter );
		$this->setMapper( Model_DB_User_Mapper::get_instance() );
	}

	public function fetch () {
		$list = array();
		foreach ( $this->getMapper()->findByFilter( $this->getFilter() ) as $item ) {
			array_push( $list, $item );
		}
		$this->setList( $list );
	}

	/**
	 * @return Model_User_List
	 */
	public function getFilter () {
		return parent::getFilter();
	}

	/**
	 * @return Model_DB_User_Object[]
	 */
	public function getList () {
		return parent::getList();
	}


	public function getListView (){
		if ( is_null( $this->_userViewList )){
        $list = $this->getList();
        $this->_userViewList = array ();
		foreach ( $list as $item ){
            $this->_userViewList[ $item->getId()] = $item->getName();
		}
        }
        return $this->_userViewList;
	}

    public function getListViewUnassigned (){
        return array ( "Не выбран" => "" ) + $this->getListView();
    }

}
