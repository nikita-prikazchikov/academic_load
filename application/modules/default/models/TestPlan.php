<?php

class Model_TestPlan {
    
    protected $_id;
	/** @var Model_TestSuite[] */
	protected $_test_suites;
	/** @var Model_DBObject_Browser[] */
	protected $_browsers;
	/** @var Model_TestCaseTree */
	protected $_test_case_tree;
	/** @var Model_DBObject_TestPlan */
	protected $model;
	/** @var Model_DBMapper_TestPlanMapper */
	private $_test_plan_mapper;
	/** @var Model_DBMapper_TestSuiteMapper */
	private $_test_suite_mapper;
	/** @var Model_DBMapper_TestPlanTestSuiteMapMapper */
	private $_test_plan_test_suite_map_mapper;
	/** @var Model_DBMapper_TestPlanBrowserMapMapper */
    private $_test_plan_browser_map_mapper;
	/** @var Model_DBMapper_BrowserMapper */
	private $_browser_mapper;

	/**
	 * @param null|array|int|Model_DBObject_TestPlan $options
	 */
	public function __construct ( $options = array() ) {

        if ( $options instanceof Model_DBObject_TestPlan ){
            $this->setModel( $options );
            $this->setId( $options->getId() );
        }
        else if ( is_numeric($options)){
            $this->setId( $options );
        }
    }

    public function __set ( $name, $value ) {

        $method = 'set' . $name;
        if ( ( 'mapper' == $name ) || !method_exists( $this, $method ) ) {
            throw new Exception( 'Invalid Model TestPlan property' );
        }
        $this->$method( $value );
    }

    public function __get ( $name ) {

        $method = 'get' . preg_replace( "/ /", "", ucwords( preg_replace( "/(?:_(\w))/", strtoupper( " \\1" ), $name ) ) );
        if ( ( 'mapper' == $name ) || !method_exists( $this, $method ) ) {
            throw new Exception( 'Invalid Model TestPlan property' );
        }
        return $this->$method();
    }

    // ===============================================================================================================================================

    public function save(){
        $this->getTestPlanMapper()->save( $this->getModel());
    }

	public function iExist (){
		return $this->getModel()->getId() !== null;
	}

	/**
	 * @return Model_DBObject_TestCase[]
	 */
	public function getTestCasesArray(){

        $res = array();
        $suites = $this->getTestSuites();
        foreach ( $suites as $suite ){
            $testCases = $suite->getTestCases();
            if ( count ( $testCases ) > 0 ){
                foreach ( $testCases as $testCase ){
                    $res[ $testCase->getId() ] = $testCase;
                }
            }
        }
        return $res;
    }

	/**
	 * @return Model_TestCaseTree[]
	 */
	public function getTestCasesTree(){

        if ( is_null( $this->_test_case_tree ) ){
			$tree = array();
	        $suites = $this->getTestSuites();
	        foreach ( $suites as $suite ){
		        $m = new Model_TestCaseTree( $suite->getId() );
		        $m->setIRoot( true );
		        $tree[] = $m;
	        }
	        $this->_test_case_tree = $tree;
        }
        return $this->_test_case_tree;
    }

	public function getBrowsersAssocArray(){
		$browsers = $this->getBrowsers();
		$arr = array();
		foreach ( $browsers as $item ){
			$arr[$item->getId()] = $item->getName();
		}
		return $arr;
	}

    protected function getTestSuitesFromDB () {

        return $this
                ->getTestSuiteMapper()
                ->parseRows(
            $this
                    ->getTestPlanMapper()
                    ->findDependentTestSuitesRowSet( $this->getId() )
        );
    }

    protected function getBrowsersFromDB () {

        return $this
                ->getBrowserMapper()
                ->parseRows(
            $this
                    ->getTestPlanMapper()
                    ->findDependentBrowsersRowSet( $this->getId() )
        );
    }

    //======================================================= Standard functions =====================================================================

    public function setActive ( $active ) {
        $this->getModel()->setActive ( $active );
        return $this;
    }

    public function getActive () {
        return $this->getModel()->getActive ();
    }

    public function setDescription ( $description ) {
        $this->getModel()->setDescription ( $description );
        return $this;
    }

    public function getDescription () {
        return $this->getModel()->getDescription ();
    }

    public function setId ( $id ) {
        $this->_id = $id;
        return $this;
    }

    public function getId () {
        return $this->_id;
    }

    public function setIdApplication ( $id_application ) {
        $this->getModel()->setIdApplication ( $id_application );
        return $this;
    }

    public function getIdApplication () {
        return $this->getModel()->getIdApplication ();
    }

    public function setName ( $name ) {
        $this->getModel()->setName ( $name );
        return $this;
    }

    public function getName () {
        return $this->getModel()->getName ();
    }

    public function setText ( $text ) {
        $this->getModel()->setText ( $text );
    }

    public function getText () {
        return $this->getModel()->getText ();
    }

    //================================================================================================================================================

    protected function setModel ( $model ) {
        $this->model = $model;
    }

    public function getModel () {

        if ( null === $this->model ) {
            if ( null !== $id = $this->getId()){
                $this->setModel( $this->getTestPlanMapper()->find ( $this->getId() ) );
            }
            else {
                $this->setModel( new Model_DBObject_TestPlan() );
            }
        }
        return $this->model;
    }

    protected function setTestSuites ( $test_cases ) {
        $this->_test_suites = $test_cases;
        return $this;
    }

	public function getTestSuites () {
        if ( null === $this->_test_suites ){

            $arr = array();
            $suites = $this->getTestSuitesFromDB();
            foreach ( $suites as $suite ){
                $arr[ $suite->getId() ] = new Model_TestSuite( $suite );
            }
            $this->setTestSuites( $arr );
        }
        return $this->_test_suites;
    }

    protected function setBrowsers ( $browsers ) {
        $this->_browsers = $browsers;
        return $this;
    }

    public function getBrowsers () {

        if ( null === $this->_browsers ){
            $this->setBrowsers( $this->getBrowsersFromDB());
        }
        return $this->_browsers;
    }

    protected function setTestSuiteMapper ( $value ) {

        $this->_test_suite_mapper = $value;
        return $this;
    }

    protected function getTestSuiteMapper () {

        if ( null === $this->_test_suite_mapper ) {
            $this->setTestSuiteMapper( Model_DBMapper_TestSuiteMapper::get_instance() );
        }
        return $this->_test_suite_mapper;
    }

    protected function setBrowserMapper ( $value ) {

        $this->_browser_mapper = $value;
        return $this;
    }

    protected function getBrowserMapper () {

        if ( null === $this->_browser_mapper ) {
            $this->setBrowserMapper( Model_DBMapper_BrowserMapper::get_instance() );
        }
        return $this->_browser_mapper;
    }

    protected function setTestPlanBrowserMapMapper ( $value ) {

        $this->_test_plan_browser_map_mapper = $value;
        return $this;
    }

    protected function getTestPlanBrowserMapMapper () {

        if ( null === $this->_test_plan_browser_map_mapper ) {
            $this->setTestPlanBrowserMapMapper( Model_DBMapper_TestPlanBrowserMapMapper::get_instance() );
        }
        return $this->_test_plan_browser_map_mapper;
    }

    protected function setTestPlanMapper ( $value ) {

        $this->_test_plan_mapper = $value;
        return $this;
    }

    protected function getTestPlanMapper () {

        if ( null === $this->_test_plan_mapper ) {
            $this->setTestPlanMapper( Model_DBMapper_TestPlanMapper::get_instance() );
        }
        return $this->_test_plan_mapper;
    }

    protected function setTestPlanTestSuiteMapMapper ( $value ) {

        $this->_test_plan_test_suite_map_mapper = $value;
        return $this;
    }

    protected function getTestPlanTestSuiteMapMapper () {

        if ( null === $this->_test_plan_test_suite_map_mapper ) {
            $this->setTestPlanTestSuiteMapMapper( Model_DBMapper_TestPlanTestSuiteMapMapper::get_instance() );
        }
        return $this->_test_plan_test_suite_map_mapper;
    }


}
