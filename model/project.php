<?php

namespace wp_whise\model;

class Project {

	public $post_id;

	public $attachment_ids;

	public $post_meta = array();

	public $updated_post_meta = array();

	private $ignore_fields = array(
		'_edit_lock',
		'_edit_last',
		'_wpnonce',
		'_wp_http_referer',
		'_wp_original_http_referer',
		'_thumbnail_id',
		'_ajax_nonce-add-estate-category'
	);

	public function __construct() {

	}

	public function set_post( $post_id ) {
		$this->post_id = $post_id;

		$this->post_meta = get_post_meta( $post_id );
	}

	public function set_post_data( $post_data ) {
		foreach ( $post_data as $key => $value ) {
			/**
			 * If unique custom field
			 */
			if ( substr( $key, 0, 1 ) === '_'
			     && substr( $key, 0, 4 ) !== '_acf'
			     && ! in_array( $key, $this->ignore_fields )
			) {
				if ( ! isset( $this->post_meta[ $key ] ) || $value != $this->post_meta[ $key ] ) {
					$this->post_meta[ $key ]         = $value;
					$this->updated_post_meta[ $key ] = $value;
				}
			}
		}
	}

	public function set_gallery_image_ids( $attachment_ids ) {
		$this->attachment_ids = $attachment_ids;

		$this->post_meta['_gallery_image_ids'] = $this->attachment_ids;

		$this->updated_post_meta['_gallery_image_ids'] = $this->attachment_ids;
	}

	public function get_gallery_image_ids() {
		return maybe_unserialize( $this->post_meta['_gallery_image_ids'][0] );
	}

	public function get_meta( $meta_key ) {
		return ( isset( $this->post_meta[ $meta_key ] ) ) ? $this->post_meta[ $meta_key ][0] : '';
	}

	public function save() {
		if ( is_array( $this->updated_post_meta ) && count( $this->updated_post_meta ) != 0 ) {
			foreach ( $this->updated_post_meta as $meta_key => $meta_value ) {
				update_post_meta( $this->post_id, $meta_key, $meta_value );
			}
		}
	}
}