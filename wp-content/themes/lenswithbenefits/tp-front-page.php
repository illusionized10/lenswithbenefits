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

				<div class="title">
					<div class="main">
						<h3>Welcome to</h3>
					</div>
					<div class="sub">
						<h2>Lens With Benefits</h2>
					</div>
				</div>
				<div class="image-area"> 
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/left-homepage-image.jpg" alt="Portrait">
					<div class="overlay-square"></div>
				</div>
				
			</div>
			<div class="col-md-6">

				<div class="content-area">
					<h2>Add an interesting title.</h2>
					<p>
						At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque.
					</p>
					<div class="button-area">
						<a class="custom-button-new" href="#">Learn More</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="service-panel">
	<div class="wrapper">
		<div class="title-area">
			<h2>Services Heading Here</h2>
			<h4>- Click to see more information -</h4>
		</div>
	</div>
	<div class="demo-3" id="demo-3">
		<section id="grid" class="grid clearfix">
			<a href="#" data-path-hover="M 0,0 0,38 90,58 180.5,38 180,0 z">
				<figure>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/1.png" />
					<svg viewBox="0 0 180 320" preserveAspectRatio="none"><path d="M 0 0 L 0 182 L 90 126.5 L 180 182 L 180 0 L 0 0 z "/></svg>
					<figcaption>
						<h5>Crystalline</h5>
						<p>Soko radicchio bunya nuts gram dulse.</p>
						<button>View</button>
					</figcaption>
				</figure>
			</a>
			<a href="#" data-path-hover="M 0,0 0,38 90,58 180.5,38 180,0 z">
				<figure>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/2.png" />
					<svg viewBox="0 0 180 320" preserveAspectRatio="none"><path d="M 0 0 L 0 182 L 90 126.5 L 180 182 L 180 0 L 0 0 z "/></svg>
					<figcaption>
						<h5>Cacophony</h5>
						<p>Two greens tigernut soybean radish.</p>
						<button>View</button>
					</figcaption>
				</figure>
			</a>
			<a href="#" data-path-hover="M 0,0 0,38 90,58 180.5,38 180,0 z">
				<figure>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/3.png" />
					<svg viewBox="0 0 180 320" preserveAspectRatio="none"><path d="M 0 0 L 0 182 L 90 126.5 L 180 182 L 180 0 L 0 0 z "/></svg>
					<figcaption>
						<h5>Languid</h5>
						<p>Beetroot water spinach okra water.</p>
						<button>View</button>
					</figcaption>
				</figure>
			</a>
			<a href="#" data-path-hover="M 0,0 0,38 90,58 180.5,38 180,0 z">
				<figure>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/4.png" />
					<svg viewBox="0 0 180 320" preserveAspectRatio="none"><path d="M 0 0 L 0 182 L 90 126.5 L 180 182 L 180 0 L 0 0 z "/></svg>
					<figcaption>
						<h5>Serene</h5>
						<p>Water spinach arugula pea tatsoi.</p>
						<button>View</button>
					</figcaption>
				</figure>
			</a>
			<a href="#" data-path-hover="M 0,0 0,38 90,58 180.5,38 180,0 z">
				<figure>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/5.png" />
					<svg viewBox="0 0 180 320" preserveAspectRatio="none"><path d="M 0 0 L 0 182 L 90 126.5 L 180 182 L 180 0 L 0 0 z "/></svg>
					<figcaption>
						<h5>Nebulous</h5>
						<p>Pea horseradish azuki bean lettuce.</p>
						<button>View</button>
					</figcaption>
				</figure>
			</a>
			<a href="#" data-path-hover="M 0,0 0,38 90,58 180.5,38 180,0 z">
				<figure>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/6.png" />
					<svg viewBox="0 0 180 320" preserveAspectRatio="none"><path d="M 0 0 L 0 182 L 90 126.5 L 180 182 L 180 0 L 0 0 z "/></svg>
					<figcaption>
						<h5>Iridescent</h5>
						<p>A grape silver beet watercress potato.</p>
						<button>View</button>
					</figcaption>
				</figure>
			</a>
			<a href="#" data-path-hover="M 0,0 0,38 90,58 180.5,38 180,0 z">
				<figure>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/7.png" />
					<svg viewBox="0 0 180 320" preserveAspectRatio="none"><path d="M 0 0 L 0 182 L 90 126.5 L 180 182 L 180 0 L 0 0 z "/></svg>
					<figcaption>
						<h5>Resonant</h5>
						<p>Chickweed okra pea winter purslane.</p>
						<button>View</button>
					</figcaption>
				</figure>
			</a>
			<a href="#" data-path-hover="M 0,0 0,38 90,58 180.5,38 180,0 z">
				<figure>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/8.png" />
					<svg viewBox="0 0 180 320" preserveAspectRatio="none"><path d="M 0 0 L 0 182 L 90 126.5 L 180 182 L 180 0 L 0 0 z "/></svg>
					<figcaption>
						<h5>Zenith</h5>
						<p>Salsify taro catsear garlic gram.</p>
						<button>View</button>
					</figcaption>
				</figure>
			</a>
		</section>
	</div>
</div>

<script type="text/javascript">
	(function() {
		function init() {
			var speed = 300,
				easing = mina.backout;
			[].slice.call ( document.querySelectorAll( '#grid > a' ) ).forEach( function( el ) {
				var s = Snap( el.querySelector( 'svg' ) ), path = s.select( 'path' ),
					pathConfig = {
						from : path.attr( 'd' ),
						to : el.getAttribute( 'data-path-hover' )
					};

				el.addEventListener( 'mouseenter', function() {
					path.animate( { 'path' : pathConfig.to }, speed, easing );
				} );

				el.addEventListener( 'mouseleave', function() {
					path.animate( { 'path' : pathConfig.from }, speed, easing );
				} );
			} );
		}
		init();
	})();
</script>

<?php get_footer();