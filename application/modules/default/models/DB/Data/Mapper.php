<?php

class Model_DB_Data_Mapper extends Model_Abstract_DBMapper{

    const CLASS_NAME = 'Model_DB_Data_Mapper';

    /**
     * @param $row
     * @param \Model_DB_Data_Object $db_model
     * @return Model_DB_Data_Object
     */
    public function parseRow ( $row, Model_DB_Data_Object $db_model = null ){

        if ( null === $db_model ){
            $db_model = new Model_DB_Data_Object();
        }

        return $db_model
            ->setIdSpecialityFk( $row[ Model_DB_Data_Table::FIELDS_ID_SPECIALITY_FK ] )
            ->setIdYearFk( $row[ Model_DB_Data_Table::FIELDS_ID_YEAR_FK ] )
            ->setHours( $row[ Model_DB_Data_Table::FIELDS_HOURS ] )
            ->setIdFlowFk( $row[ Model_DB_Data_Table::FIELDS_ID_FLOW_FK ] )
            ->setIdGroupCompositionFk( $row[ Model_DB_Data_Table::FIELDS_ID_GROUP_COMPOSITION_FK ] )
            ->setSemester( $row[ Model_DB_Data_Table::FIELDS_SEMESTER ] )
            ->setType( $row[ Model_DB_Data_Table::FIELDS_TYPE ] )
            ->setIdUserFk( $row[ Model_DB_Data_Table::FIELDS_ID_USER_FK ] )
            ->setId( $row[ Model_DB_Data_Table::FIELDS_ID ] );
    }

    public function __construct (){
        parent::__construct( 'Model_DB_Data_Object', 'Model_DB_Data_Table' );
    }

    /**
     * @return Model_DB_Data_Mapper
     */
    public static function get_instance (){
        return parent::get_instance();
    }

    public function findByFilter( Model_Data_Filter $filter ){

   		$where = $this->getWhereClauseByFilter( $filter );
   		$order = array(Model_DB_Data_Table::FIELDS_TYPE,
                          Model_DB_Data_Table::FIELDS_NAME);
   		return $this->fetchAll( $where, $order, $filter->getLimit(), $filter->getOffset() );
   	}

   	public function getCountByFilter( Model_TestPlanFilter $filter ){
   		return false;
   	}

   	protected function getWhereClauseByFilter ( Model_Data_Filter $filter ){
   		$where = "1=1 ";
   		$and = " AND ";

   		$adapter = $this->getDbTable()->getAdapter();
   		if ( $filter->getId() ){
   			$where = $adapter->quoteInto( Model_DB_Data_Table::FIELDS_ID." = ?", $filter->getId() );
   		}
   		else {
   			$value = $filter->getName();
   			if ( !empty( $value ) ){
   				$where .= $and . $adapter->quoteInto( Model_DB_Data_Table::FIELDS_NAME." LIKE ?", "%$value%" );
   			}
   		}
   		return $where;
   	}

}
