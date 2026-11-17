<?php
/**
 * 404 page.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>
<div class="container not-found">
	<h1>404</h1>
	<h2><?php esc_html_e( 'We could not find that page', 'clinic-care' ); ?></h2>
	<p><?php esc_html_e( 'The link may be old or mistyped. Try one of these instead.', 'clinic-care' ); ?></p>
	<p>
		<a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to home', 'clinic-care' ); ?></a>
		<a class="btn" style="background:#fff;color:#0b5cab;border-color:#dbeafe" href="<?php echo esc_url( clinic_care_url( 'book-appointment' ) ); ?>"><?php esc_html_e( 'Book an appointment', 'clinic-care' ); ?></a>
	</p>
</div>
<?php
get_footer();
