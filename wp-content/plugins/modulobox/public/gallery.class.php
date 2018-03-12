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
 * ModuloBox Gallery
 *
 * @class ModuloBox_Gallery
 * @version	1.0.0
 * @since 1.0.0
 */
class ModuloBox_Gallery {

	/**
	 * Gallery instance
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private $instance = 0;

	/**
	 * Options
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private $options = array();

	/**
	 * Post ID
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private $post_id;

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
	 * Initialization disabled
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {		
	}

	/**
	 * Load Gallery
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $options Options
	 */
	public function load( $options = array() ) {

		$this->options = $options;

		// remove native WordPress Gallery Shortcode
		remove_shortcode( 'gallery', 'gallery_shortcode' );
		// add custom Gallery Shortcode
		add_shortcode( 'gallery', array( $this, 'gallery_shortcode' ) );

	}

	/**
	 * Get current post ID
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_post_id() {

		if ( empty( $this->post_id ) ) {

			$post = get_post();
			$this->post_id = $post ? $post->ID : 0;
	
		}

	}

	/**
	 * Generate custom Gallery shortcode output
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $attr Shortcode attributes
	 * @return string Gallery output
	 */
	public function gallery_shortcode( $attr = array() ) {

		$this->instance++;
		$this->get_post_id();

		$attr  = $this->get_attributes( $attr );
		$posts = $this->get_posts( $attr );

		if ( ! empty( $posts ) ) {

			$output  = $this->gallery_start( $attr );
			$output .= $this->loop( $posts, $attr );
			$output .= $this->gallery_end();

			$this->enqueue_script();

			return $output;

		}

	}

	/**
	 * Normalize gallery shortcode attributes
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $attr Shortcode attributes
	 * @return array Normalized shortcode attributes
	 */
	public function get_attributes( $attr ) {

		if ( ! empty( $attr['ids'] ) ) {

			$attr['orderby'] = empty( $attr['orderby'] ) ? 'post__in' : $attr['orderby'];
			$attr['include'] = $attr['ids'];

		}

		$attr = shortcode_atts( array(
			'order'           => 'ASC',
			'orderby'         => 'menu_order ID',
			'id'              => $this->post_id,
			'size'            => 'thumbnail',
			'include'         => '',
			'exclude'         => '',
			'link'            => '',
			'mobx_row_height' => $this->options['gallery']['rowHeight'],
			'mobx_spacing'    => $this->options['gallery']['spacing']
		), $attr, 'gallery' );

		$attr['mobx_row_height'] = max( min( intval( $attr['mobx_row_height'] ), 1000 ), 10 );
		$attr['mobx_spacing']    = max( min( intval( $attr['mobx_spacing'] ), 100 ), 0 );

		return $attr;

	}

	/**
	 * Get gallery posts attributes
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $attr Shortcode attributes
	 * @return array Array of posts
	 */
	public function get_posts( $attr ) {

		$args = array(
			'exclude'        => ! empty( $attr['exclude'] ) ? $attr['exclude'] : '',
			'include'        => ! empty( $attr['include'] ) ? $attr['include'] : '',
			'post_parent'    => empty( $attr['include'] ) ? intval( $attr['id'] ) : '',
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => $attr['order'],
			'orderby'        => $attr['orderby']
		);

		return ! empty( $attr['include'] ) ? get_posts( $args ) : get_children( $args );

	}

	/**
	 * Output gallery wrapper start
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $attr Shortcode attributes
	 * @return string Gallery wrapper start
	 */
	public function gallery_start( $attr ) {

		$settings = array(
			'rowHeight' => $attr['mobx_row_height'],
			'spacing'   => $attr['mobx_spacing']
		);

		$output  = '<!-- ModuloBox Gallery v' . esc_html( MOBX_VERSION ) . ' -->';
		$output .= '<div class="mobx-gallery" id="' . esc_attr( 'gallery-' . $this->instance ) . '" data-settings="' . esc_attr( wp_json_encode( $settings ) ) . '"  itemscope itemtype="http://schema.org/ImageGallery">';
		return $output;

	}

	/**
	 * Output gallery wrapper end
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Gallery wrapper end
	 */
	public function gallery_end() {

		return '</div>';

	}

	/**
	 * Loop through each attachment post
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $posts Array of posts
	 * @param array $attr Shortcode attributes
	 * @return string Gallery items
	 */
	public function loop( $posts, $attr ) {

		$output = '';

		foreach ( $posts as $id => $post ) {
			$output .= $this->build_item( $post, $attr );
		}

		return $output;

	}

	/**
	 * Get attachment item markup
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param object $post Post attributes
	 * @param array $attr Shortcode attributes
	 * @return string Attachment
	 */
	public function build_item( $post, $attr ) {

		$caption   = $this->get_caption( $post );
		$video_url = $this->get_video_src( $post, $attr );
		$img_url   = $this->get_image_src( $post, $attr );
		$thumb_url = $this->get_thumbnail_src( $post );

		$output = '<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" style="height:' . esc_attr( $attr['mobx_row_height'] ) . 'px">';
		
			$output .= apply_filters( MOBX_NAME . '_gallery_before_item_content', '', $post, $attr );

			if ( $attr['link'] !== 'none' ) {

				$link_attr = apply_filters( MOBX_NAME . '_gallery_link_attributes', array(
					'href'        => esc_url( empty( $video_url ) ? $this->get_image_src( $post, $attr ) : $video_url ),
					'itemprop'    => 'contentUrl',
					'data-desc'   => esc_attr( wptexturize( wp_kses_post( $post->post_content ) ) ),
					'data-title'  => esc_attr( wptexturize( wp_kses_post( $post->post_title ) ) ),
					'data-thumb'  => esc_url( $thumb_url ),
					'data-poster' => esc_url( $img_url )
				), $post, $attr );

				$output .= '<a ';

				foreach ( $link_attr as $name => $value ) {
            		$output .= ' ' . $name . '="' . $value . '"';
        		}

				$output .= '>';

			}

			$img_attr = array( 'itemprop' => 'thumbnail' );

			if ( $caption ) {
				$img_attr['aria-describedby'] = $caption ? 'gallery-' . esc_attr( $this->instance ) . '-' . esc_attr( $post->ID ) : '';
			}

			$output .= wp_get_attachment_image( $post->ID, $attr['size'], false, $img_attr );

			if ( $video_url ) {
				$output .= $this->get_video_icon();
			}
		
			$output .= $attr['link'] !== 'none' ? '</a>' : null;
		
			if ( ! empty( $caption ) ) {

				$class   = ! $this->options['gallery']['caption'] ? ' class="hide"' : null;
				$output .= '<figcaption itemprop="caption description"' . $class . ' id="' . esc_attr( $img_attr['aria-describedby'] ) . '">';
					$output .=  wptexturize( wp_kses_post( $caption ) );
				$output .= '</figcaption>';

			}
		
			$output .= apply_filters( MOBX_NAME . '_gallery_after_item_content', '', $post, $attr );

		$output .= '</figure>';

		return $output;

	}

	/**
	 * Get attachment thumbnail src
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param object $post Post attributes
	 * @return string Thumnbail URL
	 */
	public function get_thumbnail_src( $post ) {

		$size = $this->options['gallery']['thumbnail'];
		$url  = wp_get_attachment_image_src( $post->ID, $size );
		$url  = $url ? $url : array();
		$url  = reset( $url );
		return $url;

	}

	/**
	 * Get attachment URL
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param object $post Post attributes
	 * @param array $attr Shortcode attributes 
	 * @return string Attachment URL
	 */
	public function get_image_src( $post, $attr ) {

		if ( $attr['link'] === 'file' ) {

			$url = wp_get_attachment_image_src( $post->ID, 'full' );
			$url = $url ? $url : array();
			$url = reset( $url );

		} else {
			$url = get_attachment_link( $post->ID );
		}

		return $url;

	}

	/**
	 * Get attachment video URL
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param object $post Post attributes
	 * @return string Video URL
	 */
	public function get_video_src( $post, $attr ) {

		return $attr['link'] === 'file' ? get_post_meta( $post->ID, '_mobx_video_url', true ) : null;

	}

	/**
	 * Get video SVG icon
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Video SVG icon
	 */
	public function get_video_icon() {

		$output = '<span class="mobx-gallery-play">';
			$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="100%" height="100%">';
				$output .= '<circle stroke="#fff" fill="none" cx="20" cy="20" r="18" stroke-width="1.5"></circle>';
				$output .= '<path fill="#fff" d="m25.633852 19.05441l-8-5c-0.309-0.194-0.697-0.203-1.015-0.027 -0.318 0.177-0.515 0.511-0.515 0.875l0 10c0 0.364 0.197 0.698 0.515 0.875 0.152 0.083 0.318 0.125 0.485 0.125 0.184 0 0.368-0.051 0.53-0.152l8-5c0.292-0.183 0.47-0.503 0.47-0.848s-0.178-0.665-0.47-0.848z"/>';
			$output .= '</svg>';
		$output .= '</span>';

		return apply_filters( MOBX_NAME . '_gallery_video_icon', $output );

	}

	/**
	 * Get attachment excerpt
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param object $post Post attributes
	 * @return string Post excerpt
	 */
	public function get_caption( $post ) {

		return trim( $post->post_excerpt );

	}

	/**
	 * Enqueue gallery shortcode script
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function enqueue_script() {

		$minified = ! $this->options['debugMode'] ? '.min' : '';
		wp_enqueue_script( MOBX_NAME . '-gallery', MOBX_PUBLIC_URL . 'assets/js/gallery' . $minified . '.js', array(), MOBX_VERSION, true );

	}

}
