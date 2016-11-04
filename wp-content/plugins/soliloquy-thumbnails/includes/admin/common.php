<?php
	
class Soliloquy_Thumbnails_Admin_Common{
    /**
     * Holds the class object.
     *
     * @since 2.3.0
     *
     * @var object
     */
    public static $instance;

    /**
     * Path to the file.
     *
     * @since 2.3.0
     *
     * @var string
     */
    public $file = __FILE__;

    /**
     * Holds the base class object.
     *
     * @since 2.3.0
     *
     * @var object
     */
    public $base;

    /**
     * Primary class constructor.
     *
     * @since 2.3.0
     */		
	function __construct(){
		
		$this->base = Soliloquy_Thumbnails::get_instance();
		
	}
	/**
	 * Returns the available thumbnail positions for the thumbnails container.
	 *
	 * @since 1.0.0
	 *
	 * @return array Array of thumbnail position data.
	 */
	function thumbnails_positions() {
	
	    $positions = array(
	        array(
	            'value' => 'top',
	            'name'  => esc_attr__(  'Top', 'soliloquy-thumbnails' )
	        ),
	        array(
	            'value' => 'bottom',
	            'name'  => esc_attr__(  'Bottom', 'soliloquy-thumbnails' )
	        ),
	        array(
	            'value' => 'left',
	            'name'  => esc_attr__(  'Left', 'soliloquy-thumbnails' )
	        ),
	        array(
	            'value' => 'right',
	            'name'  => esc_attr__(  'Right', 'soliloquy-thumbnails' )
	        ),
	    );
	
	    return apply_filters( 'soliloquy_thumbnails_positions', $positions );
	
	}
	
    /**
     * Returns the singleton instance of the class.
     *
     * @since 1.0.0
     *
     * @return object The Soliloquy_Thumbnails_Admin_Common object.
     */
    public static function get_instance() {

        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Soliloquy_Thumbnails_Admin_Common ) ) {
            self::$instance = new Soliloquy_Thumbnails_Admin_Common();
        }

        return self::$instance;

    }
	
}

$soliloquy_thumbnails_admin_common = Soliloquy_Thumbnails_Admin_Common::get_instance();