<?php get_header(); ?>

<main id="site-main">

	<div class="site-section-wrapper site-section-wrapper-main">

	<?php

		// Function to display Breadcrumbs
		ilovewp_helper_display_breadcrumbs($post);
		?>
		<div id="site-page-columns">
			<?php 
			// Function to display the SIDEBAR (if not hidden)
			ilovewp_helper_display_page_sidebar_column(); 
			
			// Function to display the START of the content column markup
			ilovewp_helper_display_page_content_wrapper_start();

				ilovewp_helper_display_woocommerce_content($post);

			// Function to display the END of the content column markup
			ilovewp_helper_display_page_content_wrapper_end(); 
			?>
		</div><!-- #site-page-columns -->

	</div><!-- .site-section-wrapper .site-section-wrapper-main -->

</main><!-- #site-main -->
	
<?php get_footer(); ?>