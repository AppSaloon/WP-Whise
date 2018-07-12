<?php

namespace wp_whise\config\cpt;

class Project_Cpt_Config {

	public function __construct() {
		$this->register_post_type();
	}

	function register_post_type() {
		$labels_project = array(
			'name'               => __( 'Project', 'project' ),
			'singular_name'      => __( 'Project', 'project' ),
			'add_new'            => __( 'Add New', 'project' ),
			'add_new_item'       => __( 'Add New Project Item', 'project' ),
			'edit_item'          => __( 'Edit Project Item', 'project' ),
			'new_item'           => __( 'New Project Item', 'project' ),
			'view_item'          => __( 'View Project Item', 'project' ),
			'search_items'       => __( 'Search Project', 'project' ),
			'not_found'          => __( 'Nothing found', 'project' ),
			'not_found_in_trash' => __( 'Nothing found in Trash', 'project' ),
			'parent_item_colon'  => ''
		);

		$args_project = array(
			'labels'             => $labels_project,
			'description'        => __( 'Project per category', 'project' ),
			'public'             => true,
			'menu_position'      => 8,
			'menu_icon'          => 'dashicons-admin-multisite',
			'publicly_queryable' => true,
			'show_ui'            => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'projects' ),
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