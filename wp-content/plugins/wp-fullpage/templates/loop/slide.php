<?php
/**
 * The template for displaying all slides
 *
 * This is the template that displays all slides by default.
 * Please note that this is the WP Fullpage construct of slides and that
 * other 'pages' on your WordPress site will use a different template.
 * 
 * @package 	WP_Fullpage\Templates\Loop
 */
?>

<div class="slide <?php print WPFP_Query()->slide->post_name; ?> <?php WPFP_Query()->get_slide_position(); ?>" data-anchor="<?php print WPFP_Query()->slide->post_name; ?>" data-bg="<?php print WPFP_Query()->get_slide_bg(); ?>">

	<article <?php post_class( '', WPFP_Query()->get_slide_ID() ); ?>>

		<div class="inner-slide">
			
			<header>
				
				<?php

					if( WPFP_Query()->display_section_title() ) :

				?>

					<div class="entry-meta icon">
						<span class="section-link">
							<a href="#<?php print WPFP_Query()->section->post_name; ?>" title="<?php print esc_attr( WPFP_Query()->get_section_title( 0, '', '', false ) ); ?>">
								<?php WPFP_Query()->get_section_title(); ?>
							</a>
						</span>
					</div>

				<?php

					endif;

				?>
				
				<?php

					if( WPFP_Query()->display_title() ) :

				?>

					<?php WPFP_Query()->get_slide_title( 0, '<h2 class="entry-title icon">', '</h2>' ); ?>
			
				<?php

					endif;

				?>
				
				<div class="entry-meta">
					
					<?php

						if( WPFP_Query()->display_date() ) :

					?>
						<span class="entry-date">
							<time class="entry-date" datetime="<?php print esc_attr( WPFP_Query()->get_slide_date( 0, 'c' ) ); ?>">
								<?php WPFP_Query()->get_slide_date(); ?>
							</time>
						</span>&nbsp;
					<?php

						endif;

					?>

					<?php

						if( WPFP_Query()->display_author() ) :

					?>
						<span class="entry-author vcard">
							<?php WPFP_Query()->get_slide_author(); ?>
						</span>&nbsp;
					<?php

						endif;

					?>

					<?php edit_post_link( __( 'Edit', WPFP_DOMAIN ), '<span class="edit-link">', '</span>', WPFP_Query()->get_slide_ID() ); ?>
				
				</div>

			</header>

			<div class="entry-content">
				<?php WPFP_Query()->get_content(); ?>
			</div>

		</div>

	</article>

</div><!-- .slide -->
