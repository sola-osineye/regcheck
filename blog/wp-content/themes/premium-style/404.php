<?php
/**
 * 404.php
 *
 * The template for displaying 404 pages (Page Not Found).
 *
 * @link        http://www.gopiplus.com/
 *
 * @author      www.gopiplus.com
 * @copyright   Copyright (c) 2013 - 2014 www.gopiplus.com
 */
?>
<?php get_header(); ?>
<div id="content" class="left">
	<div id="breadcrumbs"> 
		<a href="<?php echo home_url(); ?>"><?php _e('Home','gopiplustheme') ?></a>
		&raquo;&raquo;
		<?php _e('404 Not found','gopiplustheme') ?>
	</div>
	<!-- start post content -->
	<div id="post-404" class="hentry post error404 not-found">
		<h1 class="page-title">
			<?php _e('404! We couldn\'t find the page!','gopiplustheme') ?>
		</h1>
		<div class="entry entry-content">
		<p>
			<?php _e('The page you\'ve requested <strong>can not be displayed</strong>. We are working hard to fix all the missing resources.','gopiplustheme') ?>
		</p>
		<?php get_search_form(); ?>
		
		</div>
	</div>
	<!-- start related posts box -->
	<div class="entry-bottom">
      <div class="related-posts">
		<h3><?php _e('Recent Posts','gopiplustheme'); ?></h3>
		<div class="clear"></div>		
		<ul>
			<?php
			$posts = get_posts('numberposts=6');
			foreach($posts as $post) 
			{ 
				?><li><a class="title" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></li><?php 
			} 
			?>
			<?php wp_reset_query(); ?>
		</ul>
		</div>
	</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
