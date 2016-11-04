<?php
/**
 * Shortcode class.
 *
 * @since 1.0.0
 *
 * @package Soliloquy_WooCommerce_Shortcode
 * @author  Chris Kelley
 */
class Soliloquy_WooCommerce_Shortcode {

    /**
     * Holds the class object.
     *
     * @since 1.0.0
     *
     * @var object
     */
    public static $instance;

    /**
     * Path to the file.
     *
     * @since 1.0.0
     *
     * @var string
     */
    public $file = __FILE__; 

    /**
     * Holds the base class object.
     *
     * @since 1.0.0
     *
     * @var object
     */
    public $base;

    /**
     * Primary class constructor.
     *
     * @since 1.0.0
     */
    public function __construct() {

    	// Get base instance
    	$this->base = Soliloquy_WooCommerce::get_instance();

    	// Actions and filters
    	add_filter( 'soliloquy_output_classes', array( $this, 'output_classes' ), 10, 2 );
        add_filter( 'soliloquy_pre_data', array( $this, 'pre_data' ), 10, 2 );
        add_filter( 'soliloquy_output_item_classes', array( $this, 'output_item_classes' ), 10, 4 );

        // Dynamic Addon Support
        add_filter( 'soliloquy_dynamic_get_dynamic_slider_types', array( $this, 'register_dynamic_slider_types' ) );
        add_filter( 'soliloquy_dynamic_queried_data', array( $this, 'change_slider_type' ), 10, 3 );
        add_filter( 'soliloquy_dynamic_get_wc_product_gallery', array( $this, 'get_single_product_gallery' ), 10, 3 );
        
    }
    
    /**
     * Adds shortcode and function support for [soliloquy_dynamic id="wc-name"]
     *
     * @since 1.0.0
     *
     * @param array $types Dynamic Slider Types
     * @return array Dynamic Slider Types
     */
    function register_dynamic_slider_types( $types ) {

        $types['soliloquy_dynamic_get_wc_images'] = '#^wc-#';
        $types['soliloquy_dynamic_get_wc_product_gallery'] = '#^wcproduct-#';

        return $types;

    }
    
	/**
	* Retrieves the image data for a given NextGen Gallery ID
	*
	* @param array $dynamic_data 	Existing Dynamic Data Array
	* @param int $id				NextGen Gallery ID
	* @param array $data			Slider Configuration
	* @return bool|array			Array of data on success, false on failure
	*/
	public function get_single_product_gallery( $dynamic_data, $id, $data ) {

		// Return false if the WooCommerce class is not available.
	    if ( ! class_exists( 'WooCommerce' ) ) {
	        return false;
	    }

	    // Get shortcode instance
	    $instance = Soliloquy_Shortcode::get_instance();

	    // Get NextGen Gallery ID
	    $product_id = explode( '-', $id );
	    $id = $product_id[1];
		$product = wc_get_product( $id );	 
		 
		if( ! is_object( $product ) ){
			return false;
		}
		
	    $objects = apply_filters( 'soliloquy_dynamic_get_wc_product_image_data', $product->get_gallery_attachment_ids(), $id );
	    
	    // Return if no objects found
	    if ( ! $objects ) {
		    return false;
	    }

		// Build gallery
		foreach ( (array) $objects as $object ) {
			
			$attachment = get_post( $object );

			// Build image attributes to match Soliloquy
		    $dynamic_data[ $object ] = array(
				'src' 				=> wp_get_attachment_url( $object ),
				'title' 			=> $attachment->post_title,
				'link' 				=> get_permalink( $id ),
				'alt' 				=> get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
				'caption' 			=> $attachment->post_content,
		    ); 

		}

	    return apply_filters( 'soliloquy_dynamic_wc_product_gallery', $dynamic_data, $objects, $id, $data );
	    
	}	 
    /**
     * Changes the Dynamic Slider to an wc slider if the Dynamic Slider's ID
     * matches that of a Soliloquy Featured Content Slider
     *
     * Also allows the Dynamic Addon shortcode to override configuration settings
     * for a specific Featured Content Slider
     *
     * @since 1.0.0
     *
     * @param array $data Dynamic Slider Config
     * @param int $id wc Slider ID
     * @param array $dynamic_data Slides (will be empty)
     * @return array Featured Content Slider Config
     */
    public function change_slider_type( $data, $id, $dynamic_data ) {

        // Get Soliloquy ID
        $soliloquy_id   = explode( '-', $id );
        if ( count( $soliloquy_id ) == 1 ) {
            return $data;
        }
        $id = $soliloquy_id[1];

        // Check ID is an integer
        if ( ! is_numeric( $id ) ) {
            return $data;
        }
        
        // Get Soliloquy Slider
        $slider_data = apply_filters( 'soliloquy_dynamic_get_wc_image_data', Soliloquy::get_instance()->get_slider( $id ), $id );
        if ( ! $slider_data ) {
            return $data;
        }

        // Replace config options in $slider_data with $data
        $ignored_config_keys = array(
            'title',
            'slug',
            'classes',
            'type',
            'dynamic',
        );
        foreach ( $data['config'] as $key=>$value ) {
            // Skip ignored config keys
            if ( in_array( $key, $ignored_config_keys ) ) {
                continue;
            }

            // Replace $slider_data['config'][$key]
            // Some wc keys need to be arrays
            switch ( $key ) {
                case 'wc_product_types':
                case 'wc_terms':
                case 'wc_inc_ex':
                    // Value needs to be an array
                    $slider_data['config'][ $key ] = array(
                        $data['config'][ $key ],
                    );
                    break;
                default:
                    // Value can be anything
                    $slider_data['config'][ $key ] = $data['config'][ $key ];
                    break;
            }
            
        }

        return $slider_data;

    }

    /**
     * Adds a custom slider class to denote a featured content slider.
     *
     * @since 1.0.0
     *
     * @param array $classes  Array of slider classes.
     * @param array $data     Array of slider data.
     * @return array $classes Amended array of slider classes.
     */
    function output_classes( $classes, $data ) {

        // Return early if not a wc slider.
        $instance = Soliloquy_Shortcode::get_instance();
        if ( 'wc' !== $instance->get_config( 'type', $data ) ) {
            return $classes;
        }

        // Add custom wc class.
        $classes[] = 'soliloquy-wc-slider';
        return $classes;

    }

    /*
    * Adds Post and Taxonomy Term classes to each slider item
    *
    * @since 1.0.0
    *
    * @param array  $classes    CSS Classes
    * @param array  $item       Slide Item
    * @param int    $i          Index
    * @param array  $data       Slider Config
    * @return array             CSS Classes
    */
    function output_item_classes( $classes, $item, $i, $data ) {

        // Check if any classes are defined for the slider item
        if ( ! isset( $item['classes'] ) ) {
            return $classes;
        }

        // Append classes array to the existing classes
        $classes = array_merge( $classes, $item['classes'] );

        // Return
        return $classes;

    }

    /**
     * Filters the data to pull images from Featured Content for Featured Content sliders.
     *
     * @since 1.0.0
     *
     * @param array $data  Array of slider data.
     * @param int $id      The slider ID.
     * @return array $data Amended array of slider data.
     */
    function pre_data( $data, $id ) {

        // Return early if not an Featured Content slider.
        $instance = Soliloquy_Shortcode::get_instance();
        if ( 'wc' !== $instance->get_config( 'type', $data ) ) {
            return $data;
        }

        // Prepare and run the query for grabbing our featured content.
        $query   = $this->prepare_query( $id, $data );
        $wc_data = $this->get_data( $query, $id, $data );

        // If there was an error with the query, simply return default data.
        if ( ! $wc_data ) {
            return $data;
        }

        // Insert the featured content data into the slider data.
        $data = $this->insert_data( $data, $wc_data );
        // Return the modified data.
        return apply_filters( 'soliloquy_wc_data', $data, $id );

    }

    /**
     * Prepares the query args for the featured content query.
     *
     * @since 1.0.0
     *
     * @param mixed $id   The current slider ID.
     * @param array $data Array of slider data.
     * @return array      Array of query args for the featured content slider.
     */
    private function prepare_query( $id, $data ) {
        // Prepare vairables.
        $instance   = Soliloquy_Shortcode::get_instance();
        $query_args = array();
       
        // Set any default query args that are not appropriate for our query.
        $query_args['post_type']      = array( 'product', 'product_variation' );
        $query_args['post_parent']    = null;
        $query_args['post_mime_type'] = null;
        $query_args['cache_results']  = false;
        $query_args['no_found_rows']  = true;

        // Set our user defined query args.
        $query_args['posts_per_page'] = $instance->get_config( 'wc_number', $data );
        $query_args['orderby']        = $instance->get_config( 'wc_orderby', $data );
        $query_args['order']          = $instance->get_config( 'wc_order', $data );
        $query_args['offset']         = $instance->get_config( 'wc_offset', $data );
        $query_args['post_status']    = $instance->get_config( 'wc_status', $data );

        // Set meta_key if sorting by meta_value or meta_value_num
        if ( $query_args['orderby'] == 'meta_value' || $query_args['orderby'] == 'meta_value_num' ) {
            $query_args['meta_key'] = $instance->get_config( 'wc_meta_key', $data );
        }
        
        // Set post__in or post__not_in query params.
        $inc_ex = $instance->get_config( 'wc_inc_ex', $data );
        if ( ! empty( $inc_ex ) ) {
            $exception              = 'include' == $instance->get_config( 'wc_query', $data ) ? 'post__in' : 'post__not_in';
            $query_args[$exception] = array_map( 'absint', (array) $inc_ex );
        }

        // Set our custom taxonomy query parameters if necessary.
        $terms = $instance->get_config( 'wc_terms', $data );
        $operator = $instance->get_config( 'wc_terms_relation', $data );
        
        if ( ! empty( $terms ) ) {
            // Set our taxonomy relation parameter 
            $relation['relation'] = 'AND';

            // Loop through each term and parse out the data.
            foreach ( $terms as $term ) {
                $term_data    = explode( '|', $term );
                $taxonomies[] = $term_data[0];
                $terms[]      = $term_data;
            }

            // Loop through each taxonony and build out the taxonomy query.
            foreach ( array_unique( $taxonomies ) as $tax ) {
                $tax_terms = array();
                foreach ( $terms as $term ) {
                    if ( $tax == $term[0] ) {
                        $tax_terms[] = $term[2];
                    }
                }

                $relation[] = array(
                    'taxonomy'         => $tax,
                    'field'            => 'slug',
                    'terms'            => $tax_terms,
                    'operator'         => $operator,
                    'include_children' => false,
                );
            }
            $query_args['tax_query'] = $relation;
        }
       
		$meta = array();
		$meta['relation'] = 'AND';
		
		//Make sure the product is visible
		$meta[] = array(
			'key' 		=> '_visibility',
			'value' 	=> array('catalog', 'visible'),
			'compare' 	=> 'IN'
		);
		
		if ( $instance->get_config( 'wc_product_in_stock', $data ) ) {
					
			$meta[] = array(
				'key' 	=> '_stock_status',
		        'value' => 'instock'				
			);
				
		}
			
		if ( $instance->get_config( 'wc_product_on_sale', $data ) ) {
				
			$sale_price = array();
				
			$sale_price['relation'] = 'OR';

			$sale_price[] = array(
		    	'key' 		=> '_sale_price',
		        'value' 	=> 0,
		        'compare' 	=> '>',
		        'type' 		=> 'NUMERIC'				
			);
			
			$sale_price[] = array( 
				'key'           => '_min_variation_sale_price',
				'value'         => 0,
				'compare'       => '>',
				'type'          => 'numeric'
			);
				
			$meta[] = $sale_price;
	
		}
			
		if ( $instance->get_config( 'wc_featured_products', $data ) ) {
	
			$meta[] = array(
				'key' 	=> '_featured',
				'value' => 'yes'		
			);

		}
		
		if ( $instance->get_config( 'wc_price_range', $data ) ) {

			$price_range = array();
			
			$price_range['relation'] = 'OR';
			
			$price_range[] = array(
				array(
                    'key' 		=> '_price',
                    'value' 	=> $instance->get_config( 'wc_min_range', $data ),
                    'compare' 	=> '>=',
                    'type' 		=> 'NUMERIC'
                ),
                 array(
                    'key' 		=> '_price',
                    'value' 	=> $instance->get_config( 'wc_max_range', $data ),
                    'compare' 	=> '<=',
                    'type' 		=> 'NUMERIC'
                )
            );
   			$price_range[] = array(
   				array(
                    'key' 		=> '_sale_price',
                    'value' 	=> $instance->get_config( 'wc_min_range', $data ),
                    'compare' 	=> '>=',
                    'type' 		=> 'NUMERIC'
                ),
                array(
                    'key' 		=> '_sale_price',
                    'value' 	=> $instance->get_config( 'wc_max_range', $data ),
                    'compare' 	=> '<=',
                    'type' 		=> 'NUMERIC'
                )
            );
             
			$meta[] = $price_range;			
		}
			
		$query_args['meta_query'] = $meta;
		
        // Allow dev to optionally allow query filters.
        $query_args['suppress_filters'] = apply_filters( 'soliloquy_wc_suppress_filters', true, $query_args, $id, $data );

        // Filter and return the query args.
        return apply_filters( 'soliloquy_wc_query_args', $query_args, $id, $data );

    }

    /**
     * Runs and caches the query to grab featured content data.
     *
     * @since 1.0.0
     *
     * @param array $data Array of query args.
     * @param mixed $id   The current slider ID.
     * @param array $data Array of slider data.
     * @return bool|array False if no items founds, array of data on success.
     */
    function get_data( $query, $id, $data ) {
	    
	    $instance   = Soliloquy_Shortcode::get_instance();
    
		$cache = $instance->get_config( 'wc_no_cache', $data ) ? true : false;
		
		//filter to prevent caching for more dynamic situations
		if ( apply_filters( 'soliloquy_wc_cache_' . $id , $cache ) ){
        
            return maybe_unserialize( $fc_data = $this->_get_data( $query, $id, $data ) );
		
		}
        // If using a random selection for posts, don't cache the query.
        if ( isset( $query['orderby'] ) && 'rand' == $query['orderby'] ) {
            return maybe_unserialize( $wc_data = $this->_get_data( $query, $id, $data ) );
        }

        // Attempt to return the transient first, otherwise generate the new query to retrieve the data.
        if ( false === ( $wc_data = get_transient( '_sol_wc_' . $id ) ) ) {
            $wc_data = $this->_get_data( $query, $id, $data );
            if ( $wc_data ) {
                set_transient( '_sol_wc_' . $id, maybe_serialize( $wc_data ), DAY_IN_SECONDS );
            }
        }
        // Return the slider data.
        return maybe_unserialize( $wc_data );

    }

    /**
     * Performs the custom query to grab featured content if the transient doesn't exist.
     *
     * @since 1.0.0
     *
     * @param array $data Array of query args.
     * @param mixed $id   The current slider ID.
     * @param array $data Array of slider data.
     * @return array|bool Array of data on success, false on failure.
     */
    function _get_data( $query, $id, $data ) {

        // Get posts
        $posts = get_posts( $query );
        // If sticky posts are enabled, re-query with sticky post IDs prepending
        // above $posts IDs.  Note that get_posts does not automatically prepend
        // sticky posts to the resultset, so we do this manually now.
        $instance       = Soliloquy_Shortcode::get_instance();

        // If there is an error or no posts are returned, return false.
        if ( ! $posts || empty( $posts ) ) {
            return false;
        }

        // Return the post data.
        return apply_filters( 'soliloquy_wc_product_data', $posts, $query, $id, $data );

    }

    /**
     * Inserts the Featured Content data into the slider.
     *
     * @since 1.0.0
     *
     * @param array $data  Array of slider data.
     * @param array $wc    Array of Featured Content image data objects.
     * @return array $data Amended array of slider data.
     */
    function insert_data( $data, $wc ) {
        // Empty out the current slider data.
        $data['slider'] = array();

        // Loop through and insert the Featured Content data.
        $instance = Soliloquy_Shortcode::get_instance();
        foreach ( $wc as $i => $post ) {
            // Prepare variables.
            $id              = ! empty( $post->ID ) ? $post->ID : $i;
            $prep            = array();
            $prep['status']  = 'active';
            $prep['src']     = $this->get_featured_image( $post, $data );
            $prep['title']   = $prep['alt'] = ! empty( $post->post_title ) ? $post->post_title : '';
            $prep['caption'] = $this->get_caption( $post, $data );
            $prep['link']    = $instance->get_config( 'wc_product_url', $data ) ? get_permalink( $post->ID ) : '';
            $prep['type']    = 'image';

            // Add some CSS classes
            $disable_post_classes = $instance->get_config( 'wc_disable_post_classes', $data );
            if ( ! $instance->get_config( 'wc_disable_post_classes', $data ) ) {
                $prep['classes'] = get_post_class( '', $id );
            } else {
                $prep['classes'] = array();
            }
            
            // Prepend 'soliloquy-' to each CSS class, so we don't start apply theme styling
            if ( is_array( $prep['classes'] ) ) {
                foreach ( $prep['classes'] as $key => $class ) {
                    $prep['classes'][ $key ] = 'soliloquy-' . $class;
                }
            }

            // Allow image to be filtered for each image.
            $prep = apply_filters( 'soliloquy_wc_image', $prep, $wc, $data, $post );

            // Insert the image into the slider.
            $data['slider'][ $id ] = $prep;
        }

        // Return and allow filtering of final data.
        return apply_filters( 'soliloquy_wc_slider_data', $data, $wc );

    }

    /**
     * Retrieves the featured image for the specified post.
     *
     * @since 1.0.0
     *
     * @return string The featured image URL to use for the slide.
     */
    function get_featured_image( $post, $data ) {

        // Attempt to grab the featured image for the post.
        $instance = Soliloquy_Shortcode::get_instance();
        $thumb_id = apply_filters( 'soliloquy_wc_thumbnail_id', get_post_thumbnail_id( $post->ID ), $post, $data );
        $src      = '';

        // If we have been able to get the featured image ID, return the image based on that.
        if ( $thumb_id ) {
            $size  = $instance->get_config( 'slider_size', $data );
            $image = wp_get_attachment_image_src( $thumb_id, ( 'default' !== $size ? $size : 'full' ) );
            if ( ! $image || empty( $image[0] ) ) {
                $fallback = $instance->get_config( 'wc_fallback', $data );
                if ( ! empty( $fallback ) ) {
                    $src = esc_url( $fallback );
                } else {
                    $src = '';
                }
            } else {
                $src = $image[0];
            }
        } else {
            // Attempt to grab the first image from the post if no featured image is set.
            preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', get_post_field( 'post_content', $post->ID ), $matches );

            // If we have found an image, use that image, otherwise attempt the fallback URL.
            if ( ! empty( $matches[1][0] ) ) {
                $src = esc_url( $matches[1][0] );
            } else {
                $fallback = $instance->get_config( 'wc_fallback', $data );
                if ( ! empty( $fallback ) ) {
                    $src = esc_url( $fallback );
                } else {
                    $src = '';
                }
            }
        }

        // Return the image and allow filtering of the URL.
        return apply_filters( 'soliloquy_wc_image_src', $src, $post, $data );

    }

    /**
     * Retrieves the caption for the specified post.
     *
     * @since 1.0.0
     *
     * @return string The caption to use for the slide.
     */
    function get_caption( $post, $data ) {
	    
		$product = wc_get_product( $post->ID );

        // Prepare variables.
        $instance = Soliloquy_Shortcode::get_instance();
        $output   = '';
        $title    = false;
        $above    = false;

        // Since our title is first, check to see if we should build that in first.
        if ( $instance->get_config( 'wc_product_title', $data ) ) {
            if ( ! empty( $post->post_title ) ) {
                $title   = true;
                $output  = apply_filters( 'soliloquy_wc_before_title', $output, $post, $data );
                $output .= '<h2 class="soliloquy-wc-title">';
                    // Possibly link the title.
                    if ( $instance->get_config( 'wc_product_title_link', $data ) ) {
                        $output .= '<a class="soliloquy-wc-title-link" href="' . get_permalink( $post->ID ) . '" title="' . esc_attr( $post->post_title ) . '">' . $post->post_title . '</a>';
                    } else {
                        $output .= $post->post_title;
                    }
                $output .= '</h2>';
                $output  = apply_filters( 'soliloquy_wc_after_title', $output, $post, $data );
            }
        }

        // Now that we have built our title, let's possibly build out our caption.
        $content = $instance->get_config( 'wc_content_type', $data );

        // If the post excerpt, build out the post excerpt caption.
        if ( 'post_excerpt' == $content ) {
            if ( ! empty( $post->post_excerpt ) ) {
                $above   = true;
                $output  = apply_filters( 'soliloquy_wc_before_caption', $output, $post, $data );
                $excerpt = apply_filters( 'soliloquy_wc_product_excerpt', $post->post_excerpt, $post, $data );
                $output .= '<div class="soliloquy-wc-content' . ( $title ? ' soliloquy-wc-title-above' : '' ) . '"><p>' . $excerpt;
                $output  = apply_filters( 'soliloquy_wc_after_caption', $output, $post, $data );
            }
        }

        // If the post content, build out the post content caption.
        if ( 'post_content' == $content ) {
            if ( ! empty( $post->post_content ) ) {
                $above    = true;
                $output   = apply_filters( 'soliloquy_wc_before_caption', $output, $post, $data );

                // Strip shortcodes to prevent recursion
                $pcontent = strip_shortcodes( $post->post_content );

                // Get Post Content as HTML or Plain Text
                if ( $instance->get_config( 'wc_content_html', $data ) ) {
                    // HTML

                    // Strip images
                    $pattern = '/<img[^>]*src="([^"]*)[^>]*>/i';
                    preg_match_all( $pattern, $pcontent, $matches );
                    $images = $matches[1];
                    $pcontent = preg_replace( $pattern, '', $pcontent );
                    
                    $pcontent = Soliloquy_WooCommerce_Truncate_HTML::truncateWords( $pcontent, $instance->get_config( 'wc_content_length', $data ), ( $instance->get_config( 'wc_content_ellipses', $data ) ? '...' : '' ) );
                } else {
                    // Plain Text
                    $pcontent = wp_trim_words( $pcontent, $instance->get_config( 'wc_content_length', $data ), ( $instance->get_config( 'wc_content_ellipses', $data ) ? '...' : '' ) );
                }

                // Filter
                $pcontent = apply_filters( 'soliloquy_wc_product_content', $pcontent, $post, $data );
                
                $output  .= '<div class="soliloquy-wc-content' . ( $title ? ' soliloquy-wc-title-above' : '' ) . '"><p>' . $pcontent;
                $output   = apply_filters( 'soliloquy_wc_after_caption', $output, $post, $data );
            }
        }

        // Possibly display the cart 
        if ( $instance->get_config( 'wc_cart_btn', $data ) ) {
            $output  = apply_filters( 'soliloquy_wc_before_cart_btn', $output, $post, $data );
            $cart_btn  = apply_filters( 'soliloquy_wc_cart_btn',
							 sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
							        esc_url( $product->add_to_cart_url() ),
							        esc_attr( $product->id ),
							        esc_attr( $product->get_sku() ),
							        $product->is_purchasable() ? 'add_to_cart_button' : '',
							        esc_attr( $product->product_type ),
							        esc_html( $product->add_to_cart_text() )
							    ),
							$product );
            $output .= ( 'post_excerpt' == $content && ! empty( $post->post_excerpt ) || 'post_content' == $content && ! empty( $post->post_content ) ) ? $cart_btn . '</p></div>' : $cart_btn;
            $output  = apply_filters( 'soliloquy_wc_after_cart_btn', $output, $post, $data );
        }

        // If the output is not empty, wrap it in our caption wrapper.
        if ( ! empty( $output ) ) {
            $output = '<div class="soliloquy-wc-caption">' . $output . '</div>';
        }

        // Return and apply a filter to the caption.
        return apply_filters( 'soliloquy_wc_caption', $output, $post, $data );

    }

    /**
     * Returns the singleton instance of the class.
     *
     * @since 1.0.0
     *
     * @return object The Soliloquy_WooCommerce_Shortcode object.
     */
    public static function get_instance() {

        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Soliloquy_WooCommerce_Shortcode ) ) {
            self::$instance = new Soliloquy_WooCommerce_Shortcode();
        }

        return self::$instance;

    }

}

// Load the metabox class.
$soliloquy_wooCommerce_shortcode = Soliloquy_WooCommerce_Shortcode::get_instance();