<?php
/**
 * header.php
 *
 * This file controls the HTML <head> and top graphical markup (including
 * Navigation) for each page in your theme. Displays all of the <head> 
 * section and everything up till <div class="wrap fullwidth">
 *
 * @link        http://www.gopiplus.com/
 *
 * @author      www.gopiplus.com
 * @copyright   Copyright (c) 2013 - 2014 www.gopiplus.com
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!-- start website header -->
<div id="page-header" class="wrap header">
	<header id="masthead" class="site-header" role="banner">
		<!-- start hgroup header -->
		<div class="hgroup">
		<?php if ( get_theme_mod( 'premiumstyle_sitelogo' ) ) : ?>
			<div class="site-logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<img src="<?php echo get_theme_mod( 'premiumstyle_sitelogo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				</a>
			</div>
		<?php else : ?>
			<h1 class="site-title">
				<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
			</h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		<?php endif; ?>
		</div>
		<!-- start social header -->
		<?php if( get_theme_mod( 'premiumstyle_social_activate' ) <> '1') { ?>
			<div class="site-social">
			<?php if ( esc_url( get_theme_mod( 'facebook_url', '#' ) ) <> "") : ?>
				<span><a id="iconFacebook" target="_blank" href="<?php echo esc_url( get_theme_mod( 'facebook_url', '#' ) ); ?>" title="Follow us on Facebook"></a></span>
			<?php endif; ?>
			<?php if ( esc_url( get_theme_mod( 'twitter_url', '#' ) ) <> "") : ?>
				<span><a id="iconTwitter" target="_blank" href="<?php echo esc_url( get_theme_mod( 'twitter_url', '#' ) ); ?>" title="Follow us on Twitter"></a></span>
			<?php endif; ?>
			<?php if ( esc_url( get_theme_mod( 'googleplus_url', '#' ) ) <> "") : ?>	
				<span><a id="iconGooglePlus" target="_blank" href="<?php echo esc_url( get_theme_mod( 'googleplus_url', '#' ) ); ?>" title="Follow us on Google Plus"></a></span>
			<?php endif; ?>					
			<?php if ( esc_url( get_theme_mod( 'youtube_url', '#' ) ) <> "") : ?>
				<span><a id="iconYouTube" target="_blank" href="<?php echo esc_url( get_theme_mod( 'youtube_url', '#' ) ); ?>" title="Follow us on Youtube"></a></span>
			<?php endif; ?>
			<?php if ( esc_url( get_theme_mod( 'rss_url', '#' ) ) <> "") : ?>
				<span><a id="iconRSS" target="_blank" href="<?php echo esc_url( get_theme_mod( 'rss_url', '#' ) ); ?>" title="RSS Feed"></a></span>
			<?php endif; ?>
			</div>
		<?php } ?>	
		<!-- start image header -->
		<?php 
		$header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
		<div class="header-image">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		</a>
		</div>
		<?php endif; ?>
		<div class="clear"></div>
	</header>
</div>
<!-- end website header -->
<!-- start website menu -->
<div id="primary-nav">
  <div class="wrap nav">
	<nav id="site-navigation" class="main-navigation" role="navigation">
		<h3 class="menu-toggle"><?php _e( 'Menu', 'gopiplustheme' ); ?></h3>
		<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'gopiplustheme' ); ?>"><?php _e( 'Skip to content', 'gopiplustheme' ); ?></a>
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
	</nav>
 </div>
</div>
<!-- end website menu -->
<div class="wrap fullwidth">