<?php
/**
 * archive.php
 *
 * The template for displaying Archive pages.
 *
 * @link        http://www.gopiplus.com/
 *
 * @author      www.gopiplus.com
 * @copyright   Copyright (c) 2013 - 2014 www.gopiplus.com
 */
?>
<?php get_header(); ?>
<div id="content" class="left">
  <?php get_template_part( 'breadcrumbs', get_post_format() ); ?>
  <div id="content-loop" class="layout-content-loop">
	<?php if ( have_posts() ) : ?>	
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>
		<div class="clear"></div>
			<?php if (function_exists('wp_pagenavi')) wp_pagenavi(); else { ?>
			<div class="pagination">
			  <div class="newer">
				<?php previous_posts_link(__(' &laquo;&laquo; Newer Entries ', 'gopiplustheme')) ?>
			  </div>
			  <div class="older">
				<?php next_posts_link(__(' Older Entries &raquo;&raquo; ', 'gopiplustheme')) ?>
			  </div>
			  <div class="clear"></div>
			</div>
			<?php } ?>
	<?php else : ?>
	<?php endif; ?>
	</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>