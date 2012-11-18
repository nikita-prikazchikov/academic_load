<?php

class Model_DB_User_Object extends Model_Abstract_DBObject{

    const CLASS_NAME = 'Model_DB_User_Object';

    protected $_name;

    private $_rates = array();

    public function getAssocArray (){

        return array(
            Model_DB_User_Table::FIELDS_ID => $this->getId(),
            Model_DB_User_Table::FIELDS_NAME => $this->getName()
        );
    }

    public function save (){
        Model_DB_User_Mapper::get_instance()->save( $this );
    }

    public function getRate( $yearId ){
        if ( !isset ( $this->_rates[$yearId] )){
            $filter = new Model_Rate_Filter();
            $filter->setIdUser( $this->getId());
            $filter->setIdYear( $yearId );
            $list = Model_DB_Rate_Mapper::get_instance()->findByFilter( $filter );
            if ( count ( $list ) > 0 ){
                $this->_rates[$yearId] = $list[0];
            }
            else {
                $rate = new Model_DB_Rate_Object();
                $rate->setIdUserFk( $this->getId() )
                    ->setIdYearFk( $yearId )
                    ->setRate(0);
                $rate->save();
                $this->_rates[$yearId] = $rate;
            }
        }
        return $this->_rates[$yearId];
    }

    public function setName ( $name ){
        $this->_name = $name;
        return $this;
    }

    public function getName (){
        return $this->_name;
    }


}
