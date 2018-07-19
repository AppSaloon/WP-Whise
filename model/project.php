<?php

namespace wp_whise\model;

class Project {

	public $post_id;

	public $attachment_ids;

	public $post_meta = array();

	public $updated_post_meta = array();

	public function __construct() {

	}

	public function set_post( $post_id ) {
		$this->post_id = $post_id;

		$this->post_meta = get_post_meta( $post_id );
	}

	public function set_gallery_image_ids( $attachment_ids ) {
		$this->attachment_ids = $attachment_ids;

		$this->post_meta['_gallery_image_ids'] = $this->attachment_ids;

		$this->updated_post_meta['_gallery_image_ids'] = $this->attachment_ids;
	}

	public function get_gallery_image_ids() {
		return maybe_unserialize( $this->post_meta['_gallery_image_ids'][0] );
	}

	public function save() {
		if ( is_array( $this->updated_post_meta ) && count( $this->updated_post_meta ) != 0 ) {
			foreach ( $this->updated_post_meta as $meta_key => $meta_value ) {
				update_post_meta( $this->post_id, $meta_key, $meta_value );
			}
		}
	}
}