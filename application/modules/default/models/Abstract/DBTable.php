<?php

abstract class Model_Abstract_DBTable extends Zend_Db_Table_Abstract {

	const TABLE_SCHEMA = "workload";

	protected $_schema = self::TABLE_SCHEMA;
}