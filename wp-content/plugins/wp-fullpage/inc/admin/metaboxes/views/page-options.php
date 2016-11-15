<?php

/**
 * Template for Fullpage Option Metabox
 * 
 * @package 	WP_Fullpage\Includes\Metaboxes\Views
 */

?>

<div id="fullpage-page-options">

	<div class="row"><!-- Is it a FullPage ? -->

		<?php WPFP_Helpers()->input_field_label_start(); ?>

			<?php WPFP_Helpers()->span_label( __( 'Is it a FullPage?', WPFP_DOMAIN ) ); ?>

			<?php

				WPFP_Helpers()->tooltip( __( 'Do you want to transform this page into a FullPage?', WPFP_DOMAIN ), 'wpfp-tip' );

			?>

		<?php WPFP_Helpers()->input_field_label_end(); ?>

		<?php WPFP_Helpers()->input_field_start(); ?>

			<?php

				WPFP_Helpers()->switch_button( WPFP_FULLPAGE_PT_FULLPAGE_OPTIONS, 'isItFullpage', array(
					'yes' => __( 'yes', WPFP_DOMAIN ),
					'no'  => __( 'no', WPFP_DOMAIN ),
				), isset( $isItFullpage ) ? $isItFullpage : 'no', isset( $ISITFULLPAGE ) ? $ISITFULLPAGE : 'no' );

			?>

		<?php WPFP_Helpers()->input_field_end(); ?>
	
	</div><!-- Is it a FullPage ? -->

</div>
