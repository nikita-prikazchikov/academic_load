<?php

class Model_Data_List extends Model_Abstract_List {

	public function __construct( $filter = null ){
		if ( null === $filter ){
			$filter = new Model_Data_Filter();
		}
		$this->setFilter( $filter );
		$this->setMapper( Model_DB_Data_Mapper::get_instance() );
	}

	public function fetch () {
		$list = array();
		foreach ( $this->getMapper()->findByFilter( $this->getFilter() ) as $item ) {
			array_push( $list, $item );
		}
		$this->setList( $list );
	}

	/**
	 * @return Model_Data_List
	 */
	public function getFilter () {
		return parent::getFilter();
	}

	/**
	 * @return Model_DB_Data_Object[]
	 */
	public function getList () {
		return parent::getList();
	}
}
