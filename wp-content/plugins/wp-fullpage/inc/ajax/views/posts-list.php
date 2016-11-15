<?php

/**
 * The Posts List Template
 * 
 * @package 	WP_Fullpage\Includes\Ajax\Views
 */

?>

<div class="bbm-modal__topbar teal darken-2 row">

	<h2 class="bbm-modal__title grey-text text-lighten-4 col s5">
		<?php
			print esc_html( $title );
			
			if ( ! empty( $_REQUEST['s'] ) )
				printf( ' <span class="subtitle">' . __( 'Search results for &#8220;%s&#8221;', WPFP_DOMAIN ) . '</span>', get_search_query() );
		?>
	</h2>

	<?php $wp_list_table->views(); ?>

	<?php $wp_list_table->search_box( $post_type_object->labels->search_items, 'post' ); ?>

</div>

<div class="bbm-modal__section row">

	<?php $wp_list_table->display(); ?>

	<br class="clear" />

</div>

<div class="bbm-modal__bottombar row">
	
	<?php

	$wp_list_table->extra_tablenav();

	?>

	<div class="col s2">
		<a class="btn teal-text text-lighten-1 grey lighten-4 waves-effect <?php print WPFP_BBM_CLOSE_BUTTON; ?>"><?php _e( 'Close', WPFP_DOMAIN ); ?><i class="material-icons yellow-text text-accent-2 left">not_interested</i></a>			
	</div>
	<div class="col s2">
		<a class="btn grey-text text-lighten-4 waves-effect <?php print WPFP_BBM_ADD_BUTTON; ?>"><?php _e( 'Add', WPFP_DOMAIN ); ?><i class="material-icons yellow-text text-accent-2 right">library_add</i></a>
	</div>

</div>
