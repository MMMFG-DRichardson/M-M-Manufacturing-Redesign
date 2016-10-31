<?php

<<<<<<< HEAD
if ( ! class_exists( 'SimplePie', false ) )
	require_once( ABSPATH . WPINC . '/class-simplepie.php' );

/**
 * Core class used to implement a feed cache.
 *
 * @since 2.8.0
 *
 * @see SimplePie_Cache
 */
class WP_Feed_Cache extends SimplePie_Cache {

	/**
	 * Creates a new SimplePie_Cache object.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param string $location  URL location (scheme is used to determine handler).
	 * @param string $filename  Unique identifier for cache object.
	 * @param string $extension 'spi' or 'spc'.
	 * @return WP_Feed_Cache_Transient Feed cache handler object that uses transients.
=======
if ( !class_exists('SimplePie') )
	require_once( ABSPATH . WPINC . '/class-simplepie.php' );

class WP_Feed_Cache extends SimplePie_Cache {
	/**
	 * Create a new SimplePie_Cache object
	 *
	 * @static
	 * @access public
>>>>>>> origin/master
	 */
	public function create($location, $filename, $extension) {
		return new WP_Feed_Cache_Transient($location, $filename, $extension);
	}
}

<<<<<<< HEAD
/**
 * Core class used to implement feed cache transients.
 *
 * @since 2.8.0
 */
class WP_Feed_Cache_Transient {

	/**
	 * Holds the transient name.
	 *
	 * @since 2.8.0
	 * @access public
	 * @var string
	 */
	public $name;

	/**
	 * Holds the transient mod name.
	 *
	 * @since 2.8.0
	 * @access public
	 * @var string
	 */
	public $mod_name;

	/**
	 * Holds the cache duration in seconds.
	 *
	 * Defaults to 43200 seconds (12 hours).
	 *
	 * @since 2.8.0
	 * @access public
	 * @var int
	 */
	public $lifetime = 43200;

	/**
	 * Constructor.
	 *
	 * @since 2.8.0
	 * @since 3.2.0 Updated to use a PHP5 constructor.
	 * @access public
	 *
	 * @param string $location  URL location (scheme is used to determine handler).
	 * @param string $filename  Unique identifier for cache object.
	 * @param string $extension 'spi' or 'spc'.
	 */
=======
class WP_Feed_Cache_Transient {
	public $name;
	public $mod_name;
	public $lifetime = 43200; //Default lifetime in cache of 12 hours

>>>>>>> origin/master
	public function __construct($location, $filename, $extension) {
		$this->name = 'feed_' . $filename;
		$this->mod_name = 'feed_mod_' . $filename;

		$lifetime = $this->lifetime;
		/**
<<<<<<< HEAD
		 * Filters the transient lifetime of the feed cache.
=======
		 * Filter the transient lifetime of the feed cache.
>>>>>>> origin/master
		 *
		 * @since 2.8.0
		 *
		 * @param int    $lifetime Cache duration in seconds. Default is 43200 seconds (12 hours).
		 * @param string $filename Unique identifier for the cache object.
		 */
		$this->lifetime = apply_filters( 'wp_feed_cache_transient_lifetime', $lifetime, $filename);
	}

<<<<<<< HEAD
	/**
	 * Sets the transient.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param SimplePie $data Data to save.
	 * @return true Always true.
	 */
=======
>>>>>>> origin/master
	public function save($data) {
		if ( $data instanceof SimplePie ) {
			$data = $data->data;
		}

		set_transient($this->name, $data, $this->lifetime);
		set_transient($this->mod_name, time(), $this->lifetime);
		return true;
	}

<<<<<<< HEAD
	/**
	 * Gets the transient.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @return mixed Transient value.
	 */
=======
>>>>>>> origin/master
	public function load() {
		return get_transient($this->name);
	}

<<<<<<< HEAD
	/**
	 * Gets mod transient.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @return mixed Transient value.
	 */
=======
>>>>>>> origin/master
	public function mtime() {
		return get_transient($this->mod_name);
	}

<<<<<<< HEAD
	/**
	 * Sets mod transient.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @return bool False if value was not set and true if value was set.
	 */
=======
>>>>>>> origin/master
	public function touch() {
		return set_transient($this->mod_name, time(), $this->lifetime);
	}

<<<<<<< HEAD
	/**
	 * Deletes transients.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @return true Always true.
	 */
=======
>>>>>>> origin/master
	public function unlink() {
		delete_transient($this->name);
		delete_transient($this->mod_name);
		return true;
	}
}

<<<<<<< HEAD
/**
 * Core class for fetching remote files and reading local files with SimplePie.
 *
 * @since 2.8.0
 *
 * @see SimplePie_File
 */
class WP_SimplePie_File extends SimplePie_File {

	/**
	 * Constructor.
	 *
	 * @since 2.8.0
	 * @since 3.2.0 Updated to use a PHP5 constructor.
	 * @access public
	 *
	 * @param string       $url             Remote file URL.
	 * @param integer      $timeout         Optional. How long the connection should stay open in seconds.
	 *                                      Default 10.
	 * @param integer      $redirects       Optional. The number of allowed redirects. Default 5.
	 * @param string|array $headers         Optional. Array or string of headers to send with the request.
	 *                                      Default null.
	 * @param string       $useragent       Optional. User-agent value sent. Default null.
	 * @param boolean      $force_fsockopen Optional. Whether to force opening internet or unix domain socket
	 *                                      connection or not. Default false.
	 */
=======
class WP_SimplePie_File extends SimplePie_File {

>>>>>>> origin/master
	public function __construct($url, $timeout = 10, $redirects = 5, $headers = null, $useragent = null, $force_fsockopen = false) {
		$this->url = $url;
		$this->timeout = $timeout;
		$this->redirects = $redirects;
		$this->headers = $headers;
		$this->useragent = $useragent;

		$this->method = SIMPLEPIE_FILE_SOURCE_REMOTE;

		if ( preg_match('/^http(s)?:\/\//i', $url) ) {
			$args = array(
				'timeout' => $this->timeout,
				'redirection' => $this->redirects,
			);

			if ( !empty($this->headers) )
				$args['headers'] = $this->headers;

			if ( SIMPLEPIE_USERAGENT != $this->useragent ) //Use default WP user agent unless custom has been specified
				$args['user-agent'] = $this->useragent;

			$res = wp_safe_remote_request($url, $args);

			if ( is_wp_error($res) ) {
				$this->error = 'WP HTTP Error: ' . $res->get_error_message();
				$this->success = false;
			} else {
				$this->headers = wp_remote_retrieve_headers( $res );
				$this->body = wp_remote_retrieve_body( $res );
				$this->status_code = wp_remote_retrieve_response_code( $res );
			}
		} else {
			$this->error = '';
			$this->success = false;
		}
	}
}

/**
<<<<<<< HEAD
 * Core class used to implement SimpliePie feed sanitization.
 *
 * Extends the SimplePie_Sanitize class to use KSES, because
 * we cannot universally count on DOMDocument being available.
 *
 * @since 3.5.0
 *
 * @see SimplePie_Sanitize
 */
class WP_SimplePie_Sanitize_KSES extends SimplePie_Sanitize {

	/**
	 * WordPress SimplePie sanitization using KSES.
	 *
	 * Sanitizes the incoming data, to ensure that it matches the type of data expected, using KSES.
	 *
	 * @since 3.5.0
	 * @access public
	 *
	 * @param mixed   $data The data that needs to be sanitized.
	 * @param integer $type The type of data that it's supposed to be.
	 * @param string  $base Optional. The `xml:base` value to use when converting relative
	 *                      URLs to absolute ones. Default empty.
	 * @return mixed Sanitized data.
	 */
=======
 * WordPress SimplePie Sanitization Class
 *
 * Extension of the SimplePie_Sanitize class to use KSES, because
 * we cannot universally count on DOMDocument being available
 *
 * @package WordPress
 * @since 3.5.0
 */
class WP_SimplePie_Sanitize_KSES extends SimplePie_Sanitize {
>>>>>>> origin/master
	public function sanitize( $data, $type, $base = '' ) {
		$data = trim( $data );
		if ( $type & SIMPLEPIE_CONSTRUCT_MAYBE_HTML ) {
			if (preg_match('/(&(#(x[0-9a-fA-F]+|[0-9]+)|[a-zA-Z0-9]+)|<\/[A-Za-z][^\x09\x0A\x0B\x0C\x0D\x20\x2F\x3E]*' . SIMPLEPIE_PCRE_HTML_ATTRIBUTE . '>)/', $data)) {
				$type |= SIMPLEPIE_CONSTRUCT_HTML;
			}
			else {
				$type |= SIMPLEPIE_CONSTRUCT_TEXT;
			}
		}
		if ( $type & SIMPLEPIE_CONSTRUCT_BASE64 ) {
			$data = base64_decode( $data );
		}
		if ( $type & ( SIMPLEPIE_CONSTRUCT_HTML | SIMPLEPIE_CONSTRUCT_XHTML ) ) {
			$data = wp_kses_post( $data );
			if ( $this->output_encoding !== 'UTF-8' ) {
				$data = $this->registry->call( 'Misc', 'change_encoding', array( $data, 'UTF-8', $this->output_encoding ) );
			}
			return $data;
		} else {
			return parent::sanitize( $data, $type, $base );
		}
	}
}
