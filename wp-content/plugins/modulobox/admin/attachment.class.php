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
 * ModuloBox Attachment class
 *
 * @class ModuloBox_Attachement
 * @version	1.0.0
 * @since 1.0.0
 */
class ModuloBox_Attachement {

	/**
	 * Initialization
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		add_action( 'admin_init', array( $this, 'init_hooks' ) );

	}

	/**
	 * Hook into actions and filters
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init_hooks() {

		$options = get_option( MOBX_NAME );

		if ( isset( $options['galleryShortcode'] ) && $options['galleryShortcode'] && ( current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' ) ) ) {

			// Add the filter for editing the custom video url field
			add_filter( 'attachment_fields_to_edit', array( $this, 'attachment_fields_to_edit' ), null, 2 );
			// Add the filter for saving the custom video url field
			add_filter( 'attachment_fields_to_save', array( $this, 'attachment_fields_to_save' ), null , 2 );
			// Add the action to add custom fields for gallery shortcode
			add_action( 'print_media_templates', array( $this, 'print_media_templates' ) );
			// Enqueue the media UI script
			add_action( 'wp_enqueue_media', array( $this, 'wp_enqueue_media' ) );

		}

	}

	/**
	 * Add custom field to attachment fields
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $form_fields Attachment fields
	 * @param object $post Attachment post data
	 * @return array Attachment fields
	 */
	public function attachment_fields_to_edit( $form_fields, $post ) {

		if ( substr( $post->post_mime_type, 0, 5 ) === 'image' ) {

			$form_fields['mobx_video_url'] = array(
				'label' => __( 'Video URL', 'modulobox' ),
				'input' => 'text',
				'value' => esc_url( get_post_meta( $post->ID, '_mobx_video_url', true ) ),
				'helps' => esc_html__( 'Enter your video URL to display in MobuloBox.', 'modulobox')
			);

		}

		return $form_fields;

	}

	/**
	 * Save custom attachment field
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param object $post Attachment post data
	 * @param array $attachment Attachment fields
	 * @return object Attachment post data
	 */
	public function attachment_fields_to_save( $post, $attachment ) {

		if ( substr( $post['post_mime_type'], 0, 5 ) === 'image' ) {

			if ( isset( $attachment['mobx_video_url'] ) ) {
				update_post_meta( $post['ID'], '_mobx_video_url', esc_url_raw( $attachment['mobx_video_url'] ) );
			}

		}

		return $post;

	}

	/**
	 * Outputs a view template which can be used with wp.media.template
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function print_media_templates() {

		$styles = 'style="width:65px;float:left"';

		$field  = '<script type="text/html" id="tmpl-mobx-gallery-settings">';

			$field .= '<label class="setting">';
				$field .= '<span>' . esc_html__( 'Row Height', 'modulobox' ) . '</span>';
				$field .= '<input type="number" data-setting="mobx_row_height" value="220" min="10" max="1000" step="1" autocomplete="off" ' . $styles . '>';
			$field .= '</label>';

			$field .= '<label class="setting">';
				$field .= '<span>' . esc_html__( 'Item Spacing', 'modulobox' ) . '</span>';
				$field .= '<input type="number" data-setting="mobx_spacing" value="4" min="0" max="100" step="1" autocomplete="off" ' . $styles . '>';
			$field .= '</label>';

		$field .= '</script>';

		echo $field;

	}

	/**
	 * Enqueue script to handle custom view template with wp.media.template
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function wp_enqueue_media() {

		wp_register_script( MOBX_NAME . 'gallery-settings', MOBX_ADMIN_URL . 'assets/js/gallery.js', array( 'media-views' ), MOBX_VERSION );
		wp_enqueue_script( MOBX_NAME . 'gallery-settings' );

	}

}

new ModuloBox_Attachement;
