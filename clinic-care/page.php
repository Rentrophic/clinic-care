<?php
/**
 * Pages. Portal pages (built from Clinic Portal shortcodes) get a title band
 * and full width sections; ordinary pages get a readable content column.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();

while ( have_posts() ) :
	the_post();
	$portal = clinic_care_is_portal_page();
	?>
	<header class="page-hero">
		<div class="container">
			<p class="breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'clinic-care' ); ?></a> / <?php the_title(); ?></p>
			<h1><?php the_title(); ?></h1>
			<?php if ( has_excerpt() ) : ?>
				<p><?php echo esc_html( get_the_excerpt() ); ?></p>
			<?php endif; ?>
		</div>
	</header>

	<?php if ( $portal ) : ?>
		<?php the_content(); ?>
	<?php else : ?>
		<div class="container content-wrap">
			<div class="entry-content"><?php the_content(); ?></div>
		</div>
	<?php endif; ?>
	<?php
endwhile;

get_footer();
