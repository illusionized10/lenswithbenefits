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
 * Update plugin from external source
 *
 * @class ModuloBox_Plugin_Update
 * @version 1.0.0
 * @since 1.0.0
 */
class ModuloBox_Plugin_Update {

	/**
	 * Plugin info
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected $plugin_info = array();

	/**
	 * Cloning disabled
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __clone() {
	}

	/**
	 * De-serialization disabled
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __wakeup() {
	}

	/**
	 * API Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		// Get plugin info
		$this->plugin_info = (array) get_option( MOBX_NAME . '_plugin_info' );

		// If the plugin is registered
		if ( isset( $this->plugin_info['id'] ) && ! empty( $this->plugin_info['id'] ) ) {

			$this->init_hooks();

		}

	}

	/**
	 * Setup hooks, actions and filters
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init_hooks() {			

		// Update natification bubble for menu
		add_action( 'admin_menu', array( $this, 'add_notification_bubble' ), 999 );

		// Deferred Download because of Envato API
		add_action( 'upgrader_package_options', array( $this, 'maybe_deferred_download' ), 99 );
		// On plugin install/update page complete
		add_filter( 'update_plugin_complete_actions', array( $this, 'update_complete' ), 10, 2 );

		// Inject plugin updates into the response array
		add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'update_plugins' ) );
		add_filter( 'pre_set_transient_update_plugins', array( $this, 'update_plugins' ) );	

		// Update transient state
		add_filter( 'site_transient_update_plugins', array( $this, 'update_state' ) );
		add_filter( 'transient_update_plugins', array( $this, 'update_state' ) );

		// Inject plugin information into the API calls
		add_filter( 'plugins_api', array( $this, 'plugins_api' ), 10, 3 );

		// Add message in plugin page to download on CodeCanyon 
		add_action( 'in_plugin_update_message-' . MOBX_BASE, array( $this, 'add_plugin_message' ) );

	}

	/**
	 * Add notification bubble in menu item
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function add_notification_bubble() {
	
		global $menu;

		if ( isset( $this->plugin_info['version'] ) && version_compare( $this->plugin_info['version'], MOBX_VERSION ) >  0) {
	
			foreach ( $menu as $key => $item ) {

				if ( stripos( $item[0], $this->plugin_info['name'] ) !== false ) {

					$menu[$key][0] .= '&nbsp;<span class="update-plugins count-1"><span class="plugin-count">1</span></span>';
					break;

				}

			}

		}

	}

	/**
	 * Defers building the API download url until the last responsible moment to limit file requests
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $options Plugin package info (id, url)
	 * @return array Plugin package info (id, url)
	 */
	public function maybe_deferred_download( $options ) {

		$package = $options['package'];

		// If download plugin url have as query string parameter deferred_download and value plugin id
		if ( false !== strrpos( $package, 'deferred_download' ) && false !== strrpos( $package, 'item_id' ) ) {

			parse_str( parse_url( $package, PHP_URL_QUERY ), $vars );

			if ( $vars['item_id'] ) {

				// Get plugin package from Envato server (only available 20mins)
				$API = new ModuloBox_Plugin_Info( $this->plugin_info['access_token'] );
				$download_link = $API->download( $vars['item_id'] );
				$options['package'] = $download_link;
	
			}

		}

		return $options;

	}
		
	/**
	 * Add link to plugin page after update success
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $actions Plugin action
	 * @param string $plugin Plugin slug
	 * @return string Plugin action
	 */
	public function update_complete( $actions, $plugin ) {

		if ( isset( $plugin ) && ! empty( $plugin ) && $plugin == MOBX_BASE ) {
			$actions = '<a href="' . esc_url( admin_url( 'admin.php?page=' . MOBX_NAME ) ) . '">' . esc_html__( 'Return to ModuloBox Settings page.', 'modulobox' ) . '</a>';
		}

		return $actions;

	}

	/**
	 * Inject update data for premium plugins
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param object $transient Plugin data
	 * @return object Plugin data
	 */
	public function update_plugins( $transient ) {

		// Check if the transient contains the 'checked' information
		if ( ! isset( $transient->checked ) && empty( $transient->checked ) ) {
			return $transient;
		}

		// fetch last plugin info
		$this->get_plugin_info();

		if ( isset( $this->plugin_info['version'] ) && version_compare( $this->plugin_info['version'], MOBX_VERSION ) >  0 ) {

			$slug = $this->plugin_info['slug'];

			$transient->response[ $slug ] = (object) array(
				'slug'        => $this->plugin_info['name'],
				'plugin'      => $this->plugin_info['name'],
				'new_version' => $this->plugin_info['version'],
				'url'         => $this->plugin_info['url'],
				'package'     => $this->plugin_info['download_link']
			);

		}

		return $transient;

	}

	/**
	 * Inject update data for premium plugins
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param object $transient Plugin data
	 * @return object Plugin data
	 */
	public function update_state( $transient ) {

		if ( isset( $this->plugin_info['version'] ) && version_compare( $this->plugin_info['version'], MOBX_VERSION ) >  0 ) {

			$slug = $this->plugin_info['slug'];

			$transient->response[ $slug ] = (object) array(
				'slug'        => dirname( $slug ),
				'name'        => $this->plugin_info['name'],
				'new_version' => $this->plugin_info['version'],
				'url'         => $this->plugin_info['url'],
				'package'     => $this->plugin_info['download_link']
			);

		} else {

			if (isset( $transient->response[ MOBX_BASE ] ) ) {
				unset( $transient->response[ MOBX_BASE ] );
			}

		}

		return $transient;

	}

	/**
	 * Inject API data for premium plugins
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param object $response Plugin data
	 * @param string $action Plugin action
	 * @param object $args Plugin arg
	 * @return object Plugin data
	 */
	public function plugins_api( $response, $action, $args ) {

		// Process plugins
		if ( 'plugin_information' === $action && isset( $args->slug ) && isset( $this->plugin_info['slug'] ) && $args->slug === dirname( $this->plugin_info['slug'] ) ) {
			// Update plugin api info
			$response = (object) $this->plugin_info;
		}

		return $response;

	}

	/**
	 * Get plugin info from Envato API
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_plugin_info() {

		$API = new ModuloBox_Plugin_Info( $this->plugin_info['access_token'] );
		$response = $API->get_item( $this->plugin_info['id'] );

		// If a new version exists, get new plugin info
		if ( ! is_wp_error( $response ) && ! empty( $response ) && isset( $response['version'] ) && version_compare( $response['version'], MOBX_VERSION ) >  0 ) {

			// Merge new plugin info with old data to keep token, code, license and support until values
			$this->plugin_info = wp_parse_args( $response, $this->plugin_info );
			// Update plugin info to display changes in plugin detail popup
			update_option( MOBX_NAME . '_plugin_info',  $this->plugin_info);

		}

	}

	/**
	 * Shows message on WP Plugins page
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function add_plugin_message() {

		printf(
			'&nbsp;' .
			wp_kses(
				__( 'Or <a target="_blank" href="%s">download new version</a> on CodeCanyon.', 'modulobox' ),
				array(
					'a' => array(
						'href'   => array(),
						'target' => array()
					)
				)
			),
			esc_url( $this->plugin_info['url'] )
		);

	}

}

new ModuloBox_Plugin_Update;
