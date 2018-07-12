<?php

namespace wp_whise\config\cpt;

class Project_Cpt_Config {

	public function __construct() {
		$this->register_post_type();
	}

	function register_post_type() {
		$labels_project = array(
			'name'               => __( 'Project', 'wp_whise' ),
			'singular_name'      => __( 'Project', 'wp_whise' ),
			'add_new'            => __( 'Add New', 'wp_whise' ),
			'add_new_item'       => __( 'Add New Project Item', 'wp_whise' ),
			'edit_item'          => __( 'Edit Project Item', 'wp_whise' ),
			'new_item'           => __( 'New Project Item', 'wp_whise' ),
			'view_item'          => __( 'View Project Item', 'wp_whise' ),
			'search_items'       => __( 'Search Project', 'wp_whise' ),
			'not_found'          => __( 'Nothing found', 'wp_whise' ),
			'not_found_in_trash' => __( 'Nothing found in Trash', 'wp_whise' ),
			'parent_item_colon'  => ''
		);

		$args_project = array(
			'labels'             => $labels_project,
			'description'        => __( 'Project per category', 'v' ),
			'public'             => true,
			'menu_position'      => 8,
			'menu_icon'          => 'dashicons-admin-multisite',
			'publicly_queryable' => true,
			'show_ui'            => true,
			'query_var'          => true,
			'rewrite'            => False,
			'has_archive'        => true,
			'capability_type'    => 'post',
			'hierarchical'       => false,
			'taxonomies'         => array( 'category' ),
			'supports'           => array(
				'title'
			)
		);

		register_post_type( 'project', $args_project );
	}
}