<?php

namespace wp_whise\tests\unit\controller\cron;

use wp_whise\controller\adapter\Whise_Adapter;
use wp_whise\controller\cron\Estates_Cron_Controller;
use wp_whise\controller\Whise_Controller;

class Test_Whise_Estates_Cron_Controller extends \WP_UnitTestCase {

	CONST CLIENT_ID = '1829c9494c7d4340a152';

	protected $whise_adapter;

	protected $log;

	protected $whise_controller;

	function setUp() {
		$this->whise_adapter    = new Whise_Adapter();
		$this->log              = $this->getMockBuilder( 'wp_whise\controller\log\Database_Log_Controller' )->getMock();
		$this->whise_controller = new Whise_Controller( $this->whise_adapter, $this->log, static::CLIENT_ID );
	}

	/**
	 * @covers \wp_whise\controller\cron\Estates_Cron_Controller::get_estates
	 */
	function test_get_estates() {
		$cron = new Estates_Cron_Controller( $this->whise_controller, $this->log );

		$cron->get_estates();

		$this->assertEquals( 10, count( $cron->estates ) );
		$this->assertTrue( is_array( $cron->estates ) );
	}

	/**
	 * @covers \wp_whise\controller\cron\Estates_Cron_Controller::process_estates
	 */
	function test_process_estates() {
		$cron = new Estates_Cron_Controller( $this->whise_controller, $this->log );

		$cron->get_estates();

		$result = $cron->process_estates();

		$this->assertTrue( is_array( $result ) );
		$this->assertTrue( is_array( $result['created'] ) );
		$this->assertEquals( 10, count( $result['created'] ) );
	}
}