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

	function test_get_estates() {
		$cron = new Estates_Cron_Controller( $this->whise_controller );

		$cron->load_estates();
	}
}