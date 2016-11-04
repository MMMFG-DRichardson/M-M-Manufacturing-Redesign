<?php
/**
 * Metabox class.
 *
 * @since 2.3.0
 *
 * @package Soliloquy_WooCommerce_Metaboxes
 * @author  Chris Kelley
 */
 class Soliloquy_Thumbnails_Metaboxes {

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
    public function __construct() {

    	// Get base instance
    	$this->base = Soliloquy_Thumbnails::get_instance();
		add_filter( 'soliloquy_defaults', array( $this, 'thumbnails_defaults' ), 10, 2 );
		add_filter( 'soliloquy_tab_nav', array( $this, 'tab_nav' ) );
		add_action( 'soliloquy_mobile_box', array( $this, 'mobile_tab' ) );
		add_action( 'soliloquy_tab_thumbnails', array( $this, 'thumbnails_tab' ) );
		add_filter( 'soliloquy_save_settings', array( $this, 'save' ), 10, 2 );
		
		add_action( 'soliloquy_metabox_scripts', array( $this, 'scripts' ) );
		add_action( 'print_media_templates', array( $this, 'meta_settings' ), 10, 3 );
		add_filter( 'soliloquy_ajax_save_meta', array( $this, 'save_meta' ), 10, 4 ); // Save Thumbnail metadata
		add_filter( 'soliloquy_ajax_save_bulk_meta', array( $this, 'save_meta' ), 10, 4 ); // Save Thumbnail metadata

		//    // Edit Metadata
		//	add_action( 'soliloquy_after_preview', 'soliloquy_thumbnails_preview', 10, 3 ); // Preview Thumbnail
		//	add_action( 'soliloquy_after_image_meta_settings', 'soliloquy_thumbnails_meta', 10, 3 ); // Thumbnail URL Input Field
		//    add_action( 'soliloquy_after_video_meta_settings', 'soliloquy_thumbnails_meta', 10, 3 ); // Thumbnail URL Input Field
		//    add_action( 'soliloquy_after_html_meta_settings', 'soliloquy_thumbnails_meta', 10, 3 ); // Thumbnail URL Input Field
       

    }
    
	/**
	 * Loads scripts for our metaboxes.
	 *
	 * @since 2.3.0
	 */
	function scripts() {
		
		wp_enqueue_script( $this->base->plugin_slug . '-media', plugins_url( 'assets/js/media-edit.js', $this->base->file ), array( 'jquery' ), $this->base->version , true );
	
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
	function thumbnails_defaults( $defaults, $post_id ) {
	
	    $defaults['thumbnails']          = 0;
	    $defaults['thumbnails_width']    = 75;
	    $defaults['thumbnails_height']   = 50;
	    $defaults['thumbnails_position'] = 'bottom';
	    $defaults['thumbnails_margin']   = 10;
	    $defaults['thumbnails_num']      = 3;
	    $defaults['thumbnails_crop']     = 1;
	    $defaults['thumbnails_loop']     = 0;
	    $defaults['thumbnails_arrows']   = 1;
	
	
	    // Mobile
	    $defaults['mobile_thumbnails']   = 0;
	
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
	
	    $tabs['thumbnails'] = esc_attr__( 'Thumbnails', 'soliloquy-thumbnails' );
	    return $tabs;
	
	}	
	
	/**
	 * Callback for displaying the UI for mobile thumbnails options.
	 *
	 * @since 2.1.7
	 *
	 * @param object $post The current post object.
	 */
	function mobile_tab( $post ) {
	
	    $instance = Soliloquy_Metaboxes::get_instance();
	    ?>
	    <tr id="soliloquy-config-mobile-thumbnails-box">
	        <th scope="row">
	            <label for="soliloquy-config-mobile-thumbnails"><?php esc_html_e( 'Enable Slider Thumbnails?', 'soliloquy-thumbnails' ); ?></label>
	        </th>
	        <td>
	            <input id="soliloquy-config-mobile-thumbnails" type="checkbox" name="_soliloquy[mobile_thumbnails]" value="<?php echo $instance->get_config( 'mobile_thumbnails', $instance->get_config_default( 'mobile_thumbnails' ) ); ?>" <?php checked( $instance->get_config( 'mobile_thumbnails', $instance->get_config_default( 'mobile_thumbnails' ) ), 1 ); ?> />
	            <span class="description"><?php esc_html_e( 'Enables or disables the slider thumbnails feature on mobile devices.', 'soliloquy-thumbnails' ); ?></span>
	        </td>
	    </tr>
	    <?php
	
	}	
	/**
	 * Callback for displaying the UI for setting thumbnails options.
	 *
	 * @since 1.0.0
	 *
	 * @param object $post The current post object.
	 */
	function thumbnails_tab( $post ) {
	
	    $instance = Soliloquy_Metaboxes::get_instance();
	    $common = Soliloquy_Thumbnails_Admin_Common::get_instance();
	    ?>
	    <div id="soliloquy-thumbnails">
		    <div class="soliloquy-config-header">
	        	<h2 class="soliloquy-intro"><?php esc_html_e( 'The settings below adjust the thumbnails settings for the slider.', 'soliloquy-thumbnails' ); ?></h2>
				<p class="soliloquy-help"><?php esc_html_e( 'Need some help?', 'soliloquy-thumbnails' ); ?><a href="http://soliloquywp.com/docs/thumbnails-addon/" target="_blank"><?php esc_html_e( ' Watch a video on how to setup your slider configuration', 'soliloquy-thumbnails' ); ?></a></p>
			</div>	  		    
	        <table class="form-table">
	            <tbody>
	                <tr id="soliloquy-config-thumbnails-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-thumbnails"><?php esc_html_e( 'Enable Slider Thumbnails?', 'soliloquy-thumbnails' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-thumbnails" type="checkbox" name="_soliloquy[thumbnails]" value="<?php echo $instance->get_config( 'thumbnails', $instance->get_config_default( 'thumbnails' ) ); ?>" <?php checked( $instance->get_config( 'thumbnails', $instance->get_config_default( 'thumbnails' ) ), 1 ); ?> data-conditional="soliloquy-config-thumbnails-width-box,soliloquy-config-thumbnails-height-box,soliloquy-config-thumbnails-position-box,soliloquy-config-thumbnails-margin-box,soliloquy-config-thumbnails-num-box,soliloquy-config-thumbnails-crop-box,soliloquy-config-thumbnails-arrows-box,soliloquy-config-thumbnails-loop-box" />
	                        <span class="description"><?php esc_html_e( 'Enables or disables the slider thumbnails feature.', 'soliloquy-thumbnails' ); ?></span>
	                    </td>
	                </tr>
	                <tr id="soliloquy-config-thumbnails-num-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-thumbnails-num"><?php esc_html_e( 'Number of Visible Thumbnails', 'soliloquy-thumbnails' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-thumbnails-num" type="number" name="_soliloquy[thumbnails_num]" value="<?php echo $instance->get_config( 'thumbnails_num', $instance->get_config_default( 'thumbnails_num' ) ); ?>" />
	                        <p class="description"><?php esc_html_e( 'The number of thumbnails visible in the thumbnail container.', 'soliloquy-thumbnails' ); ?></p>
	                    </td>
	                </tr>
	                <tr id="soliloquy-config-thumbnails-width-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-thumbnails-width"><?php esc_html_e( 'Thumbnails Width', 'soliloquy-thumbnails' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-thumbnails-width" type="number" name="_soliloquy[thumbnails_width]" value="<?php echo $instance->get_config( 'thumbnails_width', $instance->get_config_default( 'thumbnails_width' ) ); ?>" /> <span class="soliloquy-unit"><?php esc_html_e( 'px', 'soliloquy-thumbnails' ); ?></span>
	                        <p class="description"><?php esc_html_e( 'The width of each slide thumbnail (acts as max width and adjusts dynamically).', 'soliloquy-thumbnails' ); ?></p>
	                    </td>
	                </tr>
	                <tr id="soliloquy-config-thumbnails-height-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-thumbnails-height"><?php esc_html_e( 'Thumbnails Height', 'soliloquy-thumbnails' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-thumbnails-height" type="number" name="_soliloquy[thumbnails_height]" value="<?php echo $instance->get_config( 'thumbnails_height', $instance->get_config_default( 'thumbnails_height' ) ); ?>" /> <span class="soliloquy-unit"><?php esc_html_e( 'px', 'soliloquy-thumbnails' ); ?></span>
	                        <p class="description"><?php esc_html_e( 'The height of each slide thumbnail (acts as max width and adjusts dynamically).', 'soliloquy-thumbnails' ); ?></p>
	                    </td>
	                </tr>
	                <tr id="soliloquy-config-thumbnails-position-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-thumbnails-position"><?php esc_html_e( 'Thumbnails Position', 'soliloquy-thumbnails' ); ?></label>
	                    </th>
	                    <td>
		                    <div class="soliloquy-select">
	                        <select id="soliloquy-config-thumbnails-position" name="_soliloquy[thumbnails_position]" class="soliloquy-chosen" data-soliloquy-chosen-options='{ "disable_search":"true", "width": "100%" }'>
	                            <?php foreach ( (array) $common->thumbnails_positions() as $i => $data ) : ?>
	                                <option value="<?php echo $data['value']; ?>"<?php selected( $data['value'], $instance->get_config( 'thumbnails_position', $instance->get_config_default( 'thumbnails_position' ) ) ); ?>><?php echo $data['name']; ?></option>
	                            <?php endforeach; ?>
	                        </select>
		                    </div>
	                        <p class="description"><?php esc_html_e( 'Sets the thumbnail position relative to the slider.', 'soliloquy-thumbnails' ); ?></p>
	                    </td>
	                </tr>
	                <tr id="soliloquy-config-thumbnails-margin-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-thumbnails-margin"><?php esc_html_e( 'Thumbnails Margin', 'soliloquy-thumbnails' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-thumbnails-margin" type="number" name="_soliloquy[thumbnails_margin]" value="<?php echo $instance->get_config( 'thumbnails_margin', $instance->get_config_default( 'thumbnails_margin' ) ); ?>" /> <span class="soliloquy-unit"><?php esc_html_e( 'px', 'soliloquy-thumbnails' ); ?></span>
	                        <p class="description"><?php esc_html_e( 'The margin between each thumbnail within the slider.', 'soliloquy-thumbnails' ); ?></p>
	                    </td>
	                </tr>
	                <tr id="soliloquy-config-thumbnails-crop-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-thumbnails-crop"><?php esc_html_e( 'Crop Slider Thumbnails?', 'soliloquy-thumbnails' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-thumbnails-crop" type="checkbox" name="_soliloquy[thumbnails_crop]" value="<?php echo $instance->get_config( 'thumbnails_crop', $instance->get_config_default( 'thumbnails_crop' ) ); ?>" <?php checked( $instance->get_config( 'thumbnails_crop', $instance->get_config_default( 'thumbnails_crop' ) ), 1 ); ?> />
	                        <span class="description"><?php esc_html_e( 'Enables or disables thumbnail cropping.', 'soliloquy-thumbnails' ); ?></span>
	                    </td>
	                </tr>
	                <tr id="soliloquy-config-thumbnails-arrows-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-thumbnails-arrows"><?php esc_html_e( 'Show Thumbnails Navigation Arrow?', 'soliloquy-thumbnails' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-thumbnails-loop" type="checkbox" name="_soliloquy[thumbnails_arrows]" value="<?php echo $instance->get_config( 'thumbnails_arrows', $instance->get_config_default( 'thumbnails_arrows' ) ); ?>" <?php checked( $instance->get_config( 'thumbnails_arrows', $instance->get_config_default( 'thumbnails_arrows' ) ), 1 ); ?> />
	                        <span class="description"><?php esc_html_e( 'Enables or disables thumbnail navigation arrows.', 'soliloquy-thumbnails' ); ?></span>
	                    </td>
	                </tr>
	                <tr id="soliloquy-config-thumbnails-loop-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-thumbnails-loop"><?php esc_html_e( 'Loop Slider Thumbnails?', 'soliloquy-thumbnails' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-thumbnails-loop" type="checkbox" name="_soliloquy[thumbnails_loop]" value="<?php echo $instance->get_config( 'thumbnails_loop', $instance->get_config_default( 'thumbnails_loop' ) ); ?>" <?php checked( $instance->get_config( 'thumbnails_loop', $instance->get_config_default( 'thumbnails_loop' ) ), 1 ); ?> />
	                        <span class="description"><?php esc_html_e( 'Enables or disables thumbnail looping.', 'soliloquy-thumbnails' ); ?></span>
	                    </td>
	                </tr>
	
	                <?php do_action( 'soliloquy_thumbnails_box', $post ); ?>
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
	
	    $settings['config']['thumbnails']          = isset( $_POST['_soliloquy']['thumbnails'] ) ? 1 : 0;
	    $settings['config']['thumbnails_width']    = absint( $_POST['_soliloquy']['thumbnails_width'] );
	    $settings['config']['thumbnails_height']   = absint( $_POST['_soliloquy']['thumbnails_height'] );
	    $settings['config']['thumbnails_position'] = preg_replace( '#[^a-z0-9-_]#', '', $_POST['_soliloquy']['thumbnails_position'] );
	    $settings['config']['thumbnails_margin']   = absint( $_POST['_soliloquy']['thumbnails_margin'] );
	    $settings['config']['thumbnails_num']      = absint( $_POST['_soliloquy']['thumbnails_num'] );
	    $settings['config']['thumbnails_crop']     = isset( $_POST['_soliloquy']['thumbnails_crop'] ) ? 1 : 0;
	    $settings['config']['thumbnails_loop']     = isset( $_POST['_soliloquy']['thumbnails_loop'] ) ? 1 : 0;
	    $settings['config']['thumbnails_arrows']    = isset( $_POST['_soliloquy']['thumbnails_arrows'] ) ? 1 : 0;
	
	    // Mobile
	    $settings['config']['mobile_thumbnails']   = isset( $_POST['_soliloquy']['mobile_thumbnails'] ) ? 1 : 0;
	
	    return $settings;
	
	}
	/**
	* Outputs the thumbnail meta settings Edit Metadata modal
	*
	* @since 2.3.0
	* 
	*/
	function meta_settings(){
		
		// Soliloquy Meta Editor
		// Use: wp.media.template( 'soliloquy-meta-editor-thumbnails' )
		?>
		<script type="text/html" id="tmpl-soliloquy-meta-editor-thumbnails">
		
			<div class="soliloquy-meta">
				
			    <label class="setting">
			        <span class="name"><?php esc_html_e( 'Thumbnail', 'soliloquy-thumbnails' ); ?></span>
					<input class="soliloquy-thumb" type="text" name="thumb" value="{{ data.thumb }}" />
					<span class="description"><?php esc_html_e( 'Specify the URL of the image to display as a thumbnail.', 'soliloquy-thumbnails' ); ?></span>
				</label>
				        
		    </div>
		
		</script> <?php
		        	
	}	
	
	/**
	* Outputs the thumbnail preview area on the Edit Metadata modal
	*
	* @since 2.1.4
	* 
	* @param int $attach_id The current attachment ID.
	* @param array $data    Array of attachment data.
	* @param int $post_id   The current post ID.
	*/
	function soliloquy_thumbnails_preview( $attach_id, $data, $post_id ) {
		
		?>
		<hr />
		<h2><?php esc_html_e( 'Thumbnail', 'soliloquy-thumbnails' ); ?></h2>
		<img class="details-image thumb" src="<?php echo ( isset( $data['thumb'] ) ? $data['thumb'] : ''); ?>" draggable="false" />
		<div class="clear">
	    	<a href="#" class="soliloquy-thumbnail button button-primary" data-field="soliloquy-thumb" title="<?php esc_attr_e( 'Choose Thumbnail Image', 'soliloquy-thumbnails' ); ?>"><?php esc_html_e( 'Choose Thumbnail Image', 'soliloquy-thumbnails' ); ?></a>
			<a href="#" class="soliloquy-thumbnail-delete button button-secondary" data-field="soliloquy-thumb" title="<?php esc_attr_e( 'Remove Thumbnail Image', 'soliloquy-thumbnails' ); ?>"><?php esc_html_e( 'Remove Thumbnail Image', 'soliloquy-thumbnails' ); ?></a>
		</div>
		
		<?php 
		// Output message to state whether the thumbnail is optional or not
		switch( $data['type'] ) {
			case 'image':
			case 'video':
				?>
				<span class="description"><?php esc_html_e( 'Optionally choose a specific thumbnail for this image. If none is chosen, one will be automatically generated from the image above.', 'soliloquy-thumbnails' ); ?></span>
				<?php
				break;
			case 'html':
			?>
				<span class="description"><?php esc_html_e( 'Specify a thumbnail image for this HTML slider.', 'soliloquy-thumbnails' ); ?></span>
				<?php
				break;
		}
			
	}
	/**
	 * Outputs the thumbnail meta fields.
	 *
	 * @since 1.0.0
	 *
	 * @param int $attach_id The current attachment ID.
	 * @param array $data    Array of attachment data.
	 * @param int $post_id   The current post ID.
	 */
	function soliloquy_thumbnails_meta( $attach_id, $data, $post_id ) {
	
	    $instance = Soliloquy_Metaboxes::get_instance();
	    ?>
	    <label class="setting">
	        <span class="name"><?php esc_html_e( 'Thumbnail', 'soliloquy-thumbnails' ); ?></span>
			<input id="soliloquy-thumb-<?php echo $attach_id; ?>" class="soliloquy-thumb" type="text" name="_soliloquy[meta_thumb]" value="<?php echo ( ! empty( $data['thumb'] ) ? esc_url( $data['thumb'] ) : '' ); ?>" data-soliloquy-meta="thumb" />
			<span class="description"><?php esc_html_e( 'Specify the URL of the image to display as a thumbnail.', 'soliloquy-thumbnails' ); ?></span>
		</label>
	    <?php
	
	}	
	/**
	* Saves thumbnail meta fields
	*
	* @since 2.1.4
	*
	* @param array $slider_data	Array of slider data
	* @param array $meta		Array of meta data
	* @param int $attach_id		The current attachment ID
	* @param int $post_id 		The current post ID
	*/
	function save_meta( $slider_data, $meta, $attach_id, $post_id ) {
		
		if ( isset( $meta['thumb'] ) ) {
	        $slider_data['slider'][$attach_id]['thumb'] = esc_url( $meta['thumb'] );
	    }
		
		return $slider_data;
	}
	
	/**
     * Returns the singleton instance of the class.
     *
     * @since 2.3.0
     *
     * @return object The Soliloquy_Thumbnails_Metaboxes object.
     */
    public static function get_instance() {

        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Soliloquy_Thumbnails_Metaboxes ) ) {
            self::$instance = new Soliloquy_Thumbnails_Metaboxes();
        }

        return self::$instance;

    }   	 
    
 }
 
 //Load the metabox class
 $soliloquy_thumbnails_metaboxes = Soliloquy_Thumbnails_Metaboxes::get_instance();
 
 