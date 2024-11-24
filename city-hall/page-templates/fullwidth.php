<?php
/**
 * Template Name: Full Width Page
 */

get_header();
?>

<main id="site-main">

	<div class="site-section-wrapper site-section-wrapper-main">

	<?php
	while (have_posts()) : the_post();

	academiathemes_hero_image_inside($post);

	ilovewp_helper_display_breadcrumbs($post);
	?>

	<div id="site-page-columns">
		<?php 
		// Function to display the START of the content column markup
		ilovewp_helper_display_page_content_wrapper_start();

			ilovewp_helper_display_title($post);
			ilovewp_helper_display_content($post);
			ilovewp_helper_display_comments($post);

		// Function to display the END of the content column markup
		ilovewp_helper_display_page_content_wrapper_end(); 
		?>
	</div><!-- #site-page-columns -->

	<?php
	endwhile;
	?>

	</div><!-- .site-section-wrapper .site-section-wrapper-main -->

</main><!-- #site-main -->
	
<?php get_footer(); ?>