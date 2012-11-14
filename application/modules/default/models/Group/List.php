<?php

class Model_Group_List extends Model_Abstract_List {

    private $_groupViewList;

	public function __construct( $filter = null ){
		if ( null === $filter ){
			$filter = new Model_Group_Filter();
		}
		$this->setFilter( $filter );
		$this->setMapper( Model_DB_Group_Mapper::get_instance() );
	}

	public function fetch () {
		$list = array();
		foreach ( $this->getMapper()->findByFilter( $this->getFilter() ) as $item ) {
			array_push( $list, $item );
		}
		$this->setList( $list );
	}

	/**
	 * @return Model_Group_List
	 */
	public function getFilter () {
		return parent::getFilter();
	}

	/**
	 * @return Model_DB_Group_Object[]
	 */
	public function getList () {
		return parent::getList();
	}

    /**
     * Function to get list of Specialities prepared for display in view
     * @return array
     */
    public function getListView (){
		if ( is_null( $this->_groupViewList )){
        $list = $this->getList();
        $this->_groupViewList = array ();
		foreach ( $list as $item ){
            $this->_groupViewList[ $item->getId()] = $item->getName();
		}
        }
        return $this->_groupViewList;
	}

}
