<?php
/**
 * Single post, physician or department.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();

while ( have_posts() ) :
	the_post();
	?>
	<header class="page-hero">
		<div class="container">
			<p class="breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'clinic-care' ); ?></a> / <?php the_title(); ?></p>
			<h1><?php the_title(); ?></h1>
			<?php if ( 'post' === get_post_type() ) : ?>
				<p class="entry-meta"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></p>
			<?php endif; ?>
		</div>
	</header>
	<div class="container content-wrap">
		<article <?php post_class(); ?>>
			<?php if ( has_post_thumbnail() ) : ?>
				<figure class="entry-media" style="margin:0 0 24px;max-width:780px"><?php the_post_thumbnail( 'large' ); ?></figure>
			<?php endif; ?>
			<div class="entry-content"><?php the_content(); ?></div>
		</article>
		<?php if ( 'post' === get_post_type() ) : ?>
			<nav class="post-navigation" style="margin-top:32px" aria-label="<?php esc_attr_e( 'Posts', 'clinic-care' ); ?>">
				<?php the_post_navigation(); ?>
			</nav>
		<?php endif; ?>
	</div>
	<?php
endwhile;

get_footer();
