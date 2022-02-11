<?php
/**
 * The template used for displaying content single
 *
 * @package neila
 */
?>
						<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

							<div class="post-image">
								<?php if ( has_post_thumbnail() ) : 

										$neila_thumb_size = get_theme_mod( 'neila_sidebar_position' );
										if ((isset($neila_thumb_size)) && ($neila_thumb_size == 'mz-full-width')) $neila_thumbnail = 'neila-large-thumbnail';
										else $neila_thumbnail = 'neila-middle-thumbnail';

									?>
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php the_post_thumbnail( $neila_thumbnail ); ?>
									</a>
								<?php endif; ?>
							</div>

							<div class="post-header">
								<div class="post-cats">
								<span class="cat"><?php the_category( ' ' ); ?></span>
								</div>
								<h1><?php the_title(); ?></h1>

								<?php if ( 'post' == get_post_type() ) : ?>
									<span class="date"><i class="fa fa-comment-o"></i><?php the_date(); ?></span>
									<span class="date"><?php the_author_posts_link(); ?></span>
									<?php
										edit_post_link(
											sprintf(
												/* translators: %s: Name of current post */
												esc_html__( 'Edit %s', 'neila' ),
												the_title( '<span class="screen-reader-text">"', '"</span>', false )
											),
											'<span class="edit-link">',
											'</span>'
										);
								endif; ?>

							</div>

							<div class="post-entry">
								<?php the_content(); ?>
								<?php			
								wp_link_pages( array(
									'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'neila' ) . '</span>',
									'after'       => '</div>',
									'link_before' => '<span>',
									'link_after'  => '</span>',
									'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'neila' ) . ' </span>%',
									'separator'   => '<span class="screen-reader-text">, </span>',
								) );
								?>
							</div>

							<div class="post-meta">
								<?php if(has_tag()) : ?>
								<!-- tags -->
								<div class="entry-tags">
									<span>
										<i class="fa fa-tags"></i>
									</span>
									<?php
										$tags = get_the_tags(get_the_ID());
										foreach($tags as $tag){
											echo '<a href="'.esc_url(get_tag_link($tag->term_id)).'">'.esc_html($tag->name).'</a> ';
										}
									?>

								</div>
								<!-- end tags -->
								<?php endif; ?>
							</div>
							
						</article>