<?php

/**
 * WP Fullpage Post Types
 * 
 * @package 	WP_Fullpage\Includes\Post_Types
 * @subpackage 	WP_Fullpage\Includes\Absctract\Classes
 */
class WP_Fullpage_Post_Types extends WP_Fullpage_Base {

	/**
	 * Init Post Types
	 *
	 * @return  void
	 */
	public function init( $dir = __DIR__, $file = __FILE__ ) {
		
		$this->actions_filters();

	} // END public function init

	/**
	 * Register Actions and Filters
	 * 
	 * @return  void
	 */
	private function actions_filters() {

		// Post Types Init
		add_action( 'init', array( &$this, 'post_types_register' ) );
		
		// Remove "Add new" entry
		add_action( 'admin_menu', array( &$this, 'remove_add_new' ) );
		
		// Post Types Updated Messages Init
		add_filter( 'post_updated_messages', array( &$this, 'post_types_updated_messages_init' ) );

	} // END private function actions_filters

	/**
	 * Register Post Types
	 * 
	 * @return  void
	 */
	public function post_types_register() {

		// 'fullpage' post type register
		$this->fullpage_type_register();

		// 'fullpage-section' post type register
		$this->fullpage_section_type_register();

		// 'fullpage-slide' post type register
		$this->fullpage_slide_type_register();

	} // END public function post_types_register

	/**
	 * Post Types Updated Messages Init
	 * 
	 * @return  void
	 */
	public function post_types_updated_messages_init( $messages ) {

		// 'fullpage' post type Updated Messages
		$messages = $this->fullpage_type_updated_messages( $messages );

		// 'fullpage-section' post type Updated Messages
		$messages = $this->fullpage_section_type_updated_messages( $messages );

		// 'fullpage-slide' post type Updated Messages
		$messages = $this->fullpage_slide_type_updated_messages( $messages );

		return $messages;

	} // END public function post_types_updated_messages_init

	/**
	 * 'fullpage' post type register
	 * 
	 * @return  void
	 */
	public function fullpage_type_register() {

		$labels = array(
			'name'               => _x( 'FullPages', 'post type general name', WPFP_DOMAIN ),
			'singular_name'      => _x( 'FullPage', 'post type singular name', WPFP_DOMAIN ),
			'menu_name'          => _x( 'FullPages', 'admin menu', WPFP_DOMAIN ),
			'name_admin_bar'     => _x( 'FullPage', 'add new on admin bar', WPFP_DOMAIN ),
			'add_new'            => _x( 'Add New', 'FullPage', WPFP_DOMAIN ),
			'add_new_item'       => __( 'Add New FullPage', WPFP_DOMAIN ),
			'new_item'           => __( 'New FullPage', WPFP_DOMAIN ),
			'edit_item'          => __( 'Edit FullPage', WPFP_DOMAIN ),
			'view_item'          => __( 'View FullPage', WPFP_DOMAIN ),
			'all_items'          => __( 'All FullPages', WPFP_DOMAIN ),
			'search_items'       => __( 'Search FullPages', WPFP_DOMAIN ),
			'parent_item_colon'  => __( 'Parent FullPages:', WPFP_DOMAIN ),
			'not_found'          => __( 'No FullPages found.', WPFP_DOMAIN ),
			'not_found_in_trash' => __( 'No FullPages found in Trash.', WPFP_DOMAIN )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => WPFP_FULLPAGE_PT ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'teaser' ),
			'menu_icon'          => 'dashicons-tablet'
		);

		register_post_type( WPFP_FULLPAGE_PT, $args );

	} // END public function fullpage_type_register

	/**
	 * 'fullpage-section' post type register
	 * 
	 * @return  void
	 */
	public function fullpage_section_type_register() {

		$labels = array(
			'name'               => _x( 'FullPage Sections', 'post type general name', WPFP_DOMAIN ),
			'singular_name'      => _x( 'FullPage Section', 'post type singular name', WPFP_DOMAIN ),
			'menu_name'          => _x( 'FullPage Sections', 'admin menu', WPFP_DOMAIN ),
			'name_admin_bar'     => _x( 'FullPage Section', 'add new on admin bar', WPFP_DOMAIN ),
			'add_new'            => _x( 'Add New', 'FullPage', WPFP_DOMAIN ),
			'add_new_item'       => __( 'Add New FullPage Section', WPFP_DOMAIN ),
			'new_item'           => __( 'New FullPage Section', WPFP_DOMAIN ),
			'edit_item'          => __( 'Edit FullPage Section', WPFP_DOMAIN ),
			'view_item'          => __( 'View FullPage Section', WPFP_DOMAIN ),
			'all_items'          => __( 'All Sections', WPFP_DOMAIN ),
			'search_items'       => __( 'Search FullPage Sections', WPFP_DOMAIN ),
			'parent_item_colon'  => __( 'Parent FullPage Sections:', WPFP_DOMAIN ),
			'not_found'          => __( 'No FullPage Sections found.', WPFP_DOMAIN ),
			'not_found_in_trash' => __( 'No FullPage Sections found in Trash.', WPFP_DOMAIN )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => 'edit.php?post_type=' . WPFP_FULLPAGE_PT,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => WPFP_FULLPAGE_SECTION_PT ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'teaser' )
		);

		register_post_type( WPFP_FULLPAGE_SECTION_PT, $args );

	} // END public function fullpage_section_type_register

	/**
	 * 'fullpage-slide' post type
	 * 
	 * @return  void
	 */
	public function fullpage_slide_type_register() {


		$labels = array(
			'name'               => _x( 'FullPage Slides', 'post type general name', WPFP_DOMAIN ),
			'singular_name'      => _x( 'FullPage Slide', 'post type singular name', WPFP_DOMAIN ),
			'menu_name'          => _x( 'FullPage Slides', 'admin menu', WPFP_DOMAIN ),
			'name_admin_bar'     => _x( 'FullPage Slide', 'add new on admin bar', WPFP_DOMAIN ),
			'add_new'            => _x( 'Add New', 'FullPage', WPFP_DOMAIN ),
			'add_new_item'       => __( 'Add New FullPage Slide', WPFP_DOMAIN ),
			'new_item'           => __( 'New FullPage Slide', WPFP_DOMAIN ),
			'edit_item'          => __( 'Edit FullPage Slide', WPFP_DOMAIN ),
			'view_item'          => __( 'View FullPage Slide', WPFP_DOMAIN ),
			'all_items'          => __( 'All Slides', WPFP_DOMAIN ),
			'search_items'       => __( 'Search FullPage Slides', WPFP_DOMAIN ),
			'parent_item_colon'  => __( 'Parent FullPage Slides:', WPFP_DOMAIN ),
			'not_found'          => __( 'No FullPage Slides found.', WPFP_DOMAIN ),
			'not_found_in_trash' => __( 'No FullPage Slides found in Trash.', WPFP_DOMAIN )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => 'edit.php?post_type=' . WPFP_FULLPAGE_PT,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => WPFP_FULLPAGE_SLIDE_PT ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'teaser', 'comments' )
		);

		register_post_type( WPFP_FULLPAGE_SLIDE_PT, $args );

	} // END public function fullpage_slide_type_register

	/**
	 * 'fullpage' post type Updated Messages
	 *
	 * See /wp-admin/edit-form-advanced.php
	 *
	 * @param  array  $messages Existing post update messages.
	 *
	 * @return array  Amended post update messages with new CPT update messages.
	 */
	public function fullpage_type_updated_messages( $messages ) {
		
		$post      = get_post();
		$post_type = get_post_type( $post );

		if( WPFP_FULLPAGE_PT == $post_type ) {

			$post_type_view     = __( 'View FullPage', WPFP_DOMAIN );
			$post_type_preview  = __( 'Preview FullPage', WPFP_DOMAIN );
			$post_type_messages = array(
				0  => '', // Unused. Messages start at index 1.
				1  => __( 'FullPage updated.', WPFP_DOMAIN ),
				2  => __( 'Custom field updated.', WPFP_DOMAIN ),
				3  => __( 'Custom field deleted.', WPFP_DOMAIN ),
				4  => __( 'FullPage updated.', WPFP_DOMAIN ),
				/* translators: %s: date and time of the revision */
				5  => isset( $_GET['revision'] ) ? sprintf( __( 'FullPage restored to revision from %s', WPFP_DOMAIN ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
				6  => __( 'FullPage published.', WPFP_DOMAIN ),
				7  => __( 'FullPage saved.', WPFP_DOMAIN ),
				8  => __( 'FullPage submitted.', WPFP_DOMAIN ),
				9  => sprintf(
					__( 'FullPage scheduled for: <strong>%1$s</strong>.', WPFP_DOMAIN ),
					// translators: Publish box date format, see http://php.net/date
					date_i18n( __( 'M j, Y @ G:i', WPFP_DOMAIN ), strtotime( $post->post_date ) )
				),
				10 => __( 'FullPage draft updated.', WPFP_DOMAIN )
			);

			$this->set_post_type_messages( $messages, $post_type, $post_type_messages, $post_type_view, $post_type_preview );

		}

		return $messages;
	
	} // END public function fullpage_type_updated_messages

	/**
	 * 'fullpage-section' post type Updated Messages
	 *
	 * See /wp-admin/edit-form-advanced.php
	 *
	 * @param  array  $messages Existing post update messages.
	 *
	 * @return array  Amended post update messages with new CPT update messages.
	 */
	public function fullpage_section_type_updated_messages( $messages ) {
		
		$post      = get_post();
		$post_type = get_post_type( $post );

		if( WPFP_FULLPAGE_SECTION_PT == $post_type ) {
			
			$post_type_view     = __( 'View FullPage Section', WPFP_DOMAIN );
			$post_type_preview  = __( 'Preview FullPage Section', WPFP_DOMAIN );
			$post_type_messages = array(
				0  => '', // Unused. Messages start at index 1.
				1  => __( 'FullPage Section updated.', WPFP_DOMAIN ),
				2  => __( 'Custom field updated.', WPFP_DOMAIN ),
				3  => __( 'Custom field deleted.', WPFP_DOMAIN ),
				4  => __( 'FullPage Section updated.', WPFP_DOMAIN ),
				/* translators: %s: date and time of the revision */
				5  => isset( $_GET['revision'] ) ? sprintf( __( 'FullPage Section restored to revision from %s', WPFP_DOMAIN ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
				6  => __( 'FullPage Section published.', WPFP_DOMAIN ),
				7  => __( 'FullPage Section saved.', WPFP_DOMAIN ),
				8  => __( 'FullPage Section submitted.', WPFP_DOMAIN ),
				9  => sprintf(
					__( 'FullPage Section scheduled for: <strong>%1$s</strong>.', WPFP_DOMAIN ),
					// translators: Publish box date format, see http://php.net/date
					date_i18n( __( 'M j, Y @ G:i', WPFP_DOMAIN ), strtotime( $post->post_date ) )
				),
				10 => __( 'FullPage Section draft updated.', WPFP_DOMAIN )
			);

			$this->set_post_type_messages( $messages, $post_type, $post_type_messages, $post_type_view, $post_type_preview );

		}

		return $messages;
	
	} // END public function fullpage_section_type_updated_messages

	/**
	 * 'fullpage-slide' post type Updated Messages
	 *
	 * See /wp-admin/edit-form-advanced.php
	 *
	 * @param  array  $messages Existing post update messages.
	 *
	 * @return array  Amended post update messages with new CPT update messages.
	 */
	public function fullpage_slide_type_updated_messages( $messages ) {
		
		$post      = get_post();
		$post_type = get_post_type( $post );

		if( WPFP_FULLPAGE_SLIDE_PT == $post_type ) {
			
			$post_type_view     = __( 'View FullPage Slide', WPFP_DOMAIN );
			$post_type_preview  = __( 'Preview FullPage Slide', WPFP_DOMAIN );
			$post_type_messages = array(
				0  => '', // Unused. Messages start at index 1.
				1  => __( 'FullPage Slide updated.', WPFP_DOMAIN ),
				2  => __( 'Custom field updated.', WPFP_DOMAIN ),
				3  => __( 'Custom field deleted.', WPFP_DOMAIN ),
				4  => __( 'FullPage Slide updated.', WPFP_DOMAIN ),
				/* translators: %s: date and time of the revision */
				5  => isset( $_GET['revision'] ) ? sprintf( __( 'FullPage Slide restored to revision from %s', WPFP_DOMAIN ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
				6  => __( 'FullPage Slide published.', WPFP_DOMAIN ),
				7  => __( 'FullPage Slide saved.', WPFP_DOMAIN ),
				8  => __( 'FullPage Slide submitted.', WPFP_DOMAIN ),
				9  => sprintf(
					__( 'FullPage Slide scheduled for: <strong>%1$s</strong>.', WPFP_DOMAIN ),
					// translators: Publish box date format, see http://php.net/date
					date_i18n( __( 'M j, Y @ G:i', WPFP_DOMAIN ), strtotime( $post->post_date ) )
				),
				10 => __( 'FullPage Slide draft updated.', WPFP_DOMAIN )
			);

			$this->set_post_type_messages( $messages, $post_type, $post_type_messages, $post_type_view, $post_type_preview );
		
		}

		return $messages;
	
	} // END public function fullpage_slide_type_updated_messages

	/**
	 * Set Post Type Messages
	 *
	 * @param  array   $messages            the array of messages
	 * @param  string  $post_type           the post type
	 * @param  array   $post_type_messages  the array of messages for the post type
	 * @param  string  $post_type_view      the post type view text
	 * @param  string  $post_type_preview   the post type preview text
	 */
	private function set_post_type_messages( &$messages, $post_type, $post_type_messages, $post_type_view, $post_type_preview ) {
		
		$post             = get_post();
		$post_type_object = get_post_type_object( $post_type );
			
		$messages[ $post_type ] = $post_type_messages;

		if ( $post_type_object->publicly_queryable ) {

			$permalink = get_permalink( $post->ID );
			$view_link = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), $post_type_view );
			
			$messages[ $post_type ][1] .= $view_link;
			$messages[ $post_type ][6] .= $view_link;
			$messages[ $post_type ][9] .= $view_link;

			$preview_permalink = add_query_arg( 'preview', 'true', $permalink );
			$preview_link      = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), $post_type_preview );
			
			$messages[ $post_type ][8]  .= $preview_link;
			$messages[ $post_type ][10] .= $preview_link;

		}
			
	} // END private function set_post_type_messages

	/**
	 * Remove "Add New" menu entry
	 */
	public function remove_add_new() {
		
		global $submenu;
		unset($submenu['edit.php?post_type=' . WPFP_FULLPAGE_PT][10]); // Removes 'Add New'.	

	} // END public function remove_add_new

} // END class WP_Fullpage_Post_Types

// instantiate the Init class
$WP_Fullpage_Post_Types = new WP_Fullpage_Post_Types();
