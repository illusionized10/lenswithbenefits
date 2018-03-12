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

if ( ! class_exists( 'ModuloBox_Code_Field' ) ) {

	class ModuloBox_Code_Field extends ModuloBox_Settings_field {

		/**
		 * Render HTML field
		 *
		 * @since 1.0.0
		 * @access static
		 *
		 * @param array $args Contains all field parameters
		 */
		static function render( $args ) {

			echo $args['desc'];
			echo $args['premium'];

			if ( $args['mode'] === 'javascript' ) {
				$content = html_entity_decode( wp_kses_decode_entities( $args['value']['original'] ) );
			} else {
				$content = wp_strip_all_tags( $args['value']['original'] );
			}

			$error = $args['value']['error'];
			echo '<span class="mobx-code-error" data-field="' . esc_attr( $args['ID'] )  . '">' . ( ! empty( $error ) ? htmlspecialchars_decode( esc_html( $error ) ) : null ) . '</span>';

			echo '<textarea rows="20" cols="50" class="mobx-code" id="' . esc_attr( $args['ID'] )  . '" name="' . esc_attr( $args['name'] )  . '" data-mode="' . esc_attr( $args['mode'] )  . '">' . esc_textarea( $content ) . '</textarea>';

		}

		/**
		 * Enqueue scripts and styles
		 *
		 * @since 1.0.0
		 * @access static
		 */
		static function scripts() {

			wp_enqueue_script( MOBX_SLUG . '-code-script', MOBX_ADMIN_URL . 'assets/js/codemirror.js', array( 'jquery' ), MOBX_VERSION, true);
    		wp_enqueue_style( MOBX_SLUG . '-code-style', MOBX_ADMIN_URL . 'assets/css/codemirror.css', array(), MOBX_VERSION );
	
		}

		/**
		 * Normalize field parameters
		 *
		 * @since 1.0.0
		 * @access static
		 *
		 * @param array $field
		 * @return array
		 */
		static function normalize( $field ) {

			$default = array(
				'mode' => 'css'
			);

			$std_props = array(
				'original' => '',
				'minified' => '',
				'error'    => ''
			);

			$field['default'] = isset( $field['default'] ) ? wp_parse_args( $field['default'], $std_props ) : $std_props;
			$field['value']   = isset( $field['value'] ) ? wp_parse_args( $field['value'], $std_props ) : $std_props;

			return wp_parse_args( $field, $default );

		}

		/**
		 * Sanitize field value
		 * JS: Source => Custom JavaScript Editor by Automattic
		 * CSS: Source => Jetpack by Automattic
		 *
		 * @since 1.0.0
		 * @access static
		 *
		 * @param mixed $val
		 * @param array $args
		 * @return string
		 */
		static function sanitize( $val, $args ) {

			if ( is_array( $val ) ) {
				return $args['default'];
			}

			// If imported value
			if ( is_object( $val ) && property_exists( $val, 'original' ) ) {
				$val = $val->original;
			}

			// Because of data serialization for the ajax request
			if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
				// Un-quotes quoted strings
				$val = wp_unslash( $val );
			}

			if ( $args['mode'] === 'javascript' ) {

				$minify = ! empty( $val ) ? ModuloBox_Base::compress_JS( $val ) : '';

				// The $val variable is explicitly not sanitized, as Javascript is allowed 
				// and other HTML elements could be constructed piece by piece even if filtered
				return array(
					'original' => esc_html( $val ),
					'minified' => $minify ? esc_html( $minify['script'] ) : '',
					'error'    => $minify ? esc_html( $minify['error'] ) : ''
				);

			} else {

				if ( ! class_exists( 'csstidy' ) ) {
					require_once( MOBX_INCLUDES_PATH . 'csstidy/class.csstidy.php' );
				}

				$csstidy = new csstidy();
				$csstidy->set_cfg( 'remove_bslash', false );
				$csstidy->set_cfg( 'compress_colors', false );
				$csstidy->set_cfg( 'compress_font-weight', false );
				$csstidy->set_cfg( 'optimise_shorthands', 0 );
				$csstidy->set_cfg( 'remove_last_;', false );
				$csstidy->set_cfg( 'case_properties', false );
				$csstidy->set_cfg( 'discard_invalid_properties', true );
				$csstidy->set_cfg( 'css_level', 'CSS3.0' );
				$csstidy->set_cfg( 'preserve_css', true );
				$csstidy->set_cfg( 'template', MOBX_INCLUDES_PATH . 'csstidy/wordpress-standard.tpl' );

				$val = preg_replace( '/\\\\([0-9a-fA-F]{4})/', '\\\\\\\\$1', $val );
				// prevent content: '\3434' from turning into '\\3434'.
				$val = str_replace( array( '\'\\\\', '"\\\\' ), array( '\'\\', '"\\' ), $val );
				// Some people put weird stuff in their CSS, KSES tends to be greedy
				$val = str_replace( '<=', '&lt;=', $val );
				// Why KSES instead of strip_tags?  Who knows?
				$val = wp_kses_split( $val, array(), array() );
				// kses replaces lone '>' with &gt;
				$val = str_replace( '&gt;', '>', $val );
				// Why both KSES and strip_tags? Because we just added some '>'.
				$val = strip_tags( $val );

				$csstidy->parse( $val );

				return array(
					'original' => $csstidy->print->plain(),
					'minified' => ModuloBox_Base::compress_CSS( $val ),
					'error'    => ''
				);

			}

		}

	}

}
