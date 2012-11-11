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
}
