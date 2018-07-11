<?php

namespace wp_whise\controller\cron;

use wp_whise\controller\log\Database_Log_Controller;
use wp_whise\controller\Whise_Controller;
use wp_whise\lib\Helper;

class Estates_Cron_Controller {

	protected $log;

	protected $whise_controller;

	protected $estates;

	public function __construct( Whise_Controller $whise_controller, Database_Log_Controller $log ) {
		$this->whise_controller = $whise_controller;

		$this->log = $log;
	}

	/**
	 * Load estates from the webservice
	 *
	 * @since 1.0.0
	 */
	public function load_estates() {
		$this->estates = $this->whise_controller->get_projects();

		$this->process_estates();
	}

	/**
	 * Process estates
	 *
	 * @since 1.0.0
	 */
	public function process_estates() {
		if ( false !== $this->estates && is_array( $this->estates ) && isset( $this->estates[0] ) ) {
			foreach ( Helper::generator( $this->estates ) as $whise_estate ) {
				/**
				 * Rename class to \wp_whise\model\Whise_Estate
				 *
				 * @var \wp_whise\model\Whise_Estate
				 */
				$whise_estate = Helper::objectToObject( $whise_estate, 'wp_whise\model\Whise_Estate' );

				if ( $whise_estate->does_post_exist() ) {
					if ( $whise_estate->update_wp_post() ) {
						$this->log->info( $whise_estate->get_estate_id() . ' is updated.' );
					} else {
						$this->log->error( 'Fail updating ' . $whise_estate->get_estate_id() );
					}
				} else {
					if ( $whise_estate->create_wp_post() ) {
						$this->log->info( $whise_estate->get_estate_id() . ' is created.' );
					} else {
						$this->log->info( 'Fail creating ' . $whise_estate->get_estate_id() );
					}
				}
			}
		} else {
			return false;
		}
	}


}