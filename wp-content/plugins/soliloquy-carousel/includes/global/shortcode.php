<?php
	
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}	
	
class Soliloquy_Carousel_Shortcode{
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
	function __construct(){
		
		add_filter( 'soliloquy_pre_data', array( $this, 'set_transition' ) );
		add_filter( 'soliloquy_disable_preloading', array( $this, 'disable_preloading' ), 10, 2 );
		add_filter( 'soliloquy_crop_type', array( $this, 'crop_output' ), 10, 4 );
		add_filter( 'soliloquy_api_config_callback', array( $this, 'output' ) );
		add_filter( 'soliloquy_output_container_classes', array( $this, 'container_classes' ), 10, 2 );
    	add_filter( 'soliloquy_output_image_slide_dimensions', array( $this, 'image_dimensions' ), 10, 2 );
		add_filter( 'soliloquy_get_config_mobile_keys', array( $this, 'mobile_keys' ) );
	
	}
	
	/**
	 * Ensures that the transition for the slider is proper for a carousel.
	 *
	 * @since 1.0.0
	 *
	 * @param array $data  Array of slider data.
	 * @return array $data Amended array of slider data.
	 */
	function set_transition( $data ) {
	
	    // If there is no carousel, don't modify any of the data.
	    $instance = Soliloquy_Shortcode::get_instance();
	    if ( ! $instance->get_config( 'carousel', $data ) ) {
	        return $data;
	    }
	
	    // Check the transition type. If it is set to 'fade', adjust it to scroll horizontally.
	    if ( 'fade' == $instance->get_config( 'transition', $data ) ) {
	        $data['config']['transition'] = 'horizontal';
	    }
	
	    // Return the data.
	    return apply_filters( 'soliloquy_carousel_transition', $data );
	
	}
	/**
	 * Adds mappings for configuration keys that have a mobile equivalent, allowing Soliloquy to
	 * use these mobile keys when reading in configuration values on mobile devices
	 *
	 * @since 2.1.7
	 *
	 * @param array $mobile_keys Mobile Keys
	 * @return array Mobile Keys
	 */
	function mobile_keys( $mobile_keys ) {
	
	    $mobile_keys['carousel'] = 'mobile_carousel';
	    return $mobile_keys;
	
	}
		
	/**
	 * Disable image preloading for Carousels; ensures they load in IE without issue.
	 * Temporary until there is a better solution for getting carousels to work with .soliloquy-preload in IE10+11
	 *
	 * @since 2.1.3
	 *
	 * @param bool $disabled Disable Image Preloading
	 * @return bool Disable Image Preloading
	 */
	function disable_preloading( $disabled, $data ) {
	
	    // Check slider is a carousel before we disable preloading
	    $instance = Soliloquy_Shortcode::get_instance();
	    if ( ! $instance->get_config( 'carousel', $data ) ) {
	        return $disabled;
	    }
	
	    // Carousel, so disable preloading
	    return true;
	
	}
	
	/**
	 * Sets the image src to return the cropped image size for the carousel.
	 *
	 * @since 1.0.0
	 *
	 * @param string $type  The type of crop to perform.
	 * @param int $id       The current slider ID.
	 * @param array $item   Array of data about the current slide item.
	 * @param array $data   Array of slider data.
	 * @return string $type Amended type of crop to perform.
	 */
	function crop_output( $type, $id, $item, $data ) {
	
	    // If there is no carousel, don't crop anything.
	    $instance = Soliloquy_Shortcode::get_instance();
	    if ( ! $instance->get_config( 'carousel', $data ) ) {
	        return $type;
	    }
	
	    // If the slider is not set to be cropped, don't crop anything.
	    if ( ! $instance->get_config( 'slider', $data ) ) {
	        return $type;
	    }
	
	    // Change the crop type for our carousel.
	    return apply_filters( 'soliloquy_carousel_crop_type', 'carousel', $type, $id, $item, $data );
	
	}
	
	/**
	 * Outputs the soliloquy-carousel class to the main container of a slider, if the
	 * carousel is enabled on that slider
	 *
	 * @since 2.1.5
	 *
	 * @param array $classes    CSS Classes
	 * @param array $data       Slider Config
	 * @return array            CSS CLasses
	 */
	function container_classes( $classes, $data ) {
	    
	    // If there is no carousel, don't output anything.
	    $instance = Soliloquy_Shortcode::get_instance();
	    if ( ! $instance->get_config( 'carousel', $data ) ) {
	        return $classes;
	    }
	
	    // Add carousel class
	    $classes[] = 'soliloquy-carousel';
	    return $classes;
	
	}
	
	/**
	 * Outputs the carousel settings to the specific slider.
	 *
	 * @since 1.0.0
	 *
	 * @param array $data Data for the slider.
	 * @return null       Return early if a carousel is not enabled.
	 */
	function output( $data ) {
	
	    // If there is no carousel, don't output anything.
	    $instance = Soliloquy_Shortcode::get_instance();
	    if ( ! $instance->get_config( 'carousel', $data ) ) {
	        return;
	    }
	
	    // Output the carousel settings.
	    ob_start();
	    ?>
	    slideWidth: <?php echo $instance->get_config( 'carousel_width', $data ); ?>,
	    slideMargin: <?php echo $instance->get_config( 'carousel_margin', $data ); ?>,
	    minSlides: <?php echo $instance->get_config( 'carousel_min', $data ); ?>,
	    maxSlides: <?php echo $instance->get_config( 'carousel_max', $data ); ?>,
	    moveSlides: <?php echo $instance->get_config( 'carousel_move', $data ); ?>,
	    <?php
	    echo ob_get_clean();
	
	}
	
	/**
	 * Amends the image dimensions = carousel width and height
	 *
	 * Called when "Set Dimensions on Images" is enabled
	 *
	 * @since 2.1.4
	 *
	 * @param array $dimensions Width and Height Dimensions
	 * @param array $data Slider Data
	 * @return array Dimensions
	 */
	function image_dimensions( $dimensions, $data ) {
	
	    // If there is no carousel, don't output anything.
	    $instance = Soliloquy_Shortcode::get_instance();
	    if ( ! $instance->get_config( 'carousel', $data ) ) {
	        return $dimensions;
	    }
	
	    // Change dimensions = carousel
	    $dimensions = array(
	        'width' => $instance->get_config( 'carousel_width', $data ),
	        'height'=> $instance->get_config( 'carousel_height', $data ),
	    );
	
	    return $dimensions;
	
	}	
    /**
     * Returns the singleton instance of the class.
     *
     * @since 2.3.0
     *
     * @return object The Soliloquy_Thumbnails_Shortcode object.
     */
    public static function get_instance() {

        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Soliloquy_Carousel_Shortcode ) ) {
            self::$instance = new Soliloquy_Carousel_Shortcode();
        }

        return self::$instance;

    }	
}

$soliloquy_carousel_shortcode = Soliloquy_Carousel_Shortcode::get_instance();