<?php
/**
 * archive.php
 *
 * The template for displaying navigation links.
 *
 * @link        http://www.gopiplus.com/
 *
 * @author      www.gopiplus.com
 * @copyright   Copyright (c) 2013 - 2014 www.gopiplus.com
 */
?>
<!-- start breadcrumbs -->
<div id="breadcrumbs">
  <?php if(function_exists('bcn_display')) { bcn_display(); } 
		  else { ?>
  <a href="<?php echo home_url(); ?>">
  <?php _e('Home','gopiplustheme') ?>
  </a>
  <?php echo ('&raquo;&raquo;&nbsp;'); ?>
  <?php if( is_tag() ) { ?>
  <?php _e('Posts Tagged &quot;','gopiplustheme') ?>
  <?php single_tag_title(); echo('&quot;'); ?>
  <?php } elseif (is_day()) { ?>
  <?php _e('Posts made in','gopiplustheme') ?>
  <?php the_time('F jS, Y'); ?>
  <?php } elseif (is_month()) { ?>
  <?php _e('Posts made in','gopiplustheme') ?>
  <?php the_time('F, Y'); ?>
  <?php } elseif (is_year()) { ?>
  <?php _e('Posts made in','gopiplustheme') ?>
  <?php the_time('Y'); ?>
  <?php } elseif (is_search()) { ?>
  <?php _e('Search results for','gopiplustheme') ?>
  <?php the_search_query() ?>
  <?php } elseif (is_single()) { ?>
  <?php $category = get_the_category();
						  if (!empty($category)) 
						  { 
								$catlink = get_category_link( $category[0]->cat_ID );
								echo ('<a href="'.$catlink.'">'.$category[0]->cat_name.'</a> &raquo;&raquo;&nbsp;'.get_the_title());
						  }; 
					?>
  <?php } elseif (is_category()) { ?>
  <?php single_cat_title(); ?>
  <?php } elseif (is_author()) { ?>
  <?php global $wp_query;
						  $curauth = $wp_query->get_queried_object(); ?>
  <?php _e('Posts by ','gopiplustheme'); echo ' ',$curauth->nickname; ?>
  <?php } elseif (is_page()) { ?>
  <?php wp_title(''); ?>
  <?php }; ?>
  <?php }; ?>
</div>