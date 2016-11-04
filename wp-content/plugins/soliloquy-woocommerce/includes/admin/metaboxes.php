<?php
/**
 * Metabox class.
 *
 * @since 1.0.0
 *
 * @package Soliloquy_WooCommerce_Metaboxes
 * @author  Chris Kelley
 */
class Soliloquy_WooCommerce_Metaboxes {

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
    	add_action( 'soliloquy_metabox_styles', array( $this, 'styles' ) );
    	add_action( 'soliloquy_metabox_scripts', array( $this, 'scripts' ) );
    	add_filter( 'soliloquy_defaults', array( $this, 'defaults' ), 10, 2 );
    	add_filter( 'soliloquy_slider_types', array( $this, 'types' ) );
    	add_action( 'soliloquy_display_wc', array( $this, 'settings_screen' ) );
    	add_filter( 'soliloquy_save_settings', array( $this, 'save' ), 10, 2 );

    }

    /**
	 * Registers and enqueues featured content styles.
	 *
	 * @since 1.0.0
	 */
	public function styles() {

	    // Register featured content styles.
	    wp_register_style( $this->base->plugin_slug . '-style', plugins_url( 'assets/css/admin.css', $this->base->file ), array( $this->base->plugin_slug . '-chosen' ), $this->base->version );

	    // Enqueue featured content styles.
	    wp_enqueue_style( $this->base->plugin_slug . '-style' );

	}

	/**
	 * Registers and enqueues featured content scripts.
	 *
	 * @since 1.0.0
	 */
	public function scripts() {

	    // Register featured content scripts.
	    wp_register_script( $this->base->plugin_slug . '-script', plugins_url( 'assets/js/wc.js', $this->base->file ), array( 'jquery', $this->base->plugin_slug . '-chosen' ), $this->base->plugin_slug, true );

	    // Enqueue featured content scripts.
	    wp_enqueue_script( $this->base->plugin_slug . '-script' );

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
		
	    $defaults['wc_product_type']            = array( 'product', 'product_variation' );
	    $defaults['wc_terms']            		= array();
	    $defaults['wc_terms_relation']   		= 'IN';
	    $defaults['wc_query']            		= 'include';
	    $defaults['wc_inc_ex']          		= array();
	    $defaults['wc_featured_products']       = 0;
	    $defaults['wc_product_on_sale']       	= 0;
	    $defaults['wc_product_in_stock']       	= 0;
	    $defaults['wc_price_range']       		= 0;
	    $defaults['wc_min_range']       		= '';
	    $defaults['wc_max_range']       		= '';
	    $defaults['wc_orderby']         		= 'date';
	    $defaults['wc_order']           		= 'DESC';
	    $defaults['wc_number']         			= 5;
	    $defaults['wc_offset']           		= 0;
	    $defaults['wc_status']           		= 'publish';
		$defaults['wc_product_url']         	= 1;
	    $defaults['wc_product_title']       	= 1;
	    $defaults['wc_product_title_link']  	= 1;
	    $defaults['wc_content_type']     		= 'post_excerpt';
	    $defaults['wc_content_length']   		= 40;
	    $defaults['wc_content_ellipses'] 		= 1;
	    $defaults['wc_content_html'] 	 		= 1;
	    $defaults['wc_cart_btn']        		= 1;
	    $defaults['wc_fallback']         		= '';
	    $defaults['wc_disable_post_classes'] 	= 0;
	    $defaults['wc_no_cache'] = 0;
	    $defaults['wc_ignore_current'] = 0;
	    
	    return $defaults;

	}

	/**
	 * Adds the "Featured Content" slider type to the list of available options.
	 *
	 * @since 1.0.0
	 *
	 * @param array $types  Types of sliders to select.
	 * @return array $types Amended types of sliders to select.
	 */
	function types( $types ) {

	    $types['wc'] = esc_attr__( 'WooCommerce', 'soliloquy-woocommerce' );
	    return $types;

	}

	/**
	 * Callback for displaying the UI for setting wc options.
	 *
	 * @since 1.0.0
	 *
	 * @param object $post The current post object.
	 */
	function settings_screen( $post ) {

	    // Load the settings for the addon.
	    $instance = Soliloquy_Metaboxes::get_instance();
	    $common = Soliloquy_WooCommerce_Common::get_instance();
	    
		?>
	    <div id="soliloquy-woocommerce">
			<?php if ( !class_exists( 'WooCommerce' )): ?>
			    <div class="soliloquy-external-req">
			        <h2><?php esc_html_e('Missing WooCommerce Plugin', 'soliloquy-woocommerce'); ?></h2>
			        <p><?php esc_html_e( 'In order to create product slides, you must first enable and setup WooCommerce.', 'soliloquy-woocommerce' ); ?></p>
					<p><a href="<?php echo admin_url('plugin-install.php?tab=search&s=woocommerce'); ?>" class="button button-soliloquy"><?php esc_html_e( 'Click here to download WooCommerce', 'soliloquy-woocommerce' ); ?></a></p>
			    </div>
			<?php else: ?>
		    <div class="soliloquy-config-header">
	        	<h2 class="soliloquy-intro"><?php esc_html_e( 'The settings below adjust the WooCommerce settings for the slider.', 'soliloquy-woocommerce' ); ?></h2>
				<p class="soliloquy-help"><?php esc_html_e( 'Need some help?', 'soliloquy-thumbnails' ); ?><a href=" http://soliloquywp.com/docs/woocommerce-addon/" target="_blank"><?php esc_html_e( ' Watch a video on how to setup your slider configuration', 'soliloquy-woocommerce' ); ?></a></p>
			</div>	
						
	       
	        <h3><?php esc_html_e( 'Query Settings', 'soliloquy-woocommerce' ); ?></h3>
	        <table class="form-table">
	            <tbody>
	                
	                <tr id="soliloquy-config-wc-terms-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-wc-terms"><?php esc_html_e( 'Select Your Taxonomy Term(s)', 'soliloquy-woocommerce' ); ?></label>
	                    </th>
	                    <td>
		                    <div class="soliloquy-select">
	                        <select id="soliloquy-config-wc-terms" class="soliloquy-chosen" name="_soliloquy[wc_terms][]" multiple="multiple" data-placeholder="<?php esc_attr_e( 'Select taxonomy terms(s) to query (defaults to none)...', 'soliloquy-woocommerce' ); ?>" data-soliloquy-chosen-options='{ "width": "100%" }'>
	                        <?php
	                            $taxonomies = get_object_taxonomies( 'product', 'objects' );
	                          
	                            foreach ( (array) $taxonomies as $taxonomy ) {
	                                if ( in_array( $taxonomy, $common->get_taxonomies() ) ) {
	                                    continue;
	                                }

	                                $terms = get_terms( $taxonomy->name );
	                                
	                                echo '<optgroup label="' . esc_attr( $taxonomy->labels->name ) . '">';
	                                    foreach ( $terms as $term ) {
	                                        echo '<option value="' . esc_attr( strtolower( $taxonomy->name ) . '|' . $term->term_id . '|' . $term->slug ) . '"' . selected( strtolower( $taxonomy->name ) . '|' . $term->term_id . '|' . $term->slug, in_array( strtolower( $taxonomy->name ) . '|' . $term->term_id . '|' . $term->slug, (array) $instance->get_config( 'wc_terms', $instance->get_config_default( 'wc_terms' ) ) ) ? strtolower( $taxonomy->name ) . '|' . $term->term_id . '|' . $term->slug : '', false ) . '>' . esc_html( ucwords( $term->name ) ) . '</option>';
	                                    }
	                                echo '</optgroup>';
	                            }
	                        ?>
	                        </select>
		                    </div>
	                        <p class="description"><?php esc_html_e( 'Determines the taxonomy terms that should be queried based on available WooCommerce products.', 'soliloquy-woocommerce' ); ?></p>
	                    </td>
	                </tr>
	                
					<tr id="soliloquy-config-wc-terms-relation-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-wc-terms-relation"><?php esc_html_e( 'Taxonomy Term(s) Relation', 'soliloquy-woocommerce' ); ?></label>
	                    </th>
	                    <td>
		                    <div class="soliloquy-select">
	                        <select id="soliloquy-config-wc-terms-relation" name="_soliloquy[wc_terms_relation]" class="soliloquy-chosen" data-soliloquy-chosen-options='{ "width": "100%" }'>
	                        	<?php
	                        	$relations = $common->get_taxonomy_relations();
	                            foreach ( (array) $relations as $relation => $label ) {
	                            	$selected = selected( $instance->get_config( 'wc_terms_relation', $instance->get_config_default( 'wc_terms_relation' ) ), $relation, false );
	                            	echo '<option value="' . $relation . '"' . $selected . '>' . $label . '</option>';
								}
	                        	?>
	                        </select>
		                    </div>
	                        <p class="description"><?php esc_html_e( 'Determines whether all or any taxonomy terms must be present in the above WooCommerce products.', 'soliloquy-woocommerce' ); ?></p>
	                    </td>
	                </tr>

	                <tr id="soliloquy-config-wc-inc-ex-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-wc-inc-ex-box"><?php esc_html_e( 'Include or Exclude?', 'soliloquy-woocommerce' ); ?></label>

	                    </th>
	                    <td>
		                  	<label for="soliloquy-config-wc-inc-ex">

	                        <div class="soliloquy-select">
	                            <select id="soliloquy-config-wc-query" class="soliloquy-chosen" name="_soliloquy[wc_query]" data-soliloquy-chosen-options='{ "disable_search":"true", "width": "100%" }'>
	                                <option value="include" <?php selected( 'include', $instance->get_config( 'wc_query', $instance->get_config_default( 'wc_query' ) ) ); ?>><?php esc_html_e( 'Include', 'soliloquy-woocommerce' ); ?></option>
	                                <option value="exclude" <?php selected( 'exclude', $instance->get_config( 'wc_query', $instance->get_config_default( 'wc_query' ) ) ); ?>><?php esc_html_e( 'Exclude', 'soliloquy-woocommerce' ); ?></option>
	                            </select>
	                        </div>
	                            <?php esc_html_e( ' ONLY the products below.', 'soliloquy-woocommerce' ); ?>
	                        </label>
	                    </td>
	                </tr>
	                	               
	                <tr id="soliloquy-config-wc-inc-ex-items-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-wc-inc-ex-items-box"><?php esc_html_e( 'Select Products?', 'soliloquy-woocommerce' ); ?></label>

	                    </th>
	                    <td>
		                    <div class="soliloquy-select">
	                        <select id="soliloquy-config-wc-inc-ex-items" class="soliloquy-chosen" name="_soliloquy[wc_inc_ex][]" multiple="multiple" data-placeholder="<?php esc_attr_e( 'Make your selection (defaults to none)...', 'soliloquy-woocommerce' ); ?>" data-soliloquy-chosen-options='{ "width": "100%" }'>
	                        <?php
	                            $post_types = array( 'product' );
	                            foreach ( (array) $post_types as $post_type ) {

	                                $object = get_post_type_object( $post_type );
	                                $posts  = get_posts( array( 'post_type' => $post_type, 'posts_per_page' => apply_filters( 'soliloquy_wc_max_queried_posts', 500 ), 'no_found_rows' => true, 'cache_results' => false ) );
	                                echo '<optgroup label="' . esc_attr( $object->labels->name ) . '">';
	                                    foreach ( (array) $posts as $item ) {
	                                        echo '<option value="' . absint( $item->ID ) . '"' . selected( $item->ID, in_array( $item->ID, (array) $instance->get_config( 'wc_inc_ex', $instance->get_config_default( 'wc_inc_ex' ) ) ) ? $item->ID : '', false ) . '>' . esc_html( ucwords( $item->post_title ) ) . '</option>';
	                                    }
	                                echo '</optgroup>';
	                            }
	                        ?>
	                        </select>
		                    </div>
	                        <p class="description"><?php esc_html_e( 'Will include or exclude ONLY the selected WooCommerce products.', 'soliloquy-woocommerce' ); ?></p>
	                    </td>
	                </tr>
	                
	                <tr id="soliloquy-config-wc-product-on-sale-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-wc-product-on-sale"><?php esc_html_e( 'Display sale products only?', 'soliloquy-woocommerce' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-wc-product-on-sale" type="checkbox" name="_soliloquy[wc_product_on_sale]" value="<?php echo $instance->get_config( 'wc_product_on_sale', $instance->get_config_default( 'wc_product_on_sale' ) ); ?>" <?php checked( $instance->get_config( 'wc_product_on_sale', $instance->get_config_default( 'wc_product_on_sale' ) ), 1 ); ?> />
	                        <span class="description"><?php esc_html_e( 'Displays products on sale only.', 'soliloquy-woocommerce' ); ?></span>
	                    </td>
	                </tr>
	  	            
	  	            <tr id="soliloquy-config-wc-product-featured-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-wc-product-featured-box"><?php esc_html_e( 'Display featured products only?', 'soliloquy-woocommerce' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-wc-product-featured-box" type="checkbox" name="_soliloquy[wc_featured_products]" value="<?php echo $instance->get_config( 'wc_featured_products', $instance->get_config_default( 'wc_featured_products' ) ); ?>" <?php checked( $instance->get_config( 'wc_featured_products', $instance->get_config_default( 'wc_featured_products' ) ), 1 ); ?> />
	                        <span class="description"><?php esc_html_e( 'Displays featured products only.', 'soliloquy-woocommerce' ); ?></span>
	                    </td>
	                </tr>
 	  	            
 	  	            <tr id="soliloquy-config-wc-product-in-stock-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-wc-product-featured-box"><?php esc_html_e( 'Display only products in stock?', 'soliloquy-woocommerce' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-wc-product-featured-box" type="checkbox" name="_soliloquy[wc_product_in_stock]" value="<?php echo $instance->get_config( 'wc_product_in_stock', $instance->get_config_default( 'wc_product_in_stock' ) ); ?>" <?php checked( $instance->get_config( 'wc_product_in_stock', $instance->get_config_default( 'wc_product_in_stock' ) ), 1 ); ?> />
	                        <span class="description"><?php esc_html_e( ' Display products in stock only?', 'soliloquy-woocommerce' ); ?></span>
	                    </td>
	                </tr>

 	  	            <tr id="soliloquy-config-wc-product-price-range-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-wc-price-range"><?php esc_html_e( 'Filter by price range?', 'soliloquy-woocommerce' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-wc-price-range" type="checkbox" name="_soliloquy[wc_price_range]" value="<?php echo $instance->get_config( 'wc_price_range', $instance->get_config_default( 'wc_price_range' ) ); ?>" <?php checked( $instance->get_config( 'wc_price_range', $instance->get_config_default( 'wc_price_range' ) ), 1 ); ?> />
	                        <span class="description"><?php esc_html_e( 'Filters products by price range.', 'soliloquy-woocommerce' ); ?></span>
	                    </td>
	                </tr>

	                <tr id="soliloquy-config-wc-min-price-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-wc-min-price"><?php esc_html_e( 'Min Price?', 'soliloquy-woocommerce' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-wc-min-price" type="number" name="_soliloquy[wc_min_range]" value="<?php echo $instance->get_config( 'wc_min_range', $instance->get_config_default( 'wc_min_range' ) ); ?>" />
	                        <p class="description"><?php esc_html_e( 'Minimum price range.', 'soliloquy-woocommerce' ); ?></p>
	                    </td>
	                </tr>
	                <tr id="soliloquy-config-wc-max-price-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-wc-max-price"><?php esc_html_e( 'Max Price?', 'soliloquy-woocommerce' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-wc-max-price" type="number" name="_soliloquy[wc_max_range]" value="<?php echo $instance->get_config( 'wc_max_range', $instance->get_config_default( 'wc_max_range' ) ); ?>" />
	                        <p class="description"><?php esc_html_e( 'Maximum price range.', 'soliloquy-woocommerce' ); ?></p>
	                    </td>
	                </tr>            	               
	                <tr id="soliloquy-config-wc-orderby-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-wc-orderby"><?php esc_html_e( 'Sort Products By', 'soliloquy-woocommerce' ); ?></label>
	                    </th>
	                    <td>
		                    <div class="soliloquy-select">
	                        <select id="soliloquy-config-wc-orderby" class="soliloquy-chosen" name="_soliloquy[wc_orderby]" data-soliloquy-chosen-options='{ "width": "100%" }'>
	                        	<?php
	                            foreach ( (array) $common->get_orderby() as $array => $data ) {
	                                echo '<option value="' . esc_attr( $data['value'] ) . '"' . selected( $data['value'], $instance->get_config( 'wc_orderby', $instance->get_config_default( 'wc_orderby' ) ), false ) . '>' . esc_html( $data['name'] ) . '</option>';
	                            }
	                        	?>
	                        </select>
		                    </div>
	                        <p class="description"><?php esc_html_e( 'Determines how the products are sorted in the slider.', 'soliloquy-woocommerce' ); ?></p>
	                    </td>
	                </tr>
	               
	                <tr id="soliloquy-config-wc-meta-key-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-wc-meta-key"><?php esc_html_e( 'Meta Key', 'soliloquy-woocommerce' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-wc-meta-key" type="text" name="_soliloquy[wc_meta_key]" value="<?php echo ( $instance->get_config( 'wc_meta_key', $instance->get_config_default( 'wc_meta_key' ) ) ); ?>" />
	                        <p class="description"><?php esc_html_e( 'The meta key to use when ordering products. Used when Sort Products By = Meta Value', 'soliloquy-woocommerce' ); ?></p>
	                    </td>
	                </tr>
	               
	                <tr id="soliloquy-config-wc-order-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-wc-order"><?php esc_html_e( 'Order Products By', 'soliloquy-woocommerce' ); ?></label>
	                    </th>
	                    <td>
		                    <div class="soliloquy-select">
	                        <select id="soliloquy-config-wc-order" class="soliloquy-chosen" name="_soliloquy[wc_order]" data-soliloquy-chosen-options='{ "width": "100%" }'>
	                        <?php
	                            foreach ( (array) $common->get_order() as $array => $data )
	                                echo '<option value="' . esc_attr( $data['value'] ) . '"' . selected( $data['value'], $instance->get_config( 'wc_order', $instance->get_config_default( 'wc_order' ) ), false ) . '>' . esc_html( $data['name'] ) . '</option>';
	                        ?>
	                        </select>
		                    </div>
	                        <p class="description"><?php esc_html_e( 'Determines how the products are ordered in the slider.', 'soliloquy-woocommerce' ); ?></p>
	                    </td>
	                </tr>
	               
	                <tr id="soliloquy-config-wc-number-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-wc-number"><?php esc_html_e( 'Number of Slides', 'soliloquy-woocommerce' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-wc-number" type="number" name="_soliloquy[wc_number]" value="<?php echo $instance->get_config( 'wc_number', $instance->get_config_default( 'wc_number' ) ); ?>" />
	                        <p class="description"><?php esc_html_e( 'The number of slides in your Woocommerce slider.', 'soliloquy-woocommerce' ); ?></p>
	                    </td>
	                </tr>
	               
	                <tr id="soliloquy-config-wc-offset-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-wc-offset"><?php esc_html_e( 'Products Offset', 'soliloquy-woocommerce' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-wc-offset" type="number" name="_soliloquy[wc_offset]" value="<?php echo absint( $instance->get_config( 'wc_offset', $instance->get_config_default( 'wc_offset' ) ) ); ?>" />
	                        <p class="description"><?php esc_html_e( 'The number of products to offset in the query.', 'soliloquy-woocommerce' ); ?></p>
	                    </td>
	                </tr>
	           
	                <tr id="soliloquy-config-wc-status-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-wc-status"><?php esc_html_e( 'Product Status', 'soliloquy-woocommerce' ); ?></label>
	                    </th>
	                    <td>
		                	<div class="soliloquy-select">

	                        <select id="soliloquy-config-wc-status" class="soliloquy-chosen" name="_soliloquy[wc_status]" data-soliloquy-chosen-options='{ "width": "100%" }'>
	                        <?php
	                            foreach ( (array) $common->get_statuses() as $status ) {
	                                echo '<option value="' . esc_attr( $status->name ) . '"' . selected( $status->name, $instance->get_config( 'wc_status', $instance->get_config_default( 'wc_status' ) ), false ) . '>' . esc_html( $status->label ) . '</option>';
	                            }
	                        ?>
	                        </select>
		                	
		                	</div>
		                	
	                        <p class="description"><?php esc_html_e( 'Determines the product status to use for the query.', 'soliloquy-woocommerce' ); ?></p>
	                    </td>
	                </tr>
	                <tr id="soliloquy-config-wc-no-cache-box">
	                
	                    <th scope="row">
	                        <label for="soliloquy-config-wc-no-cache"><?php esc_html_e( 'Disable Caching?', 'soliloquy-featured-content' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-wc-no-cache" type="checkbox" name="_soliloquy[wc_no_cache]" value="1" <?php checked( $instance->get_config( 'wc_no_cache', $instance->get_config_default( 'wc_no_cache' ) ), 1 ); ?> />	                <span class="description"><?php esc_html_e( 'Disables cache for Product Query', 'soliloquy-featured-content' ); ?></span>

	                    </td>
	                </tr>
	                
	                <?php do_action( 'soliloquy_wc_box', $post ); ?>
	            </tbody>
	        </table>

	        <h3><?php esc_html_e( 'Content Settings', 'soliloquy-woocommerce' ); ?></h3>
	        
	        <table class="form-table">
		        
	            <tbody>
		            
	                <tr id="soliloquy-config-wc-product-url-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-wc-product-url"><?php esc_html_e( 'Link Image to Product URL?', 'soliloquy-woocommerce' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-wc-product-url" type="checkbox" name="_soliloquy[wc_product_url]" value="<?php echo $instance->get_config( 'wc_product_url', $instance->get_config_default( 'wc_product_url' ) ); ?>" <?php checked( $instance->get_config( 'wc_product_url', $instance->get_config_default( 'wc_product_url' ) ), 1 ); ?> />
	                        <span class="description"><?php esc_html_e( 'Links to the image to the product URL.', 'soliloquy-woocommerce' ); ?></span>
	                    </td>
	                </tr>
					
					<tr id="soliloquy-config-wc-product-title-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-wc-post-title"><?php esc_html_e( 'Display Product Title?', 'soliloquy' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-wc-product-title" type="checkbox" name="_soliloquy[wc_product_title]" value="<?php echo $instance->get_config( 'wc_product_title', $instance->get_config_default( 'wc_product_title' ) ); ?>" <?php checked( $instance->get_config( 'wc_product_title', $instance->get_config_default( 'wc_product_title' ) ), 1 ); ?> />
	                        <span class="description"><?php esc_html_e( 'Displays the product title over the image.', 'soliloquy-woocommerce' ); ?></span>
	                    </td>
	                </tr>
	          
	                <tr id="soliloquy-config-wc-product-title-link-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-wc-product-title-link"><?php esc_html_e( 'Link Product Title to Product URL?', 'soliloquy-woocommerce' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-wc-product-title-link" type="checkbox" name="_soliloquy[wc_product_title_link]" value="<?php echo $instance->get_config( 'wc_product_title_link', $instance->get_config_default( 'wc_product_title_link' ) ); ?>" <?php checked( $instance->get_config( 'wc_product_title_link', $instance->get_config_default( 'wc_product_title_link' ) ), 1 ); ?> />
	                        <span class="description"><?php esc_html_e( 'Links the product title to the post URL.', 'soliloquy-woocommerce' ); ?></span>
	                    </td>
	                </tr>
	              	
	                <tr id="soliloquy-config-wc-content-type-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-wc-content-type"><?php esc_html_e( 'Product Content to Display', 'soliloquy-woocommerce' ); ?></label>
	                    </th>
	                    <td>
		                    <div class="soliloquy-select">
	                        <select id="soliloquy-config-wc-content-type" class="soliloquy-chosen" name="_soliloquy[wc_content_type]" data-soliloquy-chosen-options='{ "width": "100%" }'>
	                        <?php
	                            foreach ( (array) $common->get_content_types() as $array => $data )
	                                echo '<option value="' . esc_attr( $data['value'] ) . '"' . selected( $data['value'], $instance->get_config( 'wc_content_type', $instance->get_config_default( 'wc_content_type' ) ), false ) . '>' . esc_html( $data['name'] ) . '</option>';
	                        ?>
	                        </select>
		                    </div>
	                        <p class="description"><?php esc_html_e( 'Determines the type of content to retrieve and output in the caption.', 'soliloquy-woocommerce' ); ?></p>
	                    </td>
	                </tr>
	    	        
	                <tr id="soliloquy-config-wc-content-length-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-wc-content-length"><?php esc_html_e( 'Number of Words in Content', 'soliloquy-woocommerce' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-wc-content-length" type="number" name="_soliloquy[wc_content_length]" value="<?php echo $instance->get_config( 'wc_content_length', $instance->get_config_default( 'wc_content_length' ) ); ?>" />
	                        <p class="description"><?php esc_html_e( 'Sets the number of words for trimming the post content.', 'soliloquy-woocommerce' ); ?></p>
	                    </td>
	                </tr>
	                
	                <tr id="soliloquy-config-wc-content-ellipses-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-wc-content-ellipses"><?php esc_html_e( 'Append Ellipses to Post Content?', 'soliloquy' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-wc-content-ellipses" type="checkbox" name="_soliloquy[wc_content_ellipses]" value="<?php echo $instance->get_config( 'wc_content_ellipses', $instance->get_config_default( 'wc_content_ellipses' ) ); ?>" <?php checked( $instance->get_config( 'wc_content_ellipses', $instance->get_config_default( 'wc_content_ellipses' ) ), 1 ); ?> />
	                        <span class="description"><?php esc_html_e( 'Places an ellipses at the end of the post content.', 'soliloquy-woocommerce' ); ?></span>
	                    </td>
	                </tr>
	              
	                <tr id="soliloquy-config-wc-content-html">
	                    <th scope="row">
	                        <label for="soliloquy-config-wc-read-more"><?php esc_html_e( 'Output Content as HTML?', 'soliloquy' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-wc-content-html" type="checkbox" name="_soliloquy[wc_content_html]" value="<?php echo $instance->get_config( 'wc_read_more', $instance->get_config_default( 'wc_content_html' ) ); ?>" <?php checked( $instance->get_config( 'wc_content_html', $instance->get_config_default( 'wc_content_html' ) ), 1 ); ?> />
	                        <span class="description"><?php esc_html_e( 'If enabled, retrieves the Post Content as HTML, to allow for formatting to be included in the caption. Uncheck this option if you just want to get the Post Content as plain text.', 'soliloquy-woocommerce' ); ?></span>
	                    </td>
	                </tr>
	              
	                <tr id="soliloquy-config-wc-add-cart-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-wc-add-cart"><?php esc_html_e( 'Display Add To Cart Button?', 'soliloquy-woocommerce' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-wc-add-cart" type="checkbox" name="_soliloquy[wc_cart_btn]" value="<?php echo $instance->get_config( 'wc_cart_btn', $instance->get_config_default( 'wc_cart_btn' ) ); ?>" <?php checked( $instance->get_config( 'wc_cart_btn', $instance->get_config_default( 'wc_cart_btn' ) ), 1 ); ?> />
	                        <span class="description"><?php esc_html_e( 'Displays an add to cart button after the post content.', 'soliloquy-woocommerce' ); ?></span>
	                    </td>
	                </tr>
	                	                
	                <tr id="soliloquy-config-wc-fallback-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-wc-fallback"><?php esc_html_e( 'Fallback Image URL', 'soliloquy-woocommerce' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-wc-fallback" type="text" name="_soliloquy[wc_fallback]" value="<?php echo $instance->get_config( 'wc_fallback', $instance->get_config_default( 'wc_fallback' ) ); ?>" />
							<a href="#" class="button button-soliloquy-secondary soliloquy-insert-image"><?php esc_html_e( 'Insert Image', 'soliloquy-featured-content' ); ?></a>
	                        <p class="description"><?php esc_html_e( 'This image URL is used if no image URL can be found for a product.', 'soliloquy-woocommerce' ); ?></p>
	                    </td>
	                </tr>
	               
	                <tr id="soliloquy-config-wc-disable-post-classes-box">
	                    <th scope="row">
	                        <label for="soliloquy-config-wc-disable-post-classes"><?php esc_html_e( 'Disable get_post_classes()?', 'soliloquy' ); ?></label>
	                    </th>
	                    <td>
	                        <input id="soliloquy-config-wc-disable-post-classes" type="checkbox" name="_soliloquy[wc_disable_post_classes]" value="1" <?php checked( $instance->get_config( 'wc_disable_post_classes', $instance->get_config_default( 'wc_disable_post_classes' ) ), 1 ); ?> />
	                        <span class="description"><?php esc_html_e( "If checked, disables appending CSS classes generated by get_post_classes() for each product's slide. Use this if your products have a large number of taxonomy terms, taxonomies etc, for better performance", "soliloquy-woocommerce" ); ?></span>
	                    </td>
	                </tr>
	              
	                <?php do_action( 'soliloquy_wc_content_box', $post ); ?>
	                
	            </tbody>
	            
	        </table>
	        <?php endif; ?>
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

	    // If not saving a featured content slider, do nothing.
	    if ( ! isset( $_POST['_soliloquy']['type_wc'] ) ) {
	        return $settings;
	    }

	    // Save the settings.
	    $settings['config']['wc_terms']           		= isset( $_POST['_soliloquy']['wc_terms'] ) ? stripslashes_deep( $_POST['_soliloquy']['wc_terms'] ) : array();
	    $settings['config']['wc_terms_relation']   		= esc_attr( $_POST['_soliloquy']['wc_terms_relation'] );
	    $settings['config']['wc_query']            		= preg_replace( '#[^a-z0-9-_]#', '', $_POST['_soliloquy']['wc_query'] );
	    $settings['config']['wc_inc_ex']           		= isset( $_POST['_soliloquy']['wc_inc_ex'] ) ? stripslashes_deep( $_POST['_soliloquy']['wc_inc_ex'] ) : array();
	    $settings['config']['wc_featured_products']  	= isset( $_POST['_soliloquy']['wc_featured_products'] ) ? 1 : 0;
	    $settings['config']['wc_product_in_stock']		= isset( $_POST['_soliloquy']['wc_product_in_stock'] ) ? 1 : 0;
	    $settings['config']['wc_product_on_sale']  		= isset( $_POST['_soliloquy']['wc_product_on_sale'] ) ? 1 : 0;
	    $settings['config']['wc_price_range']  			= isset( $_POST['_soliloquy']['wc_price_range'] ) ? 1 : 0;
	    $settings['config']['wc_min_range']  			= absint( $_POST['_soliloquy']['wc_min_range'] );
	    $settings['config']['wc_max_range']  			= absint( $_POST['_soliloquy']['wc_max_range'] );
	    $settings['config']['wc_orderby']          		= esc_attr( $_POST['_soliloquy']['wc_orderby'] );
	    $settings['config']['wc_meta_key']         		= esc_attr( $_POST['_soliloquy']['wc_meta_key'] );
	    $settings['config']['wc_order']            		= esc_attr( $_POST['_soliloquy']['wc_order'] );
	    $settings['config']['wc_number']           		= absint( $_POST['_soliloquy']['wc_number'] );
	    $settings['config']['wc_offset']           		= absint( $_POST['_soliloquy']['wc_offset'] );
	    $settings['config']['wc_status']           		= preg_replace( '#[^a-z0-9-_]#', '', $_POST['_soliloquy']['wc_status'] );
		$settings['config']['wc_product_url']         	= isset( $_POST['_soliloquy']['wc_product_url'] ) ? 1 : 0;
	    $settings['config']['wc_product_title']       	= isset( $_POST['_soliloquy']['wc_product_title'] ) ? 1 : 0;
	    $settings['config']['wc_product_title_link']  	= isset( $_POST['_soliloquy']['wc_product_title_link'] ) ? 1 : 0;
	    $settings['config']['wc_content_type']     		= preg_replace( '#[^a-z0-9-_]#', '', $_POST['_soliloquy']['wc_content_type'] );
	    $settings['config']['wc_content_length']   		= absint( $_POST['_soliloquy']['wc_content_length'] );
	    $settings['config']['wc_content_ellipses'] 		= isset( $_POST['_soliloquy']['wc_content_ellipses'] ) ? 1 : 0;
	    $settings['config']['wc_content_html']     		= isset( $_POST['_soliloquy']['wc_content_html'] ) ? 1 : 0;
	    $settings['config']['wc_cart_btn']        		= isset( $_POST['_soliloquy']['wc_cart_btn'] ) ? 1 : 0;
	    $settings['config']['wc_fallback']        		= esc_url( $_POST['_soliloquy']['wc_fallback'] );
	    $settings['config']['wc_disable_post_classes'] 	= isset( $_POST['_soliloquy']['wc_disable_post_classes'] ) ? 1 : 0;
	    $settings['config']['wc_no_cache'] 				= isset( $_POST['_soliloquy']['wc_no_cache'] ) ? 1 : 0;
	   // $settings['config']['wc_ignore_current'] 		= isset( $_POST['_soliloquy']['wc_ignore_current'] ) ? 1 : 0;
	    
	    // Run filter
	    $settings = apply_filters( 'soliloquy_wc_save', $settings, $post_id );

	    return $settings;

	}
	
    /**
     * Returns the singleton instance of the class.
     *
     * @since 1.0.0
     *
     * @return object The Soliloquy_WooCommerce_Metaboxes object.
     */
    public static function get_instance() {

        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Soliloquy_WooCommerce_Metaboxes ) ) {
            self::$instance = new Soliloquy_WooCommerce_Metaboxes();
        }

        return self::$instance;

    }

}

// Load the metabox class.
$Soliloquy_WooCommerce_metaboxes = Soliloquy_WooCommerce_Metaboxes::get_instance();