<?php
/**
 * Metabox class.
 *
 * @since 2.2.0
 *
 * @package Soliloquy_WooCommerce_Metaboxes
 * @author  Chris Kelley
 */
 class Soliloquy_Carousel_Metaboxes{

    /**
     * Holds the class object.
     *
     * @since 2.2.0
     *
     * @var object
     */
    public static $instance;

    /**
     * Path to the file.
     *
     * @since 2.2.0
     *
     * @var string
     */
    public $file = __FILE__;

    /**
     * Holds the base class object.
     *
     * @since 2.2.0
     *
     * @var object
     */
    public $base;
    /**
     * Primary class constructor.
     *
     * @since 2.2.0
     */
    public function __construct() {

    	// Get base instance
    	$this->base = Soliloquy_Carousel::get_instance();
    	
		add_filter( 'soliloquy_defaults', array( $this, 'defaults' ), 10, 2 );
		add_filter( 'soliloquy_tab_nav', array( $this, 'tab_nav' ) );
		add_action( 'soliloquy_mobile_box', array( $this, 'mobile_tab' ) );
   		add_action( 'soliloquy_tab_carousel', array( $this, 'carousel_tab' ) );
   		add_filter( 'soliloquy_save_settings', array( $this, 'save' ), 10, 2 );
   		add_action( 'soliloquy_saved_settings', array( $this, 'crop' ), 10, 3 );
   		
    }
	 
	/**
	 * Applies a default to the addon setting.
	 *
	 * @since 1.0.0
	 *
	 * @param array $defaults  Array of default config values.
	 * @param int $post_id     The current post ID.
	 * @return array $defaults Amended array of default config values.
	 */
	function defaults( $defaults, $post_id ) {
	
	    $defaults['carousel']        = 0;
	    $defaults['carousel_width']  = 200;
	    $defaults['carousel_height'] = 125;
	    $defaults['carousel_margin'] = 10;
	    $defaults['carousel_min']    = 3;
	    $defaults['carousel_max']    = 3;
	    $defaults['carousel_move']   = 1;
	
	    // Mobile
	    $defaults['mobile_carousel'] = 0;
	
	    return $defaults;
	
	}
	
	/**
	 * Filters in a new tab for the addon.
	 *
	 * @since 1.0.0
	 *
	 * @param array $tabs  Array of default tab values.
	 * @return array $tabs Amended array of default tab values.
	 */
	function tab_nav( $tabs ) {
	
	    $tabs['carousel'] = esc_attr__( 'Carousel', 'soliloquy-carousel' );
	    return $tabs;
	
	}
	
	/**
	 * Callback for displaying the UI for setting mobile options.
	 *
	 * @since 1.0.0
	 *
	 * @param object $post The current post object.
	 */
	function mobile_tab( $post ) {
	
	    $instance = Soliloquy_Metaboxes::get_instance();
	    ?>
	    <tr id="soliloquy-config-mobile-carousel-box">
	        <th scope="row">
	            <label for="soliloquy-config-mobile-carousel"><?php esc_html_e( 'Enable Slider Carousel?', 'soliloquy-carousel' ); ?></label>
	        </th>
	        <td>
	            <input id="soliloquy-config-mobile-carousel" type="checkbox" name="_soliloquy[mobile_carousel]" value="<?php echo $instance->get_config( 'mobile_carousel', $instance->get_config_default( 'mobile_carousel' ) ); ?>" <?php checked( $instance->get_config( 'mobile_carousel', $instance->get_config_default( 'mobile_carousel' ) ), 1 ); ?> />
	            <span class="description"><?php esc_html_e( 'Enables or disables the slider carousel feature on mobile devices.', 'soliloquy-carousel' ); ?></span>
	        </td>
	    </tr>
	    <?php
	
	}
	
	/**
	 * Callback for displaying the UI for setting carousel options.
	 *
	 * @since 1.0.0
	 *
	 * @param object $post The current post object.
	 */
	function carousel_tab( $post ) {
	
	    $instance = Soliloquy_Metaboxes::get_instance();
	    ?>
	    <div id="soliloquy-carousel">
		    <div class="soliloquy-config-header">
	        	<h2 class="soliloquy-intro"><?php esc_html_e( 'The settings below adjust the carousel settings for the slider.', 'soliloquy-carousel' ); ?></h2>
				<p class="soliloquy-help"><?php esc_html_e( 'Need some help?', 'soliloquy' ); ?><a href="http://soliloquywp.com/docs/carousel-addon/" target="_blank"><?php esc_html_e( ' Watch a video on how to setup your slider configuration', 'soliloquy-carousel' ); ?></a></p>
			</div>
	        
	        <table class="form-table">
	            <tbody>
	                <tr id="soliloquy-config-carousel-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-carousel"><?php esc_html_e( 'Enable Slider Carousel?', 'soliloquy-carousel' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-carousel" type="checkbox" name="_soliloquy[carousel]" value="<?php echo $instance->get_config( 'carousel', $instance->get_config_default( 'carousel' ) ); ?>" <?php checked( $instance->get_config( 'carousel', $instance->get_config_default( 'carousel' ) ), 1 ); ?> />
	                        <span class="description"><?php esc_html_e( 'Enables or disables the slider carousel feature.', 'soliloquy-carousel' ); ?></span>
	                    </td>
	                </tr>
	                <tr id="soliloquy-config-carousel-width-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-carousel-width"><?php esc_html_e( 'Carousel Slide Width', 'soliloquy-carousel' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-carousel-width" type="number" name="_soliloquy[carousel_width]" value="<?php echo $instance->get_config( 'carousel_width', $instance->get_config_default( 'carousel_width' ) ); ?>" /> <span class="soliloquy-unit"><?php esc_html_e( 'px', 'soliloquy' ); ?></span>
	                        <p class="description"><?php esc_html_e( 'The width of each slide inside of the carousel (acts as max width and adjusts dynamically).', 'soliloquy-carousel' ); ?></p>
	                    </td>
	                </tr>
	                <tr id="soliloquy-config-carousel-height-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-carousel-height"><?php esc_html_e( 'Carousel Slide Height', 'soliloquy-carousel' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-carousel-height" type="number" name="_soliloquy[carousel_height]" value="<?php echo $instance->get_config( 'carousel_height', $instance->get_config_default( 'carousel_height' ) ); ?>" /> <span class="soliloquy-unit"><?php esc_html_e( 'px', 'soliloquy' ); ?></span>
	                        <p class="description"><?php esc_html_e( 'The height of each slide inside of the carousel (acts as max height and adjusts dynamically).', 'soliloquy-carousel' ); ?></p>
	                    </td>
	                </tr>
	                <tr id="soliloquy-config-carousel-margin-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-carousel-margin"><?php esc_html_e( 'Carousel Slide Margin', 'soliloquy-carousel' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-carousel-margin" type="number" name="_soliloquy[carousel_margin]" value="<?php echo $instance->get_config( 'carousel_margin', $instance->get_config_default( 'carousel_margin' ) ); ?>" /> <span class="soliloquy-unit"><?php esc_html_e( 'px', 'soliloquy' ); ?></span>
	                        <p class="description"><?php esc_html_e( 'The margin between each carousel slide within the slider.', 'soliloquy-carousel' ); ?></p>
	                    </td>
	                </tr>
	                <tr id="soliloquy-config-carousel-min-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-carousel-min"><?php esc_html_e( 'Carousel Slides Minimum', 'soliloquy-carousel' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-carousel-min" type="number" name="_soliloquy[carousel_min]" value="<?php echo $instance->get_config( 'carousel_min', $instance->get_config_default( 'carousel_min' ) ); ?>" />
	                        <p class="description"><?php esc_html_e( 'The minimum number of slides that should be visible within the carousel.', 'soliloquy-carousel' ); ?></p>
	                    </td>
	                </tr>
	                <tr id="soliloquy-config-carousel-max-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-carousel-max"><?php esc_html_e( 'Carousel Slides Maximum', 'soliloquy-carousel' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-carousel-max" type="number" name="_soliloquy[carousel_max]" value="<?php echo $instance->get_config( 'carousel_max', $instance->get_config_default( 'carousel_max' ) ); ?>" />
	                        <p class="description"><?php esc_html_e( 'The maximum number of slides that should be visible within the carousel.', 'soliloquy-carousel' ); ?></p>
	                    </td>
	                </tr>
	                <tr id="soliloquy-config-carousel-move-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-carousel-move"><?php esc_html_e( 'Number of Slides to Move', 'soliloquy-carousel' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-carousel-move" type="number" name="_soliloquy[carousel_move]" value="<?php echo $instance->get_config( 'carousel_move', $instance->get_config_default( 'carousel_move' ) ); ?>" />
	                        <p class="description"><?php esc_html_e( 'The number of slides to move when navigating through the carousel.', 'soliloquy-carousel' ); ?></p>
	                    </td>
	                </tr>
	                <?php do_action( 'soliloquy_carousel_box', $post ); ?>
	            </tbody>
	        </table>
	    </div>
	    <?php
	
	}
	
	/**
	 * Saves the addon settings.
	 *
	 * @since 1.0.0
	 *
	 * @param array $settings  Array of settings to be saved.
	 * @param int $post_id     The current post ID.
	 * @return array $settings Amended array of settings to be saved.
	 */
	function save( $settings, $post_id ) {
	
	    $settings['config']['carousel']        = isset( $_POST['_soliloquy']['carousel'] ) ? 1 : 0;
	    $settings['config']['carousel_width']  = absint( $_POST['_soliloquy']['carousel_width'] );
	    $settings['config']['carousel_height'] = absint( $_POST['_soliloquy']['carousel_height'] );
	    $settings['config']['carousel_margin'] = absint( $_POST['_soliloquy']['carousel_margin'] );
	    $settings['config']['carousel_min']    = absint( $_POST['_soliloquy']['carousel_min'] );
	    $settings['config']['carousel_max']    = absint( $_POST['_soliloquy']['carousel_max'] );
	    $settings['config']['carousel_move']   = absint( $_POST['_soliloquy']['carousel_move'] );
	
	    // Mobile
	    $settings['config']['mobile_carousel'] = isset( $_POST['_soliloquy']['mobile_carousel'] ) ? 1 : 0;
	
	    return $settings;
	
	}
	/**
	 * Crops images based on carousel settings for the slider.
	 *
	 * @since 1.0.0
	 *
	 * @param array $settings  Array of settings to be saved.
	 * @param int $post_id     The current post ID.
	 * @param object $post     The current post object.
	 */
	function crop( $settings, $post_id, $post ) {
	
	    // If the carousel option and crop option are checked, crop images accordingly.
	    if ( isset( $settings['config']['slider'] ) && $settings['config']['slider'] ) {
	        if ( isset( $settings['config']['carousel'] ) && $settings['config']['carousel'] ) {
	            $instance = Soliloquy_Metaboxes::get_instance();
	            $args     = apply_filters( 'soliloquy_crop_image_args',
	                array(
	                    'position' => 'c',
	                    'width'    => $instance->get_config( 'carousel_width', $instance->get_config_default( 'carousel_width' ) ),
	                    'height'   => $instance->get_config( 'carousel_height', $instance->get_config_default( 'carousel_height' ) ),
	                    'quality'  => 100,
	                    'retina'   => false
	                )
	            );
	            $instance->crop_images( $args, $post_id );
	        }
	    }
	
	}
	
	/**
     * Returns the singleton instance of the class.
     *
     * @since 2.2.0
     *
     * @return object The Soliloquy_Carousel_Metaboxes object.
     */
    public static function get_instance() {

        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Soliloquy_Carousel_Metaboxes ) ) {
            self::$instance = new Soliloquy_Carousel_Metaboxes();
        }

        return self::$instance;

    }   
       	 
 }
 
 $soliloquy_carousel_metaboxes = Soliloquy_Carousel_Metaboxes::get_instance();