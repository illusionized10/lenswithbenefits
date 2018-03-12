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
 * Creates the Envato API connection
 *
 * @class ModuloBox_Plugin_Info
 * @version 1.0.0
 * @since 1.0.0
 */
class ModuloBox_Plugin_Info {

	/**
	 * The Envato API Personal Token
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected $personal_token;
	
	/**
	 * The Envato API uri base
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private $api_base = 'https://api.envato.com/v3/market/';

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
	 *
	 * @param string $personal_token
	 */
	public function __construct( $personal_token ) {
	
		// Set Envato API Personal Token
		$this->personal_token = $personal_token;

	}

	/**
	 * Query the Envato API
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $url URL to request for
	 * @return mixed
	 */
	public function request( $url ) {

		if ( empty( $this->personal_token ) ) {
			return new WP_Error( 'api_token_error', __( 'An API Personal token is required.', 'modulobox' ) );
		}

		$args = array(
			'headers' => array(
				'Authorization' => 'Bearer ' . trim( $this->personal_token ),
			),
			'timeout' => 20,
		);

		// Make an API request.
		$response = wp_remote_get( esc_url_raw( $this->api_base . $url ), $args );

		// Check the response code.
		$response_code    = wp_remote_retrieve_response_code( $response );
		$response_message = wp_remote_retrieve_response_message( $response );

		if ( 200 !== $response_code && ! empty( $response_message ) ) {

			return new WP_Error( $response_code, $response_message );

		} elseif ( 200 !== $response_code ) {

			return new WP_Error( $response_code, __( 'An unknown API error occurred.', 'modulobox' ) );

		} else {

			$return = json_decode( wp_remote_retrieve_body( $response ), true );

			if ( null === $return ) {
				return new WP_Error( 'api_error', __( 'An unknown API error occurred.', 'modulobox' ) );
			}

			return $return;

		}

	}

	/**
	 * Deferred item download URL
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param number $id Plugin id (Envato ID)
	 * @return string Download url
	 */
	public function deferred_download( $id ) {

		if ( empty( $id ) ) {
			return '';
		}

		$args = array(
			'deferred_download' => true,
			'item_id' => $id,
		);

		return add_query_arg( $args, esc_url( admin_url( 'admin.php?page=' . MOBX_NAME ) ) );

	}

	/**
	 * Get the item download url
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param number $id Plugin id (Envato ID)
	 * @return mixed Plugin item info
	 */
	public function download( $id ) {

		if ( empty( $id ) ) {
			return false;
		}

		$response = $this->request( 'buyer/download?item_id=' . $id . '&shorten_url=true' );

		if ( is_wp_error( $response ) || empty( $response ) || ! empty( $response['error'] ) ) {
			return false;
		}

		if ( ! empty( $response['wordpress_plugin'] ) ) {
			return $response['wordpress_plugin'];
		}

		return false;

	}

	/**
	 * Get plugin item info by ID and type
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param number $id Plugin id (Envato ID)
	 * @return mixed Plugin item info
	 */
	public function get_item( $id ) {

		$response = $this->request( 'catalog/item?id=' . $id );

		if ( is_wp_error( $response ) || empty( $response ) ) {
			return $response;
		}

		if ( ! empty( $response['wordpress_plugin_metadata'] ) ) {
			return $this->normalize_plugin( $response );
		}

		return false;

	}
	
	/**
	 * Get plugins info from its name and author
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $name Plugin name
	 * @param string $author Plugin Author name
	 * @return mixed Plugin info
	 */
	public function get_plugin( $name, $author ) {

		$response = $this->request( 'buyer/list-purchases?filter_by=wordpress-plugins' );

		if ( is_wp_error( $response ) || empty( $response ) || empty( $response['results'] ) ) {
			return $response;
		}

		foreach ( $response['results'] as $plugin ) {

			$plugin_info = $this->normalize_plugin( $plugin );

			if ( stripos( $plugin_info['name'], $name ) !== false && stripos( $plugin_info['author'], $author ) !== false ) {	
				return $plugin_info;
			}

		}

	}

	/**
	 * Normalize a plugin data
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $id Plugin data
	 * @return array Plugin info
	 */
	public function normalize_plugin( $plugin ) {

		$requires = null;
		$tested   = null;
		$versions = array();

		if ( isset( $plugin['item'] ) ) {

			$purchase_info = array(
				'license'         => isset( $plugin['license'] ) ? $plugin['license'] : null,
				'purchase_code'   => isset( $plugin['code'] ) ? $plugin['code'] : null,
				'supported_until' => isset( $plugin['supported_until'] ) ? $plugin['supported_until'] : null
			);

			$plugin = $plugin['item'];

		}

		foreach ( $plugin['attributes'] as $k => $v ) {

			if ( 'compatible-software' === $v['name'] ) {

				if ( isset( $v['value'] ) ) {

					foreach ( $v['value'] as $version ) {
						$versions[] = str_replace( 'WordPress ', '', trim( $version ) );
					}

					if ( ! empty( $versions ) ) {
						$requires = $versions[ count( $versions ) - 1 ];
						$tested   = $versions[0];
					}

					break;

				}

			}
	
		}

		$metadata = isset( $plugin['wordpress_plugin_metadata'] ) ? $plugin['wordpress_plugin_metadata'] : array();
		$previews = isset( $plugin['previews'] ) ? $plugin['previews'] : array();
		$previews = isset( $previews['icon_with_landscape_preview'] ) ? $previews['icon_with_landscape_preview'] : null;

		if ( $previews ) {

			$icon_url      = isset( $previews['icon_url'] ) ? $previews['icon_url'] : null;
			$landscape_url = isset( $previews['landscape_url'] ) ? $previews['landscape_url'] : null;

		}

		$plugin_info = array(
			'id'              => isset( $plugin['id'] ) ? $plugin['id'] : null,
			'name'            => isset( $metadata['plugin_name'] ) ? $metadata['plugin_name'] : null,
			'plugin_name'     => isset( $metadata['plugin_name'] ) ? $metadata['plugin_name'] : null,
			'author'          => isset( $metadata['author'] ) ? $metadata['author'] : null,
			'version'         => isset( $metadata['version'] ) ? $metadata['version'] : null,
			'sections'        => array( 'description' => isset( $plugin['description']  ) ? preg_replace( '/<img[^>]+\>/i', '', $plugin['description'] ) : null ),
			'url'             => isset( $plugin['url'] ) ? $plugin['url'] : null,
			'homepage'        => isset( $plugin['url'] ) ? $plugin['url'] : null,
			'author_url'      => isset( $plugin['author_url'] ) ? $plugin['author_url'] : null,
			'thumbnail_url'   => isset( $icon_url ) ? $icon_url : null,
			'banners'         => array( 'low' => isset( $landscape_url ) ? $landscape_url : null ),
			'requires'        => isset( $requires ) ? $requires : null,
			'tested'          => isset( $tested ) ? $tested : null,
			'downloaded'      => isset( $plugin['number_of_sales'] ) ? $plugin['number_of_sales'] : null,
			'last_updated'    => isset( $plugin['updated_at'] ) ? $plugin['updated_at'] : null,
			'rating'          => isset( $plugin['rating'] ) ? $plugin['rating'] / 5 * 100 : null,
			'num_ratings'     => isset( $plugin['rating_count'] ) ? $plugin['rating_count'] : null,
			'download_link'   => $this->deferred_download( $plugin['id'] ),
			'access_token'    => trim( $this->personal_token )
		);

		return isset( $purchase_info ) ? wp_parse_args( $plugin_info, $purchase_info ) : $plugin_info;

	}

}
