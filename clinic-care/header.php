<?php
/**
 * Site header.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$phone     = clinic_care_opt( 'phone' );
$emergency = clinic_care_opt( 'emergency_phone' );
$tel       = function ( $n ) {
	return 'tel:' . preg_replace( '/[^\d+]/', '', $n );
};
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#0b5cab">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#content"><?php esc_html_e( 'Skip to content', 'clinic-care' ); ?></a>

<div class="cp-topbar">
	<div class="container cp-topbar__inner">
		<?php if ( $emergency ) : ?>
			<span class="cp-topbar__item"><?php echo clinic_care_icon( 'alert', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?> Emergency 24/7: <a href="<?php echo esc_url( $tel( $emergency ) ); ?>"><?php echo esc_html( $emergency ); ?></a></span>
		<?php endif; ?>
		<?php if ( $phone ) : ?>
			<span class="cp-topbar__item cp-topbar__item--hide"><?php echo clinic_care_icon( 'phone', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?> Clinic: <a href="<?php echo esc_url( $tel( $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></span>
		<?php endif; ?>
		<span class="cp-topbar__item cp-topbar__item--hide"><?php echo clinic_care_icon( 'clock', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?> Mon to Sat, see <a href="<?php echo esc_url( clinic_care_url( 'contact-us' ) ); ?>">opening hours</a></span>
	</div>
</div>

<header class="site-header">
	<div class="container site-header__inner">
		<a class="site-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php
			if ( has_custom_logo() ) {
				the_custom_logo();
			} else {
				echo clinic_care_brand_mark(); // phpcs:ignore WordPress.Security.EscapeOutput
				?>
				<span class="site-brand__text"><?php echo esc_html( get_bloginfo( 'name' ) ); ?><small>Medical Clinic</small></span>
			<?php } ?>
		</a>

		<button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-nav">
			<?php echo clinic_care_icon( 'menu', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			<span><?php esc_html_e( 'Menu', 'clinic-care' ); ?></span>
		</button>

		<nav id="primary-nav" class="primary-nav" aria-label="<?php esc_attr_e( 'Primary', 'clinic-care' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'menu',
					'fallback_cb'    => 'clinic_care_fallback_menu',
					'depth'          => 1,
				)
			);
			?>
			<a class="btn primary-nav__cta" href="<?php echo esc_url( clinic_care_url( 'book-appointment' ) ); ?>"><?php esc_html_e( 'Book Appointment', 'clinic-care' ); ?></a>
		</nav>

		<a class="btn header-cta" href="<?php echo esc_url( clinic_care_url( 'book-appointment' ) ); ?>"><?php esc_html_e( 'Book Appointment', 'clinic-care' ); ?></a>
	</div>
</header>

<main id="content" class="site-main">
