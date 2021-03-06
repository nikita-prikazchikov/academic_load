<?php

class Model_DB_Speciality_Mapper extends Model_Abstract_DBMapper{

    const CLASS_NAME = 'Model_DB_Speciality_Mapper';

    /**
     * @param $row
     * @param \Model_DB_Speciality_Object $db_model
     * @return Model_DB_Speciality_Object
     */
    public function parseRow ( $row, Model_DB_Speciality_Object $db_model = null ){

        if ( null === $db_model ){
            $db_model = new Model_DB_Speciality_Object();
        }

        return $db_model
            ->setName( $row[ Model_DB_Speciality_Table::FIELDS_NAME ] )
            ->setType( $row[ Model_DB_Speciality_Table::FIELDS_TYPE ] )
            ->setId( $row[ Model_DB_Speciality_Table::FIELDS_ID ] );
    }

    public function __construct (){
        parent::__construct( 'Model_DB_Speciality_Object', 'Model_DB_Speciality_Table' );
    }

    /**
     * @return Model_DB_Speciality_Mapper
     */
    public static function get_instance (){
        return parent::get_instance();
    }

    public function findByFilter( Model_Speciality_Filter $filter ){

   		$where = $this->getWhereClauseByFilter( $filter );
   		$order = array(Model_DB_Speciality_Table::FIELDS_TYPE,
                          Model_DB_Speciality_Table::FIELDS_NAME);
   		return $this->fetchAll( $where, $order, $filter->getLimit(), $filter->getOffset() );
   	}

   	public function getCountByFilter( Model_TestPlanFilter $filter ){
   		return false;
   	}

   	protected function getWhereClauseByFilter ( Model_Speciality_Filter $filter ){
   		$where = "1=1 ";
   		$and = " AND ";

   		$adapter = $this->getDbTable()->getAdapter();
   		if ( $filter->getId() ){
   			$where = $adapter->quoteInto( Model_DB_Speciality_Table::FIELDS_ID." = ?", $filter->getId() );
   		}
   		else {
   			$value = $filter->getName();
   			if ( !empty( $value ) ){
   				$where .= $and . $adapter->quoteInto( Model_DB_Speciality_Table::FIELDS_NAME." LIKE ?", "%$value%" );
   			}
   		}
   		return $where;
   	}

}
