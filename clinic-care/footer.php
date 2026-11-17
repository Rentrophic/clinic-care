<?php
/**
 * Site footer. The Crisp live chat script is printed here by the plugin
 * through the wp_footer hook once a Website ID is saved in Settings, Clinic Portal.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$phone = clinic_care_opt( 'phone' );
$emg   = clinic_care_opt( 'emergency_phone' );
$mail  = clinic_care_opt( 'email' );
$addr  = clinic_care_opt( 'address' );
$tel   = function ( $n ) {
	return 'tel:' . preg_replace( '/[^\d+]/', '', $n );
};
$crisp_on = function_exists( 'clinic_opt' ) && preg_match( '/^[0-9a-fA-F\-]{36}$/', (string) clinic_opt( 'crisp_id' ) );
?>
</main>

<footer class="site-footer">
	<div class="container footer-grid">
		<div class="footer-brand">
			<a class="site-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php echo clinic_care_brand_mark(); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				<span class="site-brand__text"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
			</a>
			<p>Compassionate, modern care for the whole family, with online registration and booking.</p>
			<?php if ( $crisp_on ) : ?>
				<span class="crisp-hint"><?php echo clinic_care_icon( 'chat', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?> Live chat available, look for the chat bubble</span>
			<?php endif; ?>
		</div>

		<nav aria-label="<?php esc_attr_e( 'Footer', 'clinic-care' ); ?>">
			<h2><?php esc_html_e( 'Quick links', 'clinic-care' ); ?></h2>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'container'      => false,
					'menu_class'     => 'footer-list',
					'fallback_cb'    => false,
					'depth'          => 1,
				)
			);
			?>
			<ul class="footer-list" style="margin-top:8px">
				<li><a href="<?php echo esc_url( clinic_care_url( 'staff-dashboard' ) ); ?>"><?php esc_html_e( 'Staff sign in', 'clinic-care' ); ?></a></li>
			</ul>
		</nav>

		<div>
			<h2><?php esc_html_e( 'Contact', 'clinic-care' ); ?></h2>
			<ul class="footer-list">
				<?php if ( $phone ) : ?><li><?php echo clinic_care_icon( 'phone', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><a href="<?php echo esc_url( $tel( $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></li><?php endif; ?>
				<?php if ( $emg ) : ?><li><?php echo clinic_care_icon( 'alert', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span>Emergency: <a href="<?php echo esc_url( $tel( $emg ) ); ?>"><?php echo esc_html( $emg ); ?></a></span></li><?php endif; ?>
				<?php if ( $mail ) : ?><li><?php echo clinic_care_icon( 'mail', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><a href="mailto:<?php echo esc_attr( $mail ); ?>"><?php echo esc_html( $mail ); ?></a></li><?php endif; ?>
				<?php if ( $addr ) : ?><li><?php echo clinic_care_icon( 'pin', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php echo esc_html( $addr ); ?></span></li><?php endif; ?>
			</ul>
		</div>

		<div>
			<h2><?php esc_html_e( 'Opening hours', 'clinic-care' ); ?></h2>
			<?php if ( function_exists( 'clinic_hours_rows' ) ) : ?>
				<table class="footer-hours">
					<?php foreach ( clinic_hours_rows() as $row ) : ?>
						<tr><th scope="row"><?php echo esc_html( $row[0] ); ?></th><td><?php echo esc_html( $row[1] ); ?></td></tr>
					<?php endforeach; ?>
				</table>
			<?php endif; ?>
		</div>
	</div>

	<div class="container footer-bottom">
		<span>Copyright <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>. All rights reserved.</span>
		<p class="footer-disclaimer">This website does not give emergency or diagnostic services. In an emergency call the hotline above or 911.</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
