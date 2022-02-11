<?php
/**
 * Template Name: Full Width (no sidebar)
 *
 * This is the template that displays full width page without sidebar
 *
 * @package neila
 */

$neila_page_comments = get_theme_mod( 'neila_page_comments' );
$neila_page_comments = isset($neila_page_comments) ? $neila_page_comments : '';

get_header(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( $neila_page_comments == 1 ) :
					if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
					endif;
					endif;
					?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->

	</div><!-- #primary -->
</div>
<?php
get_footer();
