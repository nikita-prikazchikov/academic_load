<?php

class Model_DB_Rate_Table extends Model_Abstract_DBTable {

    const CLASS_NAME = 'Model_DB_Rate_Table';
    const TABLE_NAME = 'rate';

    const FIELDS_ID = 'id_rate_pk';
    const FIELDS_RATE = 'rate';
    const FIELDS_ID_YEAR_FK = 'id_year_fk';
    const FIELDS_ID_USER_FK = 'id_user_fk';

    protected $_name = self::TABLE_NAME;

}