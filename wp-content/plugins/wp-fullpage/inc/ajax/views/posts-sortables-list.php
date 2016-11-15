<?php

/**
 * The Posts Sortables List Template
 * 
 * @package 	WP_Fullpage\Includes\Ajax\Views
 */

?>
	
<?php
	if( have_posts() ) :
?>

	<ul id="<?php print $sortable_id; ?>" class="wpfp-sortables collection">

		<?php
			while( have_posts() ) : the_post();
		?>

			<li class="wpfp-sortable-item collection-item" data-id="<?php the_ID(); ?>">
				<div>
					<i class="move-cursor material-icons tiny teal-text text-lighten-2 left">swap_vert</i>
					<span class="wpfp-sortable-item-title"><?php printf( '(%2s) %1s', get_the_ID(), get_the_title() ); ?></span>
					<a href="#" class="wpfp-remove-sortable-item">
						<i class="material-icons tiny teal-text text-lighten-2 right">delete</i>
					</a>
				</div>
			</li>
		
		<?php
			endwhile;
		?>

	</ul>

<?php
	else :
?>

	<div id="<?php print $sortable_id; ?>" class="collection">
		<li class="collection-item">
			<?php print $empty_text; ?>
		</li>
	</div>

<?php
	endif;
?>