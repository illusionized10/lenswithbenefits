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

		<?php } //end foreach ?>

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
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/left-homepage-image.png" alt="Portrait">
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
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/family-image.jpg" />
					<svg viewBox="0 0 180 320" preserveAspectRatio="none"><path d="M 0 0 L 0 182 L 90 126.5 L 180 182 L 180 0 L 0 0 z "/></svg>
					<figcaption>
						<h5>Family & Siblings</h5>
						<p></p>
						<button>View</button>
					</figcaption>
				</figure>
			</a>
			<a href="#" data-path-hover="M 0,0 0,38 90,58 180.5,38 180,0 z">
				<figure>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/pet-photography.jpg" />
					<svg viewBox="0 0 180 320" preserveAspectRatio="none"><path d="M 0 0 L 0 182 L 90 126.5 L 180 182 L 180 0 L 0 0 z "/></svg>
					<figcaption>
						<h5>Animals &amp; Pets</h5>
						<p></p>
						<button>View</button>
					</figcaption>
				</figure>
			</a>
			<a href="#" data-path-hover="M 0,0 0,38 90,58 180.5,38 180,0 z">
				<figure>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/wedding-photography.jpg" />
					<svg viewBox="0 0 180 320" preserveAspectRatio="none"><path d="M 0 0 L 0 182 L 90 126.5 L 180 182 L 180 0 L 0 0 z "/></svg>
					<figcaption>
						<h5>Events <br>&amp; Weddings</h5>
						<p></p>
						<button>View</button>
					</figcaption>
				</figure>
			</a>
			<a href="#" data-path-hover="M 0,0 0,38 90,58 180.5,38 180,0 z">
				<figure>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/portrait-photography.jpg" />
					<svg viewBox="0 0 180 320" preserveAspectRatio="none"><path d="M 0 0 L 0 182 L 90 126.5 L 180 182 L 180 0 L 0 0 z "/></svg>
					<figcaption>
						<h5>Portraits</h5>
						<p></p>
						<button>View</button>
					</figcaption>
				</figure>
			</a>
			<a href="#" data-path-hover="M 0,0 0,38 90,58 180.5,38 180,0 z">
				<figure>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/boudoir-photography.jpg" />
					<svg viewBox="0 0 180 320" preserveAspectRatio="none"><path d="M 0 0 L 0 182 L 90 126.5 L 180 182 L 180 0 L 0 0 z "/></svg>
					<figcaption>
						<h5>Boudoir</h5>
						<p></p>
						<button>View</button>
					</figcaption>
				</figure>
			</a>
			<a href="#" data-path-hover="M 0,0 0,38 90,58 180.5,38 180,0 z">
				<figure>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/automotive-photography.jpg" />
					<svg viewBox="0 0 180 320" preserveAspectRatio="none"><path d="M 0 0 L 0 182 L 90 126.5 L 180 182 L 180 0 L 0 0 z "/></svg>
					<figcaption>
						<h5>Automotive &amp; Sports</h5>
						<p></p>
						<button>View</button>
					</figcaption>
				</figure>
			</a>
			<a href="#" data-path-hover="M 0,0 0,38 90,58 180.5,38 180,0 z">
				<figure>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/landscape-photography.jpg" />
					<svg viewBox="0 0 180 320" preserveAspectRatio="none"><path d="M 0 0 L 0 182 L 90 126.5 L 180 182 L 180 0 L 0 0 z "/></svg>
					<figcaption>
						<h5>Landscape</h5>
						<p></p>
						<button>View</button>
					</figcaption>
				</figure>
			</a>
			<a href="#" data-path-hover="M 0,0 0,38 90,58 180.5,38 180,0 z">
				<figure>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/urban-photography.jpg" />
					<svg viewBox="0 0 180 320" preserveAspectRatio="none"><path d="M 0 0 L 0 182 L 90 126.5 L 180 182 L 180 0 L 0 0 z "/></svg>
					<figcaption>
						<h5>Urban &amp; Street</h5>
						<p></p>
						<button>View</button>
					</figcaption>
				</figure>
			</a>
		</section>
	</div>
</div>

<div class="promo-panel">
	<div class="wrapper">
		<div class="promo-title"><h2>Join Our Newsletter</h2></div>
		<div class="promo-text">
			<p>
				Signup to our newsletter and receive a 20% discount on any session!<br>
				We also send out seasonal deals, be sure to check your inbox!
			</p>
		</div>
		<div class="promo-fields">
			<div class="subscribe">

				<div id="mc_embed_signup">
                    <form id="mc-form" class="group" novalidate="true">
                        <input type="email" value="" name="EMAIL" class="email" id="mc-email" placeholder="Email Address" required="">
                        <input type="submit" name="subscribe" value="SIGNUP">
                        <label for="mc-email" class="subscribe-message"></label>
                    </form>
				</div>			

            </div>
		</div>
	</div>
</div>

<div class="contact-us-panel">
	<div class="wrapper">
		<div class="contact-panel">
			<img class="left-lamp" src="<?php echo get_template_directory_uri(); ?>/assets/images/left-lamp.png">
			<img class="right-lamp" src="<?php echo get_template_directory_uri(); ?>/assets/images/right-lamp.png">
			<h3>Interested? Let's Chat!</h3>
			<p>We are looking forward to hearing from you! If you have anything specific in mind, feel free to ask us using the form below:</p>
			<div class="contact-form">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<label>Name: </label>
						<input type="text">
					</div>
					<div class="col-md-6 col-sm-12">
						<label>Email: </label>
						<input type="text">
					</div>
					<div class="col-md-6 col-sm-12">
						<label>Phone Number</label>
						<input type="text">
					</div>
					<div class="col-md-6 col-sm-12">
						<label>Subject</label>
						<input type="text">
					</div>
					<div class="col-md-12">
						<label>How Can We Help?</label>
						<textarea></textarea>
					</div>
					<div class="col-12">
						<div class="submit-area">
							<button class="custom-button-new">SAY HELLO</button>
						</div>
					</div>
				</div>
			</div>
			<img class="left-floor-lamp" src="<?php echo get_template_directory_uri(); ?>/assets/images/floor-lamp-left.png">
			<img class="right-floor-lamp" src="<?php echo get_template_directory_uri(); ?>/assets/images/floor-lamp-right.png">
		</div>
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