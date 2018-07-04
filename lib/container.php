<?php

namespace wp_whise\lib;

use \DI;
use \DI\ContainerBuilder;

Final class Container implements Container_Interface {

	/**
	 * @var \DI\ContainerBuilder
	 */
	protected $builder;

	/**
	 * @var \DI\Container
	 */
	public $container;

	/**
	 * @var Container
	 */
	protected static $instance;

	/**
	 * Build Container.
	 */
	public function __construct() {
		$this->builder = new ContainerBuilder();

		$this->build_container();

		$this->set_classes();
	}

	/**
	 * Instance of this class
	 *
	 * @return Container
	 */
	public static function getInstance()
	{
		if( null == static::$instance ){
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Build Container
	 */
	public function build_container() {
		$this->builder->addDefinitions( [
			'plugin_activate'   => DI\object( 'wp_whise\config\Plugin_Activate' ),
			'plugin_deactivate' => DI\object( 'wp_whise\config\Plugin_Deactivate' ),
			'log'               => DI\object( 'wp_whise\lib\Log' )
		] );

		$this->container = $this->builder->build();
	}

	/**
	 * Set classes that needs to be used
	 *
	 * TODO extend this with model, controllers and config
	 */
	public function set_classes() {
		/**
		 * Set init config
		 */
		$this->container->set( 'init_config', DI\object( 'wp_whise\config\Init_Config' ) );
	}
}