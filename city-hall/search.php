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

				?>
				<h1 class="page-title"><?php esc_html_e('Search Results for', 'city-hall');?>: <strong><?php the_search_query(); ?></strong></h1>
				<?php get_search_form(); ?>

				<?php if (!have_posts()) { ?>
					
				<hr /><div class="entry-content">
				
					<p><?php esc_html_e( 'Apologies, but the search query did not return any results.', 'city-hall' ); ?></p>
					
					<h3><?php esc_html_e( 'Browse Categories', 'city-hall' ); ?></h3>
					<ul>
						<?php wp_list_categories('title_li=&hierarchical=0&show_count=1'); ?>	
					</ul>
				
					<h3><?php esc_html_e( 'Monthly Archives', 'city-hall' ); ?></h3>
					<ul>
						<?php wp_get_archives('type=monthly&show_post_count=1'); ?>	
					</ul>
				
				</div><!-- .entry-content -->
				
				<?php } else { echo '<hr />'; }	?>

				<?php get_template_part('loop');

			// Function to display the END of the content column markup
			ilovewp_helper_display_page_content_wrapper_end(); 
			
			// Function to display the SECONDARY SIDEBAR (if not hidden)
			ilovewp_helper_display_page_sidebar_secondary();
			?>
		</div><!-- #site-page-columns -->

	</div><!-- .site-section-wrapper .site-section-wrapper-main -->

</main><!-- #site-main -->
	
<?php get_footer(); ?>