<?php
/**
 * Front page: the clinic home sections, full width, no page title band.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();

if ( have_posts() && is_page() ) {
	while ( have_posts() ) {
		the_post();
		the_content();
	}
} elseif ( shortcode_exists( 'clinic_home' ) ) {
	echo do_shortcode( '[clinic_home]' );
} else {
	?>
	<div class="container content-wrap">
		<h1><?php bloginfo( 'name' ); ?></h1>
		<p><?php esc_html_e( 'Activate the Clinic Portal plugin to show the clinic home page here.', 'clinic-care' ); ?></p>
	</div>
	<?php
}

get_footer();
