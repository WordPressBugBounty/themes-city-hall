<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class city_hall_notice_review extends city_hall_notice {

	public function __construct() {

		add_action( 'wp_loaded', array( $this, 'review_notice' ), 20 );
		add_action( 'wp_loaded', array( $this, 'hide_notices' ), 15 );

		$this->current_user_id       = get_current_user_id();

	}

	public function review_notice() {
		
		if ( ! get_option( 'city_hall_theme_installed_time' ) ) {
			update_option( 'city_hall_theme_installed_time', time() );
		}

		$this_notice_was_dismissed = $this->get_notice_status('review-user-' . $this->current_user_id);
		
		if ( !$this_notice_was_dismissed ) {
			add_action( 'admin_notices', array( $this, 'review_notice_markup' ) ); // Display this notice.
		}

	}

	/**
	 * Show HTML markup if conditions meet.
	 */
	public function review_notice_markup() {
		
		$dismiss_url = wp_nonce_url(
			remove_query_arg( array( 'activated' ), add_query_arg( 'city-hall-hide-notice', 'review-user-' . $this->current_user_id ) ),
			'city_hall_hide_notices_nonce',
			'_city_hall_notice_nonce'
		);

		$theme_data	 	= wp_get_theme();
		$current_user 	= wp_get_current_user();

		if ( ( get_option( 'city_hall_theme_installed_time' ) > strtotime( '-21 day' ) ) ) {
			return;
		}

		?>
		<div id="message" class="notice notice-success ilovewp-notice ilovewp-review-notice">
			<a class="ilovewp-message-close notice-dismiss" href="<?php echo esc_url( $dismiss_url ); ?>"></a>
			<div class="ilovewp-message-content">

				<div class="ilovewp-message-image">
					<a href="<?php echo esc_url( admin_url( 'themes.php?page=city-hall-doc' ) ); ?>"><img class="ilovewp-screenshot" src="<?php echo esc_url( get_template_directory_uri() ); ?>/screenshot.png" alt="<?php esc_attr_e( 'City Hall', 'city-hall' ); ?>" /></a>
				</div><!-- ws fix
				--><div class="ilovewp-message-text">
				
					<p>
						<?php
						printf(
							/* Translators: %1$s current user display name. */
							esc_html__(
								'Dear %1$s! We hope you are happy with everything that the %2$s has to offer. %3$sIf you can spare a moment, please consider adding a rating for %4$s on WordPress.org. %3$sIt helps us continue providing updates and support for this theme.',
								'city-hall'
							),
							'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
							'<a href="' . esc_url( admin_url( 'themes.php?page=city-hall-doc' ) ) . '"><strong>' . esc_html( $theme_data->Name ) . ' Theme</strong></a>',
							'<br>',
							esc_html( $theme_data->Name )
						);
						?>
					</p>

					<p class="notice-buttons"><a href="https://wordpress.org/support/theme/city-hall/reviews/#new-post" class="btn button button-primary ilovewp-button" target="_blank"><span class="dashicons dashicons-awards"></span> <?php esc_html_e( 'Add a Rating for City Hall', 'city-hall' ); ?></a>
					<a href="<?php echo esc_url( $dismiss_url ); ?>" class="btn button button-secondary"><?php esc_html_e( 'Hide this notice', 'city-hall' ); ?></a>
					<a href="<?php echo esc_url( admin_url( 'themes.php?page=city-hall-doc' ) ); ?>" class="btn button button-secondary" target="_blank"><span><?php esc_html_e( 'Theme Help', 'city-hall' ); ?></span>
					</a></p>

				</div><!-- .ilovewp-message-text -->

			</div><!-- .ilovewp-message-content -->

		</div><!-- #message -->
		<?php
	}
}

new city_hall_notice_review();