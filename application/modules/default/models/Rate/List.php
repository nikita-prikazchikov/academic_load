<?php

class Model_Rate_List extends Model_Abstract_List {

	public function __construct( $filter = null ){
		if ( null === $filter ){
			$filter = new Model_Rate_Filter();
		}
		$this->setFilter( $filter );
		$this->setMapper( Model_DB_Rate_Mapper::get_instance() );
	}

	public function fetch () {
		$list = array();
		foreach ( $this->getMapper()->findByFilter( $this->getFilter() ) as $item ) {
			array_push( $list, $item );
		}
		$this->setList( $list );
	}

	/**
	 * @return Model_Rate_List
	 */
	public function getFilter () {
		return parent::getFilter();
	}

	/**
	 * @return Model_DB_Rate_Object[]
	 */
	public function getList () {
		return parent::getList();
	}
}
