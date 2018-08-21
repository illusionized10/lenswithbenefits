<?php
/**
 * Template Name: Services Landing Page
 */

get_header(); ?>

<?php

$serviceArgs = array(
	'posts_per_page'   => -1,
	'post_type'        => 'cc_custom_services',
	'post_status'      => 'publish',
);

$customServices = get_posts( $serviceArgs );
$numberOfServices = count( $customServices );

// Going to need to loop through the services and output them individually

?>

<?php
get_footer();