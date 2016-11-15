<?php

/**
 * Template for Slide Option Metabox
 * 
 * @package 	WP_Fullpage\Includes\Metaboxes\Views
 */

?>
<div class="container wpfp-wrap">

	<h3 class="teal-text text-lighten-1 center-align"><?php _e( 'WP Fullpage Slide Options', WPFP_DOMAIN ); ?><i class="material-icons medium yellow-text text-accent-2 over-rotate right">stay_current_landscape</i></h3>
	
	<p class="teal-text text-lighten-1 center-align flow-text"><?php _e( 'Here you can setup your FullPage Slide.', WPFP_DOMAIN ); ?></p>

	<ul id="wpfp-settingsbox" class="collapsible popout z-depth-3" data-collapsible="expandable">
		
		<li><!-- Styling -->
			<div class="collapsible-header teal-text text-lighten-1 flow-text waves-effect waves-light"><i class="material-icons red-text text-lighten-2">stars</i><?php _e( 'Styling', WPFP_DOMAIN ); ?></div>
			<div class="collapsible-body">
				
				<ul class="m-tabs">
					<li class="tab col s6"><a href="#slide-styling-general" class="active"><?php _e( 'General Parameters', WPFP_DOMAIN ); ?></a></li>
					<li class="tab col s6"><a href="#slide-styling-design"><?php _e( 'Design Parameters', WPFP_DOMAIN ); ?></a></li>
				</ul>

				<div id="slide-styling-general" class="col s12">

					<div class="row"><!-- Vertical Position -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Vertical Position', WPFP_DOMAIN ), 'verticalPosition' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'Vertical position of the content within slide.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->select( WPFP_SLIDE_PT_SLIDE_OPTIONS, 'verticalPosition', array(
									'inherit' => __( 'Inherit from Section', WPFP_DOMAIN ),
									'middle' => __( 'Middle', WPFP_DOMAIN ),
									'top'    => __( 'Top', WPFP_DOMAIN ),
									'bottom' => __( 'Bottom', WPFP_DOMAIN ),
								), isset( $verticalPosition ) ? $verticalPosition : 'inherit', 'inherit' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Vertical Position -->

					<div class="row"><!-- Horizontal Position -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Horizontal Position', WPFP_DOMAIN ), 'horizontalPosition' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'Horizontal position of the content within slide.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->select( WPFP_SLIDE_PT_SLIDE_OPTIONS, 'horizontalPosition', array(
									'inherit' => __( 'Inherit from Section', WPFP_DOMAIN ),
									'center' => __( 'Center', WPFP_DOMAIN ),
									'left'   => __( 'Left', WPFP_DOMAIN ),
									'right'  => __( 'Right', WPFP_DOMAIN ),
								), isset( $horizontalPosition ) ? $horizontalPosition : 'inherit', 'inherit' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Horizontal Position -->

				</div>

				<div id="slide-styling-design" class="col s12">

					<div class="row"><!-- Slides Color -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Slide Color', WPFP_DOMAIN ), 'slideColor' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'Define the CSS background-color property for the slide. If empty, will use the section option.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->text( WPFP_SLIDE_PT_SLIDE_OPTIONS, 'slideColor', isset( $slideColor ) ? $slideColor : '', isset( $SLIDECOLOR ) ? $SLIDECOLOR : '', __( 'eg: #ffffff, white, ...', WPFP_DOMAIN ), 'wpfp-color' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Slides Color -->

				</div>

			</div>
		</li><!-- Styling -->
			
		<li><!-- Content Styling -->
			<div class="collapsible-header teal-text text-lighten-1 flow-text waves-effect waves-light"><i class="material-icons red-text text-lighten-2">view_carousel</i><?php _e( 'Content Styling', WPFP_DOMAIN ); ?></div>
			<div class="collapsible-body">
				
				<ul class="m-tabs">
					<li class="tab col s6"><a href="#slide-content-styling-general" class="active"><?php _e( 'General Parameters', WPFP_DOMAIN ); ?></a></li>
					<li class="tab col s6"><a href="#slide-content-styling-design"><?php _e( 'Design Parameters', WPFP_DOMAIN ); ?></a></li>
				</ul>

				<div id="slide-content-styling-general" class="col s12">

					<div class="row"><!-- Display Title -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php WPFP_Helpers()->span_label( __( 'Display Title', WPFP_DOMAIN ) ); ?>
										
							<?php

								WPFP_Helpers()->tooltip( __( 'Whether you want to display post title in this slide.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->select( WPFP_SLIDE_PT_SLIDE_OPTIONS, 'displayTitle', array(
									'inherit' => __( 'Inherit from Section', WPFP_DOMAIN ),
									'yes'     => __( 'Yes', WPFP_DOMAIN ),
									'no'      => __( 'No', WPFP_DOMAIN ),
								), isset( $displayTitle ) ? $displayTitle : 'inherit', 'inherit' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Display Title -->

					<div class="row"><!-- Display Section Title -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php WPFP_Helpers()->span_label( __( 'Display Section Title', WPFP_DOMAIN ) ); ?>
										
							<?php

								WPFP_Helpers()->tooltip( __( 'Whether you want to display section title in this slide.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->select( WPFP_SLIDE_PT_SLIDE_OPTIONS, 'displaySectionTitle', array(
									'inherit' => __( 'Inherit from Section', WPFP_DOMAIN ),
									'yes'     => __( 'Yes', WPFP_DOMAIN ),
									'no'      => __( 'No', WPFP_DOMAIN ),
								), isset( $displaySectionTitle ) ? $displaySectionTitle : 'inherit', 'inherit' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Display Section Title -->

					<div class="row"><!-- Display Date -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php WPFP_Helpers()->span_label( __( 'Display Date', WPFP_DOMAIN ) ); ?>
										
							<?php

								WPFP_Helpers()->tooltip( __( 'Whether you want to display post date in this slide.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->select( WPFP_SLIDE_PT_SLIDE_OPTIONS, 'displayDate', array(
									'inherit' => __( 'Inherit from Section', WPFP_DOMAIN ),
									'yes'     => __( 'Yes', WPFP_DOMAIN ),
									'no'      => __( 'No', WPFP_DOMAIN ),
								), isset( $displayDate ) ? $displayDate : 'inherit', 'inherit' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Display Date -->

					<div class="row"><!-- Display Author -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php WPFP_Helpers()->span_label( __( 'Display Author', WPFP_DOMAIN ) ); ?>
										
							<?php

								WPFP_Helpers()->tooltip( __( 'Whether you want to display post author in this slide.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>
							
							<?php

								WPFP_Helpers()->select( WPFP_SLIDE_PT_SLIDE_OPTIONS, 'displayAuthor', array(
									'inherit' => __( 'Inherit from Section', WPFP_DOMAIN ),
									'yes'     => __( 'Yes', WPFP_DOMAIN ),
									'no'      => __( 'No', WPFP_DOMAIN ),
								), isset( $displayAuthor ) ? $displayAuthor : 'inherit', 'inherit' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Display Author -->

				</div>

				<div id="slide-content-styling-design" class="col s12">

					<div class="row"><!-- Content Width -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Content Width', WPFP_DOMAIN ), 'contentWidth' );

							?>
										
							<?php

								WPFP_Helpers()->tooltip( __( 'The content width of this slide in "%". If set to "0", will inherit the section&apos;s content width.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->number( WPFP_SLIDE_PT_SLIDE_OPTIONS, 'contentWidth', isset( $contentWidth ) ? $contentWidth : 0, 0, 0, 100, 1, 'small-text' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Content Width -->

					<div class="row"><!-- Content Inner Horizontal Margin -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Content Inner Horizontal Margin', WPFP_DOMAIN ), 'contentInnerHMargin' );

							?>
										
							<?php

								WPFP_Helpers()->tooltip( __( 'The content inner horizontal margin of this slide in "%". If set to "0", will inherit the section&apos;s content inner margin.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->number( WPFP_SLIDE_PT_SLIDE_OPTIONS, 'contentInnerHMargin', isset( $contentInnerHMargin ) ? $contentInnerHMargin : 0, 0, 0, 100, 1, 'small-text' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Content Inner Horizontal Margin -->

					<div class="row"><!-- Content Inner Vertical Margin -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Content Inner Vertical Margin', WPFP_DOMAIN ), 'contentInnerVMargin' );

							?>
										
							<?php

								WPFP_Helpers()->tooltip( __( 'The content inner vertical margin of this slide in "%". If set to "0", will inherit the section&apos;s content inner margin.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->number( WPFP_SLIDE_PT_SLIDE_OPTIONS, 'contentInnerVMargin', isset( $contentInnerVMargin ) ? $contentInnerVMargin : 0, 0, 0, 100, 1, 'small-text' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Content Inner Vertical Margin -->

					<div class="row"><!-- Content Background Color -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Content Background-Color', WPFP_DOMAIN ), 'contentBackgroundColor' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'The content background-color of this slide. If empty, will inherit the section&apos;s background-color.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->text( WPFP_SLIDE_PT_SLIDE_OPTIONS, 'contentBackgroundColor', isset( $contentBackgroundColor ) ? $contentBackgroundColor : '', '', __( 'eg: #ffffff, white, ...', WPFP_DOMAIN ), 'wpfp-color' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>

					</div><!-- Content Background Color -->

					<div class="row"><!-- Content Style -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Content Style', WPFP_DOMAIN ), 'contentStyle' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'The content style of this slide. If empty, will inherit the section&apos;s content style.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>
						
							<?php WPFP_Helpers()->div_helper( __( 'eg:', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">margin-top</span>: 20px;', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">margin-bottom</span>: 30px; ...', WPFP_DOMAIN ) ); ?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->ace_textarea( WPFP_SLIDE_PT_SLIDE_OPTIONS, 'contentStyle', isset( $contentStyle ) ? $contentStyle : '', '', '', 'ace-css' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>

					</div><!-- Content Style -->

					<div class="row"><!-- Inner Content Style -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Inner Content Style', WPFP_DOMAIN ), 'innerContentStyle' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'The inner content style of this slide. If empty, will inherit the section&apos;s content style.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>
						
							<?php WPFP_Helpers()->div_helper( __( 'eg:', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">margin-top</span>: 20px;', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">margin-bottom</span>: 30px; ...', WPFP_DOMAIN ) ); ?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->ace_textarea( WPFP_SLIDE_PT_SLIDE_OPTIONS, 'innerContentStyle', isset( $innerContentStyle ) ? $innerContentStyle : '', '', '', 'ace-css' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>

					</div><!-- Inner Content Style -->

				</div>

			</div>
		</li><!-- Content Styling -->
		
		<li><!-- Navigation -->
			<div class="collapsible-header teal-text text-lighten-1 flow-text waves-effect waves-light"><i class="material-icons red-text text-lighten-2">navigation</i><?php _e( 'Navigation', WPFP_DOMAIN ); ?></div>
			<div class="collapsible-body">

				<div class="row"><!-- Slides Navigation Title -->

					<?php WPFP_Helpers()->input_field_label_start(); ?>

						<?php

							WPFP_Helpers()->label( __( 'Slides Navigation Title', WPFP_DOMAIN ), 'slidesNavTitle' );

						?>

						<?php

							WPFP_Helpers()->tooltip( __( 'Which metadata do you want to use for the slides navigation tooltips in case they are being used. If the metadata is empty or does not exists, it will display the title instead. If empty, it will use the FullPage option.', WPFP_DOMAIN ), 'wpfp-tip' );

						?>

					<?php WPFP_Helpers()->input_field_label_end(); ?>

					<?php WPFP_Helpers()->input_field_start(); ?>

						<?php

							WPFP_Helpers()->text( WPFP_SLIDE_PT_SLIDE_OPTIONS, 'slidesNavTitle', isset( $slidesNavTitle ) ? $slidesNavTitle : '', isset( $SLIDESNAVTITLE ) ? $SLIDESNAVTITLE : '', __( 'eg: my_metadata', WPFP_DOMAIN ) );

						?>

					<?php WPFP_Helpers()->input_field_end(); ?>
				
				</div><!-- Slides Navigation Title -->

			</div>
		</li><!-- Navigation -->

	</ul>

	<?php WPFP_Helpers()->modal_reset(); ?>

	<div class="clear"></div>

</div>