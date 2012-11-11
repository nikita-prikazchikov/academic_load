<?php

class Model_DB_GroupComposition_Mapper extends Model_Abstract_DBMapper{

    const CLASS_NAME = 'Model_DB_GroupComposition_Mapper';

    /**
     * @param $row
     * @param \Model_DB_GroupComposition_Object $db_model
     * @return Model_DB_GroupComposition_Object
     */
    public function parseRow ( $row, Model_DB_GroupComposition_Object $db_model = null ){

        if ( null === $db_model ){
            $db_model = new Model_DB_GroupComposition_Object();
        }

        return $db_model
            ->setIdGroupFk( $row[ Model_DB_GroupComposition_Table::FIELDS_ID_GROUP_FK ] )
            ->setIdYearFk( $row[ Model_DB_GroupComposition_Table::FIELDS_ID_YEAR_FK ] )
            ->setSemester( $row[ Model_DB_GroupComposition_Table::FIELDS_SEMESTER ] )
            ->setSize( $row[ Model_DB_GroupComposition_Table::FIELDS_SIZE ] )
            ->setId( $row[ Model_DB_GroupComposition_Table::FIELDS_ID ] );
    }

    public function __construct (){
        parent::__construct( 'Model_DB_GroupComposition_Object', 'Model_DB_GroupComposition_Table' );
    }

    /**
     * @return Model_DB_GroupComposition_Mapper
     */
    public static function get_instance (){
        return parent::get_instance();
    }
}
