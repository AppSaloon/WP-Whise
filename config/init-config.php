<?php

namespace wp_whise\config;

use wp_whise\config\cpt\Estate_Cpt_Config;
use wp_whise\config\cpt\Project_Cpt_Config;
use wp_whise\config\cpt\Team_Cpt_Config;

class Init_Config {

	/**
	 * Init_Config constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_type_and_taxonomies' ) );
	}

	/**
	 * Register custom post type and custom taxonomies
	 *
	 * @since 1.0.0
	 */
	public function register_post_type_and_taxonomies() {
		$this->load_project_cpt();
		$this->load_estate_cpt();
		$this->load_team_cpt();
		$this->load_project_settings_config();
	}

	/**
	 * Load project custom post type
	 *
	 * @since 1.0.0
	 */
	protected function load_project_cpt() {
		new Project_Cpt_Config();
	}

	/**
	 * Load estate custom post type
	 *
	 * @since 1.0.0
	 */
	protected function load_estate_cpt() {
		new Estate_Cpt_Config();
	}

	/**
	 * Load team custom post type
	 *
	 * @since 1.0.0
	 */
	protected function load_team_cpt() {
		new Team_Cpt_Config();
	}

	/**
	 * Load project settings config
	 *
	 * @since 1.0.0
	 */
	protected function load_project_settings_config() {
		new Project_Settings_Config();
	}
}