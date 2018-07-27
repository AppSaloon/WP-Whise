<?php

namespace wp_whise\controller;

use wp_whise\controller\log\Log_Controller_Interface;
use wp_whise\lib\Helper;

class Project_Controller implements Project_Controller_Interface {

	public $whise_controller;
	public $log;

	public $estates;

	public function __construct( Whise_Controller_Interface $whise_controller, Log_Controller_Interface $log ) {
		$this->whise_controller = $whise_controller;
		$this->log              = $log;
	}

	/**
	 * Get estates from the Whise service
	 *
	 * @return bool
	 *
	 * @since 1.0.0
	 */
	public function get() {
		$this->estates = $this->whise_controller->get_projects();

		return $this->estates;
	}

	/**
	 * Process the estates from the Whise service
	 *
	 * @since 1.0.0
	 */
	public function process() {
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
				$whise_estate = Helper::objectToObject( $whise_estate, 'wp_whise\model\Whise_Project' );

				/**
				 * Skip projects
				 */
				if ( $whise_estate->ParentID == null && $whise_estate->Price == null ) {
					continue;
				}

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