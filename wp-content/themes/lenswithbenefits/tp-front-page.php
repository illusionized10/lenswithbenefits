<?php
/**
 * Template Name: Custom Homepage Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lenswithbenefits
 */

get_header(); ?>

<?php
	// Page Getters/Setters
	$sliderPostArgs = array(
		'posts_per_page'   => 5,
		'order'            => 'ASC',
		'post_type'        => 'cc_custom_slider',
	);
	$slider_posts = get_posts( $sliderPostArgs );
?>

<div class="introduction-slider">
	<div class="owl-carousel">
		<?php foreach($slider_posts as $item) { ?>

			<?php if(get_field('cc_slider_video_url', $item->ID)) { ?>
				<div class="item video">
					<div class="content">
						<a href="<?php echo get_field('cc_slider_video_url', $item->ID); ?>" class="mobx"><i class="fa fa-play"></i><span><?php echo $item->post_title; ?></span></a>
					</div>
				</div>
			<?php } else { ?>
				<div class="item image">
					<div class="content">
						<div class="title"><?php echo $item->post_title; ?></div>
					</div>
				</div>
			<?php }  //endif ?> 

		<?php } //end foreach?>
	</div>
</div>

<?php get_footer();