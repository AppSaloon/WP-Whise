<?php

namespace wp_whise\config;

class Project_Settings_Config {

	/**
	 * Register submenu for project settings
     *
	 * Project_Settings_Config constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'register_projecten_submenu_page' ) );
	}

	/**
	 * Adds new submenu to project post type
     *
     * @since 1.0.0
	 */
	public function register_projecten_submenu_page() {
		add_submenu_page( 'edit.php?post_type=project', __( 'Settings', 'compass' ), __( 'Settings', 'compass' ), 'manage_options', 'project', array(
			$this,
			'adminPanel'
		) );
	}

	/**
	 * Displays submenu form + save the results
     *
     * @since 1.0.0
	 */
	public function adminPanel() {
		if ( isset( $_POST ) && count( $_POST ) > 1 ) {
			$option['title']       = $_POST["title"];
			$option['description'] = $_POST["description"];
			$option_to_json        = json_encode( $option );
			update_option( 'projecten_settings', $option_to_json );
		}

		?>
        <div class="wrap">
            <h2><?php _e( 'Instellingen', 'compass' ); ?></h2>
            <div class="inside">
                <form method="post">
					<?php
					$options = get_option( 'projecten_settings' );
					if ( $options ) {
						$options = json_decode( $options, true );
					} else {
						$options['title']       = '';
						$options['description'] = '';
					}
					?>
                    <input type="text" name="title" id="title" value="<?php echo $options['title']; ?>"
                           style="width: 100%;"/>
                    <textarea type="text" name="description" id="description" style="width: 100%;"
                              rows="10"><?php echo $options['description']; ?></textarea>
                    <input type="submit" class="button button-primary" name="save"
                           value="<?php _e( 'Bijwerken', 'offertetool' ); ?>">
                </form>
            </div>

        </div>
		<?php

	}
}