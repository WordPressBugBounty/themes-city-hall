<?php
/**
 * Template Name: Homepage: Widgets + Page Content
 */

get_header();

if ( is_front_page() && is_active_sidebar('homepage-content-widgets') ) { ?>
	<div id="site-homepage-widgets">
		<div class="site-section-wrapper wrapper-homepage-content-widgets">
	
			<?php dynamic_sidebar( 'homepage-content-widgets' ); ?>

		</div><!-- .site-section-wrapper .wrapper-homepage-content-widgets -->

	</div><!-- #site-homepage-widgets -->

<?php } ?>
<main id="site-main">

	<div class="site-section-wrapper site-section-wrapper-main">

	<?php
	while (have_posts()) : the_post();

	academiathemes_hero_image_inside($post);
	
	// Function to display Breadcrumbs
	ilovewp_helper_display_breadcrumbs($post);

	?>
	<div id="site-page-columns">
		<?php 
		// Function to display the SIDEBAR (if not hidden)
		ilovewp_helper_display_page_sidebar_column(); 
		
		// Function to display the START of the content column markup
		ilovewp_helper_display_page_content_wrapper_start();

			ilovewp_helper_display_title($post);
			ilovewp_helper_display_content($post);

		// Function to display the END of the content column markup
		ilovewp_helper_display_page_content_wrapper_end(); 
		
		// Function to display the SECONDARY SIDEBAR (if not hidden)
		ilovewp_helper_display_page_sidebar_secondary();
		?>
	</div><!-- #site-page-columns -->
	<?php
	endwhile;
	?>

	</div><!-- .site-section-wrapper .site-section-wrapper-main -->

</main><!-- #site-main -->
<?php get_footer(); ?>