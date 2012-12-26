<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Homeroom
 * @since Homeroom 1.0
 */

// Search pages use Masonry to lay out the result tiles
add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_script( 'jquery-masonry' );
} );

get_header(); ?>

		<section id="primary" class="site-content">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php
						if ( is_category() ) {
								printf( __( 'Category Archives: %s', 'homeroom' ), '<span>' . single_cat_title( '', false ) . '</span>' );

						} elseif ( is_tag() ) {
							printf( __( 'Tag Archives: %s', 'homeroom' ), '<span>' . single_tag_title( '', false ) . '</span>' );

						} elseif ( is_author() ) {
							/* Queue the first post, that way we know
							 * what author we're dealing with (if that is the case).
							*/
							the_post();
							printf( __( 'Author Archives: %s', 'homeroom' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
							/* Since we called the_post() above, we need to
							 * rewind the loop back to the beginning that way
							 * we can run the loop properly, in full.
							 */
							rewind_posts();

						} elseif ( is_day() ) {
							printf( __( 'Daily Archives: %s', 'homeroom' ), '<span>' . get_the_date() . '</span>' );

						} elseif ( is_month() ) {
							printf( __( 'Monthly Archives: %s', 'homeroom' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

						} elseif ( is_year() ) {
							printf( __( 'Yearly Archives: %s', 'homeroom' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

						} else if ( is_search() ) {
							_e( 'Search Results for: ', 'homeroom' );
							get_template_part( 'searchform' );
						} else {
							_e( 'Archives', 'homeroom' );
						}
						?>
					</h1>
				</header><!-- .page-header -->

				<div id="masonry">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'search' ); ?>
				<?php endwhile; ?>
				</div>

				<div class="clearfix"></div>

				<?php homeroom_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'search' ); ?>

			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary .site-content -->

<?php get_footer(); ?>