<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class city_hall_notice_magma extends city_hall_notice {

	public function __construct() {

		add_action( 'wp_loaded', array( $this, 'magma_notice' ), 20 );
		add_action( 'wp_loaded', array( $this, 'hide_notices' ), 15 );

		$this->current_user_id       = get_current_user_id();

	}

	public function magma_notice() {
		
		$welcome_notice_was_dismissed = $this->get_notice_status('welcome');

		$this_notice_was_dismissed = $this->get_notice_status('upgrade-magma');
		
		if ( !$this_notice_was_dismissed && $welcome_notice_was_dismissed ) {
			add_action( 'admin_notices', array( $this, 'magma_notice_markup' ) ); // Display this notice.
		}

	}

	/**
	 * Show HTML markup if conditions meet.
	 */
	public function magma_notice_markup() {
		
		$dismiss_url = wp_nonce_url(
			remove_query_arg( array( 'activated' ), add_query_arg( 'city-hall-hide-notice', 'upgrade-magma' ) ),
			'city_hall_hide_notices_nonce',
			'_city_hall_notice_nonce'
		);

		$theme_data	 	= wp_get_theme();
		$current_user 	= wp_get_current_user();

		if ( ( get_option( 'city_hall_theme_installed_time' ) > strtotime( '-3 day' ) ) ) {
			return;
		}

		?>
		<div id="message" class="notice notice-success ilovewp-notice ilovewp-upgrade-notice">
			<a class="ilovewp-message-close notice-dismiss" href="<?php echo esc_url( $dismiss_url ); ?>"></a>
			<div class="ilovewp-message-content">

				<div class="ilovewp-message-image">
					<a href="<?php echo esc_url( admin_url( 'themes.php?page=city_hall-doc' ) ); ?>"><img class="ilovewp-screenshot" src="<?php echo esc_url( get_template_directory_uri() ); ?>/screenshot.png" alt="<?php esc_attr_e( 'City Hall Theme', 'city-hall' ); ?>" /></a>
				</div><!-- ws fix
				--><div class="ilovewp-message-text">
				
					<p>
						<?php
						printf(
							/* Translators: %1$s current user display name. */
							esc_html__(
								'Dear %1$s! %3$sIf you like using this theme, you’ll love Magma—a fantastic, high-performance theme designed to help you build a professional WordPress website with ease. %4$s is fast, flexible, and built for content-driven websites, giving you full control without unnecessary bloat.',
								'city-hall'
							),
							'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
							'<a href="' . esc_url( admin_url( 'themes.php?page=city_hall-doc' ) ) . '">' . esc_html( $theme_data->Name ) . ' Theme</a>',
							'<br>',
							'<strong><a href="https://www.ilovewp.com/product/magma/?utm_source=dashboard&utm_medium=magma-notice&utm_campaign=city_hall&utm_content=magma-notice">Magma</a></strong>');
						?>
					</p>

					<p class="notice-buttons"><a href="https://www.ilovewp.com/product/magma/?utm_source=dashboard&utm_medium=magma-notice&utm_campaign=city_hall&utm_content=magma-notice" class="btn button button-primary ilovewp-button" target="_blank"><?php esc_html_e( 'Discover Magma today!', 'city-hall' ); ?></a> <a href="https://www.youtube.com/watch?v=pxNKBXG4clY" target="_blank" rel="noopener" class="button button-primary ilovewp-button ilovewp-button-youtube"><span class="dashicons dashicons-youtube"></span> <?php esc_html_e( 'Magma Video Guide', 'city-hall' ); ?></a></p>

				</div><!-- .ilovewp-message-text -->

			</div><!-- .ilovewp-message-content -->

		</div><!-- #message -->
		<?php
	}
}

new city_hall_notice_magma();