<?php

/**
 * The Fullpage Settings Class
 * 
 * @package 	WP_Fullpage\Includes\Admin\Setings
 * @subpackage 	WP_Fullpage\Includes\Absctract\Classes
 */
class WP_Fullpage_Settings extends WP_Fullpage_Base {
	
	/**
	 * The settings page Suffix
	 *
	 * @var  string
	 */
	private $page_suffix;
	
	/**
	 * The settings page
	 *
	 * @var  string
	 */
	private $page = 'wpfp-settings';

	/**
	 * Init Settings Page Object
	 *
	 * @return  void
	 */
	public function init( $dir = __DIR__, $file = __FILE__ ) {

		parent::init( __DIR__, __FILE__ );
		
		// Add actions and filters
		$this->actions_filters();

	} // END public function init

	/**
	 * Register Actions and Filters
	 *
	 * @return  void
	 */
	private function actions_filters() {

		// Add WP FullPage Settings Menu Entry
		add_action( 'admin_menu', array( &$this, 'add_menu' ), 9 );
		
		// Register WP FullPage Settings
		add_action( 'admin_init', array( &$this, 'register_settings' ) );

		// Add some scripts and styles to settings page
		add_action( 'admin_enqueue_scripts', array( &$this, 'admin_enqueue_scripts' ) );

	} // END private function actions_filters

	/**
	 * Add an "WP FullPage Settings" page
	 * 
	 * @return  void
	 */
	public function add_menu() {
		
		$this->page_suffix = add_menu_page( 
			__( 'WP FullPage Settings', WPFP_DOMAIN ), 
			__( 'WP FullPage', WPFP_DOMAIN ), 
			'administrator', 
			$this->page, 
			array( &$this, 'settings_page' )
		);

	} // END public function add_menu

	/**
	 * Register Settings
	 *
	 * @return  void
	 */
	public function register_settings() {
		
		register_setting( 'wpfp_settings-group', WPFP_SETTINGS_FULLPAGE_OPTIONS );
		register_setting( 'wpfp_settings-group', WPFP_SETTINGS_SECTIONS_OPTIONS );
		register_setting( 'wpfp_settings-group', WPFP_SETTINGS_SLIDES_OPTIONS );
		register_setting( 'wpfp_settings-group', WPFP_SETTINGS_CUSTOM_OPTIONS );

	} // END public function register_settings

	/**
	 * Display the Settings page
	 *
	 * @return  void
	 */
	public function settings_page() {

		$fullpage_options = get_option( WPFP_SETTINGS_FULLPAGE_OPTIONS, array() );
		
		// Backcompat 
		wpfp_event_backcompat( $fullpage_options );

		extract( $fullpage_options );

		$sections_options = get_option( WPFP_SETTINGS_SECTIONS_OPTIONS, array() );

		extract( $sections_options );

		$slides_options = get_option( WPFP_SETTINGS_SLIDES_OPTIONS, array() );

		extract( $slides_options );

		$custom_options = get_option( WPFP_SETTINGS_CUSTOM_OPTIONS, array() );

		extract( $custom_options );

		// Render the Settings template
		include( $this->rel_path . 'views/settings.php' );
		
	} // END public function settings_page
	
	/**
	 * Enqueue Settings Page Style
	 *
	 * @param   string  $hook_suffix  the hook suffix of the current page
	 *
	 * @return  void
	 */
	public function admin_enqueue_scripts( $hook_suffix ) {

		if( $this->page_suffix != $hook_suffix )
			return;
		
		$dependencies = array();

		WPFP_JS_Handlers()->color_picker( '.wpfp-color', $dependencies );
		
		WPFP_JS_Handlers()->reset_form( '#wpfp-settingsbox', $dependencies );

		WPFP_JS_Handlers()->switch_button( $dependencies );

		WPFP_JS_Handlers()->materialize( $dependencies );

		WPFP_JS_Handlers()->ace( $dependencies );

		wp_enqueue_style( 'wpfp-admin-style', $this->assets_url . '../../assets/css/admin.css', $dependencies['css'], WPFP_VERSION );
		
		wp_enqueue_script( 'fullpage-settings-init', $this->assets_url . 'js/fullpage-settings.init.js', $dependencies['js'], WPFP_VERSION );

	} // END public function admin_enqueue_scripts

} // END class WP_Fullpage_Settings

// instantiate the Settings class
$WP_Fullpage_Settings = new WP_Fullpage_Settings();
