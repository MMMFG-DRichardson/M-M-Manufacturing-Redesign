<?php

/**
 * Template for Fullpage Settings Page
 * 
 * @package 	WP_Fullpage\Includes\Settings\Views
 */

?>

<div class="container wpfp-wrap">

	<h1 class="teal-text text-lighten-1 center-align"><?php _e( 'WP Fullpage Settings', WPFP_DOMAIN ); ?><i class="material-icons large yellow-text text-accent-2 over-rotate right">stay_current_landscape</i></h1>

	<p class="teal-text text-lighten-1 center-align flow-text"><?php _e( 'Here you can define the default setup for your FullPages.', WPFP_DOMAIN ); ?></p>

	<form method="post" action="options.php">

		<?php settings_fields( 'wpfp_settings-group' );?>

		<ul id="wpfp-settingsbox" class="collapsible popout z-depth-3" data-collapsible="expandable">
			
			<li><!-- Styling -->
				<div class="collapsible-header teal-text text-lighten-1 flow-text waves-effect waves-light"><i class="material-icons red-text text-lighten-2">stars</i><?php _e( 'Styling', WPFP_DOMAIN ); ?></div>
				<div class="collapsible-body">
					
					<ul class="m-tabs">
						<li class="tab col s6"><a href="#styling-general" class="active"><?php _e( 'General Parameters', WPFP_DOMAIN ); ?></a></li>
						<li class="tab col s6"><a href="#styling-design"><?php _e( 'Design Parameters', WPFP_DOMAIN ); ?></a></li>
					</ul>

					<div id="styling-general" class="col s12">
						
						<div class="row"><!-- Resize -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php WPFP_Helpers()->span_label( __( 'Resize', WPFP_DOMAIN ) ); ?>
											
								<?php

									WPFP_Helpers()->tooltip( __( 'Whether you want to resize the text when the window is resized.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->switch_button( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'resize', array(
										'yes' => __( 'yes', WPFP_DOMAIN ),
										'no'  => __( 'no', WPFP_DOMAIN ),
									), isset( $resize ) ? $resize : 'no', 'no' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>
						
						</div><!-- Resize -->

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

									WPFP_Helpers()->select( WPFP_SETTINGS_SLIDES_OPTIONS, 'verticalPosition', array(
										'middle' => __( 'Middle', WPFP_DOMAIN ),
										'top'    => __( 'Top', WPFP_DOMAIN ),
										'bottom' => __( 'Bottom', WPFP_DOMAIN ),
									), isset( $verticalPosition ) ? $verticalPosition : 'middle', 'middle' );

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

									WPFP_Helpers()->select( WPFP_SETTINGS_SLIDES_OPTIONS, 'horizontalPosition', array(
										'center' => __( 'Center', WPFP_DOMAIN ),
										'left'   => __( 'Left', WPFP_DOMAIN ),
										'right'  => __( 'Right', WPFP_DOMAIN ),
									), isset( $horizontalPosition ) ? $horizontalPosition : 'center', 'center' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Horizontal Position -->

						<div class="row"><!-- Fixed Elements -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>
														
								<?php

									WPFP_Helpers()->label( __( 'Fixed Elements', WPFP_DOMAIN ), 'fixedElements' );

								?>
											
								<?php

									WPFP_Helpers()->tooltip( __( 'Defines which elements will be taken off the scrolling structure of the plugin which is necesary when using the css3 option to keep them fixed. It requires a string with the jQuery selectors for those elements. (eg: #element1, .element2)', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->text( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'fixedElements', isset( $fixedElements ) ? $fixedElements : '', '', __( 'eg: #element1, .element2', WPFP_DOMAIN ) );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Fixed Elements -->

						<div class="row"><!-- Responsive Width -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Responsive Width', WPFP_DOMAIN ), 'fixedElements' );

								?>
											
								<?php

									WPFP_Helpers()->tooltip( __( 'A normal scroll (autoScrolling:false) will be used under the defined width in pixels. A class fp-responsive is added to the body tag in case the user wants to use it for his own responsive CSS. For example, if set to 900, whenever the browser&apos;s width is less than 900 the plugin will scroll like a normal site.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->number( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'responsiveWidth', isset( $responsiveWidth ) ? $responsiveWidth : 0, 0, 0, 1000, 10, 'small-text' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>
						
						</div><!-- Responsive Width -->

						<div class="row"><!-- Responsive Height -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Responsive Height', WPFP_DOMAIN ), 'fixedElements' );

								?>
											
								<?php

									WPFP_Helpers()->tooltip( __( 'A normal scroll (autoScrolling:false) will be used under the defined height in pixels. A class fp-responsive is added to the body tag in case the user wants to use it for his own responsive CSS. For example, if set to 900, whenever the browser&apos;s height is less than 900 the plugin will scroll like a normal site.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->number( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'responsiveHeight', isset( $responsiveHeight ) ? $responsiveHeight : 0, 0, 0, 1000, 10, 'small-text' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>
						
						</div><!-- Responsive Height -->

						<div class="row"><!-- Auto Height -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php WPFP_Helpers()->span_label( __( 'Auto Height', WPFP_DOMAIN ) ); ?>

								<?php

									WPFP_Helpers()->tooltip( __( 'It is possible to use sections or slides which don&apos;t take the whole viewport height resulting in smaller sections. This is ideal for footers. It is important to realise that it doesn&apos;t make sense to have all of your sections using this feature. If there is more than one section in the initial load of the site, the plugin won&apos;t scroll at all to see the next one as it will be already in the viewport.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->switch_button( WPFP_SETTINGS_SECTIONS_OPTIONS, 'autoHeight', array(
										'yes' => __( 'yes', WPFP_DOMAIN ),
										'no'  => __( 'no', WPFP_DOMAIN ),
									), isset( $autoHeight ) ? $autoHeight : 'no', 'no' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Auto Height -->

						<div class="row"><!-- Background Loading Mode -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php WPFP_Helpers()->span_label( __( 'Background Loading Mode', WPFP_DOMAIN ) ); ?>

								<?php

									WPFP_Helpers()->tooltip( __( 'You can load backgrounds all at once on DOM ready or once the section / slide is loaded (Lazy loading).', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->select( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'bgLoadingMode', array(
										'all-at-once'  => __( 'All at once', WPFP_DOMAIN ),
										'lazy-loading' => __( 'Lazy loading', WPFP_DOMAIN ),
									), isset( $bgLoadingMode ) ? $bgLoadingMode : 'all-at-once', 'all-at-once' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Background Loading Mode -->

					</div>

					<div id="styling-design" class="col s12">

						<div class="row"><!-- Padding Top -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Padding Top', WPFP_DOMAIN ), 'paddingTop' );

								?>
											
								<?php

									WPFP_Helpers()->tooltip( __( 'Defines the top padding for each section with a numerical value and its measure (eg: &apos;10px&apos;, &apos;10em&apos;...) Useful in case of using a fixed header.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->text( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'paddingTop', isset( $paddingTop ) ? $paddingTop : '', '', __( 'eg: 10px', WPFP_DOMAIN ) );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Padding Top -->

						<div class="row"><!-- Padding Bottom -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Padding Bottom', WPFP_DOMAIN ), 'paddingBottom' );

								?>
											
								<?php

									WPFP_Helpers()->tooltip( __( 'Defines the bottom padding for each section with a numerical value and its measure (eg: &apos;10px&apos;, &apos;10em&apos;...). Useful in case of using a fixed footer.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->text( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'paddingBottom', isset( $paddingBottom ) ? $paddingBottom : '', '', __( 'eg: 10px', WPFP_DOMAIN ) );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Padding Bottom -->

						<div class="row"><!-- Fullpage Color -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Fullpage Color', WPFP_DOMAIN ), 'fullpageColor' );

								?>

								<?php

									WPFP_Helpers()->tooltip( __( 'Define the CSS background-color property for fullpage.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->text( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'fullpageColor', isset( $fullpageColor ) ? $fullpageColor : '', '', __( 'eg: #ffffff, white, ...', WPFP_DOMAIN ), 'wpfp-color' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Fullpage Color -->

						<div class="row"><!-- Setions Color -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Setions Color', WPFP_DOMAIN ), 'sectionColor' );

								?>

								<?php

									WPFP_Helpers()->tooltip( __( 'Define the CSS background-color property for sections.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->text( WPFP_SETTINGS_SECTIONS_OPTIONS, 'sectionColor', isset( $sectionColor ) ? $sectionColor : '', '', __( 'eg: #ffffff, white, ...', WPFP_DOMAIN ), 'wpfp-color' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Setions Color -->

						<div class="row"><!-- Slides Color -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Slides Color', WPFP_DOMAIN ), 'slideColor' );

								?>

								<?php

									WPFP_Helpers()->tooltip( __( 'Define the CSS background-color property for slides.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->text( WPFP_SETTINGS_SLIDES_OPTIONS, 'slideColor', isset( $slideColor ) ? $slideColor : '', '', __( 'eg: #ffffff, white, ...', WPFP_DOMAIN ), 'wpfp-color' );

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
						<li class="tab col s6"><a href="#content-styling-general" class="active"><?php _e( 'General Parameters', WPFP_DOMAIN ); ?></a></li>
						<li class="tab col s6"><a href="#content-styling-design"><?php _e( 'Design Parameters', WPFP_DOMAIN ); ?></a></li>
					</ul>

					<div id="content-styling-general" class="col s12">

						<div class="row"><!-- Display Title -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php WPFP_Helpers()->span_label( __( 'Display Title', WPFP_DOMAIN ) ); ?>
											
								<?php

									WPFP_Helpers()->tooltip( __( 'Whether you want to display post title in slides.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->switch_button( WPFP_SETTINGS_SLIDES_OPTIONS, 'displayTitle', array(
										'yes' => __( 'yes', WPFP_DOMAIN ),
										'no'  => __( 'no', WPFP_DOMAIN ),
									), isset( $displayTitle ) ? $displayTitle : 'yes', 'yes' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>
						
						</div><!-- Display Title -->

						<div class="row"><!-- Display Section Title -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php WPFP_Helpers()->span_label( __( 'Display Section Title', WPFP_DOMAIN ) ); ?>
											
								<?php

									WPFP_Helpers()->tooltip( __( 'Whether you want to display section title in slides.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->switch_button( WPFP_SETTINGS_SLIDES_OPTIONS, 'displaySectionTitle', array(
										'yes' => __( 'yes', WPFP_DOMAIN ),
										'no'  => __( 'no', WPFP_DOMAIN ),
									), isset( $displaySectionTitle ) ? $displaySectionTitle : 'no', 'no' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>
						
						</div><!-- Display Section Title -->

						<div class="row"><!-- Display Date -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php WPFP_Helpers()->span_label( __( 'Display Date', WPFP_DOMAIN ) ); ?>
											
								<?php

									WPFP_Helpers()->tooltip( __( 'Whether you want to display post date in slides.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->switch_button( WPFP_SETTINGS_SLIDES_OPTIONS, 'displayDate', array(
										'yes' => __( 'yes', WPFP_DOMAIN ),
										'no'  => __( 'no', WPFP_DOMAIN ),
									), isset( $displayDate ) ? $displayDate : 'no', 'no' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>
						
						</div><!-- Display Date -->

						<div class="row"><!-- Display Author -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php WPFP_Helpers()->span_label( __( 'Display Author', WPFP_DOMAIN ) ); ?>
											
								<?php

									WPFP_Helpers()->tooltip( __( 'Whether you want to display post author in slides.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->switch_button( WPFP_SETTINGS_SLIDES_OPTIONS, 'displayAuthor', array(
										'yes' => __( 'yes', WPFP_DOMAIN ),
										'no'  => __( 'no', WPFP_DOMAIN ),
									), isset( $displayAuthor ) ? $displayAuthor : 'no', 'no' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>
						
						</div><!-- Display Author -->

					</div>

					<div id="content-styling-design" class="col s12">

						<div class="row"><!-- Content Width -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Content Width', WPFP_DOMAIN ), 'contentWidth' );

								?>
											
								<?php

									WPFP_Helpers()->tooltip( __( 'The content width of the slides in "%".', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->number( WPFP_SETTINGS_SLIDES_OPTIONS, 'contentWidth', isset( $contentWidth ) ? $contentWidth : 50, 50, 0, 100, 1, 'small-text' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>
						
						</div><!-- Content Width -->

						<div class="row"><!-- Content Inner Horizontal Margin -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Content Inner Horizontal Margin', WPFP_DOMAIN ), 'contentInnerHMargin' );

								?>
											
								<?php

									WPFP_Helpers()->tooltip( __( 'The content inner horizontal margin of the slides in "%".', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->number( WPFP_SETTINGS_SLIDES_OPTIONS, 'contentInnerHMargin', isset( $contentInnerHMargin ) ? $contentInnerHMargin : 10, 10, 0, 100, 1, 'small-text' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>
						
						</div><!-- Content Inner Horizontal Margin -->

						<div class="row"><!-- Content Inner Vertical Margin -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Content Inner Vertical Margin', WPFP_DOMAIN ), 'contentInnerVMargin' );

								?>
											
								<?php

									WPFP_Helpers()->tooltip( __( 'The content inner vertical margin of the slides in "%".', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->number( WPFP_SETTINGS_SLIDES_OPTIONS, 'contentInnerVMargin', isset( $contentInnerVMargin ) ? $contentInnerVMargin : 10, 10, 0, 100, 1, 'small-text' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>
						
						</div><!-- Content Inner Vertical Margin -->

						<div class="row"><!-- Content Background Color -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Content Background-Color', WPFP_DOMAIN ), 'contentBackgroundColor' );

								?>

								<?php

									WPFP_Helpers()->tooltip( __( 'The content background-color of slides.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->text( WPFP_SETTINGS_SLIDES_OPTIONS, 'contentBackgroundColor', isset( $contentBackgroundColor ) ? $contentBackgroundColor : '', '', __( 'eg: #ffffff, white, ...', WPFP_DOMAIN ), 'wpfp-color' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Content Background Color -->

						<div class="row"><!-- Content Style -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Content Style', WPFP_DOMAIN ), 'contentStyle' );

								?>

								<?php

									WPFP_Helpers()->tooltip( __( 'The content style of slides.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>
						
								<?php WPFP_Helpers()->div_helper( __( 'eg:', WPFP_DOMAIN ) ); ?>
								<?php WPFP_Helpers()->div_helper( __( '<span class="var">margin-top</span>: 20px;', WPFP_DOMAIN ) ); ?>
								<?php WPFP_Helpers()->div_helper( __( '<span class="var">margin-bottom</span>: 30px; ...', WPFP_DOMAIN ) ); ?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->ace_textarea( WPFP_SETTINGS_SLIDES_OPTIONS, 'contentStyle', isset( $contentStyle ) ? $contentStyle : '', '', '', 'ace-css' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Content Style -->

						<div class="row"><!-- Inner Content Style -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Inner Content Style', WPFP_DOMAIN ), 'innerContentStyle' );

								?>

								<?php

									WPFP_Helpers()->tooltip( __( 'The inner content style of slides.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>
						
								<?php WPFP_Helpers()->div_helper( __( 'eg:', WPFP_DOMAIN ) ); ?>
								<?php WPFP_Helpers()->div_helper( __( '<span class="var">margin-top</span>: 20px;', WPFP_DOMAIN ) ); ?>
								<?php WPFP_Helpers()->div_helper( __( '<span class="var">margin-bottom</span>: 30px; ...', WPFP_DOMAIN ) ); ?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->ace_textarea( WPFP_SETTINGS_SLIDES_OPTIONS, 'innerContentStyle', isset( $innerContentStyle ) ? $innerContentStyle : '', '', '', 'ace-css' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Inner Content Style -->

					</div>
	
				</div>
			</li><!-- Content Styling -->

			<li><!-- Navigation -->
				<div class="collapsible-header teal-text text-lighten-1 flow-text waves-effect waves-light"><i class="material-icons red-text text-lighten-2">navigation</i><?php _e( 'Navigation', WPFP_DOMAIN ); ?></div>
				<div class="collapsible-body">
					
					<ul class="m-tabs">
						<li class="tab col s6"><a href="#navigation-general" class="active"><?php _e( 'General Parameters', WPFP_DOMAIN ); ?></a></li>
						<li class="tab col s6"><a href="#navigation-design"><?php _e( 'Design Parameters', WPFP_DOMAIN ); ?></a></li>
					</ul>

					<div id="navigation-general" class="col s12">

						<div class="row"><!-- Navigation -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php WPFP_Helpers()->span_label( __( 'Navigation', WPFP_DOMAIN ) ); ?>
											
								<?php

									WPFP_Helpers()->tooltip( __( 'Show a FullPage navigation menu bar.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->switch_button( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'fullNavigation', array(
										'yes' => __( 'yes', WPFP_DOMAIN ),
										'no'  => __( 'no', WPFP_DOMAIN ),
									), isset( $fullNavigation ) ? $fullNavigation : 'yes', 'yes' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>
						
						</div><!-- Navigation -->

						<div class="row"><!-- Navigation Orientation -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Navigation Orientation', WPFP_DOMAIN ), 'fullNavigationOrientation' );

								?>
											
								<?php

									WPFP_Helpers()->tooltip( __( 'Display navigation horizontally or vertically.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->select( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'fullNavigationOrientation', array(
										'horizontal' => __( 'Horizontal', WPFP_DOMAIN ),
										'vertical'  => __( 'Vertical', WPFP_DOMAIN ),
									), isset( $fullNavigationOrientation ) ? $fullNavigationOrientation : 'horizontal', 'horizontal' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>
						
						</div><!-- Navigation Orientation -->

						<div class="row"><!-- Sections Navigation -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php WPFP_Helpers()->span_label( __( 'Sections Navigation', WPFP_DOMAIN ) ); ?>
											
								<?php

									WPFP_Helpers()->tooltip( __( 'Show a sections navigation bar made up of small circles.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->switch_button( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'navigation', array(
										'yes' => __( 'yes', WPFP_DOMAIN ),
										'no'  => __( 'no', WPFP_DOMAIN ),
									), isset( $navigation ) ? $navigation : 'yes', 'yes' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>
						
						</div><!-- Sections Navigation -->

						<div class="row"><!-- Sections Navigation Position -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Sections Navigation Position', WPFP_DOMAIN ), 'navigationPosition' );

								?>
											
								<?php

									WPFP_Helpers()->tooltip( __( 'It can be set to left or right and defines which position the navigation bar will be shown (if using one).', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->select( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'navigationPosition', array(
										'left'  => __( 'Left', WPFP_DOMAIN ),
										'right' => __( 'Right', WPFP_DOMAIN ),
									), isset( $navigationPosition ) ? $navigationPosition : 'left', 'left' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>
						
						</div><!-- Sections Navigation Position -->

						<div class="row"><!-- Sections Navigation Title -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Sections Navigation Title', WPFP_DOMAIN ), 'navTitle' );

								?>

								<?php

									WPFP_Helpers()->tooltip( __( 'Which metadata do you want to use for the sections navigation tooltips in case they are being used. If the metadata is empty or does not exists, it will display the title instead. If empty, it will display post title.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->text( WPFP_SETTINGS_SECTIONS_OPTIONS, 'navTitle', isset( $navTitle ) ? $navTitle : '', '', __( 'eg: my_metadata', WPFP_DOMAIN ) );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>
						
						</div><!-- Sections Navigation Title -->

						<div class="row"><!-- Slides Navigation -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php WPFP_Helpers()->span_label( __( 'Slides Navigation', WPFP_DOMAIN ) ); ?>
											
								<?php

									WPFP_Helpers()->tooltip( __( 'Show a navigation bar made up of small circles for each landscape slider on the site.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->switch_button( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'slidesNavigation', array(
										'yes' => __( 'yes', WPFP_DOMAIN ),
										'no'  => __( 'no', WPFP_DOMAIN ),
									), isset( $slidesNavigation ) ? $slidesNavigation : 'yes', 'yes' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>
						
						</div><!-- Slides Navigation -->

						<div class="row"><!-- Slides Nav Position -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Slides Nav Position', WPFP_DOMAIN ), 'slidesNavPosition' );

								?>

								<?php

									WPFP_Helpers()->tooltip( __( 'Defines the position for the landscape navigation bar for sliders. Admits top and bottom as values. You may want to modify the CSS styles to determine the distance from the top or bottom as well as any other style such as color.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->select( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'slidesNavPosition', array(
										'top'    => __( 'Top', WPFP_DOMAIN ),
										'bottom' => __( 'Bottom', WPFP_DOMAIN ),
									), isset( $slidesNavPosition ) ? $slidesNavPosition : 'top', 'top' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>
						
						</div><!-- Slides Nav Position -->

						<div class="row"><!-- Slides Navigation Title -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Slides Navigation Title', WPFP_DOMAIN ), 'slidesNavTitle' );

								?>

								<?php

									WPFP_Helpers()->tooltip( __( 'Which metadata do you want to use for the slides navigation tooltips in case they are being used. If the metadata is empty or does not exists, it will display the title instead. If empty, it will display post title.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->text( WPFP_SETTINGS_SLIDES_OPTIONS, 'slidesNavTitle', isset( $slidesNavTitle ) ? $slidesNavTitle : '', '', __( 'eg: my_metadata', WPFP_DOMAIN ) );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>
						
						</div><!-- Slides Navigation Title -->

						<div class="row"><!-- Lock Anchors -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php WPFP_Helpers()->span_label( __( 'Lock Anchors', WPFP_DOMAIN ) ); ?>
											
								<?php

									WPFP_Helpers()->tooltip( __( "Determines whether anchors in the URL will have any effect at all in the plugin. You can still using anchors internally for your own functions and callbacks, but they won&apos;t have any effect in the scrolling of the site. Useful if you want to combine fullPage.js with other plugins using anchor in the URL.", WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->switch_button( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'lockAnchors', array(
										'yes' => __( 'yes', WPFP_DOMAIN ),
										'no'  => __( 'no', WPFP_DOMAIN ),
									), isset( $lockAnchors ) ? $lockAnchors : 'no', 'no' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>
						
						</div><!-- Lock Anchors -->

					</div>

					<div id="navigation-design" class="col s12">

						<div class="row"><!-- Navigation Background Color -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Navigation Background-Color', WPFP_DOMAIN ), 'fullNavigationBackgroundColor' );

								?>

								<?php

									WPFP_Helpers()->tooltip( __( 'The Navigation background-color.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->text( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'fullNavigationBackgroundColor', isset( $fullNavigationBackgroundColor ) ? $fullNavigationBackgroundColor : 'rgba(255, 255, 255, 0.8)', 'rgba(255, 255, 255, 0.8)', __( 'eg: #ffffff, white, ...', WPFP_DOMAIN ), 'wpfp-color' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Navigation Background Color -->

						<div class="row"><!-- Navigation Text Color -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Navigation Text Color', WPFP_DOMAIN ), 'fullNavigationTextColor' );

								?>

								<?php

									WPFP_Helpers()->tooltip( __( 'The Navigation Text color.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->text( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'fullNavigationTextColor', isset( $fullNavigationTextColor ) ? $fullNavigationTextColor : '#666666', '#666666', __( 'eg: #ffffff, white, ...', WPFP_DOMAIN ), 'wpfp-color' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Navigation Text Color -->

						<div class="row"><!-- Navigation Active Background Color -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Navigation Active Background-Color', WPFP_DOMAIN ), 'fullNavigationActiveBackgroundColor' );

								?>

								<?php

									WPFP_Helpers()->tooltip( __( 'The Navigation active background-color.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->text( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'fullNavigationActiveBackgroundColor', isset( $fullNavigationActiveBackgroundColor ) ? $fullNavigationActiveBackgroundColor : 'rgba(130, 130, 130, 0.8)', 'rgba(130, 130, 130, 0.8)', __( 'eg: #ffffff, white, ...', WPFP_DOMAIN ), 'wpfp-color' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Navigation Active Background Color -->

						<div class="row"><!-- Navigation Active Text Color -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Navigation Active Text Color', WPFP_DOMAIN ), 'fullNavigationActiveTextColor' );

								?>

								<?php

									WPFP_Helpers()->tooltip( __( 'The Navigation active Text color.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->text( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'fullNavigationActiveTextColor', isset( $fullNavigationActiveTextColor ) ? $fullNavigationActiveTextColor : '#ffffff', '#ffffff', __( 'eg: #ffffff, white, ...', WPFP_DOMAIN ), 'wpfp-color' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Navigation Active Text Color -->

						<div class="row"><!-- Sections Navigation Color -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Sections Navigation Color', WPFP_DOMAIN ), 'sectionsNavigationColor' );

								?>

								<?php

									WPFP_Helpers()->tooltip( __( 'The Sections Navigation color.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->text( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'sectionsNavigationColor', isset( $sectionsNavigationColor ) ? $sectionsNavigationColor : '#333333', '#333333', __( 'eg: #ffffff, white, ...', WPFP_DOMAIN ), 'wpfp-color' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Full Sections Navigation Color -->

						<div class="row"><!-- Sections Navigation Active Color -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Sections Navigation Active Color', WPFP_DOMAIN ), 'sectionsNavigationActiveColor' );

								?>

								<?php

									WPFP_Helpers()->tooltip( __( 'The Sections Navigation Active color.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->text( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'sectionsNavigationActiveColor', isset( $sectionsNavigationActiveColor ) ? $sectionsNavigationActiveColor : '#666666', '#666666', __( 'eg: #ffffff, white, ...', WPFP_DOMAIN ), 'wpfp-color' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Sections Navigation Active Color -->

						<div class="row"><!-- Slides Navigation Color -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Slides Navigation Color', WPFP_DOMAIN ), 'slidesNavigationColor' );

								?>

								<?php

									WPFP_Helpers()->tooltip( __( 'The Slides Navigation color.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->text( WPFP_SETTINGS_SECTIONS_OPTIONS, 'slidesNavigationColor', isset( $slidesNavigationColor ) ? $slidesNavigationColor : '#333333', '#333333', __( 'eg: #ffffff, white, ...', WPFP_DOMAIN ), 'wpfp-color' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Slides Navigation Color -->

						<div class="row"><!-- Slides Navigation Active Color -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Slides Navigation Active Color', WPFP_DOMAIN ), 'slidesNavigationActiveColor' );

								?>

								<?php

									WPFP_Helpers()->tooltip( __( 'The Slides Navigation Active color.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->text( WPFP_SETTINGS_SECTIONS_OPTIONS, 'slidesNavigationActiveColor', isset( $slidesNavigationActiveColor ) ? $slidesNavigationActiveColor : '#666666', '#666666', __( 'eg: #ffffff, white, ...', WPFP_DOMAIN ), 'wpfp-color' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Slides Navigation Active Color -->

						<div class="row"><!-- Navigation Arrows Color -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Navigation Arrows Color', WPFP_DOMAIN ), 'navigationArrowsColor' );

								?>

								<?php

									WPFP_Helpers()->tooltip( __( 'The Navigation Arrows color.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->text( WPFP_SETTINGS_SECTIONS_OPTIONS, 'navigationArrowsColor', isset( $navigationArrowsColor ) ? $navigationArrowsColor : '#333333', '#333333', __( 'eg: #ffffff, white, ...', WPFP_DOMAIN ), 'wpfp-color' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Navigation Arrows Color -->

						<div class="row"><!-- Navigation Arrows Hover Color -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Navigation Arrows Hover Color', WPFP_DOMAIN ), 'navigationArrowsHoverColor' );

								?>

								<?php

									WPFP_Helpers()->tooltip( __( 'The Navigation Arrows Hover color.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->text( WPFP_SETTINGS_SECTIONS_OPTIONS, 'navigationArrowsHoverColor', isset( $navigationArrowsHoverColor ) ? $navigationArrowsHoverColor : '#666666', '#666666', __( 'eg: #ffffff, white, ...', WPFP_DOMAIN ), 'wpfp-color' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Navigation Arrows Hover Color -->

						<div class="row"><!-- Tooltip Color -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Tooltip Color', WPFP_DOMAIN ), 'tooltipColor' );

								?>

								<?php

									WPFP_Helpers()->tooltip( __( 'The Tooltip color.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->text( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'tooltipColor', isset( $tooltipColor ) ? $tooltipColor : '#ffffff', '#ffffff', __( 'eg: #ffffff, white, ...', WPFP_DOMAIN ), 'wpfp-color' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Tooltip Color -->

						<div class="row"><!-- Tooltip Background Color -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Tooltip Background Color', WPFP_DOMAIN ), 'tooltipBgColor' );

								?>

								<?php

									WPFP_Helpers()->tooltip( __( 'The Tooltip background-color.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->text( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'tooltipBgColor', isset( $tooltipBgColor ) ? $tooltipBgColor : '#333333', '#333333', __( 'eg: #ffffff, white, ...', WPFP_DOMAIN ), 'wpfp-color' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Tooltip Background Color -->

					</div>

				</div>
			</li><!-- Navigation -->

			<li><!-- Scrolling -->
				<div class="collapsible-header teal-text text-lighten-1 flow-text waves-effect waves-light"><i class="material-icons red-text text-lighten-2">swap_vert</i><?php _e( 'Scrolling', WPFP_DOMAIN ); ?></div>
				<div class="collapsible-body">

					<div class="row"><!-- CSS 3 -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php WPFP_Helpers()->span_label( __( 'CSS 3', WPFP_DOMAIN ) ); ?>
										
							<?php

								WPFP_Helpers()->tooltip( __( 'Defines whether to use JavaScript or CSS3 transforms to scroll within sections and slides. Useful to speed up the movement in tablet and mobile devices with browsers supporting CSS3. If this option is set to true and the browser doesn&apos;t support CSS3, a jQuery fallback will be used instead.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->switch_button( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'css3', array(
									'yes' => __( 'yes', WPFP_DOMAIN ),
									'no'  => __( 'no', WPFP_DOMAIN ),
								), isset( $css3 ) ? $css3 : 'yes', 'yes' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- CSS 3 -->

					<div class="row"><!-- Parallax -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php WPFP_Helpers()->span_label( __( 'Parallax', WPFP_DOMAIN ) ); ?>
										
							<?php

								WPFP_Helpers()->tooltip( __( "Defines whether to add a Parallax effects to your FullPage or not.", WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->switch_button( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'parallax', array(
									'yes' => __( 'yes', WPFP_DOMAIN ),
									'no'  => __( 'no', WPFP_DOMAIN ),
								), isset( $parallax ) ? $parallax : 'no', 'no' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Parallax -->

					<div class="row"><!-- Scrolling Speed -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Scrolling Speed', WPFP_DOMAIN ), 'scrollingSpeed' );

							?>
										
							<?php

								WPFP_Helpers()->tooltip( __( 'Speed in miliseconds for the scrolling transitions.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->number( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'scrollingSpeed', isset( $scrollingSpeed ) ? $scrollingSpeed : 700, 700, 0, 2000, 50, 'small-text' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Scrolling Speed -->

					<div class="row"><!-- Transition effect -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Transition effect', WPFP_DOMAIN ), 'easing' );

							?>
										
							<?php

								WPFP_Helpers()->tooltip( __( 'Defines the transition effect to use for the vertical and horizontal scrolling.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->select( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'easing', array(
									'linear'           => __( 'Linear', WPFP_DOMAIN ),
									'swing'            => __( 'Swing', WPFP_DOMAIN ),
									'easeInSine'       => __( 'Ease In Sine', WPFP_DOMAIN ),
									'easeOutSine'      => __( 'Ease Out Sine', WPFP_DOMAIN ),
									'easeInOutSine'    => __( 'Ease In Out Sine', WPFP_DOMAIN ),
									'easeInCirc'       => __( 'Ease In Circ', WPFP_DOMAIN ),
									'easeOutCirc'      => __( 'Ease Out Circ', WPFP_DOMAIN ),
									'easeInOutCirc'    => __( 'Ease In Out Circ', WPFP_DOMAIN ),
									'easeInQuad'       => __( 'Ease In Quad', WPFP_DOMAIN ),
									'easeOutQuad'      => __( 'Ease Out Quad', WPFP_DOMAIN ),
									'easeInOutQuad'    => __( 'Ease In Out Quad', WPFP_DOMAIN ),
									'easeInCubic'      => __( 'Ease In Cubic', WPFP_DOMAIN ),
									'easeOutCubic'     => __( 'Ease Out Cubic', WPFP_DOMAIN ),
									'easeInOutCubic'   => __( 'Ease In Out Cubic', WPFP_DOMAIN ),
									'easeInQuart'      => __( 'Ease In Quart', WPFP_DOMAIN ),
									'easeOutQuart'     => __( 'Ease Out Quart', WPFP_DOMAIN ),
									'easeInOutQuart'   => __( 'Ease In Out Quart', WPFP_DOMAIN ),
									'easeInQuint'      => __( 'Ease In Quint', WPFP_DOMAIN ),
									'easeOutQuint'     => __( 'Ease Out Quint', WPFP_DOMAIN ),
									'easeInOutQuint'   => __( 'Ease In Out Quint', WPFP_DOMAIN ),
									'easeInExpo'       => __( 'Ease In Expo', WPFP_DOMAIN ),
									'easeOutExpo'      => __( 'Ease Out Expo', WPFP_DOMAIN ),
									'easeInOutExpo'    => __( 'Ease In Out Expo', WPFP_DOMAIN ),
									'easeInBack'       => __( 'Ease In Back', WPFP_DOMAIN ),
									'easeOutBack'      => __( 'Ease Out Back', WPFP_DOMAIN ),
									'easeInOutBack'    => __( 'Ease In Out Back', WPFP_DOMAIN ),
									'easeInElastic'    => __( 'Ease In Elastic', WPFP_DOMAIN ),
									'easeOutElastic'   => __( 'Ease Out Elastic', WPFP_DOMAIN ),
									'easeInOutElastic' => __( 'Ease In Out Elastic', WPFP_DOMAIN ),
									'easeInBounce'     => __( 'Ease In Bounce', WPFP_DOMAIN ),
									'easeOutBounce'    => __( 'Ease Out Bounce', WPFP_DOMAIN ),
									'easeInOutBounce'  => __( 'Ease In Out Bounce', WPFP_DOMAIN ),
								), isset( $easing ) ? $easing : 'easeInQuad', 'linear' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Transition effect -->

					<div class="row"><!-- CSS3 Transition effect -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'CSS3 Transition effect', WPFP_DOMAIN ), 'easingCss3' );

							?>
										
							<?php

								WPFP_Helpers()->tooltip( __( 'Defines the transition effect to use for the vertical and horizontal scrolling in case of CSS3.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->select( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'easingCss3', array(
									'linear'                                    => __( 'Linear', WPFP_DOMAIN ),
									'ease'                                      => __( 'Ease', WPFP_DOMAIN ),
									'ease-in'                                   => __( 'Ease In', WPFP_DOMAIN ),
									'ease-out'                                  => __( 'Ease Out', WPFP_DOMAIN ),
									'ease-in-out'                               => __( 'Ease In Out', WPFP_DOMAIN ),
									'cubic-bezier(0.470, 0.000, 0.745, 0.715)'  => __( 'Ease In Sine', WPFP_DOMAIN ),
									'cubic-bezier(0.390, 0.575, 0.565, 1.000)'  => __( 'Ease Out Sine', WPFP_DOMAIN ),
									'cubic-bezier(0.445, 0.050, 0.550, 0.950)'  => __( 'Ease In Out Sine', WPFP_DOMAIN ),
									'cubic-bezier(0.600, 0.040, 0.980, 0.335)'  => __( 'Ease In Circ', WPFP_DOMAIN ),
									'cubic-bezier(0.075, 0.820, 0.165, 1.000)'  => __( 'Ease Out Circ', WPFP_DOMAIN ),
									'cubic-bezier(0.785, 0.135, 0.150, 0.860)'  => __( 'Ease In Out Circ', WPFP_DOMAIN ),
									'cubic-bezier(0.550, 0.085, 0.680, 0.530)'  => __( 'Ease In Quad', WPFP_DOMAIN ),
									'cubic-bezier(0.250, 0.460, 0.450, 0.940)'  => __( 'Ease Out Quad', WPFP_DOMAIN ),
									'cubic-bezier(0.455, 0.030, 0.515, 0.955)'  => __( 'Ease In Out Quad', WPFP_DOMAIN ),
									'cubic-bezier(0.550, 0.055, 0.675, 0.190)'  => __( 'Ease In Cubic', WPFP_DOMAIN ),
									'cubic-bezier(0.215, 0.610, 0.355, 1.000)'  => __( 'Ease Out Cubic', WPFP_DOMAIN ),
									'cubic-bezier(0.645, 0.045, 0.355, 1.000)'  => __( 'Ease In Out Cubic', WPFP_DOMAIN ),
									'cubic-bezier(0.895, 0.030, 0.685, 0.220)'  => __( 'Ease In Quart', WPFP_DOMAIN ),
									'cubic-bezier(0.165, 0.840, 0.440, 1.000)'  => __( 'Ease Out Quart', WPFP_DOMAIN ),
									'cubic-bezier(0.770, 0.000, 0.175, 1.000)'  => __( 'Ease In Out Quart', WPFP_DOMAIN ),
									'cubic-bezier(0.755, 0.050, 0.855, 0.060)'  => __( 'Ease In Quint', WPFP_DOMAIN ),
									'cubic-bezier(0.230, 1.000, 0.320, 1.000)'  => __( 'Ease Out Quint', WPFP_DOMAIN ),
									'cubic-bezier(0.860, 0.000, 0.070, 1.000)'  => __( 'Ease In Out Quint', WPFP_DOMAIN ),
									'cubic-bezier(0.950, 0.050, 0.795, 0.035)'  => __( 'Ease In Expo', WPFP_DOMAIN ),
									'cubic-bezier(0.190, 1.000, 0.220, 1.000)'  => __( 'Ease Out Expo', WPFP_DOMAIN ),
									'cubic-bezier(1.000, 0.000, 0.000, 1.000)'  => __( 'Ease In Out Expo', WPFP_DOMAIN ),
									'cubic-bezier(0.600, -0.280, 0.735, 0.045)' => __( 'Ease In Back', WPFP_DOMAIN ),
									'cubic-bezier(0.175, 0.885, 0.320, 1.275)'  => __( 'Ease Out Back', WPFP_DOMAIN ),
									'cubic-bezier(0.680, 0, 0.265, 1.550)'      => __( 'Ease In Out Back', WPFP_DOMAIN ),
								), isset( $easingCss3 ) ? $easingCss3 : 'linear', 'linear' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- CSS3 Transition effect -->

					<div class="row"><!-- Loop Bottom -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php WPFP_Helpers()->span_label( __( 'Loop Bottom', WPFP_DOMAIN ) ); ?>
										
							<?php

								WPFP_Helpers()->tooltip( __( 'Defines whether scrolling down in the last section should scroll to the first one or not.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->switch_button( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'loopBottom', array(
									'yes' => __( 'yes', WPFP_DOMAIN ),
									'no'  => __( 'no', WPFP_DOMAIN ),
								), isset( $loopBottom ) ? $loopBottom : 'yes', 'yes' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Loop Bottom -->

					<div class="row"><!-- Loop Top -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php WPFP_Helpers()->span_label( __( 'Loop Top', WPFP_DOMAIN ) ); ?>
										
							<?php

								WPFP_Helpers()->tooltip( __( 'Defines whether scrolling up in the first section should scroll to the last one or not.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->switch_button( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'loopTop', array(
									'yes' => __( 'yes', WPFP_DOMAIN ),
									'no'  => __( 'no', WPFP_DOMAIN ),
								), isset( $loopTop ) ? $loopTop : 'yes', 'yes' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Loop Top -->

					<div class="row"><!-- Loop Horizontal -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php WPFP_Helpers()->span_label( __( 'Loop Horizontal', WPFP_DOMAIN ) ); ?>
										
							<?php

								WPFP_Helpers()->tooltip( __( 'Defines whether horizontal sliders will loop after reaching the last or previous slide or not.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->switch_button( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'loopHorizontal', array(
									'yes' => __( 'yes', WPFP_DOMAIN ),
									'no'  => __( 'no', WPFP_DOMAIN ),
								), isset( $loopHorizontal ) ? $loopHorizontal : 'yes', 'yes' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Loop Horizontal -->

					<div class="row"><!-- Auto Scrolling -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php WPFP_Helpers()->span_label( __( 'Auto Scrolling', WPFP_DOMAIN ) ); ?>
										
							<?php

								WPFP_Helpers()->tooltip( __( 'Defines whether to use the "automatic" scrolling or the "normal" one. It also has affects the way the sections fit in the browser/device window in tablets and mobile phones.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->switch_button( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'autoScrolling', array(
									'yes' => __( 'yes', WPFP_DOMAIN ),
									'no'  => __( 'no', WPFP_DOMAIN ),
								), isset( $autoScrolling ) ? $autoScrolling : 'yes', 'yes' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Auto Scrolling -->

					<div class="row"><!-- Scroll Overflow -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php WPFP_Helpers()->span_label( __( 'Scroll Overflow', WPFP_DOMAIN ) ); ?>
										
							<?php

								WPFP_Helpers()->tooltip( __( 'Defines whether or not to create a scroll for the section in case its content is bigger than the height of it.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->switch_button( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'scrollOverflow', array(
									'yes' => __( 'yes', WPFP_DOMAIN ),
									'no'  => __( 'no', WPFP_DOMAIN ),
								), isset( $scrollOverflow ) ? $scrollOverflow : 'yes', 'yes' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Scroll Overflow -->

					<div class="row"><!-- Normal Scroll Elements -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Normal Scroll Elements', WPFP_DOMAIN ), 'normalScrollElements' );

							?>
										
							<?php

								WPFP_Helpers()->tooltip( __( 'If you want to avoid the auto scroll when scrolling over some elements, this is the option you need to use. (useful for maps, scrolling divs etc.) It requires a string with the jQuery selectors for those elements. (eg: #element1, .element2)', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->text( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'normalScrollElements', isset( $normalScrollElements ) ? $normalScrollElements : '', '', __( 'eg: #element1, .element2', WPFP_DOMAIN ) );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Normal Scroll Elements -->

					<div class="row"><!-- Normal Scroll Element Touch Threshold -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Normal Scroll Element Touch Threshold', WPFP_DOMAIN ), 'normalScrollElementTouchThreshold' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'Defines the threshold for the number of hops up the html node tree Fullpage will test to see if normalScrollElements is a match to allow scrolling functionality on divs on a touch device.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->number( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'normalScrollElementTouchThreshold', isset( $normalScrollElementTouchThreshold ) ? $normalScrollElementTouchThreshold : 5, 5, 0, 100, 1, 'small-text' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Normal Scroll Element Touch Threshold -->

					<div class="row"><!-- Continuous Vertical -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php WPFP_Helpers()->span_label( __( 'Continuous Vertical', WPFP_DOMAIN ) ); ?>

							<?php

								WPFP_Helpers()->tooltip( __( 'Defines whether scrolling down in the last section should scroll down to the first one or not, and if scrolling up in the first section should scroll up to the last one or not. Not compatible with loopTop or loopBottom.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->switch_button( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'continuousVertical', array(
									'yes' => __( 'yes', WPFP_DOMAIN ),
									'no'  => __( 'no', WPFP_DOMAIN ),
								), isset( $continuousVertical ) ? $continuousVertical : 'no', 'no' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Continuous Vertical -->

					<div class="row"><!-- Touch Sensitivity -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Touch Sensitivity', WPFP_DOMAIN ), 'touchSensitivity' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'Defines a percentage of the browsers window width/height, and how far a swipe must measure for navigating to the next section / slide.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->number( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'touchSensitivity', isset( $touchSensitivity ) ? $touchSensitivity : 15, 15, 1, 100, 1, 'small-text' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Touch Sensitivity -->
					
					<div class="row"><!-- Fit To Section -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php WPFP_Helpers()->span_label( __( 'Fit to Section', WPFP_DOMAIN ) ); ?>
										
							<?php

								WPFP_Helpers()->tooltip( __( 'Determines whether or not to fit sections to the viewport or not. When active, the current active section will always fill the whole viewport. Otherwise the user will be free to stop in the middle of a section.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->switch_button( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'fitToSection', array(
									'yes' => __( 'yes', WPFP_DOMAIN ),
									'no'  => __( 'no', WPFP_DOMAIN ),
								), isset( $fitToSection ) ? $fitToSection : 'yes', 'yes' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Fit To Section -->

					<div class="row"><!-- Fit To Section Delay -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Fit to Section Delay', WPFP_DOMAIN ), 'fitToSectionDelay' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'If "Fit to Section" is active, this delays the fitting by the configured milliseconds.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->number( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'fitToSectionDelay', isset( $fitToSectionDelay ) ? $fitToSectionDelay : 1000, 1000, 0, 10000, 100, 'small-text' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Fit To Section Delay -->
					
					<div class="row"><!-- Scroll Bar -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php WPFP_Helpers()->span_label( __( 'Scroll Bar', WPFP_DOMAIN ) ); ?>
										
							<?php

								WPFP_Helpers()->tooltip( __( 'Determines whether to use scrollbar for the site or not. In case of using scroll bar, the autoScrolling functionality will still working as expected. The user will also be free to scroll the site with the scroll bar and fullPage.js will fit the section in the screen when scrolling finishes.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->switch_button( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'scrollBar', array(
									'yes' => __( 'yes', WPFP_DOMAIN ),
									'no'  => __( 'no', WPFP_DOMAIN ),
								), isset( $scrollBar ) ? $scrollBar : 'no', 'no' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Scroll Bar -->

				</div>
			</li><!-- Scrolling -->

			<li><!-- Accessibility -->
				<div class="collapsible-header teal-text text-lighten-1 flow-text waves-effect waves-light"><i class="material-icons red-text text-lighten-2">spellcheck</i><?php _e( 'Accessibility', WPFP_DOMAIN ); ?></div>
				<div class="collapsible-body">

					<div class="row"><!-- Keyboard Scrolling -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php WPFP_Helpers()->span_label( __( 'Keyboard Scrolling', WPFP_DOMAIN ) ); ?>

							<?php

								WPFP_Helpers()->tooltip( __( 'Defines if the content can be navigated using the keyboard.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->switch_button( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'keyboardScrolling', array(
									'yes' => __( 'yes', WPFP_DOMAIN ),
									'no'  => __( 'no', WPFP_DOMAIN ),
								), isset( $keyboardScrolling ) ? $keyboardScrolling : 'yes', 'yes' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Keyboard Scrolling -->

					<div class="row"><!-- Animate Anchor -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php WPFP_Helpers()->span_label( __( 'Animate Anchor', WPFP_DOMAIN ) ); ?>

							<?php

								WPFP_Helpers()->tooltip( __( 'Defines whether the load of the site when given an anchor (#) will scroll with animation to its destination or will directly load on the given section.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->switch_button( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'animateAnchor', array(
									'yes' => __( 'yes', WPFP_DOMAIN ),
									'no'  => __( 'no', WPFP_DOMAIN ),
								), isset( $animateAnchor ) ? $animateAnchor : 'yes', 'yes' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Animate Anchor -->

					<div class="row"><!-- Record History -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php WPFP_Helpers()->span_label( __( 'Record History', WPFP_DOMAIN ) ); ?>

							<?php

								WPFP_Helpers()->tooltip( __( 'Defines whether to push the state of the site to the browser&apos;s history. When active each section/slide of the site will act as a new page and the back and forward buttons of the browser will scroll the sections/slides to reach the previous or next state of the site. When set to false, the URL will keep changing but will have no effect ont he browser&apos;s history. This option is automatically turned off when Auto Scrolling is not active.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->switch_button( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'recordHistory', array(
									'yes' => __( 'yes', WPFP_DOMAIN ),
									'no'  => __( 'no', WPFP_DOMAIN ),
								), isset( $recordHistory ) ? $recordHistory : 'yes', 'yes' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Record History -->

				</div>
			</li><!-- Accessibility -->

			<li><!-- Events -->
				<div class="collapsible-header teal-text text-lighten-1 flow-text waves-effect waves-light"><i class="material-icons red-text text-lighten-2">class</i><?php _e( 'Events', WPFP_DOMAIN ); ?></div>
				<div class="collapsible-body">

					<div class="row">
						<div class="col s12 flow-text">
							<?php WPFP_Helpers()->div_helper( __( 'Take a look at <span class="var">`templates/js/jquery.fullpage.theme.js`</span> for more variables.', WPFP_DOMAIN ) ); ?>
						</div>
					</div>

					<div class="row"><!-- On Leave -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'On Leave', WPFP_DOMAIN ), 'onLeave' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'This callback is fired once the user leaves a section, in the transition to the new section. Use your own javascript code or customize the function "fullpageOnLeave" in "your-theme/wp-fullpage/js/jquery.fullpage.custom.js".', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

							<?php

								WPFP_Helpers()->goto_tip( __( 'Go to callback definition.', WPFP_DOMAIN ), 'https://github.com/alvarotrigo/fullPage.js#onleave-index-nextindex-direction', 'wpfp-goto tabs-tip' );

							?>

							<?php WPFP_Helpers()->div_helper( __( 'Available variables:', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">$</span> as jQuery', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">index</span>: index of the leaving section. Starting from 1.', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">nextIndex</span>: index of the destination section. Starting from 1.', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">direction</span>: it will take the values "up" or "down" depending on the scrolling direction.', WPFP_DOMAIN ) ); ?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->ace_textarea( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'onLeave', isset( $onLeave ) ? $onLeave : '', '' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- On Leave -->

					<div class="row"><!-- After Load -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'After Load', WPFP_DOMAIN ), 'afterLoad' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'Callback fired once the sections have been loaded, after the scrolling has ended. Use your own javascript code or customize the function "fullpageAfterLoad" in "your-theme/wp-fullpage/js/jquery.fullpage.custom.js".', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

							<?php

								WPFP_Helpers()->goto_tip( __( 'Go to callback definition.', WPFP_DOMAIN ), 'https://github.com/alvarotrigo/fullPage.js#afterload-anchorlink-index', 'wpfp-goto tabs-tip' );

							?>

							<?php WPFP_Helpers()->div_helper( __( 'Available variables:', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">$</span> as jQuery', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">anchorLink</span>: anchorLink corresponding to the section.', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">index</span>: index of the section. Starting from 1.', WPFP_DOMAIN ) ); ?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->ace_textarea( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'afterLoad', isset( $afterLoad ) ? $afterLoad : '', '' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- After Load -->

					<div class="row"><!-- After Render -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'After Render', WPFP_DOMAIN ), 'afterRender' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'This callback is fired just after the structure of the page is generated. This is the callback you want to use to initialize other plugins or fire any code which requires the document to be ready (as this plugin modifies the DOM to create the resulting structure). Use your own javascript code or customize the function "fullpageAfterRender" in "your-theme/wp-fullpage/js/jquery.fullpage.custom.js".', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

							<?php

								WPFP_Helpers()->goto_tip( __( 'Go to callback definition.', WPFP_DOMAIN ), 'https://github.com/alvarotrigo/fullPage.js#afterrender', 'wpfp-goto tabs-tip' );

							?>

							<?php WPFP_Helpers()->div_helper( __( 'Available variables:', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">$</span> as jQuery', WPFP_DOMAIN ) ); ?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->ace_textarea( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'afterRender', isset( $afterRender ) ? $afterRender : '', '' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- After Render -->

					<div class="row"><!-- After Resize -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'After Resize', WPFP_DOMAIN ), 'afterResize' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'This callback is fired after resizing the browser&apos;s window. Just after the sections are resized. Use your own javascript code or customize the function "fullpageAfterResize" in "your-theme/wp-fullpage/js/jquery.fullpage.custom.js".', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

							<?php

								WPFP_Helpers()->goto_tip( __( 'Go to callback definition.', WPFP_DOMAIN ), 'https://github.com/alvarotrigo/fullPage.js#afterresize', 'wpfp-goto tabs-tip' );

							?>

							<?php WPFP_Helpers()->div_helper( __( 'Available variables:', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">$</span> as jQuery', WPFP_DOMAIN ) ); ?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->ace_textarea( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'afterResize', isset( $afterResize ) ? $afterResize : '', '' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- After Resize -->

					<div class="row"><!-- After Slide Load -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'After Slide Load', WPFP_DOMAIN ), 'afterSlideLoad' );

							?>
								
							<?php

								WPFP_Helpers()->tooltip( __( 'Callback fired once the slide of a section have been loaded, after the scrolling has ended. Use your own javascript code or customize the function "fullpageAfterSlideLoad" in "your-theme/wp-fullpage/js/jquery.fullpage.custom.js".', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

							<?php

								WPFP_Helpers()->goto_tip( __( 'Go to callback definition.', WPFP_DOMAIN ), 'https://github.com/alvarotrigo/fullPage.js#afterslideload-anchorlink-index-slideanchor-slideindex', 'wpfp-goto tabs-tip' );

							?>

							<?php WPFP_Helpers()->div_helper( __( 'Available variables:', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">$</span> as jQuery', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">anchorLink</span>: anchorLink corresponding to the section.', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">index</span>: index of the section. Starting from 1.', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">slideAnchor</span>: anchor corresponding to the slide (in case there is).', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">slideIndex</span>: index of the slide. Starting from 1. (the default slide doesn&apos;t count as slide, but as a section).', WPFP_DOMAIN ) ); ?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->ace_textarea( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'afterSlideLoad', isset( $afterSlideLoad ) ? $afterSlideLoad : '', '' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- After Slide Load -->

					<div class="row"><!-- On Slide Leave -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'On Slide Leave', WPFP_DOMAIN ), 'onSlideLeave' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'This callback is fired once the user leaves an slide to go to another, in the transition to the new slide. Use your own javascript code or customize the function "fullpageSlideLeave" in "your-theme/wp-fullpage/js/jquery.fullpage.custom.js".', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

							<?php

								WPFP_Helpers()->goto_tip( __( 'Go to callback definition.', WPFP_DOMAIN ), 'https://github.com/alvarotrigo/fullPage.js#onslideleave-anchorlink-index-slideindex-direction', 'wpfp-goto tabs-tip' );

							?>

							<?php WPFP_Helpers()->div_helper( __( 'Available variables:', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">$</span> as jQuery', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">anchorLink</span>: anchorLink corresponding to the section.', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">index</span>: index of the section. Starting from 1.', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">slideIndex</span>: index of the slide. Starting from 0.', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">direction</span>: takes the values "right" or "left" depending on the scrolling direction.', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">nextSlideIndex</span>: index of the destination slide. Starting from 0.', WPFP_DOMAIN ) ); ?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->ace_textarea( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'onSlideLeave', isset( $onSlideLeave ) ? $onSlideLeave : '', '' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- On Slide Leave -->

					<div class="row"><!-- On DOM Ready -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'On DOM Ready', WPFP_DOMAIN ), 'onDomReady' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'This callback is fired once DOM is ready.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

							<?php WPFP_Helpers()->div_helper( __( 'Available variables:', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">$</span> as jQuery', WPFP_DOMAIN ) ); ?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->ace_textarea( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'onDomReady', isset( $onDomReady ) ? $onDomReady : '', '' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- On DOM Ready -->

				</div>
			</li><!-- Events -->

			<li><!-- Query -->
				<div class="collapsible-header teal-text text-lighten-1 flow-text waves-effect waves-light"><i class="material-icons red-text text-lighten-2">settings</i><?php _e( 'Query', WPFP_DOMAIN ); ?></div>
				<div class="collapsible-body">

					<div class="row"><!-- Teaser -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php WPFP_Helpers()->span_label( __( 'Teaser', WPFP_DOMAIN ) ); ?>
										
							<?php

								WPFP_Helpers()->tooltip( __( 'Display the teaser.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->switch_button( WPFP_SETTINGS_CUSTOM_OPTIONS, 'teaserDisplay', array(
									'yes' => __( 'yes', WPFP_DOMAIN ),
									'no'  => __( 'no', WPFP_DOMAIN ),
								), isset( $teaserDisplay ) ? $teaserDisplay : 'yes', 'yes' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Teaser -->

					<div id="teaserLength-container" class="row"><!-- Teaser Length -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Teaser Length', WPFP_DOMAIN ), 'teaserLength' );

							?>
										
							<?php

								WPFP_Helpers()->tooltip( __( 'How many characters do you want to display in the teaser. If set to "0", it will take the default value af your theme.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->number( WPFP_SETTINGS_CUSTOM_OPTIONS, 'teaserLength', isset( $teaserLength ) ? $teaserLength : 100, 100, 0, 1000, 10, 'small-text' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Teaser Length -->

					<div class="row"><!-- Count -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Count', WPFP_DOMAIN ), 'countPosts' );

							?>
										
							<?php

								WPFP_Helpers()->tooltip( __( 'How many posts do you want to display.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->number( WPFP_SETTINGS_CUSTOM_OPTIONS, 'countPosts', isset( $countPosts ) ? $countPosts : get_option( 'posts_per_page' ), get_option( 'posts_per_page' ), 1, 100, 1, 'small-text' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Count -->

					<div class="row"><!-- Order By -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Order By', WPFP_DOMAIN ), 'orderBy' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'What do you want to order the list with.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->select( WPFP_SETTINGS_CUSTOM_OPTIONS, 'orderBy', array(
									'date'          => __( 'Date', WPFP_DOMAIN ),
									'post__in'      => __( 'Include Order', WPFP_DOMAIN ),
									'ID'            => __( 'Post ID', WPFP_DOMAIN ),
									'author'        => __( 'Author', WPFP_DOMAIN ),
									'title'         => __( 'Author', WPFP_DOMAIN ),
									'name'          => __( 'Post Name (slug)', WPFP_DOMAIN ),
									'modified'      => __( 'Modified date', WPFP_DOMAIN ),
									'parent'        => __( 'Parent', WPFP_DOMAIN ),
									'rand'          => __( 'Random', WPFP_DOMAIN ),
									'comment_count' => __( 'Comment count', WPFP_DOMAIN ),
									'meta_value'    => __( 'Meta Value', WPFP_DOMAIN ),
								), isset( $orderBy ) ? $orderBy : 'date', 'date' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Order By -->

					<div id="orderByMetaValueKey-container" class="row"><!-- Order By Meta Value Key -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Order By Meta Value Key', WPFP_DOMAIN ), 'orderByMetaValueKey' );

							?>
					
							<?php

								WPFP_Helpers()->tooltip( __( 'which meta key do you want to use to order the list.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->text( WPFP_SETTINGS_CUSTOM_OPTIONS, 'orderByMetaValueKey', isset( $orderByMetaValueKey ) ? $orderByMetaValueKey : '', '', __( 'eg: my_meta_key', WPFP_DOMAIN ) );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Order By Meta Value Key -->

					<div class="row"><!-- Order -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Order', WPFP_DOMAIN ), 'order' );

							?>
					
							<?php

								WPFP_Helpers()->tooltip( __( 'How do you want to order the list.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->select( WPFP_SETTINGS_CUSTOM_OPTIONS, 'order', array(
									'ASC'  => __( 'ASC', WPFP_DOMAIN ),
									'DESC' => __( 'DESC', WPFP_DOMAIN ),
								), isset( $order ) ? $order : 'ASC', 'ASC' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Order -->

				</div>
			</li><!-- Query -->

			<li><!-- Debug -->
				<div class="collapsible-header teal-text text-lighten-1 flow-text waves-effect waves-light"><i class="material-icons red-text text-lighten-2">chat</i><?php _e( 'Debug', WPFP_DOMAIN ); ?></div>
				<div class="collapsible-body">

					<div class="row"><!-- Debug Mode -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php WPFP_Helpers()->span_label( __( 'Verbose Mode', WPFP_DOMAIN ) ); ?>
										
							<?php

								WPFP_Helpers()->tooltip( __( 'If active, displays console logs.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->switch_button( WPFP_SETTINGS_FULLPAGE_OPTIONS, 'verboseMode', array(
									'yes' => __( 'yes', WPFP_DOMAIN ),
									'no'  => __( 'no', WPFP_DOMAIN ),
								), isset( $verboseMode ) ? $verboseMode : 'no', 'no' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Debug Mode -->

				</div>
			</li><!-- Debug -->

		</ul>

		<?php WPFP_Helpers()->modal_reset(); ?>
		
		<?php WPFP_Helpers()->submit(); ?>

		<div class="clear"></div>

	</form>

</div>
