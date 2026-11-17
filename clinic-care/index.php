<?php
/**
 * Blog index, archives and search results.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();

if ( is_search() ) {
	/* translators: %s: search query */
	$title = sprintf( __( 'Search results for "%s"', 'clinic-care' ), get_search_query() );
} elseif ( is_archive() ) {
	$title = get_the_archive_title();
} else {
	$title = __( 'News and updates', 'clinic-care' );
}
?>
<header class="page-hero">
	<div class="container">
		<p class="breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'clinic-care' ); ?></a></p>
		<h1><?php echo esc_html( $title ); ?></h1>
	</div>
</header>

<div class="container content-wrap">
	<?php if ( have_posts() ) : ?>
		<div class="post-grid">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article <?php post_class( 'post-card' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<a class="post-card__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true"><?php the_post_thumbnail( 'medium_large' ); ?></a>
					<?php endif; ?>
					<div class="post-card__body">
						<p class="entry-meta"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></p>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 26 ) ); ?></p>
						<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'clinic-care' ); ?><span class="screen-reader-text"> <?php the_title(); ?></span></a>
					</div>
				</article>
			<?php endwhile; ?>
		</div>
		<nav class="pagination" aria-label="<?php esc_attr_e( 'Pagination', 'clinic-care' ); ?>">
			<?php the_posts_pagination(); ?>
		</nav>
	<?php else : ?>
		<p><?php esc_html_e( 'Nothing found. Try another search.', 'clinic-care' ); ?></p>
		<?php get_search_form(); ?>
	<?php endif; ?>
</div>
<?php
get_footer();
