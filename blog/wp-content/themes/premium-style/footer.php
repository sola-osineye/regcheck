<?php
/**
 * footer.php
 *
 * The template for displaying the footer. Contains footer 
 * content and the closing of the html elements.
 *
 * @link        http://www.gopiplus.com/
 *
 * @author      www.gopiplus.com
 * @copyright   Copyright (c) 2013 - 2014 www.gopiplus.com
 */
?>
<div class="clear"></div>
<div id="footer">
	<div class="copyright">
		<span class="footerleft">  
			<?php echo get_theme_mod( 'premiumstyle_footer_l', 'Copyright &copy; 2013' ); ?>
		</span>
		<span class="footerright">
			<?php echo get_theme_mod( 'premiumstyle_footer_r', 'All rights reserved' ); ?>
		</span>
		<div class="clear"></div>
	</div>
</div>
</div>
<div class="credits">
	<?php do_action( 'premiumstyle_credits' ); ?>
	<?php printf( __( 'Proudly powered by', 'gopiplustheme' ) ); ?>
	<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'gopiplustheme' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'gopiplustheme' ); ?>">
		<?php printf( __( '%s', 'gopiplustheme' ), 'WordPress' ); ?>
	</a>
	<?php printf( __( '&nbsp;&nbsp;Premium Style Theme by', 'gopiplustheme' ) ); ?>
	<a href="<?php echo esc_url( __( 'http://www.gopiplus.com/', 'gopiplustheme' ) ); ?>" title="<?php esc_attr_e( 'Premium Style Theme', 'gopiplustheme' ); ?>">
		<?php printf( __( '%s', 'gopiplustheme' ), 'www.gopiplus.com' ); ?>
	</a>
</div>
<?php wp_footer(); ?>
</body>
</html>