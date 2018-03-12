<?php
/**
 * @package   ModuloBox
 * @author    Themeone <themeone.master@gmail.com>
 * @copyright 2017 Themeone
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ModuloBox handle ajax requests
 *
 * @class ModuloBox_Async_Request
 * @version	1.0.0
 * @since 1.0.0
 */
class ModuloBox_Async_Request extends ModuloBox_Settings_field {

	/**
	 * Cloning disabled
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function __clone() {
	}

	/**
	 * De-serialization disabled
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function __wakeup() {
	}

	/**
	 * Initialization
	 *
	 * @since 1.0.0
	 * @access public 
	 */
	public function __construct() {

		// Init Settings API
		parent::__construct();

		// Handle Ajax requests
		add_action( 'wp_ajax_' . MOBX_NAME . '_ajax_request', array( $this, 'check_ajax_request' ) );

	}

	/**
	 * Check for ajax request type
	 *
	 * @since 1.0.0
	 * @access public 
	 */
	public function check_ajax_request() {

		$type = isset( $_POST[ 'type' ] ) ? $_POST[ 'type' ] : null;

		if ( method_exists( $this, $type ) ) {

			$this->$type();

		} else {

			wp_send_json(array(
				'success' => false,		
				'message' => esc_html__( 'Sorry, an unknown error occurred.', 'modulobox' )
			));

		}

	}

	/**
	 * Check refer for admin ajax requests
	 *
	 * @since 1.0.0
	 * @access public 
	 *
	 * @param int|string $action    Action nonce.
 	 * @param string     $query_arg Nonce Key of $_REQUEST
	 */
	public function check_admin_referer( $action = -1, $query_arg = '_wpnonce' ) {

		if ( check_ajax_referer( $action, $query_arg, false ) === false ) {

			wp_send_json(array(
				'success' => false,		
				'message' => esc_html__( 'An error occurred. Please try to refresh the page or logout and login again.', 'modulobox' )
			));

		}

		if ( ! current_user_can( 'manage_options' ) ) {

			wp_send_json(array(
				'success' => false,		
				'message' => esc_html__( 'You are not allowed to perform this action. Please contact site administrator for further information.', 'modulobox' ),
			));

		}	

	}

	/**
	 * Save settings
	 *
	 * @since 1.0.0
	 * @access public 
	 */
	public function save_settings() {

		$this->check_admin_referer( MOBX_NAME . '-options', '_wpnonce' );
		
		$success = false;

		if ( isset( $_POST[ MOBX_NAME ] ) && ! empty( $_POST[ MOBX_NAME ] ) ) {

			// Settings API handles sanitization when updating option (see sanitize_settings method in settings-field.class.php)
			update_option( MOBX_NAME, $_POST[ MOBX_NAME ] );
			
			$message = __( 'Settings saved!', 'modulobox' );
			$success = true;

		} else {
			$message = __( 'Sorry, an unknown error occurred while saving settings.', 'modulobox' );
		}

		wp_send_json(array(
			'success' => $success,
			'message' => esc_html( $message ),
			'content' => get_option( MOBX_NAME )
		));

	}

	/**
	 * Preview Lightbox
	 *
	 * @since 1.0.0
	 * @access public 
	 */
	public function preview_lightbox() {

		$this->check_admin_referer( MOBX_NAME . '-options', '_wpnonce' );
		
		$success = false;
		$options = null;

		if ( isset( $_POST[ MOBX_NAME ] ) && ! empty( $_POST[ MOBX_NAME ] ) ) {

			// Sanitize settings with WordPress Settings API sanitize callback
			$options   = parent::sanitize_settings( $_POST[ MOBX_NAME ] );

			// Normalize sanitized settings
			$normalize = new ModuloBox_Normalize_Settings( $options );
			$options   = $normalize->get_settings();

			$message = __( 'Opening lightbox preview!', 'modulobox' );
			$success = true;

		} else {
			$message = __( 'Sorry, an unknown error occurred while getting settings.', 'modulobox' );
		}

		wp_send_json(array(
			'success' => $success,
			'message' => esc_html( $message ),
			'content' => $options
		));

	}

	/**
	 * Register plugin from Envato Personal Token (Envato API)
	 *
	 * @since 1.0.0
	 * @access public 
	 */
	public function register_plugin() {

		$this->check_admin_referer( MOBX_NAME . '_admin_nonce', 'nonce' );

		$success = false;
		$content = null;

		if ( isset( $_POST['access_token'] )  ) {

			if ( ! empty( $_POST['access_token'] ) ) {

				// Init Envato API
				$API = new ModuloBox_Plugin_Info( $_POST['access_token'] );
				// Get plugin info from plugin name and author
				$response = $API->get_plugin( MOBX_NAME, 'themeone' );

				// If an error occured when fetching data from Envato server
				if ( is_wp_error( $response ) ) {

					if ( isset( $response->errors[401] ) || isset( $response->errors[403] ) ) {
						$message = __( 'Your Personal Token is not valid!' , 'modulobox' );
					} else if ( isset( $response->errors[404] ) ) {
						$message = __( 'Sorry, an issue occured from Envato API Server. Please try later.' , 'modulobox' );
					} else {
						$message = __( 'Sorry, an unknown error occurred from Envato API Server' , 'modulobox' );
					}

				// If the plugin id exists
				} else if ( isset( $response['id'] )  && ! empty( $response['id'] ) ) {

					// Set plugin slug (required to update)
					$response['slug'] = MOBX_BASE;

					update_option( MOBX_NAME . '_plugin_info',  $response);

					$success = true;
					$message = __( 'ModuloBox was correctly registered!' , 'modulobox' );

				// If no plugin info is returned
				} else {

					$message = __( 'No purchase was found from your Envato Account' , 'modulobox' );

				}

			} else {

				$message = __( 'Please enter a Personal Token' , 'modulobox' );	

			}
			
			if ( $success === false ) {

				delete_option( MOBX_NAME . '_plugin_info' );

			}

			// Get updates-support tab content
			ob_start();
			include_once( MOBX_ADMIN_PATH . 'views/updates-support.php' );
			$content = ob_get_clean();

		} else {

			$message = __( 'Sorry, an unknown error occurred while registering' , 'modulobox' );

		}

		wp_send_json(array(
			'success' => $success,				
			'message' => esc_html( $message ),
			'content' => $content
		));

	}

	/**
	 * Check for plugin for update from Envato API
	 *
	 * @since 1.0.0
	 * @access public 
	 */
	public function check_plugin_update() {

		$this->check_admin_referer( MOBX_NAME . '_admin_nonce', 'nonce' );

		$success = false;
		$content = null;

		// Get plugin info stored when registering
		$plugin_info = (array) get_option( MOBX_NAME . '_plugin_info' );

		// If the plugin id exists
		if ( isset( $plugin_info['id'] ) && ! empty( $plugin_info['id'] ) ) {

			// Init Envato API
			$API = new ModuloBox_Plugin_Info( $plugin_info['access_token'] );
			// Get plugin info from plugin id
			$response = $API->get_item( $plugin_info['id'] );
			
			// If an error occured when fetching data from Envato server
			if ( is_wp_error( $response ) ) {
				
				$message = __( 'Sorry, an unknown error occurred while checking for update', 'modulobox');

			} else if ( ! empty( $response ) && isset( $response['version'] ) && version_compare( $response['version'], MOBX_VERSION ) >  0 ) {

				// Merge new plugin info with old data to keep slug, token, code, license and support until values
				$plugin_info = wp_parse_args( $response, $plugin_info );
				// Update plugin info to display changes in plugin detail popup
				update_option( MOBX_NAME . '_plugin_info',  $plugin_info );

				// Get updates-support tab content
				ob_start();
				include_once( MOBX_ADMIN_PATH . 'views/updates-support.php' );
				$content = ob_get_clean();

				$success = true;
				$message = __( 'A new update is available!', 'modulobox');

			} else {

				$message = __( 'No update available!', 'modulobox');

			}

		} else {

			$message = __( 'Sorry, an unknown error occurred while checking for update', 'modulobox');

		}

		wp_send_json(array(
			'success' => $success,				
			'message' => esc_html( $message ),
			'content' => $content
		));

	}

}

new ModuloBox_Async_Request;
