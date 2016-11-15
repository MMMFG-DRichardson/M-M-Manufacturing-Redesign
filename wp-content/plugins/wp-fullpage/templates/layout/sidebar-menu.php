<?php
/**
 * The Sidebar containing the complete menu
 * 
 * @package 	WP_Fullpage\Templates\Layout
 */
?>

<?php

	$orientation = WPFP_Query()->fullpage->fullpage_options['fullNavigationOrientation'];

	WPFP_Helpers()->ob_start();

?>

	<?php

	foreach( WPFP_Query()->sections as $key1 => $section ) :

	?>

		<li>
			<?php 

			if( 1 < count( $section->slides ) ) : 

			?>

				<a data-activates="navigation-<?php print $section->post_name ?>" class="dropdown-button" data-href="#<?php print $section->post_name ?>">
					<?php print WPFP_Query()->get_section_nav_title( $key1 ); ?>
				</a>

			<?php

			else :

			?>

				<a data-activates="navigation-<?php print $section->post_name ?>" class="dropdown-button" href="#<?php print $section->post_name ?>">
					<?php print WPFP_Query()->get_section_nav_title( $key1 ); ?>
				</a>

			<?php

			endif;

			?>

			<ul id="navigation-<?php print $section->post_name ?>" class="dropdown-content">

			<?php 

			if( 1 < count( $section->slides ) ) : 

				foreach( $section->slides as $key2 => $slide ) :

				?>

					<li>
						<a href="#<?php print $section->post_name ?>/<?php print $slide->post_name ?>" data-section="<?php print $key1 + 1; ?>" data-slide="<?php print $key2; ?>">
							<?php print WPFP_Query()->get_slide_nav_title( $key1, $key2 ); ?>
						</a>
					</li>

				<?php 

				endforeach; 

			endif;

			?>

			</ul>

		</li>

		<?php

	endforeach;

	?>

<?php 
	
	$nav = WPFP_Helpers()->ob_get_clean();

?>

<nav id="wpfp-navmenu">

	<div class="nav-wrapper">
		
		<a href="#" data-activates="wpfp-sidemenu" class="button-collapse dashicons dashicons-menu"></a>

		<ul id="wpfp-menu" class="<?php print $orientation; ?> wpfp-menu hide-on-med-and-down">

			<?php print $nav; ?>

		</ul>
		
		<ul id="wpfp-sidemenu" class="side-nav wpfp-menu">
			
			<?php print str_replace( 'navigation-', 'sidenavigation-', $nav ); ?>
		
		</ul>

	</div>

</nav>