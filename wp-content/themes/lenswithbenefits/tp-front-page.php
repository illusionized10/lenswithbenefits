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
	<div class="owl-carousel owl-theme">

		<?php foreach($slider_posts as $item) { ?>

			<?php if(get_field('cc_slider_video_url', $item->ID)) { ?>
				<div class="item video" style="background-image:url('<?php echo get_field("cc_video_background_image", $item->ID); ?>');">
					<div class="content">
						<a href="<?php echo get_field('cc_slider_video_url', $item->ID); ?>" class="mobx">
							<i class="far fa-play-circle"></i>
						</a>
					</div>
					<div class="slide-text">
						<div class="title"><?php echo $item->post_title; ?></div>
						<div class="subtitle"><?php echo get_field('cc_slide_subtitle', $item->ID); ?></div> 
					</div>
				</div>
			<?php } else { ?>
				<div class="item image" style="">
					<div class="content">
						<div class="title"><?php echo $item->post_title; ?></div>
					</div>
				</div>
			<?php }  //endif ?> 

		<?php } //end foreach?>

	</div>
</div>

<div class="second-panel">
	<div class="wrapper">
		<div class="row">
			<div class="col-md-6">

				<div class="image-area">
					<img src="http://via.placeholder.com/660x805">
				</div>
				
			</div>
			<div class="col-md-6">

				<div class="content-area">
					<h2>Add an interesting title.</h2>
					<p>
						At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque.
					</p>
					<a class="custom-button" href="#">Learn More</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="service-panel">
	
</div>

<?php get_footer();