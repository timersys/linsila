<?php
/**
 * The template for displaying linsila app header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package Linsila
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="linsila" class="">

<header class="site-header" role="banner">
	<div class="contain-to-grid sticky">
		<nav class="top-bar" data-topbar role="navigation" data-options="sticky_on: large">
			<ul class="title-area">
				<li class="name"><h1><a href="<?php get_permalink( linsila_get_page_id('linsila'));?>">Dashboard</a></h1></li>

				<!-- Mobile Menu Toggle -->
				<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
			</ul>
			<section class="top-bar-section">

				<!-- Top Bar Left Nav Elements -->
				<ul class="left">
					<!-- Divider -->
					<li class="divider"></li>
					<!-- Dropdown -->
					<li class="has-dropdown not-click"><a href="#">Item 1</a>
						<ul class="dropdown"><li class="title back js-generated"><h5><a href="javascript:void(0)">Back</a></h5></li><li class="parent-link hide-for-medium-up"><a class="parent-link js-generated" href="#">Item 1</a></li>
							<li><label>Level One</label></li>
							<li><a href="#">Sub-item 1</a></li>
							<li><a href="#">Sub-item 2</a></li>
							<li class="divider"></li>
							<li><a href="#">Sub-item 3</a></li>
							<li class="has-dropdown not-click"><a href="#">Sub-item 4</a>

								<!-- Nested Dropdown -->
								<ul class="dropdown"><li class="title back js-generated"><h5><a href="javascript:void(0)">Back</a></h5></li><li class="parent-link hide-for-medium-up"><a class="parent-link js-generated" href="#">Sub-item 4</a></li>
									<li><label>Level Two</label></li>
									<li><a href="#">Sub-item 2</a></li>
									<li><a href="#">Sub-item 3</a></li>
									<li><a href="#">Sub-item 4</a></li>
								</ul>
							</li>
							<li><a href="#">Sub-item 5</a></li>
						</ul>
					</li>

					<li class="divider"></li>

					<!-- Anchor -->
					<li><a href="#">Generic Button</a></li>
					<li class="divider"></li>

					<!-- Button -->
					<li class="has-form show-for-large-up">
						<a href="http://foundation.zurb.com/docs" class="button">Get Lucky</a>
					</li>
				</ul>
				<!-- Top Bar Right Nav Elements -->
				<ul class="right">

					<!-- Search | has-form wrapper -->
					<li class="has-form">
						<div class="row collapse">
							<div class="large-8 small-9 columns">
								<input type="text" placeholder="Find Stuff">
							</div>
							<div class="large-4 small-3 columns">
								<a href="#" class="alert button expand">Search</a>
							</div>
						</div>
					</li>
				</ul>


			</section>
		</nav>
	</div>
</header><!-- .site-header -->


<div id="linsila-content" class="row">
