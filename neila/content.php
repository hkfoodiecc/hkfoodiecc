<?php
/**
 *
 * The template used for displaying articles & search results
 *
 * @package neila
 */
$neila_options = get_theme_mods();

?>
					<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<div class="post-inner-content">

							<div class="post-image">
								<?php if ( has_post_thumbnail() ) : 

										$neila_thumb_size = array_key_exists('neila_sidebar_position', $neila_options) ? $neila_options['neila_sidebar_position'] : '';
										$neila_thumbs_layout = array_key_exists('neila_thumbs_layout', $neila_options) ? $neila_options['neila_thumbs_layout'] : '';

										if ($neila_thumbs_layout == "portrait") $neila_thumbnail = 'neila-portrait-thumbnail';
										else $neila_thumbnail = 'neila-landscape-thumbnail';
										if ($neila_thumb_size == 'mz-full-width') $neila_thumbnail = 'neila-large-thumbnail';

									?>
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php echo get_the_post_thumbnail( get_the_ID(), $neila_thumbnail ); ?>
									</a>
								<?php endif; ?>
							</div>
							<div class="post-cats">
								<span class="cat"><?php the_category( ' | ' ); ?></span>
							</div>
							<div class="post-header">
								<h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							</div>
							<div class="post-entry">

								<?php the_excerpt(); ?>
								
								<p class="read-more"><a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Continue Reading...', 'neila' ); ?></a></p>
							</div>

						</div><!-- end: post-inner-content -->

					</article>
