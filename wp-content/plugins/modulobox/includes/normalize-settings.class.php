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
 * ModuloBox Normalize settings
 *
 * @class ModuloBox_Normalize_Settings
 * @version	1.0.0
 * @since 1.0.0
 */
class ModuloBox_Normalize_Settings {

	/**
	 * Options
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private $options = array();

	/**
	 * Accessibility
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private $accessibility = array(
		'closeLabel',
		'downloadLabel',
		'fullScreenLabel',
		'nextLabel',
		'prevLabel',
		'shareLabel',
		'playLabel',
		'zoomLabel'
	);

	/**
	 * Font styles options/selectors
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private $font_styles = array(
		'counterMessageFont' => '.mobx-holder .mobx-counter',
		'captionTitleFont'   => '.mobx-holder .mobx-title',
		'captionDescFont'    => '.mobx-holder .mobx-desc',
		'galleryCaptionFont' => '.mobx-gallery figure figcaption'
	);

	/**
	 * Main styles rules => options/selectors
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private $styles = array(
		'background-color'  => array(
			'overlayBackground'      => '.mobx-overlay',
			'topBarBackground'       => '.mobx-top-bar',
			'prevNextBackground'     => 'button.mobx-prev,button.mobx-next',
			'captionBackground'      => '.mobx-bottom-bar',
			'tooltipBackground'      => '.mobx-holder .mobx-share-tooltip'
		),
		'border-color'      => array(
			'thumbnailBorderColor'   => '.mobx-thumb:after',
			'tooltipBackground'      => '.mobx-holder .mobx-share-tooltip',
			'loaderBackground'       => '.mobx-holder .mobx-loader'
		),
		'border-left-color' => array(
			'loaderColor'            => '.mobx-holder .mobx-loader'	
		),
		'color'             => array(
			'controlsColor'          => '.mobx-top-bar *',
			'prevNextColor'          => '.mobx-prev *,.mobx-next *',
			'tooltipIconColor'       => '.mobx-holder .mobx-share-tooltip'
		),
		'opacity'           => array(
			'thumbnailOpacity'       => '.mobx-thumb-loaded',
			'thumbnailActiveOpacity' => '.mobx-active-thumb .mobx-thumb-loaded'
		),
		'height'            => array(
			'controlsSize'           => '.mobx-top-bar button',
			'timerSize'              => '.mobx-timer',
			'prevNextHeight'         => 'button.mobx-prev, button.mobx-next',
			'tooltipIconSize'        => '.mobx-share-tooltip button'
		),
		'width'             => array(
			'controlsSize'           => '.mobx-top-bar button',
			'timerSize'              => '.mobx-timer',
			'prevNextWidth'          => 'button.mobx-prev, button.mobx-next',
			'tooltipWidth'           => '.mobx-holder .mobx-share-tooltip',
			'tooltipIconSize'        => '.mobx-share-tooltip button'
		),
		'max-width'         => array(
			'captionMaxWidth'        => '.mobx-caption-inner'
		)
	);

	/**
	 * 3rd party gallery/grid to attach
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private $modules = array(
		'wp-image'             => 'a > img[class*="wp-image-"]',
		'wp-gallery'           => '.gallery-icon > a',
		'woo-gallery'          => '.woocommerce-product-gallery__image:not(.clone) a',
		'visual-composer'      => 'a.vc_single_image-wrapper, .vc_grid-item.vc_visible-item a.vc_gitem-link, .wpb_gallery li:not(.clone) a, .wpb_gallery .nivoSlider a, .vc_images_carousel a',
		'jetpack-gallery'      => '.tiled-gallery-item > a',
		'nextgen-gallery'      => '.ngg-gallery-thumbnail > a, .ngg-imagebrowser [id^="ngg-image"] a',
		'envira-gallery'       => 'a.envira-gallery-link',
		'justified-image-grid' => 'a.jig-link',
		'the-grid'             => 'a.tg-media-button',
		'essential-grid'       => '.esgbox'
	);

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
	 * Construct disabled
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct( $options = '' ) {

		// Merge options with default values
		$default = include( MOBX_INCLUDES_PATH . 'default.php' );
		$this->options = wp_parse_args( (array) $options, $default );

		self::set_attraction();
		self::set_friction();
		self::set_thumbnail_sizes();
		self::set_video_ratio();
		self::set_zoom_to();
		self::set_controls_size();		
		self::set_styles();
		self::set_gallery();
		self::set_font_styles();
		self::set_google_fonts();
		self::set_custom_css();
		self::set_accessibility();
		self::set_modules();
		self::escape_CSS_JS();

	}

	/**
	 * Return settings array
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array
	 */
	public function get_settings() {

		$data = array(
			'options'        => $this->options,
			'inlineCSS'      => $this->options['inlineCSS'],
			'customJSBefore' => $this->options['customJSBefore'],
			'customJSAfter'  => $this->options['customJSAfter'],
			'accessibility'  => $this->options['accessibility'],
			'mobileDevice'   => $this->options['mobileDevice'],
			'googleFonts'    => $this->options['googleFonts'],
			'gallery'        => $this->options['gallery'],
			'debugMode'      => $this->options['debugMode'],
			'modules'        => $this->options['modules']
		);

		// Unset unecessary options for ModuloBox instance (JS)
		foreach ( $data as $name => $options ) {
			unset( $data['options'][ $name ] );	
		}

		return $data;

	}

	/**
	 * Set attraction values
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function set_attraction() {

		$this->options['attraction'] = array(
			'slider' => floatval( $this->options['sliderAttraction'] ),
			'slide'  => floatval( $this->options['slideAttraction'] ),
    		'thumbs' => floatval( $this->options['thumbsAttraction'] ),
		);

		unset( $this->options['sliderAttraction'] );
		unset( $this->options['slideAttraction'] );
		unset( $this->options['thumbsAttraction'] );

	}

	/**
	 * Set friction values
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function set_friction() {

		$this->options['friction'] = array(
			'slider' => floatval( $this->options['sliderFriction'] ),
			'slide'  => floatval( $this->options['slideFriction'] ),
    		'thumbs' => floatval( $this->options['thumbsFriction'] )
		);

		unset( $this->options['sliderFriction'] );
		unset( $this->options['slideFriction'] );
		unset( $this->options['thumbsFriction'] );

	}

	/**
	 * Set thumbnail sizes
	 *
	 * @since 1.0.0
	 * @modified 1.0.5
	 * @access public
	 */
	public function set_thumbnail_sizes() {

		$sizes = $this->options['thumbnailSizes'];

		if ( is_array( $sizes ) && array_key_exists( 'browser', $sizes ) ) {

			$new_sizes = array();

			foreach( $sizes['browser'] as $index => $width ) {

				$new_sizes[ intval( $width ) ] = array(
					'width'  => intval( $sizes['width'][ $index ] ),
					'height' => intval( $sizes['height'][ $index ] ),
					'gutter' => intval( $sizes['gutter'][ $index ] )
				);

			}

			krsort( $new_sizes );
			$this->options['thumbnailSizes'] = $new_sizes;

		}

	}

	/**
	 * Set video aspect ratio
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function set_video_ratio() {

		$this->options['videoRatio'] = ModuloBox_Base::convert_to_decimal( $this->options['videoRatio'] );

	}

	/**
	 * Set zoom to value
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function set_zoom_to() {

		if ( $this->options['zoomTo'] !== 'auto' ) {
			$this->options['zoomTo'] = $this->options['zoomToValue'];
		}

		unset( $this->options['zoomToValue'] );

	}

	/**
	 * Set controls icons sizes
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function set_controls_size() {

		$this->options['timerSize']       = intval( $this->options['controlsSize'] ) - 16 + 24;
		$this->options['controlsSize']    = intval( $this->options['controlsSize'] ) - 16 + 40;
		$this->options['prevNextWidth']   = ( intval( $this->options['prevNextSize'] ) - 22 + 32 ) * 44/32;
		$this->options['prevNextHeight']  = intval( $this->options['prevNextSize'] ) - 22 + 32;
		$this->options['tooltipIconSize'] = intval( $this->options['tooltipIconSize'] ) - 16 + 40;

		unset( $this->options['prevNextSize'] );

	}

	/**
	 * Set main inline styles
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function set_styles() {

		$styles  = array();
		$opts   = array();
		$this->options['inlineCSS'] = null;

		foreach ( $this->styles as $property => $options ) {

			foreach ( $options as $option => $selector ) {

				if ( array_key_exists( $option, $this->options ) && ! empty( $this->options[ $option ] ) ) {

					$unit  = in_array( $property,  array( 'height', 'width', 'max-width' ) ) ? 'px' : null;
					$styles[ $selector ]  = array_key_exists( $selector, $styles ) ? $styles[ $selector ] : '';
					$styles[ $selector ] .= esc_attr( $property ) . ':' . esc_html( $this->options[ $option ] . $unit ) . ';';

				}

				array_push( $opts, $option );

			}

		}

		foreach ( $styles as $selector => $rules ) {

			$this->options['inlineCSS'] .= esc_attr( $selector ) . '{';
			$this->options['inlineCSS'] .= $rules;
			$this->options['inlineCSS'] .= '}';

		}

		foreach ( $opts as $option ) {
			unset( $this->options[ $option ] );
		}

	}

	/**
	 * Set gallery shortcode styles
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function set_gallery() {

		if ( ! $this->options['galleryShortcode'] ) {

			$this->options['galleryCaptionFont'] = '';

		} else {

			$background = $this->options['galleryCaptionOverlay'];
			$this->options['inlineCSS'] .= '.mobx-gallery figure figcaption{';
			$this->options['inlineCSS'] .= 'background: -webkit-gradient(linear, left top, left bottom, from(transparent), to(' . esc_attr( $background ) . '));';
    		$this->options['inlineCSS'] .= 'background: -webkit-linear-gradient(top, transparent 0%, ' . esc_attr( $background ) . ' 100%);';
    		$this->options['inlineCSS'] .= 'background: -moz-linear-gradient(top, transparent 0%, ' . esc_attr( $background ) . ' 100%);';
    		$this->options['inlineCSS'] .= 'background: linear-gradient(to bottom, transparent 0%, ' . esc_attr( $background ) . ' 100%);';
			$this->options['inlineCSS'] .= '}';

			$this->options['gallery'] = array(
				'caption'   => $this->options['galleryCaption'],
				'thumbnail' => $this->options['galleryThumbnailSize'],
				'rowHeight' => $this->options['galleryRowHeight'],
				'spacing'   => $this->options['gallerySpacing']
			);

			$this->options['mediaSelector'] .= ( empty( $this->options['mediaSelector'] ) ? '' : ', ' ) . '.mobx-gallery figure > a';

		}

		unset( $this->options['galleryShortcode'] );
		unset( $this->options['galleryThumbnailSize'] );
		unset( $this->options['galleryRowHeight'] );
		unset( $this->options['gallerySpacing'] );
		unset( $this->options['galleryCaption'] );
		unset( $this->options['galleryCaptionOverlay'] );

	}


	/**
	 * Set font styles
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function set_font_styles() {

		$media_queries = array();
		$this->options['googleFonts'] = array();

		foreach ( $this->font_styles as $element => $selector ) {

			if ( is_array( $this->options[ $element ] ) ) {

				$prev_prop = array();

				// Make device widths unique
				$widths = array_map( 'unserialize', array_unique( array_map( 'serialize', $this->options[ $element ] ) ) );

				foreach ( $widths as $width => $prop ) {

					// Remove duplicate prop from previous device width
					$prop_diff = array_diff_assoc( $prop, $prev_prop );
					// Unset invalid css property
					unset( $prop_diff['font-subset'] );
					// Store properties to make array_diff for next iteration
					$prev_prop = $prop;
					// Prepare css rules
					$rules = '';

					foreach ( $prop_diff as $rule => $value ) {

						if ( ! empty( $value ) ) {

							$unit   = $rule == 'font-size' || $rule == 'line-height' ? 'px' : null;
							$rules .= esc_attr( $rule ) . ':' . esc_html( $value . $unit ) . ';';

						}

					}

					if ( ! empty( $rules ) ) {

						if ( empty( $media_queries[ $width ] ) ) {
							$media_queries[ $width ] = '';
						}

						$media_queries[ $width ] .= esc_attr( $selector ) . '{' . $rules . '}';

					}

					// Store google fonts
					if ( array_key_exists( 'font-subset', $prop ) && ! empty( $prop['font-subset'] ) ) {

						$family = $prop['font-family'];
						$this->options['googleFonts'][ $family ]['variants'][] = $prop['font-weight'];
						$this->options['googleFonts'][ $family ]['subsets'][]  = $prop['font-subset'];

					}

				}

			}

			unset( $this->options[ $element ] );

		}

		foreach ( $media_queries as $width => $selectors ) {

			// Filter to change media query max width
			$width = apply_filters( MOBX_NAME . '_media_query_max_width', $width );

			$this->options['inlineCSS'] .= $width > 0 ? '@media only screen and (max-width: ' . esc_attr( $width ) . 'px){' : null;
			$this->options['inlineCSS'] .= $selectors;
			$this->options['inlineCSS'] .= $width > 0 ? '}' : null;

		}

	}

	/**
	 * Set google fonts
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function set_google_fonts() {
		
		$this->options['googleFonts'] = ! empty( $this->options['googleFonts'] ) ? esc_url_raw( ModuloBox_Base::google_fonts( $this->options['googleFonts'] ) ) : null;

	}

	/**
	 * Set custom CSS
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function set_custom_css() {

		if ( array_key_exists( 'minified', $this->options['customCSS'] ) ) {

			$minify  = $this->options['minifyCSS'];
			$css     = ! empty ( $this->options['customCSS']['minified'] ) && $minify ? $this->options['customCSS']['minified'] : $this->options['customCSS']['original'];
			$this->options['inlineCSS'] .= !empty( $css ) ? "\n" . '/*** Custom CSS ***/' . "\n" . $css : '';

		}

		unset( $this->options['customCSS'] );
		unset( $this->options['minifyCSS'] );

	}

	/**
	 * Set accessibility labels
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function set_accessibility() {

		$this->options['accessibility'] = array();

		foreach ( $this->accessibility as $label ) {

			$this->options['accessibility'][ $label ] = esc_html( $this->options[ $label ] );
			unset( $this->options[ $label ] );

		}

		$this->options['accessibility']['title'] = $this->options['buttonsTitle'];
		unset( $this->options['buttonsTitle'] );

	}

	/**
	 * Escape custom CSS and JS
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function escape_CSS_JS() {

		$customJS = array(
			'customJSBefore',
			'customJSAfter'
		);

		// Only generate custom JS on front end
		if ( ! is_admin() ) {

			foreach ( $customJS as $js ) {

				if ( empty( $this->options[ $js ]['error'] ) ) {

					$minify  = $this->options['minifyJS'];
					$content = ! empty ( $this->options[ $js ]['minified'] ) && $minify ? $this->options[ $js ]['minified'] : $this->options[ $js ]['original'];
					$this->options[ $js ] = html_entity_decode( wp_kses_decode_entities( $content ) );

				} else {
					$this->options[ $js ] = '';
				}

			} 

		} else {

			$this->options['customJSBefore'] = esc_html( $this->options['customJSBefore']['error'] );
			$this->options['customJSAfter']  = esc_html( $this->options['customJSAfter']['error'] );

		}

		unset( $this->options['minifyJS'] );

		$this->options['inlineCSS'] = wp_strip_all_tags( $this->options['inlineCSS'] );

	}

	/**
	 * Handle galleries
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function set_modules() {

		$this->options['modules'] = array( 'svg-icons' );

		// set default modules
		if ( ! empty( $this->options['googleFonts'] ) ) {
			array_push( $this->options['modules'], 'google-fonts' );
		}

		foreach ( $this->modules as $module => $selector ) {

			if ( $module === 'the-grid' ) {
				$this->options[ $module ] = get_option( 'the_grid_lightbox', 'the_grid' ) === 'modulobox' ? 1 : 0;
			}

			if ( $this->options[ $module ] ) {

				$this->options['mediaSelector'] .= empty( $this->options['mediaSelector'] ) ? $selector : ', ' . $selector;
				array_push( $this->options['modules'], $module );

			}

			unset( $this->options[ $module ] );

		}

	}

}
