<?php

namespace wp_whise\tests\unit\controller;

/**
 * Class SampleTest
 *
 * @package SampleTest
 */

use wp_whise\controller\Whise_Controller;

/**
 * Sample test case.
 *
 * @group whise
 * @group unit
 * @covers \wp_whise\controller\adapter\Whise_Adapter
 */
class Test_Whise_Controller extends \WP_UnitTestCase {

	CONST CLIENT_ID = '1829c9494c7d4340a152';

	/**
	 * @var \wp_whise\controller\Whise_Controller
	 */
	public $whise_controller;

	public $log;

	public $whise_adapter;

	function setUp() {
		$this->whise_adapter = $this->getMockBuilder( 'wp_whise\controller\adapter\Whise_Adapter' )->getMock();
		$this->log           = $this->getMockBuilder( 'wp_whise\controller\log\Database_Log_Controller' )->getMock();
	}

	/**
	 * @covers \wp_whise\controller\Whise_Controller::get_estates
	 */
	function test_get_estate_list() {
		$object                = new \stdClass();
		$object->d             = new \stdClass();
		$object->d->__type     = 'EstateServiceGetEstateListResponse:Whoman.Estate';
		$object->d->EstateList = array( 1, 2, 3, 4 );

		$this->whise_adapter->method( 'get' )->willReturn( $object );

		$this->whise_controller = new Whise_Controller( $this->whise_adapter, $this->log, static::CLIENT_ID );

		$response = $this->whise_controller->get_estates();

		$this->assertTrue( is_array( $response ) );
	}

	/**
	 * @covers \wp_whise\controller\Whise_Controller::get_estates
	 */
	function test_get_estate_list_with_wp_error() {
		$object                = new \WP_Error( 'broke', 'it is stuck' );
		$object->d             = new \stdClass();
		$object->d->__type     = 'EstateServiceGetEstateListResponse:Whoman.Estate';
		$object->d->EstateList = array();

		$this->whise_adapter->method( 'get' )->willReturn( $object );

		$this->whise_controller = new Whise_Controller( $this->whise_adapter, $this->log, static::CLIENT_ID );

		$response = $this->whise_controller->get_estates();

		$this->assertFalse( $response );
	}

	/**
	 * @covers \wp_whise\controller\Whise_Controller::get_estate_categories
	 */
	function test_get_estate_categories() {
		$object                  = new \stdClass();
		$object->d               = new \stdClass();
		$object->d->__type       = 'EstateServiceGetCategoryListResponse:Whoman.Estate';
		$object->d->CategoryList = array( 1, 2, 3, 4 );

		$this->whise_adapter->method( 'get' )->willReturn( $object );

		$this->whise_controller = new Whise_Controller( $this->whise_adapter, $this->log, static::CLIENT_ID );

		$response = $this->whise_controller->get_estate_categories();

		$this->assertTrue( is_array( $response ) );
	}
}
