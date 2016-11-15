<?php

/**
 * The Fullpage Javascript Handlers Class
 * 
 * @package 	WP_Fullpage\Includes\Admin\JS_Handlers
 * @subpackage 	WP_Fullpage\Includes\Absctract\Classes
 */
class WP_Fullpage_JS_Handlers extends WP_Fullpage_Base {

	/**
	 * @var  WP_Fullpage_JS_Handlers The single instance of the class
	 */
	protected static $_instance = null;

	/**
	 * @var  bool 	Is Backbone Modal loaded ?
	 */
	public $backbone_modal_is_loaded = false;

	/**
	 * Main WP_Fullpage_JS_Handlers Instance
	 *
	 * Ensures only one instance of WP_Fullpage_JS_Handlers is loaded or can be loaded.
	 *
	 * @see 	WPFP_JS_Handlers()
	 * 
	 * @return  WP_Fullpage_JS_Handlers - Main instance
	 */
	public static function instance() {
		
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;

	} // END public static function instance
	
	/**
	 * Init Fullpage Javascript Handlers
	 *
	 * @return  void
	 */
	public function init( $dir = __DIR__, $file = __FILE__ ) {
		
		// Base Init
		parent::init( $dir, $file );
		
	} // END public function init

	/**
	 * Load Backbone Modal Handler
	 *
	 * Ensures only one instance of Backbone Modal is loaded or can be loaded.
	 *
	 * @param   array   $dependencies  a full array of dependencies :
	 *                          array( 
	 *                     			'js' => array(
	 *                     				'js-dependencie-1-handle',
	 *                     				'js-dependencie-2-handle',
	 *                     			),
	 *                     			'css' => array(
	 *                     				'css-dependencie-1-handle',
	 *                     				'css-dependencie-2-handle',
	 *                     			) 
	 *                     		)
	 *
	 * @return   void                    			
	 */
	private function load_backbone_modal( &$dependencies ) {
		
		if( $this->backbone_modal_is_loaded )
			return;

		$this->backbone_modal_is_loaded = true;

		wp_enqueue_style( 'wpfp-backbone-modal', $this->assets_url . 'css/backbone.modal.css', array(), WPFP_VERSION );
		
		$bbm_params = array(
			'prefix'            => WPFP_BBM_PREFIX,
			'noTemplateOrViews' => __( 'No template or views defined for Backbone.Modal', WPFP_DOMAIN ),
			'noViewContainer'   => __( 'No viewContainer defined for Backbone.Modal', WPFP_DOMAIN ),
		);

		wp_enqueue_script( 'wpfp-backbone-modal', $this->assets_url . 'js/backbone.modal.js', array( 'jquery', 'backbone' ), WPFP_VERSION );
		wp_localize_script( 'wpfp-backbone-modal', 'wpfpBbmParams', $bbm_params );
		
		$this->last_dependencies( 
			$dependencies,
			array( 
				'js' => array(
					'wpfp-backbone-modal',
				),
				'css' => array(
					'wpfp-backbone-modal',
				) 
			)
		);
		
	} // END private function load_backbone_modal

	/**
	 * Load Backbone Modal Posts List Handler
	 *
	 * @param   array   $dependencies  a full array of dependencies :
	 *                          array( 
	 *                     			'js' => array(
	 *                     				'js-dependencie-1-handle',
	 *                     				'js-dependencie-2-handle',
	 *                     			),
	 *                     			'css' => array(
	 *                     				'css-dependencie-1-handle',
	 *                     				'css-dependencie-2-handle',
	 *                     			) 
	 *                     		)
	 *
	 * @return   void                    			
	 */
	private function load_backbone_modal_posts_list( &$dependencies ) {
		
		$this->load_backbone_modal( $dependencies );
		
		$bbm_pl_params = array(
			'cancelClass'        => WPFP_BBM_CLOSE_BUTTON,
			'submitClass'        => WPFP_BBM_ADD_BUTTON,
			'loadsContentClass'  => WPFP_BBM_LOADS_CONTENT,
			'searchContentClass' => WPFP_BBM_SEARCH_INPUT,
			'pageContentClass'   => WPFP_BBM_PAGE_INPUT,
			'dateContentClass'   => WPFP_BBM_DATE_SELECT,
			'catContentClass'    => WPFP_BBM_CAT_SELECT,
			'selectAllClass'     => WPFP_BBM_SELECT_ALL,
		);

		wp_enqueue_script( 'wpfp-backbone-modal-posts-list', $this->assets_url . 'js/backbone.modal.posts-list.js', array( 'jquery', 'wpfp-backbone-modal' ), WPFP_VERSION );
		wp_localize_script( 'wpfp-backbone-modal-posts-list', 'wpfpBbmPLParams', $bbm_pl_params );
				
		$this->last_dependencies( 
			$dependencies,
			array( 
				'js' => array(
					'wpfp-backbone-modal-posts-list',
				),
			)
		);

	} // END private function load_backbone_modal_posts_list

	/**
	 * Load Backbone Modal Posts of a Term List Handler
	 *
	 * @param   array   $dependencies  a full array of dependencies :
	 *                          array( 
	 *                     			'js' => array(
	 *                     				'js-dependencie-1-handle',
	 *                     				'js-dependencie-2-handle',
	 *                     			),
	 *                     			'css' => array(
	 *                     				'css-dependencie-1-handle',
	 *                     				'css-dependencie-2-handle',
	 *                     			) 
	 *                     		)
	 *
	 * @return   void                    			
	 */
	private function load_backbone_modal_posts_of_term_list( &$dependencies ) {
		
		$this->load_backbone_modal( $dependencies );
		
		$bbm_pot_params = array(
			'cancelClass'        => WPFP_BBM_CLOSE_BUTTON,
			'submitClass'        => WPFP_BBM_ADD_BUTTON,
			'loadsContentClass'  => WPFP_BBM_LOADS_CONTENT,
			'searchContentClass' => WPFP_BBM_SEARCH_INPUT,
			'pageContentClass'   => WPFP_BBM_PAGE_INPUT,
			'dateContentClass'   => WPFP_BBM_DATE_SELECT,
			'selectAllClass'     => WPFP_BBM_SELECT_ALL,
		);

		wp_enqueue_script( 'wpfp-backbone-modal-posts-of-term-list', $this->assets_url . 'js/backbone.modal.posts-of-term-list.js', array( 'jquery', 'wpfp-backbone-modal' ), WPFP_VERSION );
		wp_localize_script( 'wpfp-backbone-modal-posts-of-term-list', 'wpfpBbmPOTermParams', $bbm_pot_params );
		
		$this->last_dependencies( 
			$dependencies,
			array( 
				'js' => array(
					'wpfp-backbone-modal-posts-of-term-list',
				),
			)
		);

	} // END private function load_backbone_modal_posts_of_term_list

	/**
	 * Load Backbone Modal Posts of a Type List Handler
	 *
	 * @param   array   $dependencies  a full array of dependencies :
	 *                          array( 
	 *                     			'js' => array(
	 *                     				'js-dependencie-1-handle',
	 *                     				'js-dependencie-2-handle',
	 *                     			),
	 *                     			'css' => array(
	 *                     				'css-dependencie-1-handle',
	 *                     				'css-dependencie-2-handle',
	 *                     			) 
	 *                     		)
	 *
	 * @return   void                    			
	 */
	private function load_backbone_modal_posts_of_type_list( &$dependencies ) {
		
		$this->load_backbone_modal( $dependencies );
		
		$bbm_pot_params = array(
			'cancelClass'        => WPFP_BBM_CLOSE_BUTTON,
			'submitClass'        => WPFP_BBM_ADD_BUTTON,
			'loadsContentClass'  => WPFP_BBM_LOADS_CONTENT,
			'searchContentClass' => WPFP_BBM_SEARCH_INPUT,
			'pageContentClass'   => WPFP_BBM_PAGE_INPUT,
			'dateContentClass'   => WPFP_BBM_DATE_SELECT,
			'selectAllClass'     => WPFP_BBM_SELECT_ALL,
		);

		wp_enqueue_script( 'wpfp-backbone-modal-posts-of-type-list', $this->assets_url . 'js/backbone.modal.posts-of-type-list.js', array( 'jquery', 'wpfp-backbone-modal' ), WPFP_VERSION );
		wp_localize_script( 'wpfp-backbone-modal-posts-of-type-list', 'wpfpBbmPOTypeParams', $bbm_pot_params );
		
		$this->last_dependencies( 
			$dependencies,
			array( 
				'js' => array(
					'wpfp-backbone-modal-posts-of-type-list',
				),
			)
		);

	} // END private function load_backbone_modal_posts_of_type_list

	/**
	 * Add Backbone Modal Posts List Handler
	 * 
	 *          WPFP_JS_Handlers()->backbone_modal_posts_list( $args );
	 *
	 * 			where : $args = array(
	 *		  		array(
	 *			   		'postType'         => 'my_first_post_type',
	 *			     	'launcherID'       => 'my_first_post_type_launcher_selector',
	 *			     	'inputID'          => 'my_first_post_type_input_selector',
	 *			     	'ajaxAction'       => 'my_first_ajax_action',
	 *			     	'nonce'            => 'my_first_nonce',
	 *		       	),
	 *		        array(
	 *			       	'postType'         => 'my_second_post_type',
	 *			        'launcherID'       => 'my_second_post_type_launcher_selector',
	 *			     	'inputID'          => 'my_second_post_type_input_selector',
	 *			     	'ajaxAction'       => 'my_second_ajax_action',
	 *			     	'nonce'            => 'my_second_nonce',
	 *		        ),
	 *	         );
	 *
	 *
	 * @param   array   $args  an array of arguments
	 * @param   array   $dependencies  a full array of dependencies :
	 *                          array( 
	 *                     			'js' => array(
	 *                     				'js-dependencie-1-handle',
	 *                     				'js-dependencie-2-handle',
	 *                     			),
	 *                     			'css' => array(
	 *                     				'css-dependencie-1-handle',
	 *                     				'css-dependencie-2-handle',
	 *                     			) 
	 *                     		)
	 *
	 * @return   void                    			
	 */
	public function backbone_modal_posts_list( $args, &$dependencies ) {

		$this->load_backbone_modal_posts_list( $dependencies );

		$post_types = array();

		foreach( $args as $arg ) {
			$post_types[] = $arg;
		}

		$params = array(
			'ajaxUrl'  => WPFP_AJAX_ACTION_URL,
			'postTypes' => $post_types,
		);

		wp_enqueue_script( 'wpfp-backbone-modal-posts-list-init', $this->assets_url . 'js/backbone.modal.posts-list.init.js', array( 'jquery', 'wpfp-backbone-modal-posts-list' ), WPFP_VERSION );
		wp_localize_script( 'wpfp-backbone-modal-posts-list-init', 'wpfpBbmPLInitParams', $params );
				
		$this->last_dependencies( 
			$dependencies,
			array( 
				'js' => array(
					'wpfp-backbone-modal-posts-list-init',
				)
			)
		);

	} // END public function backbone_modal_posts_list

	/**
	 * Add Backbone Modal Posts of Term List Handler
	 * 
	 *          WPFP_JS_Handlers()->backbone_modal_posts_of_term_list( $args, $dependencies );
	 *
	 * 			where : $args = array(
	 *		  		array(
	 *			   		'postType'         => 'my_first_post_type',
	 *			     	'launcherID'       => 'my_first_post_type_launcher_selector',
	 *			     	'inputID'          => 'my_first_post_type_input_selector',
	 *			     	'ajaxAction'       => 'my_first_ajax_action',
	 *			     	'nonce'            => 'my_first_nonce',
	 *		       	),
	 *		        array(
	 *			       	'postType'         => 'my_second_post_type',
	 *			        'launcherID'       => 'my_second_post_type_launcher_selector',
	 *			     	'inputID'          => 'my_second_post_type_input_selector',
	 *			     	'ajaxAction'       => 'my_second_ajax_action',
	 *			     	'nonce'            => 'my_second_nonce',
	 *		        ),
	 *	         );
	 *
	 *
	 * @param   array   $args  an array of arguments
	 * @param   array   $dependencies  a full array of dependencies :
	 *                          array( 
	 *                     			'js' => array(
	 *                     				'js-dependencie-1-handle',
	 *                     				'js-dependencie-2-handle',
	 *                     			),
	 *                     			'css' => array(
	 *                     				'css-dependencie-1-handle',
	 *                     				'css-dependencie-2-handle',
	 *                     			) 
	 *                     		)
	 *
	 * @return   void                    			
	 */
	public function backbone_modal_posts_of_term_list( $args, &$dependencies ) {

		$this->load_backbone_modal_posts_of_term_list( $dependencies );

		$terms = array();

		foreach( $args as $arg ) {
			$terms[] = $arg;
		}

		$params = array( 
			'terms'   => $terms,
			'ajaxUrl' => WPFP_AJAX_ACTION_URL,	
		);

		wp_enqueue_script( 'wpfp-backbone-modal-posts-of-term-list-init', $this->assets_url . 'js/backbone.modal.posts-of-term-list.init.js', $dependencies['js'], WPFP_VERSION );
		wp_localize_script( 'wpfp-backbone-modal-posts-of-term-list-init', 'wpfpBbmPOTermInitParams', $params );
		
		$this->last_dependencies( 
			$dependencies, 
			array( 
				'js' => array(
					'wpfp-backbone-modal-posts-of-term-list-init',
				)
			)
		);

	} // END public function backbone_modal_posts_of_term_list

	/**
	 * Add Backbone Modal Posts of Type List Handler
	 * 
	 *          WPFP_JS_Handlers()->backbone_modal_posts_of_type_list( $args, $dependencies );
	 *
	 * 			where : $args = array(
	 *		  		array(
	 *			   		'postType'         => 'my_first_post_type',
	 *			     	'launcherID'       => 'my_first_post_type_launcher_selector',
	 *			     	'inputID'          => 'my_first_post_type_input_selector',
	 *			     	'ajaxAction'       => 'my_first_ajax_action',
	 *			     	'nonce'            => 'my_first_nonce',
	 *		       	),
	 *		        array(
	 *			       	'postType'         => 'my_second_post_type',
	 *			        'launcherID'       => 'my_second_post_type_launcher_selector',
	 *			     	'inputID'          => 'my_second_post_type_input_selector',
	 *			     	'ajaxAction'       => 'my_second_ajax_action',
	 *			     	'nonce'            => 'my_second_nonce',
	 *		        ),
	 *	         );
	 *
	 *
	 * @param   array   $args  an array of arguments
	 * @param   array   $dependencies  a full array of dependencies :
	 *                          array( 
	 *                     			'js' => array(
	 *                     				'js-dependencie-1-handle',
	 *                     				'js-dependencie-2-handle',
	 *                     			),
	 *                     			'css' => array(
	 *                     				'css-dependencie-1-handle',
	 *                     				'css-dependencie-2-handle',
	 *                     			) 
	 *                     		)
	 *
	 * @return   void                    			
	 */
	public function backbone_modal_posts_of_type_list( $args, &$dependencies ) {

		$this->load_backbone_modal_posts_of_type_list( $dependencies );

		$post_types = array();

		foreach( $args as $arg ) {
			$post_types[] = $arg;
		}

		$params = array(
			'ajaxUrl'  => WPFP_AJAX_ACTION_URL,
			'postTypes' => $post_types,
		);

		wp_enqueue_script( 'wpfp-backbone-modal-posts-of-type-list-init', $this->assets_url . 'js/backbone.modal.posts-of-type-list.init.js', $dependencies['js'], WPFP_VERSION );
		wp_localize_script( 'wpfp-backbone-modal-posts-of-type-list-init', 'wpfpBbmPOTypeInitParams', $params );
		
		$this->last_dependencies( 
			$dependencies, 
			array( 
				'js' => array(
					'wpfp-backbone-modal-posts-of-type-list-init',
				)
			)
		);

	} // END public function backbone_modal_posts_of_term_list

	/**
	 * Add a jQuery Sortables Handler
	 * 
	 *          WPFP_JS_Handlers()->jquery_sortables( $args, $dependencies );
	 *
	 * 			where : $args = array(
	 *		  		array(
	 *			   		'ajaxAction'       => 'my_first_ajax_action',
	 *			   		'postType'         => 'my_first_post_type',
	 *			     	'sortableID'       => 'my_first_post_type_sortable_selector',
	 *			     	'inputID'          => 'my_first_post_type_input_selector',
	 *			     	'nonce'            => 'my_first_nonce',
	 *		       	),
	 *		  		array(
	 *			   		'ajaxAction'       => 'my_second_ajax_action',
	 *			   		'postType'         => 'my_second_post_type',
	 *			     	'sortableID'       => 'my_second_post_type_sortable_selector',
	 *			     	'inputID'          => 'my_second_post_type_input_selector',
	 *			     	'nonce'            => 'my_second_nonce',
	 *		       	),
	 *	         );
	 *
	 *
	 * @param   array   $args  an array of arguments
	 * @param   array   $dependencies  a full array of dependencies :
	 *                          array( 
	 *                     			'js' => array(
	 *                     				'js-dependencie-1-handle',
	 *                     				'js-dependencie-2-handle',
	 *                     			),
	 *                     			'css' => array(
	 *                     				'css-dependencie-1-handle',
	 *                     				'css-dependencie-2-handle',
	 *                     			) 
	 *                     		)
	 *
	 * @return   void                    			
	 */
	public function jquery_sortables( $args, &$dependencies ) {

		$sortables = array();

		foreach( $args as $arg ) {
			$sortables[] = $arg;
		}

		$params = array(
			'ajaxUrl'   => WPFP_AJAX_ACTION_URL,
			'sortables' => $sortables,
		);

		wp_enqueue_style( 'wpfp-jquery-ui-sortables', $this->assets_url . 'css/jquery-ui-sortables.css', array(), WPFP_VERSION );
		wp_enqueue_script( 'wpfp-jquery-ui-sortables-init', $this->assets_url . 'js/jquery-ui-sortable.init.js', array( 'jquery', 'jquery-ui-sortable' ), WPFP_VERSION );
		wp_localize_script( 'wpfp-jquery-ui-sortables-init', 'jquerySortablesUIInitParams', $params );
		
		$this->last_dependencies( 
			$dependencies, 
			array( 
				'js' => array(
					'wpfp-jquery-ui-sortables-init',
				),
				'css' => array(
					'wpfp-jquery-ui-sortables',
				) 
			)
		);

	} // END public function jquery_sortables

	/**
	 * Add a Reset Form Handler
	 * 
	 *          WPFP_JS_Handlers()->reset_form( $selectors, $dependencies );
	 *
	 * @param   string   $selectors             the CSS selectors to bind
	 * @param   array    $dependencies          a full array of dependencies :
	 *                          array( 
	 *                     			'js' => array(
	 *                     				'js-dependencie-1-handle',
	 *                     				'js-dependencie-2-handle',
	 *                     			),
	 *                     			'css' => array(
	 *                     				'css-dependencie-1-handle',
	 *                     				'css-dependencie-2-handle',
	 *                     			) 
	 *                     		)
	 *
	 * @return   void                    			
	 */
	public function reset_form( $selectors, &$dependencies ) {

		$params = array(
			'selectors' => $selectors,
		);

		wp_enqueue_script( 'wpfp-reset-form', $this->assets_url . 'js/reset-form.js', array( 'jquery' ), WPFP_VERSION );
		wp_localize_script( 'wpfp-reset-form', 'wpfpResetFormParams', $params );
		
		$this->last_dependencies( 
			$dependencies, 
			array( 
				'js' => array(
					'wpfp-reset-form',
				) 
			)
		);

	} // END public function reset_form

	/**
	 * Add a Color Picker
	 * 
	 *          WPFP_JS_Handlers()->color_picker( $selectors, $dependencies );
	 *
	 * @param   string   $selectors             the CSS selectors to bind
	 * @param   array    $dependencies          a full array of dependencies :
	 *                          array( 
	 *                     			'js' => array(
	 *                     				'js-dependencie-1-handle',
	 *                     				'js-dependencie-2-handle',
	 *                     			),
	 *                     			'css' => array(
	 *                     				'css-dependencie-1-handle',
	 *                     				'css-dependencie-2-handle',
	 *                     			) 
	 *                     		)
	 *
	 * @return   void                    			
	 */
	public function color_picker( $selectors, &$dependencies ) {

		wp_enqueue_style( 'spectrum', $this->assets_url . 'css/spectrum.css', array(), WPFP_VERSION );
		wp_enqueue_style( 'spectrum-custom', $this->assets_url . 'css/spectrum-custom.css', array( 'spectrum' ), WPFP_VERSION );
		wp_enqueue_script( 'spectrum', $this->assets_url . 'js/spectrum.js', array(), WPFP_VERSION );

		$params = array(
			'selectors' => $selectors,
			'cancelText' => __( 'Cancel', WPFP_DOMAIN ),
			'chooseText' => __( 'Choose', WPFP_DOMAIN ),
		);

		wp_enqueue_script( 'spectrum-init', $this->assets_url . 'js/spectrum.init.js', array( 'wp-color-picker' ), WPFP_VERSION );
		wp_localize_script( 'spectrum-init', 'wpfpSpectrumParams', $params );
		
		$this->last_dependencies( 
			$dependencies, 
			array( 
				'js'  => array(
					'spectrum-init',
				),
				'css' => array(
					'spectrum-custom',
				) 
			)
		);

	} // END public function color_picker

	/**
	 * Add a Switch Handler
	 * 
	 *          WPFP_JS_Handlers()->switch_button( $dependencies );
	 *
	 * @param   array   $dependencies  a full array of dependencies :
	 *                          array( 
	 *                     			'js' => array(
	 *                     				'js-dependencie-1-handle',
	 *                     				'js-dependencie-2-handle',
	 *                     			),
	 *                     			'css' => array(
	 *                     				'css-dependencie-1-handle',
	 *                     				'css-dependencie-2-handle',
	 *                     			) 
	 *                     		)
	 *
	 * @return   void                    			
	 */
	public function switch_button( &$dependencies ) {

		wp_enqueue_script( 'wpfp-switch-init', $this->assets_url . 'js/switch.init.js', array( 'jquery' ), WPFP_VERSION );
		wp_enqueue_style( 'wpfp-switch', $this->assets_url . 'css/switch.css', array(), WPFP_VERSION );
		
		$this->last_dependencies( 
			$dependencies, 
			array( 
				'js' => array(
					'wpfp-switch-init'
				),
				'css' => array(
					'wpfp-switch',
				) 
			)
		);

	} // END public function switch_button

	/**
	 * Add Materialize
	 * 
	 *          WPFP_JS_Handlers()->materialize( $dependencies );
	 *
	 * @param   array   $dependencies  a full array of dependencies :
	 *                          array( 
	 *                     			'js' => array(
	 *                     				'js-dependencie-1-handle',
	 *                     				'js-dependencie-2-handle',
	 *                     			),
	 *                     			'css' => array(
	 *                     				'css-dependencie-1-handle',
	 *                     				'css-dependencie-2-handle',
	 *                     			) 
	 *                     		)
	 *
	 * @return   void                    			
	 */
	public function materialize( &$dependencies ) {

		wp_enqueue_script( 'materialize', $this->assets_url . 'js/materialize.min.js', array( 'jquery' ), WPFP_VERSION );
		wp_enqueue_script( 'materialize-init', $this->assets_url . 'js/materialize.init.js', array( 'materialize' ), WPFP_VERSION );
		wp_enqueue_style( 'materialize', $this->assets_url . 'css/materialize.css', array(), WPFP_VERSION );
		wp_enqueue_style( 'materialize-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons', array( 'materialize' ), WPFP_VERSION );
		
		$this->last_dependencies( 
			$dependencies, 
			array( 
				'js' => array(
					'materialize-init'
				),
				'css' => array(
					'materialize-icons',
				) 
			)
		);

	} // END public function materialize

	/**
	 * Add Ace.js
	 * 
	 *          WPFP_JS_Handlers()->ace( $dependencies );
	 *
	 * @param   array   $dependencies  a full array of dependencies :
	 *                          array( 
	 *                     			'js' => array(
	 *                     				'js-dependencie-1-handle',
	 *                     				'js-dependencie-2-handle',
	 *                     			),
	 *                     			'css' => array(
	 *                     				'css-dependencie-1-handle',
	 *                     				'css-dependencie-2-handle',
	 *                     			) 
	 *                     		)
	 *
	 * @return   void                    			
	 */
	public function ace( &$dependencies ) {

		wp_enqueue_script( 'ace', $this->assets_url . 'js/ace/ace.js', array(), WPFP_VERSION );
		wp_enqueue_script( 'ace-monokai', $this->assets_url . 'js/ace/theme-monokai-light.js', array( 'ace' ), WPFP_VERSION );
		wp_enqueue_script( 'ace-init', $this->assets_url . 'js/ace.init.js', array( 'ace-monokai' ), WPFP_VERSION );
		
		$this->last_dependencies( 
			$dependencies, 
			array( 
				'js' => array(
					'ace-init'
				),
			)
		);

	} // END public function materialize

	/**
	 * Set last dependencies
	 *
	 * Ensure CSS and JS files are enqueued in the right way they are called
	 *
	 * 		WPFP_JS_Handlers()->last_dependencies( 
	 * 			array( 
	 * 				'js' => array( 
	 * 					'previous-dependencie-1', 
	 * 					'previous-dependencie-2' 
	 * 			  	), 
	 * 			  	'css' => array( 
	 * 			  		'previous-dependencie-1', 
	 * 			  		'previous-dependencie-2' 
	 * 			  	)
	 * 			), 
	 * 			array( 
	 * 				'js' => array( 
	 * 					'new-previous-dependencie-3', 
	 * 					'new-previous-dependencie-4' 
	 * 			  	), 
	 * 			  	'css' => array( 
	 * 			  		'new-dependencie-3', 
	 * 			  		'new-dependencie-4' 
	 * 			  	)
	 * 			) 
	 * 		);
	 *
	 * @param   array   $previous_dependencies  full array of previous dependencies
	 * @param   array   $new_dependencies       full array of new dependencies
	 *
	 * @return  void
	 */
	public function last_dependencies( &$previous_dependencies, $new_dependencies ) {
		
		$previous_dependencies = array_merge( $previous_dependencies, $new_dependencies );

	} // END public function last_dependencies

} // END class WP_Fullpage_JS_Handlers

/**
 * Returns the main instance of WP_Fullpage_JS_Handlers to prevent the need to use globals.
 *
 * WPFP_JS_Handlers()->my_method() 
 * 
 * @package 	WP_Fullpage\Includes\Admin\JS_Handlers
 *
 * @return 		WP_Fullpage_JS_Handlers
 */
function WPFP_JS_Handlers() {

	return WP_Fullpage_JS_Handlers::instance();

}

