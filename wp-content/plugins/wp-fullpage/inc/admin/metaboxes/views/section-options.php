<?php

/**
 * Template for Section Option Metabox
 * 
 * @package 	WP_Fullpage\Includes\Metaboxes\Views
 */

?>
<div class="container wpfp-wrap">

	<h3 class="teal-text text-lighten-1 center-align"><?php _e( 'WP Fullpage Section Options', WPFP_DOMAIN ); ?><i class="material-icons medium yellow-text text-accent-2 over-rotate right">stay_current_landscape</i></h3>
	
	<p class="teal-text text-lighten-1 center-align flow-text"><?php _e( 'Here you can setup your FullPage Section.', WPFP_DOMAIN ); ?></p>

	<ul id="wpfp-settingsbox" class="collapsible popout z-depth-3" data-collapsible="expandable">
		
		<li><!-- Slides Content -->
			<div class="collapsible-header teal-text text-lighten-1 flow-text waves-effect waves-light"><i class="material-icons red-text text-lighten-2">view_week</i><?php _e( 'Slides Content', WPFP_DOMAIN ); ?></div>
			<div class="collapsible-body">

				<div class="row"><!-- Section Type -->

					<?php WPFP_Helpers()->input_field_label_start(); ?>

						<?php

							WPFP_Helpers()->label( __( 'Slides Type', WPFP_DOMAIN ), 'slidesType' );

						?>

						<?php

							WPFP_Helpers()->tooltip( __( 'Which type of slides do you want to display for this Section.', WPFP_DOMAIN ), 'wpfp-tip' );

						?>

					<?php WPFP_Helpers()->input_field_label_end(); ?>

					<?php WPFP_Helpers()->input_field_start(); ?>

						<?php

							WPFP_Helpers()->select( WPFP_SECTION_PT_SLIDES_OPTIONS, 'slidesType', array(
								'section'        => __( 'Simple Section', WPFP_DOMAIN ),
								'slides'        => __( 'Slides', WPFP_DOMAIN ),
								'post-taxonomies' => __( 'Post Taxonomies', WPFP_DOMAIN ),
								'post-types'      => __( 'Post Types', WPFP_DOMAIN ),
							), isset( $slidesType ) ? $slidesType : '', '', 'no-reset' );

						?>

					<?php WPFP_Helpers()->input_field_end(); ?>
				
				</div><!-- Section Type -->

				<div id="slides-wrapper" class="row wpfp-slide-wrapper"><!-- Slides -->
					
					<div class="container">
						
						<h4><?php _e( 'Slides', WPFP_DOMAIN ); ?></h4>
						
						<div class="row"><!-- Slides -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Slides', WPFP_DOMAIN ), 'bbm-slides-list-launcher' );

								?>

								<?php

									WPFP_Helpers()->tooltip( __( 'Add and reorder some slides to your Section.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<ul id="sortableSlides"></ul>
								
								<?php

									WPFP_Helpers()->hidden( WPFP_SECTION_PT_SLIDES_OPTIONS . '[slides]', 'slides-list', isset( $slides ) ? $slides : '' );

								?>
								
								<?php

									$datas = array(
										'postType' => WPFP_FULLPAGE_SLIDE_PT,
									);
								
								?>

								<?php

									WPFP_Helpers()->button( 'bbm-slides-list-launcher', __( 'Add slides' , WPFP_DOMAIN ), $datas );

								?>

								<div class="clear"></div>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Slides -->
					
					</div>
				
				</div><!-- Slides -->

				<div id="post-taxonomies-or-types-wrapper" class="row wpfp-slide-wrapper"><!-- Post Taxonomies or Types -->

					<div class="container">
						
						<h4 class="post-taxonomies-wrapper"><?php _e( 'Post taxonomies', WPFP_DOMAIN ); ?></h4>
						
						<h4 class="post-types-wrapper"><?php _e( 'Post types', WPFP_DOMAIN ); ?></h4>

						<div class="row"><!-- Teaser -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php WPFP_Helpers()->span_label( __( 'Teaser', WPFP_DOMAIN ) ); ?>

								<?php

									WPFP_Helpers()->tooltip( __( 'Display the teaser?', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->switch_button( WPFP_SECTION_PT_CUSTOM_OPTIONS, 'teaserDisplay', array(
										'yes' => __( 'yes', WPFP_DOMAIN ),
										'no'  => __( 'no', WPFP_DOMAIN ),
									), isset( $teaserDisplay ) ? $teaserDisplay : 'yes', isset( $TEASERDISPLAY ) ? $TEASERDISPLAY : 'yes' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Teaser -->

						<div id="teaserLength-container" class="row"><!-- Teaser Length -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Teaser Length', WPFP_DOMAIN ), 'teaserLength' );

								?>

								<?php

									WPFP_Helpers()->tooltip( __( 'How many characters do you want to display in the teaser? If set to "0", it will take the default value af your theme.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->number( WPFP_SECTION_PT_CUSTOM_OPTIONS, 'teaserLength', isset( $teaserLength ) ? $teaserLength : 100, isset( $TEASERLENGTH ) ? $TEASERLENGTH : 100, 0, 1000, 10, 'small-text' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Teaser Length -->

						<div class="row"><!-- Count -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Count', WPFP_DOMAIN ), 'countPosts' );

								?>

								<?php

									WPFP_Helpers()->tooltip( __( 'How many posts do you want to display?', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->number( WPFP_SECTION_PT_CUSTOM_OPTIONS, 'countPosts', isset( $teaserLength ) ? $countPosts : get_option( 'posts_per_page' ), isset( $COUNTPOSTS ) ? $COUNTPOSTS : get_option( 'posts_per_page' ), 1, 100, 1, 'small-text' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Count -->

						<div class="row"><!-- Order By -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Order By', WPFP_DOMAIN ), 'orderBy' );

								?>
						
								<?php

									WPFP_Helpers()->tooltip( __( 'What do you want to order the list with?', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->select( WPFP_SECTION_PT_CUSTOM_OPTIONS, 'orderBy', array(
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
									), isset( $orderBy ) ? $orderBy : 'date', isset( $ORDERBY ) ? $ORDERBY : 'date' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Order By -->

						<div id="orderByMetaValueKey-container" class="row"><!-- Order By Meta Value Key -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Order By Meta Value Key', WPFP_DOMAIN ), 'orderByMetaValueKey' );

								?>
						
								<?php

									WPFP_Helpers()->tooltip( __( 'which meta key do you want to use to order the list?', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->text( WPFP_SECTION_PT_CUSTOM_OPTIONS, 'orderByMetaValueKey', isset( $orderByMetaValueKey ) ? $orderByMetaValueKey : '', isset( $ORDERBYMETAVALUEKEY ) ? $ORDERBYMETAVALUEKEY : '', __( 'eg: my_meta_key', WPFP_DOMAIN ) );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Order By Meta Value Key -->

						<div class="row"><!-- Order -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Order', WPFP_DOMAIN ), 'order' );

								?>
						
								<?php

									WPFP_Helpers()->tooltip( __( 'How do you want to order the list?', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->select( WPFP_SECTION_PT_CUSTOM_OPTIONS, 'order', array(
										'ASC'  => __( 'ASC', WPFP_DOMAIN ),
										'DESC' => __( 'DESC', WPFP_DOMAIN ),
									), isset( $order ) ? $order : 'ASC', isset( $ORDER ) ? $ORDER : 'ASC' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Order -->

						<div class="row post-taxonomies-wrapper"><!-- Taxonomy -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Taxonomy', WPFP_DOMAIN ), 'taxonomy' );

								?>
						
								<?php

									WPFP_Helpers()->tooltip( __( 'Which taxonomy do you want to list?', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									$_taxonomies = array();

									foreach ( $taxonomies as $_taxonomy )
										$_taxonomies[$_taxonomy->name] = $_taxonomy->label;

									WPFP_Helpers()->select( WPFP_SECTION_PT_SLIDES_OPTIONS, 'taxonomy', $_taxonomies, isset( $taxonomy ) ? $taxonomy : '', '', 'taxonomy no-reset' );

								?>	

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Taxonomy -->

						<div class="row post-taxonomies-wrapper"><!-- Term of the taxonomy -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Term of the taxonomy', WPFP_DOMAIN ), '' );

								?>
						
								<?php

									WPFP_Helpers()->tooltip( __( 'Which term of the taxonomy do you want to list?', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->hidden( WPFP_SECTION_PT_SLIDES_OPTIONS . '[term]', 'term', isset( $term ) ? $term : '' );

								?>

								<?php

									foreach ( $terms as $_taxonomy => $_terms ) :

										$__terms = array();

										foreach ( $_terms as $_term )
											$__terms[$_term->term_id] = $_term->name;

										WPFP_Helpers()->select( WPFP_SECTION_PT_SLIDES_OPTIONS, $_taxonomy . '-term', $__terms, isset( $term ) ? $term : '', '', 'term no-reset' );


									endforeach;

								?>	

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Term of the taxonomy -->

						<div class="row post-taxonomies-wrapper"><!-- Include Children -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Include Children', WPFP_DOMAIN ), '' );

								?>

								<?php

									WPFP_Helpers()->tooltip( __( 'Do you want to include children of the term?', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									WPFP_Helpers()->switch_button( WPFP_SECTION_PT_SLIDES_OPTIONS, 'includeChildren', array(
										'yes' => __( 'yes', WPFP_DOMAIN ),
										'no'  => __( 'no', WPFP_DOMAIN ),
									), isset( $includeChildren ) ? $includeChildren : 'no', isset( $INCLUDECHILDREN ) ? $INCLUDECHILDREN : 'no' );

								?>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Include Children -->

						<div class="row post-types-wrapper"><!-- Post Type -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Post Type', WPFP_DOMAIN ), 'postType' );

								?>
						
								<?php

									WPFP_Helpers()->tooltip( __( 'Which post type do you want to list?', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<?php

									$___post_types = array();

									foreach ( $post_types as $__post_type => $__post_type_object )
										$___post_types[$__post_type] = $__post_type_object->labels->singular_name;

									WPFP_Helpers()->select( WPFP_SECTION_PT_SLIDES_OPTIONS, 'postType', $___post_types, isset( $postType ) ? $postType : '', '', 'postType no-reset' );

								?>	

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Post Type -->

						<div class="row "><!-- Included Posts -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Included Posts', WPFP_DOMAIN ), 'bbm-included-posts-launcher' );

								?>

								<?php

									WPFP_Helpers()->tooltip( __( 'The posts to include.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<ul id="sortableIncludedPosts"></ul>

								<?php

									WPFP_Helpers()->hidden( WPFP_SECTION_PT_SLIDES_OPTIONS . '[includedPosts]', 'included-posts', isset( $includedPosts ) ? $includedPosts : '' );

								?>	
								
								<div class="post-taxonomies-wrapper">

									<?php

										foreach ( $terms as $_taxonomy => $_terms ) :

									?>
												
										<?php

											foreach ( $_terms as $_term ) :
												
												$datas = array(
													'taxonomy' => $_taxonomy,
													'termID' => $_term->term_id,
												);

												$dataKey = 'includedPosts' . ucfirst( $_taxonomy ) . $_term->term_id;

												?>

													<?php

														WPFP_Helpers()->hidden( WPFP_SECTION_PT_SLIDES_OPTIONS . '[' . $dataKey . ']', 'included-posts-' . $_taxonomy . '-' . $_term->term_id, isset( $$dataKey ) ? $$dataKey : '' );

													?>

													<?php

														WPFP_Helpers()->button( 'bbm-included-posts-of-term-launcher-' . $_taxonomy . '-' . $_term->term_id, sprintf( __( 'Include posts of term "%1s"' , WPFP_DOMAIN ), $_term->name ), $datas, 'bbm-included-posts-of-term-launcher' );

													?>
												
												<?php

											endforeach;
									
										?>

									<?php

										endforeach;

									?>
								
								</div>

								<div class="post-types-wrapper">

									<?php

										foreach ( $post_types as $__post_type => $__post_type_object ) :
											
											$datas = array(
												'postType' => $__post_type,
											);

											$dataKey = 'includedPosts' . ucfirst( $__post_type );

											?>

												<?php

													WPFP_Helpers()->hidden( WPFP_SECTION_PT_SLIDES_OPTIONS . '[' . $dataKey . ']', 'included-posts-' . $__post_type, isset( $$dataKey ) ? $$dataKey : '' );

												?>

												<?php

													WPFP_Helpers()->button( 'bbm-included-posts-of-type-launcher-' . $__post_type, sprintf( __( 'Include posts of type "%1s"' , WPFP_DOMAIN ), $__post_type_object->labels->singular_name ), $datas, 'bbm-included-posts-of-type-launcher' );

												?>
											
											<?php

										endforeach;

									?>

								</div>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Included Posts -->

						<div class="row "><!-- Excluded Posts -->

							<?php WPFP_Helpers()->input_field_label_start(); ?>

								<?php

									WPFP_Helpers()->label( __( 'Excluded Posts', WPFP_DOMAIN ), 'bbm-excluded-posts-launcher' );

								?>

								<?php

									WPFP_Helpers()->tooltip( __( 'The posts to exclude.', WPFP_DOMAIN ), 'wpfp-tip' );

								?>

							<?php WPFP_Helpers()->input_field_label_end(); ?>

							<?php WPFP_Helpers()->input_field_start(); ?>

								<ul id="sortableExcludedPosts"></ul>

								<?php

									WPFP_Helpers()->hidden( WPFP_SECTION_PT_SLIDES_OPTIONS . '[excludedPosts]', 'excluded-posts', isset( $excludedPosts ) ? $excludedPosts : '' );

								?>

								<div class="post-taxonomies-wrapper">

									<?php

										foreach ( $terms as $_taxonomy => $_terms ) :

									?>
												
										<?php

											foreach ( $_terms as $_term ) :
												
												$datas = array(
													'taxonomy' => $_taxonomy,
													'termID' => $_term->term_id,
												);

												$dataKey = 'excludedPosts' . ucfirst( $_taxonomy ) . $_term->term_id;

												?>

													<?php

														WPFP_Helpers()->hidden( WPFP_SECTION_PT_SLIDES_OPTIONS . '[' . $dataKey . ']', 'excluded-posts-' . $_taxonomy . '-' . $_term->term_id, isset( $$dataKey ) ? $$dataKey : '' );

													?>

													<?php

														WPFP_Helpers()->button( 'bbm-excluded-posts-of-term-launcher-' . $_taxonomy . '-' . $_term->term_id, sprintf( __( 'Exclude posts of term "%1s"' , WPFP_DOMAIN ), $_term->name ), $datas, 'bbm-excluded-posts-of-term-launcher' );

													?>
												
												<?php

											endforeach;
									
										?>

									<?php

										endforeach;

									?>

								</div>

								<div class="post-types-wrapper">

									<?php

										foreach ( $post_types as $__post_type => $__post_type_object ) :
											
											$datas = array(
												'postType' => $__post_type,
											);

											$dataKey = 'excludedPosts' . ucfirst( $__post_type );

											?>

												<?php

													WPFP_Helpers()->hidden( WPFP_SECTION_PT_SLIDES_OPTIONS . '[' . $dataKey . ']', 'excluded-posts-' . $__post_type, isset( $$dataKey ) ? $$dataKey : '' );

												?>

												<?php

													WPFP_Helpers()->button( 'bbm-excluded-posts-of-type-launcher-' . $__post_type, sprintf( __( 'Exclude posts of type "%1s"' , WPFP_DOMAIN ), $__post_type_object->labels->singular_name ), $datas, 'bbm-excluded-posts-of-type-launcher' );

												?>
											
											<?php

										endforeach;

									?>
									
								</div>

							<?php WPFP_Helpers()->input_field_end(); ?>

						</div><!-- Excluded Posts -->
					
					</div>
				
				</div><!-- Post Taxonomies or Types -->

			</div>
		</li><!-- Slides Content -->
		
		<li><!-- Styling -->
			<div class="collapsible-header teal-text text-lighten-1 flow-text waves-effect waves-light"><i class="material-icons red-text text-lighten-2">stars</i><?php _e( 'Styling', WPFP_DOMAIN ); ?></div>
			<div class="collapsible-body">
				
				<ul class="m-tabs">
					<li class="tab col s6"><a href="#styling-general" class="active"><?php _e( 'General Parameters', WPFP_DOMAIN ); ?></a></li>
					<li class="tab col s6"><a href="#styling-design"><?php _e( 'Design Parameters', WPFP_DOMAIN ); ?></a></li>
				</ul>

				<div id="styling-general" class="col s12">

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

								WPFP_Helpers()->select( WPFP_SECTION_PT_SLIDES_OPTIONS, 'verticalPosition', array(
									'inherit' => __( 'Inherit from Fullpage', WPFP_DOMAIN ),
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

								WPFP_Helpers()->select( WPFP_SECTION_PT_SLIDES_OPTIONS, 'horizontalPosition', array(
									'inherit' => __( 'Inherit from Fullpage', WPFP_DOMAIN ),
									'center' => __( 'Center', WPFP_DOMAIN ),
									'left'   => __( 'Left', WPFP_DOMAIN ),
									'right'  => __( 'Right', WPFP_DOMAIN ),
								), isset( $horizontalPosition ) ? $horizontalPosition : 'inherit', 'inherit' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Horizontal Position -->

					<div class="row"><!-- Auto Height -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php WPFP_Helpers()->span_label( __( 'Auto Height', WPFP_DOMAIN ) ); ?>

							<?php

								WPFP_Helpers()->tooltip( __( 'It is possible to use sections or slides which don&apos;t take the whole viewport height resulting in smaller sections. This is ideal for footers. It is important to realise that it doesn&apos;t make sense to have all of your sections using this feature. If there is more than one section in the initial load of the site, the plugin won&apos;t scroll at all to see the next one as it will be already in the viewport.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->switch_button( WPFP_SECTION_PT_SECTION_OPTIONS, 'autoHeight', array(
									'yes' => __( 'yes', WPFP_DOMAIN ),
									'no'  => __( 'no', WPFP_DOMAIN ),
								), isset( $autoHeight ) ? $autoHeight : 'no', isset( $AUTOHEIGHT ) ? $AUTOHEIGHT : 'no' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>

					</div><!-- Auto Height -->

					</div>

				<div id="styling-design" class="col s12">

					<div class="row"><!-- Section Color -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Section Color', WPFP_DOMAIN ), 'sectionColor' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'Define the CSS background-color property for the section. If empty, it will use the FullPage option.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->text( WPFP_SECTION_PT_SECTION_OPTIONS, 'sectionColor', isset( $sectionColor ) ? $sectionColor : '', isset( $SECTIONCOLOR ) ? $SECTIONCOLOR : '', __( 'eg: #ffffff, white, ...', WPFP_DOMAIN ), 'wpfp-color' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Section Color -->

					<div class="row"><!-- Slides Color -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Slides Color', WPFP_DOMAIN ), 'slideColor' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'Define the CSS background-color property for the slides. If empty, it will use the FullPage option.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->text( WPFP_SECTION_PT_SLIDES_OPTIONS, 'slideColor', isset( $slideColor ) ? $slideColor : '', isset( $SLIDECOLOR ) ? $SLIDECOLOR : '', __( 'eg: #ffffff, white, ...', WPFP_DOMAIN ), 'wpfp-color' );

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

								WPFP_Helpers()->tooltip( __( 'Whether you want to display post title in this slide.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->select( WPFP_SECTION_PT_SLIDES_OPTIONS, 'displayTitle', array(
									'inherit' => __( 'Inherit from FullPage', WPFP_DOMAIN ),
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

								WPFP_Helpers()->select( WPFP_SECTION_PT_SLIDES_OPTIONS, 'displaySectionTitle', array(
									'inherit' => __( 'Inherit from FullPage', WPFP_DOMAIN ),
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

								WPFP_Helpers()->select( WPFP_SECTION_PT_SLIDES_OPTIONS, 'displayDate', array(
									'inherit' => __( 'Inherit from FullPage', WPFP_DOMAIN ),
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

								WPFP_Helpers()->select( WPFP_SECTION_PT_SLIDES_OPTIONS, 'displayAuthor', array(
									'inherit' => __( 'Inherit from FullPage', WPFP_DOMAIN ),
									'yes'     => __( 'Yes', WPFP_DOMAIN ),
									'no'      => __( 'No', WPFP_DOMAIN ),
								), isset( $displayAuthor ) ? $displayAuthor : 'inherit', 'inherit' );

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

								WPFP_Helpers()->tooltip( __( 'The content width of this slide in "%". If set to "0", will inherit the fullPage&apos;s content width.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->number( WPFP_SECTION_PT_SLIDES_OPTIONS, 'contentWidth', isset( $contentWidth ) ? $contentWidth : 0, 0, 0, 100, 1, 'small-text' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Content Width -->

					<div class="row"><!-- Content Inner Horizontal Margin -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Content Inner Horizontal Margin', WPFP_DOMAIN ), 'contentInnerHMargin' );

							?>
										
							<?php

								WPFP_Helpers()->tooltip( __( 'The content inner horizontal margin of this slide in "%". If set to "0", will inherit the fullPage&apos;s content inner margin.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->number( WPFP_SECTION_PT_SLIDES_OPTIONS, 'contentInnerHMargin', isset( $contentInnerHMargin ) ? $contentInnerHMargin : 0, 0, 0, 100, 1, 'small-text' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Content Inner Horizontal Margin -->

					<div class="row"><!-- Content Inner Vertical Margin -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Content Inner Vertical Margin', WPFP_DOMAIN ), 'contentInnerVMargin' );

							?>
										
							<?php

								WPFP_Helpers()->tooltip( __( 'The content inner vertical margin of this slide in "%". If set to "0", will inherit the fullPage&apos;s content inner margin.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->number( WPFP_SECTION_PT_SLIDES_OPTIONS, 'contentInnerVMargin', isset( $contentInnerVMargin ) ? $contentInnerVMargin : 0, 0, 0, 100, 1, 'small-text' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Content Inner Vertical Margin -->

					<div class="row"><!-- Content Background Color -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Content Background-Color', WPFP_DOMAIN ), 'contentBackgroundColor' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'The content background-color of this slide. If empty, will inherit the fullPage&apos;s background-color.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->text( WPFP_SECTION_PT_SLIDES_OPTIONS, 'contentBackgroundColor', isset( $contentBackgroundColor ) ? $contentBackgroundColor : '', '', __( 'eg: #ffffff, white, ...', WPFP_DOMAIN ), 'wpfp-color' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>

					</div><!-- Content Background Color -->

					<div class="row"><!-- Content Style -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Content Style', WPFP_DOMAIN ), 'contentStyle' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'The content style of slides of this section&apos;s slides. If empty, will inherit the fullPage&apos;s content style.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>
						
							<?php WPFP_Helpers()->div_helper( __( 'eg:', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">margin-top</span>: 20px;', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">margin-bottom</span>: 30px; ...', WPFP_DOMAIN ) ); ?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->ace_textarea( WPFP_SECTION_PT_SLIDES_OPTIONS, 'contentStyle', isset( $contentStyle ) ? $contentStyle : '', '', '', 'ace-css' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>

					</div><!-- Content Style -->

					<div class="row"><!-- Inner Content Style -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Inner Content Style', WPFP_DOMAIN ), 'innerContentStyle' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'The inner content style of this section&apos;s slides. If empty, will inherit the fullPage&apos;s content style.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>
						
							<?php WPFP_Helpers()->div_helper( __( 'eg:', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">margin-top</span>: 20px;', WPFP_DOMAIN ) ); ?>
							<?php WPFP_Helpers()->div_helper( __( '<span class="var">margin-bottom</span>: 30px; ...', WPFP_DOMAIN ) ); ?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->ace_textarea( WPFP_SECTION_PT_SLIDES_OPTIONS, 'innerContentStyle', isset( $innerContentStyle ) ? $innerContentStyle : '', '', '', 'ace-css' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>

					</div><!-- Inner Content Style -->

				</div>

			</div>
		</li><!-- Content Styling -->
		
		<li><!-- Scrolling -->
			<div class="collapsible-header teal-text text-lighten-1 flow-text waves-effect waves-light"><i class="material-icons red-text text-lighten-2">swap_vert</i><?php _e( 'Scrolling', WPFP_DOMAIN ); ?></div>
			<div class="collapsible-body">

				<div class="row"><!-- CSS3 Transition effect -->

					<?php WPFP_Helpers()->input_field_label_start(); ?>

						<?php

							WPFP_Helpers()->label( __( 'Horizontal CSS3 Transition effect', WPFP_DOMAIN ), 'easingCss3' );

						?>
									
						<?php

							WPFP_Helpers()->tooltip( __( 'Defines the transition effect to use for the horizontal scrolling in case of CSS3.', WPFP_DOMAIN ), 'wpfp-tip' );

						?>

					<?php WPFP_Helpers()->input_field_label_end(); ?>

					<?php WPFP_Helpers()->input_field_start(); ?>

						<?php

							WPFP_Helpers()->select( WPFP_SECTION_PT_FULLPAGE_OPTIONS, 'easingCss3', array(
								'inherit'           => __( 'Inherit from FullPage', WPFP_DOMAIN ),
								'linear'            => __( 'Linear', WPFP_DOMAIN ),
								'ease'              => __( 'Ease', WPFP_DOMAIN ),
								'ease-in'           => __( 'Ease In', WPFP_DOMAIN ),
								'ease-out'          => __( 'Ease Out', WPFP_DOMAIN ),
								'ease-in-out'       => __( 'Ease In Out', WPFP_DOMAIN ),
								'ease-in-sine'      => __( 'Ease In Sine', WPFP_DOMAIN ),
								'ease-out-sine'     => __( 'Ease Out Sine', WPFP_DOMAIN ),
								'ease-in-out-sine'  => __( 'Ease In Out Sine', WPFP_DOMAIN ),
								'ease-in-circ'      => __( 'Ease In Circ', WPFP_DOMAIN ),
								'ease-out-circ'     => __( 'Ease Out Circ', WPFP_DOMAIN ),
								'ease-in-out-circ'  => __( 'Ease In Out Circ', WPFP_DOMAIN ),
								'ease-in-quad'      => __( 'Ease In Quad', WPFP_DOMAIN ),
								'ease-out-quad'     => __( 'Ease Out Quad', WPFP_DOMAIN ),
								'ease-in-out-quad'  => __( 'Ease In Out Quad', WPFP_DOMAIN ),
								'ease-in-cubic'     => __( 'Ease In Cubic', WPFP_DOMAIN ),
								'ease-out-cubic'    => __( 'Ease Out Cubic', WPFP_DOMAIN ),
								'ease-in-out-cubic' => __( 'Ease In Out Cubic', WPFP_DOMAIN ),
								'ease-in-quart'     => __( 'Ease In Quart', WPFP_DOMAIN ),
								'ease-out-quart'    => __( 'Ease Out Quart', WPFP_DOMAIN ),
								'ease-in-out-quart' => __( 'Ease In Out Quart', WPFP_DOMAIN ),
								'ease-in-quint'     => __( 'Ease In Quint', WPFP_DOMAIN ),
								'ease-out-quint'    => __( 'Ease Out Quint', WPFP_DOMAIN ),
								'ease-in-out-quint' => __( 'Ease In Out Quint', WPFP_DOMAIN ),
								'ease-in-expo'      => __( 'Ease In Expo', WPFP_DOMAIN ),
								'ease-out-expo'     => __( 'Ease Out Expo', WPFP_DOMAIN ),
								'ease-in-out-expo'  => __( 'Ease In Out Expo', WPFP_DOMAIN ),
								'ease-in-back'      => __( 'Ease In Back', WPFP_DOMAIN ),
								'ease-out-back'     => __( 'Ease Out Back', WPFP_DOMAIN ),
								'ease-in-out-back'  => __( 'Ease In Out Back', WPFP_DOMAIN ),
							), isset( $easingCss3 ) ? $easingCss3 : 'inherit', 'inherit' );

						?>

					<?php WPFP_Helpers()->input_field_end(); ?>
				
				</div><!-- CSS3 Transition effect -->

			</div>
		</li><!-- Scrolling -->
		
		<li><!-- Navigation -->
			<div class="collapsible-header teal-text text-lighten-1 flow-text waves-effect waves-light"><i class="material-icons red-text text-lighten-2">navigation</i><?php _e( 'Navigation', WPFP_DOMAIN ); ?></div>
			<div class="collapsible-body">
				
				<ul class="m-tabs">
					<li class="tab col s6"><a href="#navigation-general" class="active"><?php _e( 'General Parameters', WPFP_DOMAIN ); ?></a></li>
					<li class="tab col s6"><a href="#navigation-design"><?php _e( 'Design Parameters', WPFP_DOMAIN ); ?></a></li>
				</ul>

				<div id="navigation-general" class="col s12">

					<div class="row"><!-- Navigation Title -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Navigation Title', WPFP_DOMAIN ), 'navTitle' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'Which metadata do you want to use for the navigation tooltip in case it is being used? If the metadata is empty or does not exists, it will display the title instead. If empty, it will use the FullPage option.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->text( WPFP_SECTION_PT_SECTION_OPTIONS, 'navTitle', isset( $navTitle ) ? $navTitle : '', isset( $NAVTITLE ) ? $NAVTITLE : '', __( 'eg: my_metadata', WPFP_DOMAIN ) );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Navigation Title -->

					<div class="row"><!-- Slides Navigation -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php WPFP_Helpers()->span_label( __( 'Slides Navigation', WPFP_DOMAIN ) ); ?>
										
							<?php

								WPFP_Helpers()->tooltip( __( 'If active, it will show a navigation bar made up of small circles for each landscape slider on the site. Choose Inherit to use Fullpage option.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->select( WPFP_SECTION_PT_FULLPAGE_OPTIONS, 'slidesNavigation', array(
									'inherit' => __( 'Inherit from FullPage', WPFP_DOMAIN ),
									'yes'     => __( 'yes', WPFP_DOMAIN ),
									'no'      => __( 'no', WPFP_DOMAIN ),
								), isset( $slidesNavigation ) ? $slidesNavigation : 'inherit', 'inherit' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Slides Navigation -->

					<div class="row"><!-- Slides Nav Position -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Slides Nav Position', WPFP_DOMAIN ), 'slidesNavPosition' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'Defines the position for the landscape navigation bar for sliders. Admits top and bottom as values. Choose Inherit to use Fullpage option.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->select( WPFP_SECTION_PT_FULLPAGE_OPTIONS, 'slidesNavPosition', array(
									'inherit' => __( 'Inherit from FullPage', WPFP_DOMAIN ),
									'top'     => __( 'Top', WPFP_DOMAIN ),
									'bottom'  => __( 'Bottom', WPFP_DOMAIN ),
								), isset( $slidesNavPosition ) ? $slidesNavPosition : 'inherit', 'inherit' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Slides Nav Position -->

					<div class="row"><!-- Slides Navigation Title -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Slides Navigation Title', WPFP_DOMAIN ), 'slidesNavTitle' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'Which metadata do you want to use for the slides navigation tooltips in case they are being used? If the metadata is empty or does not exists, it will display the title instead. If empty, it will use the FullPage option.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->text( WPFP_SECTION_PT_FULLPAGE_OPTIONS, 'slidesNavTitle', isset( $slidesNavTitle ) ? $slidesNavTitle : '', isset( $SLIDESNAVTITLE ) ? $SLIDESNAVTITLE : '', __( 'eg: my_metadata', WPFP_DOMAIN ) );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>
					
					</div><!-- Slides Navigation Title -->

				</div>

				<div id="navigation-design" class="col s12">

					<div class="row"><!-- Slides Navigation Color -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Slides Navigation Color', WPFP_DOMAIN ), 'slidesNavigationColor' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'The Slides Navigation color. If empty, it will use the FullPage option.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->text( WPFP_SECTION_PT_SECTION_OPTIONS, 'slidesNavigationColor', isset( $slidesNavigationColor ) ? $slidesNavigationColor : '', '', __( 'eg: #ffffff, white, ...', WPFP_DOMAIN ), 'wpfp-color' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>

					</div><!-- Slides Navigation Color -->

					<div class="row"><!-- Slides Navigation Active Color -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Slides Navigation Active Color', WPFP_DOMAIN ), 'slidesNavigationActiveColor' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'The Slides Navigation Active color. If empty, it will use the FullPage option.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->text( WPFP_SECTION_PT_SECTION_OPTIONS, 'slidesNavigationActiveColor', isset( $slidesNavigationActiveColor ) ? $slidesNavigationActiveColor : '', '', __( 'eg: #ffffff, white, ...', WPFP_DOMAIN ), 'wpfp-color' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>

					</div><!-- Slides Navigation Active Color -->

					<div class="row"><!-- Navigation Arrows Color -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Navigation Arrows Color', WPFP_DOMAIN ), 'navigationArrowsColor' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'The Navigation Arrows color. If empty, it will use the FullPage option.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->text( WPFP_SECTION_PT_SECTION_OPTIONS, 'navigationArrowsColor', isset( $navigationArrowsColor ) ? $navigationArrowsColor : '', '', __( 'eg: #ffffff, white, ...', WPFP_DOMAIN ), 'wpfp-color' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>

					</div><!-- Navigation Arrows Color -->

					<div class="row"><!-- Navigation Arrows Hover Color -->

						<?php WPFP_Helpers()->input_field_label_start(); ?>

							<?php

								WPFP_Helpers()->label( __( 'Navigation Arrows Hover Color', WPFP_DOMAIN ), 'navigationArrowsHoverColor' );

							?>

							<?php

								WPFP_Helpers()->tooltip( __( 'The Navigation Arrows Hover color. If empty, it will use the FullPage option.', WPFP_DOMAIN ), 'wpfp-tip' );

							?>

						<?php WPFP_Helpers()->input_field_label_end(); ?>

						<?php WPFP_Helpers()->input_field_start(); ?>

							<?php

								WPFP_Helpers()->text( WPFP_SECTION_PT_SECTION_OPTIONS, 'navigationArrowsHoverColor', isset( $navigationArrowsHoverColor ) ? $navigationArrowsHoverColor : '', '', __( 'eg: #ffffff, white, ...', WPFP_DOMAIN ), 'wpfp-color' );

							?>

						<?php WPFP_Helpers()->input_field_end(); ?>

					</div><!-- Navigation Arrows Hover Color -->

				</div>

			</div>
		</li><!-- Navigation -->

	</ul>

	<?php WPFP_Helpers()->modal_reset(); ?>

	<div class="clear"></div>

</div>
