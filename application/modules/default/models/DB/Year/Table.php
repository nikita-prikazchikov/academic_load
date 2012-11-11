<?php

class Model_DB_Year_Table extends Model_Abstract_DBTable{

    const CLASS_NAME = 'Model_DB_Year_Table';
    const TABLE_NAME = 'year';

    const FIELDS_ID = 'id_year_pk';
    const FIELDS_NAME = 'name';

    protected $_name = self::TABLE_NAME;
}