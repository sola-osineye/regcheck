<?php
/**
 * functions.php
 *
 * This file loads the theme functions and definitions.
 *
 * @link        http://www.gopiplus.com/
 *
 * @author      www.gopiplus.com
 * @copyright   Copyright (c) 2013 - 2014 www.gopiplus.com
 */

/**
 * Sets up the content width value based on the theme's design.
 *
 */
if ( ! isset( $content_width ) )
{
	$content_width = 1000;
}

/**
 * Sets up theme defaults and registers the various WordPress features that
 * Premium Stylesupports.
 */
function premiumstyle_setup() 
{
	//  Translations can be added to the /languages/ directory.
	load_theme_textdomain( 'gopiplustheme', get_template_directory() . '/languages' );
	
	// This theme styles the visual editor to match the theme style.
	add_editor_style();
	
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Navigation Menu', 'gopiplustheme' ) );
	
	// Custom Background
	add_theme_support( 'custom-background', array('default-color' => 'FFFFFF',) );
	
	// This theme uses a custom image size for featured images, displayed on posts and pages.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); 
	// 200 pixels wide by 150 pixels high, hard crop mode
	add_image_size('excerpt-thumbnail', 200, 150, true); 
}
add_action( 'after_setup_theme', 'premiumstyle_setup' );

/**
 * Enqueues scripts and styles for front end.
 *
 */
function premiumstyle_scripts_styles() 
{
	global $wp_styles;
	global $wp_scripts;

	// Adds JavaScript to pages with the comment form to support sites with threaded comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
	{
		wp_enqueue_script( 'comment-reply' );
	}
	
	// Loads Premium Stylemain stylesheet.
	wp_enqueue_style( 'premiumstyle-style', get_stylesheet_uri() );
	
	wp_enqueue_script('navigation', get_template_directory_uri().'/js/navigation.js', false, '20131110', true);	

	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'premiumstyle-ie', get_template_directory_uri() . '/ie.css', array( 'premiumstyle-style' ), '20131110' );
	$wp_styles->add_data( 'premiumstyle-ie', 'conditional', 'lt IE 9' );
	
	wp_enqueue_script('html5', get_template_directory_uri().'/js/html5.js', false, '20131110', false);
	$wp_scripts->add_data( 'html5', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'premiumstyle_scripts_styles' );

/**
 * Creates a formatted title for the website.
 *
 */
function premiumstyle_wp_title( $title, $sep ) 
{
	global $paged, $page;

	// Skip the title for RSS feed.
	if ( is_feed() )
	{
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
	{
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
	{
		$title = "$title $sep " . sprintf( __( 'Page %s', 'gopiplustheme' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'premiumstyle_wp_title', 10, 2 );

/**
 * Sets up the WordPress core custom header arguments and settings.
 *
 */
function premiumstyle_custom_header() 
{
	$args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => '333333',
		'default-image'          => '',
		// Callbacks for styling the header
		'wp-head-callback'    => 'premiumstyle_header_style',
	);

	add_theme_support( 'custom-header', $args );
}
add_action( 'after_setup_theme', 'premiumstyle_custom_header' );

/**
 * Display related/recent post in the posts footer.
 *
 */
function premiumstyle_related_posts() 
{
	global $post, $wpdb;
	$related_post_found = false;
	$backup = $post;
	$tags = wp_get_post_tags($post->ID);
	$tagIDs = array();
	if ($tags) 
	{
		$tagcount = count($tags);
		for ($i = 0; $i < $tagcount; $i++) 
		{
			$tagIDs[$i] = $tags[$i]->term_id;
		}
		
		$args = array('tag__in' => $tagIDs, 'post__not_in' => array($post->ID), 'showposts' => 5, 'ignore_sticky_posts' => 1);
		$premiumstyle_query = new WP_Query($args);
		if( $premiumstyle_query->have_posts() ) 
		{ 
			$related_post_found = true; 
			?>
				<h3><?php _e('Related Posts','gopiplustheme'); ?></h3>
				<div class="clear"></div>
				<ul>		
				<?php while ($premiumstyle_query->have_posts()) : $premiumstyle_query->the_post(); ?>
					<li><a class="title" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></li>				
				<?php endwhile; ?>
				</ul>		
			<?php 
		}
	}
	
	// Show recent posts if no related found in database.
	if(!$related_post_found)
	{ 
		?>
		<h3><?php _e('Recent Posts','gopiplustheme'); ?></h3>
		<div class="clear"></div>		
		<ul>
		<?php
			$args = array( 'posts_per_page' => 5, 'orderby'=> 'post_date', 'order' => 'DESC' );
			$posts = get_posts( $args );
			foreach($posts as $post) 
			{ 
				?>
				<li>
					<a class="title" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
				</li>
				<?php 
			} 
		?>
		</ul>
		<?php 
	}
	wp_reset_postdata();
}

/**
 * Displays navigation to next/previous set of posts when applicable.
 *
 */
function premiumstyle_content_nav( $html_id ) 
{
	global $wp_query;
	$html_id = esc_attr( $html_id );
	if ( $wp_query->max_num_pages > 1 )
	{
		?>
			<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
				<div class="nav-previous alignleft">
					<?php next_posts_link( __( '<span class="meta-nav">&laquo;&laquo;</span> Older posts', 'gopiplustheme' ) ); ?>
				</div>
				<div class="nav-next alignright">
					<?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&raquo;&raquo;</span>', 'gopiplustheme' ) ); ?>
				</div>
			</nav>
		<?php 
	}
}

/**
 * Register widgetized area and update sidebar with default widgets
 *
 */
function premiumstyle_widgets_init() 
{
	register_sidebar( array (
		'name' 			=> __( 'Sidebar', 'gopiplustheme' ),
		'id' 			=> 'sidebar',
		'description' 	=> __( 'Sidebar', 'gopiplustheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' 	=> "<div class='clear'></div></div>",
		'before_title' 	=> '<p class="widget-title">',
		'after_title' 	=> '</p>',
	) );
}
add_action( 'widgets_init', 'premiumstyle_widgets_init' );

/**
 * Adding options page under Appearance menu 
 *
 */
function premiumstyle_theme_menu() 
{  
	add_theme_page( 'Premium Style', 'Premium Style', 'edit_theme_options', 'premiumstyle', 'premiumstyle_display');  
} 
add_action( 'admin_menu', 'premiumstyle_theme_menu' ); 

/**
 * Register widgetized area and update sidebar with default widgets
 *
 */
if (!function_exists("premiumstyle_custom_comment")) 
{
	function premiumstyle_custom_comment($comment, $args, $depth) 
	{
	   $GLOBALS['comment'] = $comment; 
	   ?>       
		<li <?php comment_class(); ?>>
		<a name="comment-<?php comment_ID() ?>"></a>
		<div id="li-comment-<?php comment_ID() ?>" class="comment-container">
			<div class="comment-head">    
				<?php if(get_comment_type() == "comment"){ ?>
					<div class="avatar"><?php premiumstyle_commenter_avatar($args) ?></div>
				<?php } ?>        
				<div class="reply">
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div> 	                          	
			</div>
			<div class="comment-entry"  id="comment-<?php comment_ID(); ?>">
				<span class="arrow"></span>
				<div class="comment-info">
					<div class="left">
						<span class="name"><?php premiumstyle_commenter_link() ?></span>
					</div>
					<div class="right">        
						<span class="date">
							<?php echo get_comment_date(get_option( 'date_format' )) ?> 
							<?php _e('at', 'gopiplustheme'); ?> 
							<?php echo get_comment_time(get_option( 'time_format' )); ?>
						</span>
						<span class="perma">
							<a href="<?php echo get_comment_link(); ?>" title="<?php _e('Direct link to this comment', 'gopiplustheme'); ?>">#</a>
						</span>
						<span class="edit"><?php edit_comment_link(__('Edit', 'gopiplustheme'), '', ''); ?></span>
					</div>
					<div class="clear"></div> 
				</div>	
				<?php comment_text() ?> 
				<?php if ($comment->comment_approved == '0') { ?>
					<p class='unapproved'><?php _e('Your comment is awaiting moderation.', 'gopiplustheme'); ?></p>
				<?php } ?>					
			</div>
		</div>		
	<?php 
	}
}

/**
 * Display pingbacks and trackbacks comment
 *
 */	
function premiumstyle_list_pings($comment, $args, $depth) 
{
	$GLOBALS['comment'] = $comment; 
	?>
	<li id="comment-<?php comment_ID(); ?>">
		<span class="author"><?php comment_author_link(); ?></span> - 
		<span class="date"><?php echo get_comment_date(get_option( 'date_format' )) ?></span>
	<span class="pingcontent"><?php comment_text() ?></span>
	<?php 
} 

/**
 * Display commenter link if link available.
 *
 */	
function premiumstyle_commenter_link() 
{
	$commenter = get_comment_author_link();
	echo $commenter;
}

/**
 * Display commenter avatar in the comment screen.
 *
 */
function premiumstyle_commenter_avatar($args) 
{
	$email 	= get_comment_author_email();
	$avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( "$email",  $args['avatar_size']) );
	echo $avatar;
}

/**
 * Style the header text displayed on the blog.
 *
 */
function premiumstyle_header_style() 
{
	$text_color = get_header_textcolor();

	// If no custom options for text are set.
	if ( $text_color == get_theme_support( 'custom-header', 'default-text-color' ) )
	{
		return;
	}
	// If we get this far, we have custom styles.
	?>
	<style type="text/css" id="premiumstyle-header-css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px 1px 1px 1px); /* IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text, use that.
		else :
	?>
		.site-header h1 a,
		.site-header h2 {
			color: #<?php echo $text_color; ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}

/**
 * Premium Style customizer begins
 *
 */
function premiumstyle_customizer( $wp_customize ) 
{
	// Theme customizer text area control
	class PremiumStyle_WP_Theme_Textarea_Control extends WP_Customize_Control 
	{
		public $type = 'textarea';
		public function render_content() 
		{
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="8" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
		}
	}
	
	// Theme customizer text box control
	class PremiumStyle_WP_Theme_Textbox_control extends WP_Customize_Control 
	{
		public $type = 'textarea';
		public function render_content() 
		{
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
		}
	}
	
	// Social text area customizer
	class PremiumStyle_WP_Theme_Social_control extends WP_Customize_Control 
	{
		public $type = 'textarea';
		public function render_content() 
		{
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="1" style="width:100%;" <?php $this->link(); ?>><?php echo esc_url( $this->value() ); ?></textarea>
			</label>
			<?php
		}
	}
	
	// Start upload site logo section
    $wp_customize->add_section( 'premiumstyle_sitelogo_section' , array(
    		'title'       	=> __( 'Logo', 'gopiplustheme' ),
    		'priority'    	=> 10,
    		'description' 	=> 'Upload a logo to replace the default site name and description in the header.',) );
	
	$wp_customize->add_setting( 'premiumstyle_sitelogo' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'premiumstyle_sitelogo', array(
			'label'    		=> __( 'Logo', 'gopiplustheme' ),
			'section'  		=> 'premiumstyle_sitelogo_section',
			'settings' 		=> 'premiumstyle_sitelogo',) ) );
	// End upload site logo section
				
	// Start social icons link section
	$wp_customize->add_section('premiumstyle_social_sec' , array(
			'title' 		=> __('Social Icons','gopiplustheme'),
			'priority'  	=> 210,));

	$wp_customize->add_setting('twitter_url', array(
			'default' => 'http://www.twitter.com/', 
			'sanitize_callback' => 'premiumstyle_sanitize',));
	$wp_customize->add_control(new PremiumStyle_WP_Theme_Social_control($wp_customize, 'twitter_url', array(
			'label' 		=> 'Twitter url',
			'section' 		=> 'premiumstyle_social_sec',
			'settings' 		=> 'twitter_url',)));
			
	$wp_customize->add_setting('premiumstyle_social_activate');
	$wp_customize->add_control('premiumstyle_social_activate', array(
			'type' 			=> 'checkbox', 
			'label' 		=> 'Disable all social icons', 
			'section' 		=> 'premiumstyle_social_sec',));

	$wp_customize->add_setting('facebook_url', array(
			'default' 		=> 'http://www.facebook.com/',
			'sanitize_callback' => 'premiumstyle_sanitize',));
	$wp_customize->add_control(new PremiumStyle_WP_Theme_Social_control($wp_customize, 'facebook_url', array(
			'label' 		=> 'Facebook url',
			'section' 		=> 'premiumstyle_social_sec',
			'settings' 		=> 'facebook_url',)));

	$wp_customize->add_setting('googleplus_url', array(
			'default' 		=> 'http://plus.google.com/',
			'sanitize_callback' => 'premiumstyle_sanitize',));
	$wp_customize->add_control(new PremiumStyle_WP_Theme_Social_control($wp_customize, 'googleplus_url', array(
			'label' 		=> 'Google plus url',
			'section' 		=> 'premiumstyle_social_sec',
			'settings' 		=> 'googleplus_url',)));

	$wp_customize->add_setting('youtube_url', array(
			'default' 		=> 'http://www.youtube.com/',
			'sanitize_callback' => 'premiumstyle_sanitize',));
	$wp_customize->add_control(new PremiumStyle_WP_Theme_Social_control($wp_customize, 'youtube_url', array(
			'label' 		=> 'Youtube url',
			'section' 		=> 'premiumstyle_social_sec', 
			'settings' 		=> 'youtube_url',)));

	$wp_customize->add_setting('rss_url', array(
			'default' 		=> '',
			'sanitize_callback' => 'premiumstyle_sanitize',));
	$wp_customize->add_control(new PremiumStyle_WP_Theme_Social_control($wp_customize, 'rss_url', array(
			'label' 		=> 'Rss url',
			'section' 		=> 'premiumstyle_social_sec',
			'settings' 		=> 'rss_url',)));
	// End social icons link section
		
	// Start related & author box
	$wp_customize->add_section('premiumstyle_infobox_sec' , array(
			'title' 		=> __('Display Box Setting','gopiplustheme'),
			'priority'    	=> 230,));
	$wp_customize->add_setting('premiumstyle_related_box');
	$wp_customize->add_control('premiumstyle_related_box',array(
			'type' 			=> 'checkbox', 
			'label' 		=> 'Hide related posts box on your posts and pages.',
			'section'		=> 'premiumstyle_infobox_sec',));
	
	$wp_customize->add_setting('premiumstyle_author_box');
	$wp_customize->add_control('premiumstyle_author_box',array(
			'type' 			=> 'checkbox', 
			'label' 		=> 'Hide author information box on your posts and pages.',
			'section' 		=> 'premiumstyle_infobox_sec',));
			
	$wp_customize->add_setting('premiumstyle_thumbnail_box');
	$wp_customize->add_control('premiumstyle_thumbnail_box',array(
			'type' 			=> 'checkbox', 
			'label' 		=> 'Hide thumbnail image on your single view posts and pages.',
			'section' 		=> 'premiumstyle_infobox_sec',));
	// End related & author box
	
	// Start theme footer text
	$wp_customize->add_section('premiumstyle_footer_sec' , array(
			'title' 		=> __('Footer Text','gopiplustheme'),
			'priority'    	=> 240,));
	$wp_customize->add_setting('premiumstyle_footer_l', array(
			'default' 		=> 'Copyright &copy; 2014',));
	$wp_customize->add_control(new PremiumStyle_WP_Theme_Textbox_control($wp_customize, 'premiumstyle_footer_l', array(
			'label'			=> 'Footer Left',
			'section' 		=> 'premiumstyle_footer_sec',
			'settings' 		=> 'premiumstyle_footer_l',)));
	
	$wp_customize->add_setting('premiumstyle_footer_r', array(
			'default' 		=> 'All rights reserved',));
	$wp_customize->add_control(new PremiumStyle_WP_Theme_Textbox_control($wp_customize, 'premiumstyle_footer_r', array(
			'label' 		=> 'Footer Right',
			'section' 		=> 'premiumstyle_footer_sec',
			'settings' 		=> 'premiumstyle_footer_r',)));
	// End theme footer text
}
add_action('customize_register', 'premiumstyle_customizer');

/**
 * Premium Style sanitize URL, Now Its safe to use in database queries
 *
 */
function premiumstyle_sanitize( $value ) 
{
    $response = esc_url_raw( $value );
    return $response;
}

/**
 * Premium Style admin tips 
 *
 */
function premiumstyle_display() 
{
	define('premiumstyle_link', 'http://www.gopiplus.com/work/2013/11/11/premium-style-wordpress-theme/');
	define('premiumstyle_docs', 'http://www.gopiplus.com/work/2013/11/12/premium-style-wordpress-theme-documentation/');
	?>
	<div class="wrap">
	  <div id="icon-themes" class="icon32"></div>
	  <h2><?php _e( 'Premium Style WordPress Theme', 'gopiplustheme' ); ?></h2>
	  <div class="tool-box">
		<h3 style="color:#009933"><?php _e( 'Thank You for Selecting Premium Style Theme From', 'gopiplustheme' ); ?>
		<a style="color:#009933;text-decoration:none;" href="<?php _e( premiumstyle_link, 'gopiplustheme' ); ?>" target="_blank">
		<?php _e( 'gopiplus.com', 'gopiplustheme' ); ?></a></h3>
		<h3><?php _e( 'Theme configuration', 'gopiplustheme' ); ?></h3>
			<?php _e( 'Please click customize link to configure your theme.', 'gopiplustheme' ); ?>
		<h3><?php _e( 'Features of this theme', 'gopiplustheme' ); ?></h3>
		<ol>
		  <li><?php _e( 'Free theme', 'gopiplustheme' ); ?></li>
		  <li><?php _e( 'Highly customizable', 'gopiplustheme' ); ?></li>
		  <li><?php _e( '100% Responsive', 'gopiplustheme' ); ?></li>
		  <li><?php _e( 'Valid XHTML5 + CSS', 'gopiplustheme' ); ?></li>
		  <li><?php _e( 'Firefox, IE8+, Chrome and Safari compatible', 'gopiplustheme' ); ?></li>
		  <li><?php _e( 'WP 3.6+ compatible and Tested up tp 3.8', 'gopiplustheme' ); ?></li>
		  <li><?php _e( 'Blog style structure', 'gopiplustheme' ); ?></li>
		  <li><?php _e( 'Social Icon settings', 'gopiplustheme' ); ?></li>
		  <li><?php _e( 'Option to enable/disable Author Info Box', 'gopiplustheme' ); ?></li>
		  <li><?php _e( 'Breadcrumbs links', 'gopiplustheme' ); ?></li>
		  <li><?php _e( 'Free 24x5 email support', 'gopiplustheme' ); ?></li>
		</ol>
		<h3><?php _e( 'Frequently asked questions', 'gopiplustheme' ); ?></h3>
		<ol>
		  <li><a href="<?php _e( premiumstyle_link, 'gopiplustheme' ); ?>" target="_blank"><?php _e( 'How do I install the theme onto my wordpress blog?', 'gopiplustheme' ); ?></a></li>
		  <li><a href="<?php _e( premiumstyle_link, 'gopiplustheme' ); ?>" target="_blank"><?php _e( 'How to setup Featured image for post?', 'gopiplustheme' ); ?></a></li>
		  <li><a href="<?php _e( premiumstyle_link, 'gopiplustheme' ); ?>" target="_blank"><?php _e( 'How to Disable and Enable home page slider?', 'gopiplustheme' ); ?></a></li>
		  <li><a href="<?php _e( premiumstyle_link, 'gopiplustheme' ); ?>" target="_blank"><?php _e( 'How to configure Social Icon in the theme?', 'gopiplustheme' ); ?></a></li>
		  <li><a href="<?php _e( premiumstyle_link, 'gopiplustheme' ); ?>" target="_blank"><?php _e( 'How to add favicon?', 'gopiplustheme' ); ?></a></li>
		  <li><a href="<?php _e( premiumstyle_link, 'gopiplustheme' ); ?>" target="_blank"><?php _e( 'How to Enable and Disable AuthorInfo/Related Box in the single view post?', 'gopiplustheme' ); ?></a>
		  </li>
		</ol>
		<h3><?php _e( 'Theme documentation', 'gopiplustheme' ); ?></h3>
		<ol><li><a href="<?php _e( premiumstyle_docs, 'gopiplustheme' ); ?>" target="_blank"><?php _e( premiumstyle_docs, 'gopiplustheme' ); ?></a></li></ol>
	  </div>
	</div>
	<?php
}
?>