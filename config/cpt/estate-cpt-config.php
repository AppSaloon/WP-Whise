<?php

namespace wp_whise\config\cpt;

class Estate_Cpt_Config {

	public function __construct() {
		$this->register_post_type();
	}

	protected function register_post_type() {
		$labels_sale = array(
			'name' => __('Sale', 'sale'),
			'singular_name' => __('Sale', 'sale'),
			'add_new' => __('Add New', 'sale'),
			'add_new_item' => __('Add New Sale Item', 'sale'),
			'edit_item' => __('Edit Sale Item', 'sale'),
			'new_item' => __('New Sale Item', 'sale'),
			'view_item' => __('View Sale Item', 'sale'),
			'search_items' => __('Search Sale', 'sale'),
			'not_found' => __('Nothing found', 'sale'),
			'not_found_in_trash' => __('Nothing found in Trash', 'sale'),
			'parent_item_colon' => ''
		);

		$args_sale = array(
			'labels' => $labels_sale,
			'description' => __('Sale per category', 'sale'),
			'public' => true,
			'menu_position' => 9,
			'menu_icon' => 'dashicons-admin-home',
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'aanbod'),
			'has_archive' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'taxonomies' => array('category'),
			'supports' => array(
				'title')
		);

		register_post_type('sale', $args_sale);
	}
}