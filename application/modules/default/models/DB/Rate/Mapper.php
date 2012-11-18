<?php

class Model_DB_Rate_Mapper extends Model_Abstract_DBMapper{

    const CLASS_NAME = 'Model_DB_Rate_Mapper';

    /**
     * @param $row
     * @param \Model_DB_Rate_Object $db_model
     * @return Model_DB_Rate_Object
     */
    public function parseRow ( $row, Model_DB_Rate_Object $db_model = null ){

        if ( null === $db_model ){
            $db_model = new Model_DB_Rate_Object();
        }

        return $db_model
            ->setIdYearFk( $row[ Model_DB_Rate_Table::FIELDS_ID_YEAR_FK ] )
            ->setRate( $row[ Model_DB_Rate_Table::FIELDS_RATE ] )
            ->setIdUserFk( $row[ Model_DB_Rate_Table::FIELDS_ID_USER_FK ] )
            ->setId( $row[ Model_DB_Rate_Table::FIELDS_ID ] );
    }

    public function __construct (){
        parent::__construct( 'Model_DB_Rate_Object', 'Model_DB_Rate_Table' );
    }

    /**
     * @return Model_DB_Rate_Mapper
     */
    public static function get_instance (){
        return parent::get_instance();
    }

    public function findByFilter( Model_Rate_Filter $filter ){

   		$where = $this->getWhereClauseByFilter( $filter );
   		$order = null;

   		return $this->fetchAll( $where, $order, $filter->getLimit(), $filter->getOffset() );
   	}

   	public function getCountByFilter( Model_TestPlanFilter $filter ){
   		return false;
   	}

   	protected function getWhereClauseByFilter ( Model_Rate_Filter $filter ){
   		$where = "1=1 ";
   		$and = " AND ";

   		$adapter = $this->getDbTable()->getAdapter();
   		if ( $filter->getId() ){
   			$where = $adapter->quoteInto( Model_DB_Rate_Table::FIELDS_ID." = ?", $filter->getId() );
   		}
   		else {
   			$value = $filter->getIdUser();
   			if ( !empty( $value ) ){
   				$where .= $and . $adapter->quoteInto( Model_DB_Rate_Table::FIELDS_ID_USER_FK." LIKE ?", "%$value%" );
   			}
   			$value = $filter->getIdYear();
   			if ( !empty( $value ) ){
   				$where .= $and . $adapter->quoteInto( Model_DB_Rate_Table::FIELDS_ID_YEAR_FK." LIKE ?", "%$value%" );
   			}
   		}
   		return $where;
   	}
}
