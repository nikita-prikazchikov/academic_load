<?php

class Model_Year_List extends Model_Abstract_List {

    private $_yearViewList;

	public function __construct( $filter = null ){
		if ( null === $filter ){
			$filter = new Model_Year_Filter();
		}
		$this->setFilter( $filter );
		$this->setMapper( Model_DB_Year_Mapper::get_instance() );
	}

	public function fetch () {
		$list = array();
		foreach ( $this->getMapper()->findByFilter( $this->getFilter() ) as $item ) {
			array_push( $list, $item );
		}
		$this->setList( $list );
	}

	/**
	 * @return Model_Year_List
	 */
	public function getFilter () {
		return parent::getFilter();
	}

	/**
	 * @return Model_DB_Year_Object[]
	 */
	public function getList () {
		return parent::getList();
	}


	public function getListView (){
		if ( is_null( $this->_yearViewList )){
        $list = $this->getList();
        $this->_yearViewList = array ();
		foreach ( $list as $item ){
            $this->_yearViewList[ $item->getId()] = $item->getName();
		}
        }
        return $this->_yearViewList;
	}

    public function getListViewUnassigned (){
        return array ( "Не выбран" => "" ) + $this->getListView();
    }

}
