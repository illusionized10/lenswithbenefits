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
	'order'            => 'DESC',
	'post_type'        => 'post',
	'post_status'      => 'publish',
);

$slider_posts = get_posts( $args );

?>

SEXY NEW HOMEPAGEEEEEE BAYEEE BAYEEE

<?php get_footer();