<?php
/**
 * Template Name: Services Landing Page
 */

get_header(); ?>

<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/normalize.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/base.css" />
<!-- Modern Browser Script -->
<script>document.documentElement.className="js";var supportsCssVars=function(){var e,t=document.createElement("style");return t.innerHTML="root: { --tmp-var: bold; }",document.head.appendChild(t),e=!!(window.CSS&&window.CSS.supports&&window.CSS.supports("font-weight","var(--tmp-var)")),t.parentNode.removeChild(t),e};supportsCssVars()||alert("Please view this demo in a modern browser that supports CSS Variables.");</script>

<?php

$serviceArgs = array(
	'posts_per_page'   => -1,
	'post_type'        => 'cc_custom_services',
	'post_status'      => 'publish',
);

$customServices = get_posts( $serviceArgs );
?>

<svg class="hidden">
	<symbol id="icon-arrow" viewBox="0 0 24 24">
		<title>arrow</title>
		<polygon points="6.3,12.8 20.9,12.8 20.9,11.2 6.3,11.2 10.2,7.2 9,6 3.1,12 9,18 10.2,16.8 "/>
	</symbol>
	<symbol id="icon-drop" viewBox="0 0 24 24">
		<title>drop</title>
		<path d="M12,21c-3.6,0-6.6-3-6.6-6.6C5.4,11,10.8,4,11.4,3.2C11.6,3.1,11.8,3,12,3s0.4,0.1,0.6,0.3c0.6,0.8,6.1,7.8,6.1,11.2C18.6,18.1,15.6,21,12,21zM12,4.8c-1.8,2.4-5.2,7.4-5.2,9.6c0,2.9,2.3,5.2,5.2,5.2s5.2-2.3,5.2-5.2C17.2,12.2,13.8,7.3,12,4.8z"/><path d="M12,18.2c-0.4,0-0.7-0.3-0.7-0.7s0.3-0.7,0.7-0.7c1.3,0,2.4-1.1,2.4-2.4c0-0.4,0.3-0.7,0.7-0.7c0.4,0,0.7,0.3,0.7,0.7C15.8,16.5,14.1,18.2,12,18.2z"/>
	</symbol>
	<symbol id="icon-menu" viewBox="0 0 24 13">
		<title>menu</title>
		<path d="M.75 1.515h22.498a.75.75 0 0 0 0-1.5H.75a.75.75 0 0 0 0 1.5zM23.248 5.265H8.168a.75.75 0 0 0 0 1.5h15.08a.75.75 0 0 0 0-1.5zM23.248 10.514H4.322a.75.75 0 0 0 0 1.5h18.926a.75.75 0 0 0 0-1.5z"/>
	</symbol>
	<symbol id="icon-dot" viewBox="0 0 24 24">
		<title>dot</title>
		<path d="M11.5 9c-.69 0-1.28.244-1.768.732A2.41 2.41 0 0 0 9 11.5c0 .69.244 1.28.732 1.767A2.409 2.409 0 0 0 11.5 14c.69 0 1.28-.244 1.768-.733A2.408 2.408 0 0 0 14 11.5c0-.69-.244-1.28-.732-1.768A2.408 2.408 0 0 0 11.5 9z"/>
	</symbol>
	<symbol id="icon-cross" viewBox="0 0 24 24">
		<title>cross</title>
		<path d="M11.449 11.962l-5.1 5.099a.363.363 0 1 0 .513.512L12 12.436l5.137 5.137a.361.361 0 0 0 .513 0 .363.363 0 0 0 0-.512l-5.099-5.1 5.102-5.102a.363.363 0 1 0-.512-.513L12 11.487l-5.141-5.14a.363.363 0 0 0-.513.512l5.103 5.103z"/>
	</symbol>
	<symbol id="icon-arrowlong" viewBox="0 0 32 11">
		<title>arrow-long</title>
		<path d="M27.166.183a.619.619 0 0 0-.878 0 .619.619 0 0 0 0 .878l2.735 2.735H.768a.624.624 0 0 0 0 1.248h28.254L26.287 7.77a.619.619 0 0 0 0 .878.617.617 0 0 0 .441.183c.163 0 .32-.061.442-.183l3.796-3.796a.623.623 0 0 0-.005-.878L27.166.183z"/>
	</symbol>
	<symbol id="icon-close" viewBox="0 0 24 24">
		<title>close</title>
		<path d="M21 4.565L19.435 3 12 10.435 4.565 3 3 4.565 10.435 12 3 19.435 4.565 21 12 13.565 19.435 21 21 19.435 13.565 12z"/>
	</symbol>
	<symbol id="icon-navup" viewBox="0 0 50 50">
		<title>navup</title>
		<path d="M20.259 28.211l5.07-5.03 5.075 5.034a.36.36 0 0 0 .51 0 .356.356 0 0 0 0-.506l-5.323-5.28a.404.404 0 0 0-.135-.084.364.364 0 0 0-.384.08l-5.324 5.28a.356.356 0 0 0 0 .506c.141.14.37.14.51 0z" />
	</symbol>
	<symbol id="icon-navdown" viewBox="0 0 50 50">
		<title>navdown</title>
		<path d="M20.259 22.43l5.07 5.03 5.075-5.034a.36.36 0 0 1 .51 0c.14.14.14.366 0 .506l-5.323 5.28a.404.404 0 0 1-.135.084.364.364 0 0 1-.384-.081l-5.324-5.28a.356.356 0 0 1 0-.505c.141-.14.37-.14.51 0z" />
	</symbol>
	<symbol id="icon-grid" viewBox="0 0 24 24">
		<title>grid</title>
		<path d="M8.982 8.982h5.988v5.988H8.982zM0 0h5.988v5.988H0zM8.982 17.965h5.988v5.988H8.982zM0 8.982h5.988v5.988H0zM0 17.965h5.988v5.988H0zM17.965 0h5.988v5.988h-5.988zM8.982 0h5.988v5.988H8.982zM17.965 8.982h5.988v5.988h-5.988zM17.965 17.965h5.988v5.988h-5.988z"/>
	</symbol>
</svg>
<main>

	<div class="sections">
		<!-- photo gallery expander with toggles; content for each is in its section -->
		<div class="facts">
			<div class="facts__toggle">
				<span class="facts__toggle-inner facts__toggle-inner--more">
					<svg class="icon icon--dot"><use xlink:href="#icon-dot"></use></svg>
					<span class="facts__toggle-text">See photo gallery</span>
				</span>
				<span class="facts__toggle-inner facts__toggle-inner--less">
					<svg class="icon icon--cross"><use xlink:href="#icon-cross"></use></svg>
					<span class="facts__toggle-text">Hide photo gallery</span>
				</span>
			</div>
			<button class="button-contentclose">
				<svg class="icon icon--close"><use xlink:href="#icon-close"></use></svg>
			</button>
		</div>
		<!-- index -->
		<div class="sections__index">
			<span class="sections__index-current">
				<span class="sections__index-inner">01</span>
			</span>
			<span class="sections__index-total">04</span>
		</div>
		<!-- navigation down -->
		<nav class="sections__nav">
			<button class="sections__nav-item sections__nav-item--prev">
				<svg class="icon icon--navup"><use xlink:href="#icon-navup"></use></svg>
			</button>
			<button class="sections__nav-item sections__nav-item--next">
				<svg class="icon icon--navdown"><use xlink:href="#icon-navdown"></use></svg>
			</button>
		</nav>

		
		<!-- This is where we run our foor loop -->
		<?php $sectionCounter = 0; ?>
		<?php foreach ($customServices as $service) { ?>
			<?php $sectionCounter++; ?>
			<?php if($sectionCounter == 1) { ?>
			<!-- sections -->
			<section class="section section--current">
				<div class="section__content">
					<h2 class="section__title">Hiking</h2>
					<p class="section__description"><span class="section__description-inner">Hiking is the preferred term, in Canada and the United States, for a long, vigorous walk, usually on trails (footpaths), in the countryside, while the word walking is used for shorter, particularly urban walks.</span></p>
				</div>
				<div class="section__img">
					<div class="section__img-inner" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/1.jpg)"></div>
				</div>
				<div class="section__more">
					<div class="section__more-inner section__more-inner--bg1">
						<span class="section__more-text">Book your photoshoot today!</span>
						<a href="#" class="section__more-link">
							<span class="section__more-linktext">Say Hello</span>
							<svg class="icon icon--arrowlong"><use xlink:href="#icon-arrowlong"></use></svg>
						</a>
					</div>
				</div>
				<div class="section__expander"></div>
				<ul class="section__facts">
					<li class="section__facts-item">
						<h3 class="section__facts-title">Insert Text Here</h3>
						<span class="section__facts-detail">Lorem ipsum dolor sit amet, cons</span>
					</li>
					<li class="section__facts-item">
						<h3 class="section__facts-title">Insert Text Here</h3>
						<span class="section__facts-detail">Lorem ipsum dolor sit amet, cons</span>
					</li>
					<li class="section__facts-item">
						<h3 class="section__facts-title">Service Title Here - Photo Gallery</h3>
						<span class="section__facts-detail">Click to see a collection of images</span>
					</li>
					<li class="section__facts-item section__facts-item--clickable" data-gallery="gallery1">
						<div class="section__facts-img">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/images/thumb1.jpg" alt="Some image"/>
							<svg class="icon icon--grid"><use xlink:href="#icon-grid"></use></svg>
						</div>
					</li>
				</ul>
				<div class="section__gallery" id="gallery<?php echo $sectionCounter; ?>">
					<h3 class="section__gallery-item section__gallery-item--title">More impressions</h3>
					<a class="section__gallery-item" href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/thumb1.jpg" alt="Some image"/></a>
					<a class="section__gallery-item" href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/thumb2.jpg" alt="Some image"/></a>
					<a class="section__gallery-item" href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/thumb3.jpg" alt="Some image"/></a>
					<a class="section__gallery-item" href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/thumb4.jpg" alt="Some image"/></a>
					<a class="section__gallery-item" href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/thumb5.jpg" alt="Some image"/></a>
					<a class="section__gallery-item" href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/thumb6.jpg" alt="Some image"/></a>
				</div>
			</section><!--/ section -->
			<?php } else { ?>
			<!-- sections -->
			<section class="section">
				<div class="section__content">
					<h2 class="section__title">Hiking</h2>
					<p class="section__description"><span class="section__description-inner">Hiking is the preferred term, in Canada and the United States, for a long, vigorous walk, usually on trails (footpaths), in the countryside, while the word walking is used for shorter, particularly urban walks.</span></p>
				</div>
				<div class="section__img">
					<div class="section__img-inner" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/1.jpg)"></div>
				</div>
				<div class="section__more">
					<div class="section__more-inner section__more-inner--bg1">
						<span class="section__more-text">Want to know more?</span>
						<a href="#" class="section__more-link">
							<span class="section__more-linktext">Explore all hikes</span>
							<svg class="icon icon--arrowlong"><use xlink:href="#icon-arrowlong"></use></svg>
						</a>
					</div>
				</div>
				<div class="section__expander"></div>
				<ul class="section__facts">
					<li class="section__facts-item">
						<h3 class="section__facts-title">Insert Text Here</h3>
						<span class="section__facts-detail">Lorem ipsum dolor sit amet, cons</span>
					</li>
					<li class="section__facts-item">
						<h3 class="section__facts-title">Insert Text Here</h3>
						<span class="section__facts-detail">Lorem ipsum dolor sit amet, cons</span>
					</li>
					<li class="section__facts-item">
						<h3 class="section__facts-title">Service Title Here - Photo Gallery</h3>
						<span class="section__facts-detail">Click to see a collection of images</span>
					</li>
					<li class="section__facts-item section__facts-item--clickable" data-gallery="gallery1">
						<div class="section__facts-img">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/images/thumb1.jpg" alt="Some image"/>
							<svg class="icon icon--grid"><use xlink:href="#icon-grid"></use></svg>
						</div>
					</li>
				</ul>
				<div class="section__gallery" id="gallery<?php echo $sectionCounter; ?>">
					<h3 class="section__gallery-item section__gallery-item--title">More impressions</h3>
					<a class="section__gallery-item" href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/thumb1.jpg" alt="Some image"/></a>
					<a class="section__gallery-item" href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/thumb2.jpg" alt="Some image"/></a>
					<a class="section__gallery-item" href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/thumb3.jpg" alt="Some image"/></a>
					<a class="section__gallery-item" href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/thumb4.jpg" alt="Some image"/></a>
					<a class="section__gallery-item" href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/thumb5.jpg" alt="Some image"/></a>
					<a class="section__gallery-item" href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/thumb6.jpg" alt="Some image"/></a>
				</div>
			</section><!--/ section -->
			<?php } ?>

		<?php } ?>
	</div><!--/ sections -->
</main>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/charming.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/anime.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/services.js"></script>

<?php
get_footer();