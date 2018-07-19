<?php

namespace wp_whise\controller\cron;

use wp_whise\controller\log\Database_Log_Controller;
use wp_whise\controller\Whise_Controller;
use wp_whise\lib\Helper;

class Estates_Cron_Controller {

	public $log;

	protected $whise_controller;

	public $estates;

	public function __construct( Whise_Controller $whise_controller, Database_Log_Controller $log ) {
		$this->whise_controller = $whise_controller;

		$this->log = $log;
	}

	/**
	 * GET estates from the webservice Whise
	 *
	 * @since 1.0.0 */
	public function get_estates() {
		$this->estates = $this->whise_controller->get_projects();
	}

	/**
	 * Process estates
	 *
	 * @since 1.0.0
	 */
	public function process_estates() {
		if ( false !== $this->estates && is_array( $this->estates ) && isset( $this->estates[0] ) ) {
			/**
			 * This will be an array of the processed estates.
			 *
			 * array(
			 *      'updated' => array() // list of all updated post ids
			 *      'created' => array() // list of all created post ids
			 *      'fail' => array()    // list of all failed EstateId from the webservice
			 * )
			 */
			$processed_estates = array();

			foreach ( Helper::generator( $this->estates ) as $whise_estate ) {
				/**
				 * Rename class to \wp_whise\model\Whise_Estate
				 *
				 * @var \wp_whise\model\Whise_Estate
				 */
				$whise_estate = Helper::objectToObject( $whise_estate, 'wp_whise\model\Whise_Estate' );

				/**
				 * Checks if the estate exists
				 */
				if ( $whise_estate->does_post_exist() ) {
					/**
					 * Update existing estate
					 */
					if ( $whise_estate->update_wp_post() ) {
						$processed_estates['updated'][] = $whise_estate->post_id;

						$this->log->info( $whise_estate->get_estate_id() . ' is updated.' );
					} else {
						$processed_estates['fail'][] = $whise_estate->get_estate_id();

						$this->log->error( 'Fail updating ' . $whise_estate->get_estate_id() );
					}
				} else {
					/**
					 * Create new estate
					 */
					if ( $whise_estate->create_wp_post() ) {
						$processed_estates['created'][] = $whise_estate->post_id;

						$this->log->info( $whise_estate->get_estate_id() . ' is created.' );
					} else {
						$processed_estates['fail'][] = $whise_estate->get_estate_id();

						$this->log->info( 'Fail creating ' . $whise_estate->get_estate_id() );
					}
				}
			}

			return $processed_estates;
		} else {
			return false;
		}
	}


}