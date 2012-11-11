<?php

class Model_TestPlanList extends Tenac_Model_Abstract_List {

	public function __construct( $filter = null ){
		if ( null === $filter ){
			$filter = new Model_TestPlanFilter();
		}
		$this->setFilter( $filter );
		$this->setMapper( Model_DBMapper_TestPlanMapper::get_instance() );
	}

	public function fetch () {
		$list = array();
		foreach ( $this->getMapper()->findByFilter( $this->getFilter() ) as $item ) {
			array_push( $list, new Model_TestPlan( $item ) );
		}
		$this->setList( $list );
	}

	/**
	 * @return Model_TestPlanFilter
	 */
	public function getFilter () {
		return parent::getFilter();
	}

	/**
	 * @return Model_TestPlan[]
	 */
	public function getList () {
		return parent::getList();
	}


	public function getListView (){
		$list = $this->getList();
		$res = array ();
		foreach ( $list as $item ){
			$res[ $item->getId()] = $item->getName();
		}
		return $res;
	}

}
