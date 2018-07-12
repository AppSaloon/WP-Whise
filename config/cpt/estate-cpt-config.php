<?php

namespace wp_whise\config\cpt;

class Estate_Cpt_Config {

	public function __construct() {
		$this->register_post_type();
	}

	protected function register_post_type() {
		$labels_sale = array(
			'name'               => __( 'Estate', 'wp_whise' ),
			'singular_name'      => __( 'Estate', 'wp_whise' ),
			'add_new'            => __( 'Add New', 'wp_whise' ),
			'add_new_item'       => __( 'Add New Estate Item', 'wp_whise' ),
			'edit_item'          => __( 'Edit Estate Item', 'wp_whise' ),
			'new_item'           => __( 'New Estate Item', 'wp_whise' ),
			'view_item'          => __( 'View Estate Item', 'wp_whise' ),
			'search_items'       => __( 'Search Estate', 'wp_whise' ),
			'not_found'          => __( 'Nothing found', 'wp_whise' ),
			'not_found_in_trash' => __( 'Nothing found in Trash', 'wp_whise' ),
			'parent_item_colon'  => ''
		);

		$args_sale = array(
			'labels'             => $labels_sale,
			'description'        => __( 'Estate per category', 'wp_whise' ),
			'public'             => true,
			'menu_position'      => 9,
			'menu_icon'          => 'dashicons-admin-home',
			'publicly_queryable' => true,
			'show_ui'            => true,
			'query_var'          => true,
			'rewrite'            => false,
			'has_archive'        => true,
			'capability_type'    => 'post',
			'hierarchical'       => false,
			'taxonomies'         => array( 'category' ),
			'supports'           => array(
				'title'
			)
		);

		register_post_type( 'estate', $args_sale );
	}
}