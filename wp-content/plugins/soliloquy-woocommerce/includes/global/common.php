<?php
/**
 * Metabox class.
 *
 * @since 1.0.0
 *
 * @package Soliloquy_WooCommerce_Common
 * @author  Chris Kelley
 */
class Soliloquy_WooCommerce_Common {

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
        add_action( 'wp_loaded', array( $this, 'register_publish_hooks' ) );
    	add_action( 'save_post', array( $this, 'flush_global_caches' ), 999 );
    	add_action( 'pre_post_update', array( $this, 'flush_global_caches' ), 999 );
    	add_action( 'soliloquy_flush_caches', array( $this, 'flush_caches' ), 10, 2 );

    }

    /**
     * Registers publish and publish future actions for each public Post Type,
     * so FC caches can be flushed
     *
     * @since 1.0.0
     */
    public function register_publish_hooks() {

        // Get public Post Types
        $post_types = get_post_types( array(
            'public' => true,
        ), 'objects' );

        // Register publish hooks for each Post Type
        foreach ( $post_types as $post_type => $data ) {
            add_action( 'publish_' . $post_type, array( $this, 'flush_global_caches' ) );
            add_action( 'publish_future_' . $post_type, array( $this, 'flush_global_caches' ) ); 
        }

    }

    /**
     * Callback for taxonomies to exclude from the dropdown select box.
     *
     * @since 1.0.0
     *
     * @return array Array of taxonomies to exclude.
     */
    function get_taxonomies() {

        $taxonomies = apply_filters( 'soliloquy_wc_excluded_taxonomies', array( 'nav_menu' ) );
        return (array) $taxonomies;

    }

    /**
     * Callback for taxonomy relation options.
     *
     * @since 1.0.0
     *
     * @return array Array of taxonomies to exclude.
     */
    function get_taxonomy_relations() {

        $relations = array(
            'AND' => esc_attr__( 'Posts must have ALL of the above taxonomy terms (AND)', 'soliloquy-woocommerce' ),
            'IN' => esc_attr__(  'Posts must have ANY of the above taxonomy terms (IN)', 'soliloquy-woocommerce' ),   
        );

        // Allow relations to be filtered
        $relations = apply_filters( 'soliloquy_wc_taxonomy_relations', $relations );

        return (array) $relations;

    }

    /**
     * Returns the available sticky post options for the query
     *
     * @since 1.0.0
     *
     * @return array Sticky Post Options
     */
    function get_sticky() {

        $sticky = array(
            array(
                'name'  => esc_attr__(  'Exclude Sticky Posts', 'soliloquy-woocommerce' ),
                'value' => 0,
            ),
            array(
                'name'  => esc_attr__(  'Include Sticky Posts', 'soliloquy-woocommerce' ),
                'value' => 1,
            ), 
            array(
                'name'  => esc_attr__(  'Only Include Sticky Posts (ignores all other settings)', 'soliloquy-woocommerce' ),
                'value' => 2,
            ), 
        );

        return apply_filters( 'soliloquy_wc_sticky', $sticky );

    }

    /**
     * Returns the available orderby options for the query.
     *
     * @since 1.0.0
     *
     * @return array Array of orderby data.
     */
    function get_orderby() {

        $orderby = array(
            array(
                'name'  => esc_attr__(  'Date', 'soliloquy-woocommerce' ),
                'value' => 'date'
            ),
            array(
                'name'  => esc_attr__(  'ID', 'soliloquy-woocommerce' ),
                'value' => 'ID'
            ),
            array(
                'name'  => esc_attr__(  'Author', 'soliloquy-woocommerce' ),
                'value' => 'author'
            ),
            array(
                'name'  => esc_attr__(  'Title', 'soliloquy-woocommerce' ),
                'value' => 'title'
            ),
            array(
                'name'  => esc_attr__(  'Menu Order', 'soliloquy-woocommerce' ),
                'value' => 'menu_order'
            ),
            array(
                'name'  => esc_attr__(  'Random', 'soliloquy-woocommerce' ),
                'value' => 'rand'
            ),
            array(
                'name'  => esc_attr__(  'Comment Count', 'soliloquy-woocommerce' ),
                'value' => 'comment_count'
            ),
            array(
                'name'  => esc_attr__(  'Post Name', 'soliloquy-woocommerce' ),
                'value' => 'name'
            ),
            array(
                'name'  => esc_attr__(  'Modified Date', 'soliloquy-woocommerce' ),
                'value' => 'modified'
            ),
            array(
                'name'  => esc_attr__(  'Meta Value', 'soliloquy-woocommerce' ),
                'value' => 'meta_value',
            ),
            array(
                'name'  => esc_attr__(  'Meta Value (Numeric)', 'soliloquy-woocommerce' ),
                'value' => 'meta_value_num',
            ),  
        );

        return apply_filters( 'soliloquy_wc_orderby', $orderby );

    }

    /**
     * Returns the available order options for the query.
     *
     * @since 1.0.0
     *
     * @return array Array of order data.
     */
    function get_order() {

        $order = array(
            array(
                'name'  => esc_attr__(  'Descending Order', 'soliloquy-woocommerce' ),
                'value' => 'DESC'
            ),
            array(
                'name'  => esc_attr__(  'Ascending Order', 'soliloquy-woocommerce' ),
                'value' => 'ASC'
            )
        );

        return apply_filters( 'soliloquy_wc_order', $order );

    }

    /**
     * Returns the available post status options for the query.
     *
     * @since 1.0.0
     *
     * @return array Array of post status data.
     */
    function get_statuses() {

        $statuses = get_post_stati( array( 'internal' => false ), 'objects' );
        return apply_filters( 'soliloquy_wc_statuses', $statuses );

    }

    /**
     * Returns the available content type options for the query output.
     *
     * @since 1.0.0
     *
     * @return array Array of content type data.
     */
    function get_content_types() {

        $types = array(
            array(
                'name'  => esc_attr__(  'No Content', 'soliloquy-woocommerce' ),
                'value' => 'none'
            ),
            array(
                'name'  => esc_attr__(  'Post Content', 'soliloquy-woocommerce' ),
                'value' => 'post_content'
            ),
            array(
                'name'  => esc_attr__(  'Post Excerpt', 'soliloquy-woocommerce' ),
                'value' => 'post_excerpt'
            )
        );

        return apply_filters( 'soliloquy_wc_content_types', $types );

    }

    /**
	 * Flushes the Featured Content data caches globally on save/update of any post.
	 *
	 * @since 1.0.0
	 *
	 * @param int $post_id The current post ID.
	 */
	function flush_global_caches( $post_id ) {

        // Get all Featured Content Sliders
        $sliders = Soliloquy::get_instance()->get_sliders( false, true ); // false = don't skip empty (i.e. FC) sliders
                                                                          // true = ignore cache/transient
        if ( is_array( $sliders ) ) {
            foreach ( $sliders as $slider ) {
	            
                // Skip non-FC sliders
                if ( isset( $slider['config']['type'] ) && $slider['config']['type'] !== 'wc' ) {
                    continue;
                }

                // Check slider ID exists
                // Does not exist on slider creation
                if ( !isset( $slider['id'] ) ) {
                    continue;
                }
                
                // Delete the ID cache.
                delete_transient( '_sol_cache_' . $slider['id'] );
                delete_transient( '_sol_wc_' . $slider['id'] );

                // Delete the slug cache.
                $slug = get_post_meta( $slider['id'], '_sol_slider_data', true );
                if ( ! empty( $slug['config']['slug'] ) ) {
                    delete_transient( '_sol_cache_' . $slug['config']['slug'] );
                    delete_transient( '_sol_wc_' . $slug['config']['slug'] );
                }
            }
        }

	}

	/**
	 * Flushes the Featured Content data caches on save.
	 *
	 * @since 1.0.0
	 *
	 * @param int $post_id The current post ID.
	 * @param string $slug The current slider slug.
	 */
	function flush_caches( $post_id, $slug ) {

	    delete_transient( '_sol_wc_' . $post_id );
	    delete_transient( '_sol_wc_' . $slug );

	}

    /**
     * Returns the singleton instance of the class.
     *
     * @since 1.0.0
     *
     * @return object The Soliloquy_WooCommerce_Common object.
     */
    public static function get_instance() {

        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Soliloquy_WooCommerce_Common ) ) {
            self::$instance = new Soliloquy_WooCommerce_Common();
        }

        return self::$instance;

    }

}

// Load the metabox class.
$Soliloquy_WooCommerce_common = Soliloquy_WooCommerce_Common::get_instance();