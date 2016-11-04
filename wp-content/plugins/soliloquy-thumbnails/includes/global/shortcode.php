<?php

class Soliloquy_Thumbnails_Shortcode{
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
		
    	add_action( 'soliloquy_before_output', array( $this, 'init' ), 11 );
		
	}
	
	function init( $data ){
		
	    // If there are no thumbnails, don't output anything.
	    $instance = Soliloquy_Shortcode::get_instance();
	    
	    if ( ! $instance->get_config( 'thumbnails', $data ) ) {
	        return;
	    }
	
	    // Add classes to outer container
	    add_filter( 'soliloquy_output_container_classes', array ( $this, 'outer_container_classes' ), 10, 2 );
	
	    // Determine slider content filter based on thumbnail position.
	    switch ( $instance->get_config( 'thumbnails_position', $data ) ) {
	        case 'top':
	            add_filter( 'soliloquy_output_start', array( $this, 'output' ), 10, 2 );
	            break;
	
	        case 'left':
	            add_filter( 'soliloquy_output_start', array( $this, 'output' ), 10, 2 );
	            add_filter( 'soliloquy_output_container_style', array( $this, 'container_style' ), 10, 2 );
	            break;
	
	        case 'right':
	            add_filter( 'soliloquy_output_start', array( $this, 'output' ), 10, 2 );
	            add_filter( 'soliloquy_output_container_style', array( $this, 'container_style' ), 10, 2 );
	            break;
	        
	        case 'bottom':
	        	if ( $instance->get_config( 'slider_size', $data ) != 'fullscreen' ) {
	
	        	    add_filter( 'soliloquy_output', array( $this, 'output' ), 10, 2 );
	        	
	        	}else{
		        	
		        	add_filter( 'soliloquy_output_start', array( $this, 'output' ), 10, 2 );
	
	        	}
	        	
	            break;
	    }
	
	    // Add the rest of the contextual hooks/filters.
	    add_filter( 'soliloquy_cropped_image', array( $this, 'get_thumbnail' ), 10, 5 );
	    add_filter( 'soliloquy_output_start', array( $this, 'thumbnails_styles' ), 0, 2 );
	    add_filter( 'soliloquy_thumbnails_output_container_style', array( $instance, 'position_slider' ), 999, 2 );
	    add_action( 'soliloquy_api_start_global', array( $this, 'thumbnails_reveal' ) );
	    add_action( 'soliloquy_api_preload', array( $this, 'preload' ), 0 );
	    add_action( 'soliloquy_api_slider', array( $this, 'thumbnails_js' ) );
	    add_action( 'soliloquy_api_before_transition', array( $this, 'thumbnails_sync' ) );		
		add_filter( 'soliloquy_get_config_mobile_keys', array( $this, 'mobile_keys' ) );
    
	}
	
	/**
	 * Adds CSS classes to the Soliloquy outer container
	 *
	 * @since 2.2.0
	 *
	 * @param array $classes CSS Classes
	 * @param array $data Slider Data
	 * @return array CSS Classes
	 */
	function outer_container_classes( $classes, $data ) {
	
	    // Get instance
	    $instance  = Soliloquy_Shortcode::get_instance();
	
	    // Check thumbnails are enabled on this slider
	    if ( ! $instance->get_config( 'thumbnails', $data ) ) {
	        return $classes;
	    }
	
	    // If here, thumbnails are enabled
	    // Add classes
	    $classes[] = 'soliloquy-thumbnails-outer-container';
	    $classes[] = 'soliloquy-thumbnails-position-' . $instance->get_config( 'thumbnails_position', $data );
	
	    return $classes;
	
	}
	
	/**
	 * Adds inline styles to the Soliloquy inner container
	 *
	 * Used to apply left/right padding to the Soliloquy inner container if thumbnails are
	 * left/right aligned, so the thumbnails + slideshow display side by side
	 *
	 * @since 2.2.0
	 *
	 * @param string $styles Inline CSS Styles
	 * @param array $data Slider Data
	 * @return string Inline CSS Styles
	 */
	function container_style( $styles, $data ) {
		
	    // Check if thumbnails are left/right positioned
	    $instance  = Soliloquy_Shortcode::get_instance();	
		
		//if fullscreen slider just return
		if ( $instance->get_config( 'slider_size', $data ) === 'fullscreen' ){
		
			return $styles;
		}
	
	    $position = $instance->get_config( 'thumbnails_position', $data );
	    
	    // Get width and margin
	    $width = $instance->get_config( 'thumbnails_width', $data );
	    $margin = $instance->get_config( 'thumbnails_margin', $data );
	    $spacing = $width + $margin;
	
	    switch ( $position ) {
	        case 'left':
	            // Add left padding to slider
	            $styles .= 'padding-left:' . $spacing . 'px;';
	            break;
	
	        case'right':
	            // Add right padding to slider
	            $styles .= 'padding-right:' . $spacing . 'px;';
	            break;
	    }
	
	    return $styles;
	
	}
	
	/**
	 * Outputs the thumbnails HTML markup.
	 *
	 * @since 1.0.0
	 *
	 * @param string $slider  The HTML markup of the slider.
	 * @param array $data     Data for the slider.
	 * @return string $slider Amended HTML markup of the slider.
	 */
	function output( $slider, $data ) {
	
	    // If there are no thumbnails, don't output anything.
	    $instance = Soliloquy_Shortcode::get_instance();
	    if ( ! $instance->get_config( 'thumbnails', $data ) ) {
	        return $slider;
	    }
	    
	    // Calculate width and height
	    $i        = 0;
	    $width    = 'left' == $instance->get_config( 'thumbnails_position', $data ) || 'right' == $instance->get_config( 'thumbnails_position', $data ) ? $instance->get_config( 'thumbnails_width', $data ) : $instance->get_config( 'slider_width', $data );
	    $height   = 'left' == $instance->get_config( 'thumbnails_position', $data ) || 'right' == $instance->get_config( 'thumbnails_position', $data ) ? $instance->get_config( 'slider_height', $data ) : $instance->get_config( 'thumbnails_height', $data );
	
	    // If no width, force it
	    if ( empty( $width ) ) {
	        $width = 960;
	    }
	
	    $thumbs   = apply_filters( 'soliloquy_thumbnails_output_start', $slider, $data );
	
	    $thumbs  .= '<div id="soliloquy-thumbnails-container-' . sanitize_html_class( $data['id'] ) . '" class="' . $this->thumbnails_classes( $data ) . '" style="max-width:' . $width . 'px;max-height:' . $height . 'px;' . apply_filters( 'soliloquy_thumbnails_output_container_style', '', $data ) . '"' . apply_filters( 'soliloquy_thumbnails_output_container_attr', '', $data ) . '>';
	        $thumbs .= '<ul id="soliloquy-thumbnails-' . sanitize_html_class( $data['id'] ) . '" class="soliloquy-thumbnails soliloquy-wrap soliloquy-clear">';
	            $thumbs = apply_filters( 'soliloquy_thumbnails_output_before_container', $thumbs, $data );
	
	            foreach ( $data['slider'] as $id => $item ) {
	                // Skip over images that are pending (ignore if in Preview mode).
	                if ( isset( $item['status'] ) && 'pending' == $item['status'] && ! is_preview() ) {
	                    continue;
	                }
	
	                $thumbs   = apply_filters( 'soliloquy_thumbnails_output_before_item', $thumbs, $id, $item, $data, $i );
	                $output   = '<li class="' . $this->item_classes( $item, $i, $data ) . '"' . apply_filters( 'soliloquy_thumbnails_output_item_attr', '', $id, $item, $data, $i ) . ' data-index="' . $i . '" draggable="false" style="list-style:none">';
	                    $output .= $this->get_slide( $id, $item, $data, $i );
	                $output .= '</li>';
	                $output  = apply_filters( 'soliloquy_thumbnails_output_single_item', $output, $id, $item, $data, $i );
	                $thumbs .= $output;
	                $thumbs  = apply_filters( 'soliloquy_thumbnails_output_after_item', $thumbs, $id, $item, $data, $i );
	
	                // Increment the iterator.
	                $i++;
	            }
	
	            $thumbs = apply_filters( 'soliloquy_thumbnails_output_after_container', $thumbs, $data );
	        $thumbs .= '</ul>';
	        $thumbs  = apply_filters( 'soliloquy_thumbnails_output_end', $thumbs, $data );
	    $thumbs .= '</div>';
	
	    // Remove contextual filters.
	    remove_filter( 'soliloquy_thumbnails_output_container_style', array( $instance, 'position_slider' ), 999, 2 );
	    remove_filter( 'soliloquy_output', 'soliloquy_thumbnails_output', 10, 2 );
	    remove_filter( 'soliloquy_output_start', 'soliloquy_thumbnails_output', 10, 2 );
	
	    return apply_filters( 'soliloquy_thumbnails_output', $thumbs, $data );
	
	}
	
	/**
	 * Outputs the thumbnails styles.
	 *
	 * @since 1.0.0
	 *
	 * @param string $slider  The HTML markup of the slider.
	 * @param array $data     Data for the slider.
	 * @return string $slider Amended HTML markup of the slider.
	 */
	function thumbnails_styles( $slider, $data ) {
	
	    // If there are no thumbnails, don't output anything.
	    $instance = Soliloquy_Shortcode::get_instance();
	    if ( ! $instance->get_config( 'thumbnails', $data ) ) {
	        return $slider;
	    }
	
	    // Since this CSS only needs to be defined once on a page, use static flag to help keep track.
	    static $soliloquy_thumbnails_css_flag = false;
	
	    // If the flag has been set to true, return the default code.
	    if ( $soliloquy_thumbnails_css_flag ) {
	        return $slider;
	    }
	
	    $styles   = '<style type="text/css">';
	        $styles .= '.soliloquy-thumbnails-container .soliloquy-item { opacity: .5; }';
	        $styles .= '.soliloquy-thumbnails-container .soliloquy-active-slide, .soliloquy-thumbnails-container .soliloquy-item:hover { opacity: 1; }';
	    $styles  .= '</style>';
	    $styles   = apply_filters( 'soliloquy_thumbnails_styles', $styles, $data );
	
	    // Set our flag to true.
	    $soliloquy_thumbnails_css_flag = true;
	
	    return Soliloquy_Shortcode::get_instance()->minify( $styles ) . $slider;
	
	}
	
	/**
	 * Reveals the thumbnails with elegance.
	 *
	 * @since 1.0.0
	 *
	 * @param array $data Array of slider data.
	 */
	function thumbnails_reveal( $data ) {
	
	    // If there are no thumbnails, don't output anything.
	    $instance = Soliloquy_Shortcode::get_instance();
	    if ( ! $instance->get_config( 'thumbnails', $data ) ) {
	        return;
	    }
	
	    ob_start();
	    ?>
	    jQuery('#soliloquy-thumbnails-container-<?php echo $data['id']; ?>').css('height', Math.round(jQuery('#soliloquy-thumbnails-container-<?php echo $data['id']; ?>').width()/(<?php echo $instance->get_config( 'slider_width', $data ); ?>/<?php echo $instance->get_config( 'thumbnails_height', $data ); ?>))).fadeTo(300, 1);
	    <?php
	    echo ob_get_clean();
	
	}
	
	/**
	 * Preloads the thumbnail output at lightening fast speeds.
	 *
	 * @since 1.0.0
	 *
	 * @param array $data Array of slider data.
	 */
	function preload( $data ) {
	
	    // If there are no thumbnails, don't output anything.
	    $instance = Soliloquy_Shortcode::get_instance();
	    if ( ! $instance->get_config( 'thumbnails', $data ) ) {
	        return;
	    }
	
	    ob_start();
	    ?>
	    if ( typeof soliloquy_thumbnails_slider === 'undefined' || false === soliloquy_thumbnails_slider ) {
	        soliloquy_thumbnails_slider = {};
	    }
	
	    var soliloquy_thumbnails_container_<?php echo $data['id']; ?> = $('#soliloquy-thumbnails-container-<?php echo $data['id']; ?>'),
	        soliloquy_thumbnails_<?php echo $data['id']; ?> = $('#soliloquy-thumbnails-<?php echo $data['id']; ?>'),
	        soliloquy_thumbnails_holder_<?php echo $data['id']; ?> = $('#soliloquy-thumbnails-<?php echo $data['id']; ?>').find('.soliloquy-preload');
	
	    if ( 0 !== soliloquy_thumbnails_holder_<?php echo $data['id']; ?>.length ) {
	        var soliloquy_thumbnails_src_attr = 'data-soliloquy-src';
	        $.each(soliloquy_thumbnails_holder_<?php echo $data['id']; ?>, function(i, el){
	            var soliloquy_src = $(this).attr(soliloquy_thumbnails_src_attr);
	            if ( typeof soliloquy_src === 'undefined' || false === soliloquy_src ) {
	                return;
	            }
	
	            var soliloquy_image = new Image();
	            soliloquy_image.src = soliloquy_src;
	            $(this).attr('src', soliloquy_src).removeAttr(soliloquy_thumbnails_src_attr);
	        });
	    }
	    <?php
	    echo ob_get_clean();
	
	}
	
	/**
	 * Outputs the thumbnails JS init code to initialize the thumbnails.
	 *
	 * @since 1.0.0
	 *
	 * @param array $data Array of slider data.
	 */
	function thumbnails_js( $data ) {
	
	    // If there are no thumbnails, don't output anything.
	    $instance = Soliloquy_Shortcode::get_instance();
	    if ( ! $instance->get_config( 'thumbnails', $data ) ) {
	        return;
	    }
	
	    // Get mode (horizontal or vertical)
	    $position = $instance->get_config( 'thumbnails_position', $data );
	    switch ( $position ) {
	        case 'top':
	        case 'bottom':
	            $mode = 'horizontal';
	            break;
	
	        case 'left':
	        case 'right':
	            $mode = 'vertical';
	            break;
	    }
	
	    ob_start();
	    ?>
	    soliloquy_thumbnails_slider['<?php echo $data['id']; ?>'] = soliloquy_thumbnails_<?php echo $data['id']; ?>.soliloquy({
	        <?php do_action( 'soliloquy_thumbnails_api_config_start', $data ); ?>
	        slideWidth: <?php echo $instance->get_config( 'thumbnails_width', $data ); ?>,
	        slideMargin: <?php echo $instance->get_config( 'thumbnails_margin', $data ); ?>,
	        minSlides: <?php echo $instance->get_config( 'thumbnails_num', $data ) != '' ? $instance->get_config( 'thumbnails_num', $data ) : 1;  ?>,
	        maxSlides: <?php echo $instance->get_config( 'thumbnails_num', $data ) != '' ? $instance->get_config( 'thumbnails_num', $data ) : 1;  ?>,
	        moveSlides: 1,
	        slideSelector: '.soliloquy-item',
	        auto: 0,
	        useCSS: 0,
	        adaptiveHeight: 1,
	        adaptiveHeightSpeed: <?php echo apply_filters( 'soliloquy_adaptive_height_speed', 400, $data ); ?>,
	        infiniteLoop:<?php echo $instance->get_config( 'thumbnails_loop', $data ) != '' ? $instance->get_config( 'thumbnails_loop', $data ) : 0;  ?>,
	        hideControlOnEnd: 1,
	        mode: '<?php echo $mode; ?>',
	        pager: 0,
	        controls: <?php echo $instance->get_config( 'thumbnails_arrows', $data ) != '' ? $instance->get_config( 'thumbnails_arrows', $data ) : 0;  ?>,
	        nextText: '',
	        prevText: '',
	        startText: '',
	        stopText: '',
	        <?php do_action( 'soliloquy_thumbnails_api_config_callback', $data ); ?>
	        onSliderLoad: function(currentIndex){
	            soliloquy_thumbnails_container_<?php echo $data['id']; ?>.find('.soliloquy-active-slide').removeClass('soliloquy-active-slide');
	            soliloquy_thumbnails_container_<?php echo $data['id']; ?>.css({'height':'auto','background-image':'none'}).find('.soliloquy-controls').fadeTo(300, 1);
	            $('#soliloquy-thumbnails-<?php echo $data['id']; ?> .soliloquy-item').eq(soliloquy_slider['<?php echo $data['id']; ?>'].getCurrentSlide()).addClass('soliloquy-active-slide');
	            $(document).on('click.SoliloquyThumbnails', '#soliloquy-thumbnails-<?php echo $data['id']; ?> .soliloquy-thumbnails-item', function(e){
	                e.preventDefault();
	                var $this = $(this);
	                if ( $this.hasClass('soliloquy-active-slide') ) {
	                    return;
	                }
	                soliloquy_slider['<?php echo $data['id']; ?>'].goToSlide($this.attr('data-index'));
	            });
	            <?php do_action( 'soliloquy_thumbnails_api_on_load', $data ); ?>
	        },
	        onSlideBefore: function(element, oldIndex, newIndex){
	            <?php do_action( 'soliloquy_thumbnails_api_before_transition', $data ); ?>
	        },
	        onSlideAfter: function(element, oldIndex, newIndex){
	            <?php do_action( 'soliloquy_thumbnails_api_after_transition', $data ); ?>
	        },
	        <?php do_action( 'soliloquy_thumbnails_api_config_end', $data ); ?>
	    });
	    <?php
	    echo ob_get_clean();
	
	}
	
	/**
	 * Syncs the thumbnails to the main slider.
	 *
	 * @since 1.0.0
	 *
	 * @param array $data Array of slider data.
	 */
	function thumbnails_sync( $data ) {
	
	    // If there are no thumbnails, don't output anything.
	    $instance = Soliloquy_Shortcode::get_instance();
	    if ( ! $instance->get_config( 'thumbnails', $data ) ) {
	        return;
	    }
	
	    ob_start();
	    ?>
	    soliloquy_thumbnails_<?php echo $data['id']; ?>.find('.soliloquy-active-slide').removeClass('soliloquy-active-slide');
	    soliloquy_thumbnails_<?php echo $data['id']; ?>.find('.soliloquy-item:not(.soliloquy-clone):eq(' + newIndex + ')').addClass('soliloquy-active-slide');
	    if ( soliloquy_thumbnails_slider['<?php echo $data['id']; ?>'].getSlideCount() - newIndex >= parseInt(<?php echo $instance->get_config( 'thumbnails_num', $data ); ?>) ) {
	        soliloquy_thumbnails_slider['<?php echo $data['id']; ?>'].goToSlide(newIndex);
	    } else {
	        soliloquy_thumbnails_slider['<?php echo $data['id']; ?>'].goToSlide(soliloquy_thumbnails_slider['<?php echo $data['id']; ?>'].getSlideCount() - parseInt(<?php echo $instance->get_config( 'thumbnails_num', $data ); ?>));
	    }
	    <?php
	    echo ob_get_clean();
	
	}
	
	/**
	 * Returns the thumbnails slider classes.
	 *
	 * @since 1.0.0
	 *
	 * @param array $data Array of slider data.
	 * @return string     String of space separated thumbnail slider classes.
	 */
	function thumbnails_classes( $data ) {
	
	    // Set default class.
	    $instance  = Soliloquy_Shortcode::get_instance();
	    $classes   = array();
	    $classes[] = 'soliloquy-container';
	    $classes[] = 'soliloquy-thumbnails-container';
	
	    // Allow filtering of classes and then return what's left.
	    $classes = apply_filters( 'soliloquy_thumbnails_output_classes', $classes, $data );
	
	    // Add custom class based on the theme.
	    $classes[] = 'soliloquy-theme-' . $instance->get_config( 'slider_theme', $data );
	    
	    // If the slider has RTL support, add a class for it.
	    if ( $instance->get_config( 'rtl', $data ) ) {
	        $classes[] = 'soliloquy-rtl';
	    }
	
	    return trim( implode( ' ', array_map( 'trim', array_map( 'sanitize_html_class', array_unique( $classes ) ) ) ) );
	
	}
	
	/**
	 * Returns the thumbnails slider item classes.
	 *
	 * @since 1.0.0
	 *
	 * @param array $item Array of item data.
	 * @param int $i      The current position in the slider.
	 * @param array $data The slider data to use for retrieval.
	 * @return string     String of space separated slider item classes.
	 */
	function item_classes( $item, $i, $data ) {
	
	    // Set default class.
	    $classes   = array();
	    $classes[] = 'soliloquy-item';
	    $classes[] = 'soliloquy-item-' . $i;
	    $classes[] = 'soliloquy-thumbnails-item';
	
	    // Set the type of slide as a class.
	    $classes[] = ! empty( $item['type'] ) ? 'soliloquy-' . $item['type'] . '-slide' : 'soliloquy-image-slide';
	
	    // Allow filtering of classes and then return what's left.
	    $classes = apply_filters( 'soliloquy_thumbnails_output_item_classes', $classes, $item, $i, $data );
	    return trim( implode( ' ', array_map( 'trim', array_map( 'sanitize_html_class', array_unique( $classes ) ) ) ) );
	
	}
	
	/**
	* When soliloquy_thumbnails_get_slide calls Soliloquy_Shortcode::get_image_src(),
	* get_image_src fires the filter that calls this function so we generate a thumbnail
	* based from the 'full' thumbnail, if specified.
	*
	* Otherwise fallback to the image and use that as a thumbnail
	*
	* @since 2.1.8
	*
	* @param string $image Image
	* @param int $id Image ID
	* @param array $item Slide
	* @param array $data Slider Config
	* @param int $slider_id Slider ID
	* @return string Image to use as Thumbnail
	*/
	function get_thumbnail( $image, $id, $item, $data, $slider_id ) {
	
	    if ( isset( $item['thumb'] ) && ! empty( $item['thumb'] ) ) {
	        return $item['thumb'];
	    }
	
	    return $image;
	
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
	
	    $mobile_keys['thumbnails'] = 'mobile_thumbnails';
	    return $mobile_keys;
	
	}		
	/**
	 * Returns the slide markup for the thumbnails slider.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed $id   The slider ID.
	 * @param array $item Array of item data.
	 * @param array $data The slider data to use for retrieval.
	 * @param int $i      The current position in the slider.
	 * @return string     String of space separated slider item classes.
	 */
	function get_slide( $id, $item, $data, $i ) {

		$instance = Soliloquy_Shortcode::get_instance();
		$mobile = $instance->is_mobile();
	    $imagesrc = $instance->get_image_src( $id, $item, $data, 'thumbnails' );
	
	    $output   = apply_filters( 'soliloquy_thumbnails_output_before_item', '', $id, $item, $data, $i );
	        $output  = apply_filters( 'soliloquy_thumbnails_output_before_link', $output, $id, $item, $data, $i );
	        $output .= '<a href="" class="soliloquy-link soliloquy-thumbnails-link" title="' . esc_attr( $item['title'] ) . '"' . apply_filters( 'soliloquy_thumbnails_output_link_attr', '', $id, $item, $data, $i ) . '>';
	            $output  = apply_filters( 'soliloquy_thumbnails_output_before_image', $output, $id, $item, $data, $i );
	            
	            if ( $mobile ) {
		            $output .= '<img id="soliloquy-image-' . sanitize_html_class( $id ) . '" class="soliloquy-image soliloquy-thumbnails-image soliloquy-preload soliloquy-image-' . $i . '" src="' . esc_url( plugins_url( 'assets/css/images/holder.gif', Soliloquy::get_instance()->file ) ) . '" data-soliloquy-src="' . esc_url( $imagesrc ) . '" alt="' . trim( esc_html( $item['title'] ) ) . '"' . apply_filters( 'soliloquy_thumbnails_output_image_attr', '', $id, $item, $data, $i ) . ' />';
	            } else {
		            $output .= '<img id="soliloquy-image-' . sanitize_html_class( $id ) . '" class="soliloquy-image soliloquy-thumbnails-image soliloquy-image-' . $i . '" src="' . esc_url( $imagesrc ) . '" alt="' . trim( esc_html( $item['title'] ) ) . '"' . ( $instance->get_config( 'dimensions', $data ) ? ' width="' . $instance->get_config( 'thumbnails_width', $data ) . '" height="' . $instance->get_config( 'thumbnails_height', $data ) . '"' : '' ) . apply_filters( 'soliloquy_thumbnails_output_image_attr', '', $id, $item, $data, $i ) . ' />';
	            }
	            
	            $output  = apply_filters( 'soliloquy_thumbnails_output_after_image', $output, $id, $item, $data, $i );
	        $output .= '</a>';
	        $output  = apply_filters( 'soliloquy_thumbnails_output_after_link', $output, $id, $item, $data, $i );
	    $output   = apply_filters( 'soliloquy_thumbnails_output_after_item', $output, $id, $item, $data, $i );
	
	    return apply_filters( 'soliloquy_thumbnails_output_single_item', $output, $id, $item, $data, $i );
	
	}
    /**
     * Returns the singleton instance of the class.
     *
     * @since 2.3.0
     *
     * @return object The Soliloquy_Thumbnails_Shortcode object.
     */
    public static function get_instance() {

        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Soliloquy_Thumbnails_Shortcode ) ) {
            self::$instance = new Soliloquy_Thumbnails_Shortcode();
        }

        return self::$instance;

    }
}

//Load the Shortcode Class
$soliloquy_thumbnails_shortcode = Soliloquy_Thumbnails_Shortcode::get_instance();