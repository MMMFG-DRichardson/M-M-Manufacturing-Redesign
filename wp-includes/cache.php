<?php
/**
 * Object Cache API
 *
<<<<<<< HEAD
 * @link https://codex.wordpress.org/Class_Reference/WP_Object_Cache
=======
 * @link https://codex.wordpress.org/Function_Reference/WP_Cache
>>>>>>> origin/master
 *
 * @package WordPress
 * @subpackage Cache
 */

/**
 * Adds data to the cache, if the cache key doesn't already exist.
 *
 * @since 2.0.0
<<<<<<< HEAD
 *
 * @see WP_Object_Cache::add()
 * @global WP_Object_Cache $wp_object_cache Object cache global instance.
 *
 * @param int|string $key    The cache key to use for retrieval later.
 * @param mixed      $data   The data to add to the cache.
 * @param string     $group  Optional. The group to add the cache to. Enables the same key
 *                           to be used across groups. Default empty.
 * @param int        $expire Optional. When the cache data should expire, in seconds.
 *                           Default 0 (no expiration).
 * @return bool False if cache key and group already exist, true on success.
=======
 * @uses $wp_object_cache Object Cache Class
 * @see WP_Object_Cache::add()
 *
 * @param int|string $key The cache key to use for retrieval later
 * @param mixed $data The data to add to the cache store
 * @param string $group The group to add the cache to
 * @param int $expire When the cache data should be expired
 * @return bool False if cache key and group already exist, true on success
>>>>>>> origin/master
 */
function wp_cache_add( $key, $data, $group = '', $expire = 0 ) {
	global $wp_object_cache;

	return $wp_object_cache->add( $key, $data, $group, (int) $expire );
}

/**
 * Closes the cache.
 *
 * This function has ceased to do anything since WordPress 2.5. The
<<<<<<< HEAD
 * functionality was removed along with the rest of the persistent cache.
 *
 * This does not mean that plugins can't implement this function when they need
 * to make sure that the cache is cleaned up after WordPress no longer needs it.
 *
 * @since 2.0.0
 *
 * @return true Always returns true.
=======
 * functionality was removed along with the rest of the persistent cache. This
 * does not mean that plugins can't implement this function when they need to
 * make sure that the cache is cleaned up after WordPress no longer needs it.
 *
 * @since 2.0.0
 *
 * @return bool Always returns True
>>>>>>> origin/master
 */
function wp_cache_close() {
	return true;
}

/**
<<<<<<< HEAD
 * Decrements numeric cache item's value.
 *
 * @since 3.3.0
 *
 * @see WP_Object_Cache::decr()
 * @global WP_Object_Cache $wp_object_cache Object cache global instance.
 *
 * @param int|string $key    The cache key to decrement.
 * @param int        $offset Optional. The amount by which to decrement the item's value. Default 1.
 * @param string     $group  Optional. The group the key is in. Default empty.
=======
 * Decrement numeric cache item's value
 *
 * @since 3.3.0
 * @uses $wp_object_cache Object Cache Class
 * @see WP_Object_Cache::decr()
 *
 * @param int|string $key The cache key to increment
 * @param int $offset The amount by which to decrement the item's value. Default is 1.
 * @param string $group The group the key is in.
>>>>>>> origin/master
 * @return false|int False on failure, the item's new value on success.
 */
function wp_cache_decr( $key, $offset = 1, $group = '' ) {
	global $wp_object_cache;

	return $wp_object_cache->decr( $key, $offset, $group );
}

/**
 * Removes the cache contents matching key and group.
 *
 * @since 2.0.0
<<<<<<< HEAD
 *
 * @see WP_Object_Cache::delete()
 * @global WP_Object_Cache $wp_object_cache Object cache global instance.
 *
 * @param int|string $key   What the contents in the cache are called.
 * @param string     $group Optional. Where the cache contents are grouped. Default empty.
 * @return bool True on successful removal, false on failure.
 */
function wp_cache_delete( $key, $group = '' ) {
=======
 * @uses $wp_object_cache Object Cache Class
 * @see WP_Object_Cache::delete()
 *
 * @param int|string $key What the contents in the cache are called
 * @param string $group Where the cache contents are grouped
 * @return bool True on successful removal, false on failure
 */
function wp_cache_delete($key, $group = '') {
>>>>>>> origin/master
	global $wp_object_cache;

	return $wp_object_cache->delete($key, $group);
}

/**
 * Removes all cache items.
 *
 * @since 2.0.0
<<<<<<< HEAD
 *
 * @see WP_Object_Cache::flush()
 * @global WP_Object_Cache $wp_object_cache Object cache global instance.
=======
 * @uses $wp_object_cache Object Cache Class
 * @see WP_Object_Cache::flush()
>>>>>>> origin/master
 *
 * @return bool False on failure, true on success
 */
function wp_cache_flush() {
	global $wp_object_cache;

	return $wp_object_cache->flush();
}

/**
 * Retrieves the cache contents from the cache by key and group.
 *
 * @since 2.0.0
<<<<<<< HEAD
 *
 * @see WP_Object_Cache::get()
 * @global WP_Object_Cache $wp_object_cache Object cache global instance.
 *
 * @param int|string  $key    The key under which the cache contents are stored.
 * @param string      $group  Optional. Where the cache contents are grouped. Default empty.
 * @param bool        $force  Optional. Whether to force an update of the local cache from the persistent
 *                            cache. Default false.
 * @param bool        $found  Optional. Whether the key was found in the cache. Disambiguates a return of false,
 *                            a storable value. Passed by reference. Default null.
 * @return bool|mixed False on failure to retrieve contents or the cache
 *		              contents on success
=======
 * @uses $wp_object_cache Object Cache Class
 * @see WP_Object_Cache::get()
 *
 * @param int|string $key What the contents in the cache are called
 * @param string $group Where the cache contents are grouped
 * @param bool $force Whether to force an update of the local cache from the persistent cache (default is false)
 * @param bool &$found Whether key was found in the cache. Disambiguates a return of false, a storable value.
 * @return bool|mixed False on failure to retrieve contents or the cache
 *		contents on success
>>>>>>> origin/master
 */
function wp_cache_get( $key, $group = '', $force = false, &$found = null ) {
	global $wp_object_cache;

	return $wp_object_cache->get( $key, $group, $force, $found );
}

/**
 * Increment numeric cache item's value
 *
 * @since 3.3.0
<<<<<<< HEAD
 *
 * @see WP_Object_Cache::incr()
 * @global WP_Object_Cache $wp_object_cache Object cache global instance.
 *
 * @param int|string $key    The key for the cache contents that should be incremented.
 * @param int        $offset Optional. The amount by which to increment the item's value. Default 1.
 * @param string     $group  Optional. The group the key is in. Default empty.
=======
 * @uses $wp_object_cache Object Cache Class
 * @see WP_Object_Cache::incr()
 *
 * @param int|string $key The cache key to increment
 * @param int $offset The amount by which to increment the item's value. Default is 1.
 * @param string $group The group the key is in.
>>>>>>> origin/master
 * @return false|int False on failure, the item's new value on success.
 */
function wp_cache_incr( $key, $offset = 1, $group = '' ) {
	global $wp_object_cache;

	return $wp_object_cache->incr( $key, $offset, $group );
}

/**
 * Sets up Object Cache Global and assigns it.
 *
 * @since 2.0.0
<<<<<<< HEAD
 *
 * @global WP_Object_Cache $wp_object_cache
=======
 * @global WP_Object_Cache $wp_object_cache WordPress Object Cache
>>>>>>> origin/master
 */
function wp_cache_init() {
	$GLOBALS['wp_object_cache'] = new WP_Object_Cache();
}

/**
 * Replaces the contents of the cache with new data.
 *
 * @since 2.0.0
<<<<<<< HEAD
 *
 * @see WP_Object_Cache::replace()
 * @global WP_Object_Cache $wp_object_cache Object cache global instance.
 *
 * @param int|string $key    The key for the cache data that should be replaced.
 * @param mixed      $data   The new data to store in the cache.
 * @param string     $group  Optional. The group for the cache data that should be replaced.
 *                           Default empty.
 * @param int        $expire Optional. When to expire the cache contents, in seconds.
 *                           Default 0 (no expiration).
 * @return bool False if original value does not exist, true if contents were replaced
=======
 * @uses $wp_object_cache Object Cache Class
 * @see WP_Object_Cache::replace()
 *
 * @param int|string $key What to call the contents in the cache
 * @param mixed $data The contents to store in the cache
 * @param string $group Where to group the cache contents
 * @param int $expire When to expire the cache contents
 * @return bool False if not exists, true if contents were replaced
>>>>>>> origin/master
 */
function wp_cache_replace( $key, $data, $group = '', $expire = 0 ) {
	global $wp_object_cache;

	return $wp_object_cache->replace( $key, $data, $group, (int) $expire );
}

/**
 * Saves the data to the cache.
 *
<<<<<<< HEAD
 * Differs from wp_cache_add() and wp_cache_replace() in that it will always write data.
 *
 * @since 2.0.0
 *
 * @see WP_Object_Cache::set()
 * @global WP_Object_Cache $wp_object_cache Object cache global instance.
 *
 * @param int|string $key    The cache key to use for retrieval later.
 * @param mixed      $data   The contents to store in the cache.
 * @param string     $group  Optional. Where to group the cache contents. Enables the same key
 *                           to be used across groups. Default empty.
 * @param int        $expire Optional. When to expire the cache contents, in seconds.
 *                           Default 0 (no expiration).
=======
 * @since 2.0.0
 *
 * @uses $wp_object_cache Object Cache Class
 * @see WP_Object_Cache::set()
 *
 * @param int|string $key What to call the contents in the cache
 * @param mixed $data The contents to store in the cache
 * @param string $group Where to group the cache contents
 * @param int $expire When to expire the cache contents
>>>>>>> origin/master
 * @return bool False on failure, true on success
 */
function wp_cache_set( $key, $data, $group = '', $expire = 0 ) {
	global $wp_object_cache;

	return $wp_object_cache->set( $key, $data, $group, (int) $expire );
}

/**
<<<<<<< HEAD
 * Switches the internal blog ID.
=======
 * Switch the interal blog id.
>>>>>>> origin/master
 *
 * This changes the blog id used to create keys in blog specific groups.
 *
 * @since 3.5.0
 *
<<<<<<< HEAD
 * @see WP_Object_Cache::switch_to_blog()
 * @global WP_Object_Cache $wp_object_cache Object cache global instance.
 *
 * @param int $blog_id Site ID.
=======
 * @param int $blog_id Blog ID
>>>>>>> origin/master
 */
function wp_cache_switch_to_blog( $blog_id ) {
	global $wp_object_cache;

<<<<<<< HEAD
	$wp_object_cache->switch_to_blog( $blog_id );
=======
	return $wp_object_cache->switch_to_blog( $blog_id );
>>>>>>> origin/master
}

/**
 * Adds a group or set of groups to the list of global groups.
 *
 * @since 2.6.0
 *
<<<<<<< HEAD
 * @see WP_Object_Cache::add_global_groups()
 * @global WP_Object_Cache $wp_object_cache Object cache global instance.
 *
 * @param string|array $groups A group or an array of groups to add.
=======
 * @param string|array $groups A group or an array of groups to add
>>>>>>> origin/master
 */
function wp_cache_add_global_groups( $groups ) {
	global $wp_object_cache;

<<<<<<< HEAD
	$wp_object_cache->add_global_groups( $groups );
=======
	return $wp_object_cache->add_global_groups( $groups );
>>>>>>> origin/master
}

/**
 * Adds a group or set of groups to the list of non-persistent groups.
 *
 * @since 2.6.0
 *
<<<<<<< HEAD
 * @param string|array $groups A group or an array of groups to add.
=======
 * @param string|array $groups A group or an array of groups to add
>>>>>>> origin/master
 */
function wp_cache_add_non_persistent_groups( $groups ) {
	// Default cache doesn't persist so nothing to do here.
}

/**
<<<<<<< HEAD
 * Reset internal cache keys and structures.
 *
 * If the cache back end uses global blog or site IDs as part of its cache keys,
 * this function instructs the back end to reset those keys and perform any cleanup
 * since blog or site IDs have changed since cache init.
=======
 * Reset internal cache keys and structures. If the cache backend uses global
 * blog or site IDs as part of its cache keys, this function instructs the
 * backend to reset those keys and perform any cleanup since blog or site IDs
 * have changed since cache init.
>>>>>>> origin/master
 *
 * This function is deprecated. Use wp_cache_switch_to_blog() instead of this
 * function when preparing the cache for a blog switch. For clearing the cache
 * during unit tests, consider using wp_cache_init(). wp_cache_init() is not
 * recommended outside of unit tests as the performance penality for using it is
 * high.
 *
 * @since 2.6.0
<<<<<<< HEAD
 * @deprecated 3.5.0 WP_Object_Cache::reset()
 * @see WP_Object_Cache::reset()
 *
 * @global WP_Object_Cache $wp_object_cache Object cache global instance.
 */
function wp_cache_reset() {
	_deprecated_function( __FUNCTION__, '3.5.0' );

	global $wp_object_cache;

	$wp_object_cache->reset();
}

/**
 * Core class that implements an object cache.
=======
 * @deprecated 3.5.0
 */
function wp_cache_reset() {
	_deprecated_function( __FUNCTION__, '3.5' );

	global $wp_object_cache;

	return $wp_object_cache->reset();
}

/**
 * WordPress Object Cache
>>>>>>> origin/master
 *
 * The WordPress Object Cache is used to save on trips to the database. The
 * Object Cache stores all of the cache data to memory and makes the cache
 * contents available by using a key, which is used to name and later retrieve
 * the cache contents.
 *
 * The Object Cache can be replaced by other caching mechanisms by placing files
 * in the wp-content folder which is looked at in wp-settings. If that file
 * exists, then this file will not be included.
 *
 * @package WordPress
 * @subpackage Cache
 * @since 2.0.0
 */
class WP_Object_Cache {

	/**
<<<<<<< HEAD
	 * Holds the cached objects.
	 *
	 * @since 2.0.0
	 * @access private
	 * @var array
=======
	 * Holds the cached objects
	 *
	 * @var array
	 * @access private
	 * @since 2.0.0
>>>>>>> origin/master
	 */
	private $cache = array();

	/**
	 * The amount of times the cache data was already stored in the cache.
	 *
	 * @since 2.5.0
	 * @access private
	 * @var int
	 */
	private $cache_hits = 0;

	/**
<<<<<<< HEAD
	 * Amount of times the cache did not have the request in cache.
	 *
	 * @since 2.0.0
	 * @access public
	 * @var int
=======
	 * Amount of times the cache did not have the request in cache
	 *
	 * @var int
	 * @access public
	 * @since 2.0.0
>>>>>>> origin/master
	 */
	public $cache_misses = 0;

	/**
<<<<<<< HEAD
	 * List of global cache groups.
	 *
	 * @since 3.0.0
	 * @access protected
	 * @var array
=======
	 * List of global groups
	 *
	 * @var array
	 * @access protected
	 * @since 3.0.0
>>>>>>> origin/master
	 */
	protected $global_groups = array();

	/**
	 * The blog prefix to prepend to keys in non-global groups.
	 *
<<<<<<< HEAD
	 * @since 3.5.0
	 * @access private
	 * @var int
=======
	 * @var int
	 * @access private
	 * @since 3.5.0
>>>>>>> origin/master
	 */
	private $blog_prefix;

	/**
<<<<<<< HEAD
	 * Holds the value of is_multisite().
	 *
	 * @since 3.5.0
	 * @access private
	 * @var bool
=======
	 * Holds the value of `is_multisite()`
	 *
	 * @var bool
	 * @access private
	 * @since 3.5.0
>>>>>>> origin/master
	 */
	private $multisite;

	/**
<<<<<<< HEAD
	 * Makes private properties readable for backward compatibility.
=======
	 * Make private properties readable for backwards compatibility.
>>>>>>> origin/master
	 *
	 * @since 4.0.0
	 * @access public
	 *
	 * @param string $name Property to get.
	 * @return mixed Property.
	 */
	public function __get( $name ) {
		return $this->$name;
	}

	/**
<<<<<<< HEAD
	 * Makes private properties settable for backward compatibility.
=======
	 * Make private properties settable for backwards compatibility.
>>>>>>> origin/master
	 *
	 * @since 4.0.0
	 * @access public
	 *
	 * @param string $name  Property to set.
	 * @param mixed  $value Property value.
	 * @return mixed Newly-set property.
	 */
	public function __set( $name, $value ) {
		return $this->$name = $value;
	}

	/**
<<<<<<< HEAD
	 * Makes private properties checkable for backward compatibility.
=======
	 * Make private properties checkable for backwards compatibility.
>>>>>>> origin/master
	 *
	 * @since 4.0.0
	 * @access public
	 *
	 * @param string $name Property to check if set.
	 * @return bool Whether the property is set.
	 */
	public function __isset( $name ) {
		return isset( $this->$name );
	}

	/**
<<<<<<< HEAD
	 * Makes private properties un-settable for backward compatibility.
=======
	 * Make private properties un-settable for backwards compatibility.
>>>>>>> origin/master
	 *
	 * @since 4.0.0
	 * @access public
	 *
	 * @param string $name Property to unset.
	 */
	public function __unset( $name ) {
		unset( $this->$name );
	}

	/**
	 * Adds data to the cache if it doesn't already exist.
	 *
<<<<<<< HEAD
	 * @since 2.0.0
	 * @access public
	 *
	 * @uses WP_Object_Cache::_exists() Checks to see if the cache already has data.
	 * @uses WP_Object_Cache::set()     Sets the data after the checking the cache
	 *		                            contents existence.
	 *
	 * @param int|string $key    What to call the contents in the cache.
	 * @param mixed      $data   The contents to store in the cache.
	 * @param string     $group  Optional. Where to group the cache contents. Default 'default'.
	 * @param int        $expire Optional. When to expire the cache contents. Default 0 (no expiration).
=======
	 * @uses WP_Object_Cache::_exists Checks to see if the cache already has data.
	 * @uses WP_Object_Cache::set Sets the data after the checking the cache
	 *		contents existence.
	 *
	 * @since 2.0.0
	 *
	 * @param int|string $key What to call the contents in the cache
	 * @param mixed $data The contents to store in the cache
	 * @param string $group Where to group the cache contents
	 * @param int $expire When to expire the cache contents
>>>>>>> origin/master
	 * @return bool False if cache key and group already exist, true on success
	 */
	public function add( $key, $data, $group = 'default', $expire = 0 ) {
		if ( wp_suspend_cache_addition() )
			return false;

		if ( empty( $group ) )
			$group = 'default';

		$id = $key;
		if ( $this->multisite && ! isset( $this->global_groups[ $group ] ) )
			$id = $this->blog_prefix . $key;

		if ( $this->_exists( $id, $group ) )
			return false;

		return $this->set( $key, $data, $group, (int) $expire );
	}

	/**
<<<<<<< HEAD
	 * Sets the list of global cache groups.
	 *
	 * @since 3.0.0
	 * @access public
=======
	 * Sets the list of global groups.
	 *
	 * @since 3.0.0
>>>>>>> origin/master
	 *
	 * @param array $groups List of groups that are global.
	 */
	public function add_global_groups( $groups ) {
		$groups = (array) $groups;

		$groups = array_fill_keys( $groups, true );
		$this->global_groups = array_merge( $this->global_groups, $groups );
	}

	/**
<<<<<<< HEAD
	 * Decrements numeric cache item's value.
	 *
	 * @since 3.3.0
	 * @access public
	 *
	 * @param int|string $key    The cache key to decrement.
	 * @param int        $offset Optional. The amount by which to decrement the item's value. Default 1.
	 * @param string     $group  Optional. The group the key is in. Default 'default'.
=======
	 * Decrement numeric cache item's value
	 *
	 * @since 3.3.0
	 *
	 * @param int|string $key The cache key to increment
	 * @param int $offset The amount by which to decrement the item's value. Default is 1.
	 * @param string $group The group the key is in.
>>>>>>> origin/master
	 * @return false|int False on failure, the item's new value on success.
	 */
	public function decr( $key, $offset = 1, $group = 'default' ) {
		if ( empty( $group ) )
			$group = 'default';

		if ( $this->multisite && ! isset( $this->global_groups[ $group ] ) )
			$key = $this->blog_prefix . $key;

		if ( ! $this->_exists( $key, $group ) )
			return false;

		if ( ! is_numeric( $this->cache[ $group ][ $key ] ) )
			$this->cache[ $group ][ $key ] = 0;

		$offset = (int) $offset;

		$this->cache[ $group ][ $key ] -= $offset;

		if ( $this->cache[ $group ][ $key ] < 0 )
			$this->cache[ $group ][ $key ] = 0;

		return $this->cache[ $group ][ $key ];
	}

	/**
<<<<<<< HEAD
	 * Removes the contents of the cache key in the group.
=======
	 * Remove the contents of the cache key in the group
>>>>>>> origin/master
	 *
	 * If the cache key does not exist in the group, then nothing will happen.
	 *
	 * @since 2.0.0
<<<<<<< HEAD
	 * @access public
	 *
	 * @param int|string $key        What the contents in the cache are called.
	 * @param string     $group      Optional. Where the cache contents are grouped. Default 'default'.
	 * @param bool       $deprecated Optional. Unused. Default false.
	 * @return bool False if the contents weren't deleted and true on success.
=======
	 *
	 * @param int|string $key What the contents in the cache are called
	 * @param string $group Where the cache contents are grouped
	 * @param bool $deprecated Deprecated.
	 *
	 * @return bool False if the contents weren't deleted and true on success
>>>>>>> origin/master
	 */
	public function delete( $key, $group = 'default', $deprecated = false ) {
		if ( empty( $group ) )
			$group = 'default';

		if ( $this->multisite && ! isset( $this->global_groups[ $group ] ) )
			$key = $this->blog_prefix . $key;

		if ( ! $this->_exists( $key, $group ) )
			return false;

		unset( $this->cache[$group][$key] );
		return true;
	}

	/**
<<<<<<< HEAD
	 * Clears the object cache of all data.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return true Always returns true.
	 */
	public function flush() {
		$this->cache = array();
=======
	 * Clears the object cache of all data
	 *
	 * @since 2.0.0
	 *
	 * @return bool Always returns true
	 */
	public function flush() {
		$this->cache = array ();
>>>>>>> origin/master

		return true;
	}

	/**
<<<<<<< HEAD
	 * Retrieves the cache contents, if it exists.
=======
	 * Retrieves the cache contents, if it exists
>>>>>>> origin/master
	 *
	 * The contents will be first attempted to be retrieved by searching by the
	 * key in the cache group. If the cache is hit (success) then the contents
	 * are returned.
	 *
	 * On failure, the number of cache misses will be incremented.
	 *
	 * @since 2.0.0
<<<<<<< HEAD
	 * @access public
	 *
	 * @param int|string $key    What the contents in the cache are called.
	 * @param string     $group  Optional. Where the cache contents are grouped. Default 'default'.
	 * @param string     $force  Optional. Unused. Whether to force a refetch rather than relying on the local
	 *                           cache. Default false.
	 * @param bool       $found  Optional. Whether the key was found in the cache. Disambiguates a return of
	 *                           false, a storable value. Passed by reference. Default null.
	 * @return false|mixed False on failure to retrieve contents or the cache contents on success.
=======
	 *
	 * @param int|string $key What the contents in the cache are called
	 * @param string $group Where the cache contents are grouped
	 * @param string $force Whether to force a refetch rather than relying on the local cache (default is false)
	 * @return bool|mixed False on failure to retrieve contents or the cache
	 *		contents on success
>>>>>>> origin/master
	 */
	public function get( $key, $group = 'default', $force = false, &$found = null ) {
		if ( empty( $group ) )
			$group = 'default';

		if ( $this->multisite && ! isset( $this->global_groups[ $group ] ) )
			$key = $this->blog_prefix . $key;

		if ( $this->_exists( $key, $group ) ) {
			$found = true;
			$this->cache_hits += 1;
			if ( is_object($this->cache[$group][$key]) )
				return clone $this->cache[$group][$key];
			else
				return $this->cache[$group][$key];
		}

		$found = false;
		$this->cache_misses += 1;
		return false;
	}

	/**
<<<<<<< HEAD
	 * Increments numeric cache item's value.
	 *
	 * @since 3.3.0
	 * @access public
	 *
	 * @param int|string $key    The cache key to increment
	 * @param int        $offset Optional. The amount by which to increment the item's value. Default 1.
	 * @param string     $group  Optional. The group the key is in. Default 'default'.
=======
	 * Increment numeric cache item's value
	 *
	 * @since 3.3.0
	 *
	 * @param int|string $key The cache key to increment
	 * @param int $offset The amount by which to increment the item's value. Default is 1.
	 * @param string $group The group the key is in.
>>>>>>> origin/master
	 * @return false|int False on failure, the item's new value on success.
	 */
	public function incr( $key, $offset = 1, $group = 'default' ) {
		if ( empty( $group ) )
			$group = 'default';

		if ( $this->multisite && ! isset( $this->global_groups[ $group ] ) )
			$key = $this->blog_prefix . $key;

		if ( ! $this->_exists( $key, $group ) )
			return false;

		if ( ! is_numeric( $this->cache[ $group ][ $key ] ) )
			$this->cache[ $group ][ $key ] = 0;

		$offset = (int) $offset;

		$this->cache[ $group ][ $key ] += $offset;

		if ( $this->cache[ $group ][ $key ] < 0 )
			$this->cache[ $group ][ $key ] = 0;

		return $this->cache[ $group ][ $key ];
	}

	/**
<<<<<<< HEAD
	 * Replaces the contents in the cache, if contents already exist.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @see WP_Object_Cache::set()
	 *
	 * @param int|string $key    What to call the contents in the cache.
	 * @param mixed      $data   The contents to store in the cache.
	 * @param string     $group  Optional. Where to group the cache contents. Default 'default'.
	 * @param int        $expire Optional. When to expire the cache contents. Default 0 (no expiration).
	 * @return bool False if not exists, true if contents were replaced.
=======
	 * Replace the contents in the cache, if contents already exist
	 *
	 * @since 2.0.0
	 * @see WP_Object_Cache::set()
	 *
	 * @param int|string $key What to call the contents in the cache
	 * @param mixed $data The contents to store in the cache
	 * @param string $group Where to group the cache contents
	 * @param int $expire When to expire the cache contents
	 * @return bool False if not exists, true if contents were replaced
>>>>>>> origin/master
	 */
	public function replace( $key, $data, $group = 'default', $expire = 0 ) {
		if ( empty( $group ) )
			$group = 'default';

		$id = $key;
		if ( $this->multisite && ! isset( $this->global_groups[ $group ] ) )
			$id = $this->blog_prefix . $key;

		if ( ! $this->_exists( $id, $group ) )
			return false;

		return $this->set( $key, $data, $group, (int) $expire );
	}

	/**
<<<<<<< HEAD
	 * Resets cache keys.
	 *
	 * @since 3.0.0
	 * @access public
	 *
	 * @deprecated 3.5.0 Use switch_to_blog()
	 * @see switch_to_blog()
	 */
	public function reset() {
		_deprecated_function( __FUNCTION__, '3.5.0', 'switch_to_blog()' );
=======
	 * Reset keys
	 *
	 * @since 3.0.0
	 * @deprecated 3.5.0
	 */
	public function reset() {
		_deprecated_function( __FUNCTION__, '3.5', 'switch_to_blog()' );
>>>>>>> origin/master

		// Clear out non-global caches since the blog ID has changed.
		foreach ( array_keys( $this->cache ) as $group ) {
			if ( ! isset( $this->global_groups[ $group ] ) )
				unset( $this->cache[ $group ] );
		}
	}

	/**
<<<<<<< HEAD
	 * Sets the data contents into the cache.
=======
	 * Sets the data contents into the cache
>>>>>>> origin/master
	 *
	 * The cache contents is grouped by the $group parameter followed by the
	 * $key. This allows for duplicate ids in unique groups. Therefore, naming of
	 * the group should be used with care and should follow normal function
	 * naming guidelines outside of core WordPress usage.
	 *
	 * The $expire parameter is not used, because the cache will automatically
	 * expire for each time a page is accessed and PHP finishes. The method is
	 * more for cache plugins which use files.
	 *
	 * @since 2.0.0
<<<<<<< HEAD
	 * @access public
	 *
	 * @param int|string $key    What to call the contents in the cache.
	 * @param mixed      $data   The contents to store in the cache.
	 * @param string     $group  Optional. Where to group the cache contents. Default 'default'.
	 * @param int        $expire Not Used.
	 * @return true Always returns true.
=======
	 *
	 * @param int|string $key What to call the contents in the cache
	 * @param mixed $data The contents to store in the cache
	 * @param string $group Where to group the cache contents
	 * @param int $expire Not Used
	 * @return bool Always returns true
>>>>>>> origin/master
	 */
	public function set( $key, $data, $group = 'default', $expire = 0 ) {
		if ( empty( $group ) )
			$group = 'default';

		if ( $this->multisite && ! isset( $this->global_groups[ $group ] ) )
			$key = $this->blog_prefix . $key;

		if ( is_object( $data ) )
			$data = clone $data;

		$this->cache[$group][$key] = $data;
		return true;
	}

	/**
	 * Echoes the stats of the caching.
	 *
	 * Gives the cache hits, and cache misses. Also prints every cached group,
	 * key and the data.
	 *
	 * @since 2.0.0
<<<<<<< HEAD
	 * @access public
=======
>>>>>>> origin/master
	 */
	public function stats() {
		echo "<p>";
		echo "<strong>Cache Hits:</strong> {$this->cache_hits}<br />";
		echo "<strong>Cache Misses:</strong> {$this->cache_misses}<br />";
		echo "</p>";
		echo '<ul>';
		foreach ($this->cache as $group => $cache) {
<<<<<<< HEAD
			echo "<li><strong>Group:</strong> $group - ( " . number_format( strlen( serialize( $cache ) ) / KB_IN_BYTES, 2 ) . 'k )</li>';
=======
			echo "<li><strong>Group:</strong> $group - ( " . number_format( strlen( serialize( $cache ) ) / 1024, 2 ) . 'k )</li>';
>>>>>>> origin/master
		}
		echo '</ul>';
	}

	/**
<<<<<<< HEAD
	 * Switches the internal blog ID.
	 *
	 * This changes the blog ID used to create keys in blog specific groups.
	 *
	 * @since 3.5.0
	 * @access public
	 *
	 * @param int $blog_id Blog ID.
=======
	 * Switch the interal blog id.
	 *
	 * This changes the blog id used to create keys in blog specific groups.
	 *
	 * @since 3.5.0
	 *
	 * @param int $blog_id Blog ID
>>>>>>> origin/master
	 */
	public function switch_to_blog( $blog_id ) {
		$blog_id = (int) $blog_id;
		$this->blog_prefix = $this->multisite ? $blog_id . ':' : '';
	}

	/**
<<<<<<< HEAD
	 * Serves as a utility function to determine whether a key exists in the cache.
	 *
	 * @since 3.4.0
	 * @access protected
	 *
	 * @param int|string $key   Cache key to check for existence.
	 * @param string     $group Cache group for the key existence check.
	 * @return bool Whether the key exists in the cache for the given group.
=======
	 * Utility function to determine whether a key exists in the cache.
	 *
	 * @since 3.4.0
	 *
	 * @access protected
	 * @param string $key
	 * @param string $group
	 * @return bool
>>>>>>> origin/master
	 */
	protected function _exists( $key, $group ) {
		return isset( $this->cache[ $group ] ) && ( isset( $this->cache[ $group ][ $key ] ) || array_key_exists( $key, $this->cache[ $group ] ) );
	}

	/**
<<<<<<< HEAD
	 * Sets up object properties; PHP 5 style constructor.
	 *
	 * @since 2.0.8
	 *
     * @global int $blog_id Global blog ID.
=======
	 * Sets up object properties; PHP 5 style constructor
	 *
	 * @since 2.0.8
>>>>>>> origin/master
	 */
	public function __construct() {
		global $blog_id;

		$this->multisite = is_multisite();
		$this->blog_prefix =  $this->multisite ? $blog_id . ':' : '';


		/**
		 * @todo This should be moved to the PHP4 style constructor, PHP5
		 * already calls __destruct()
		 */
		register_shutdown_function( array( $this, '__destruct' ) );
	}

	/**
<<<<<<< HEAD
	 * Saves the object cache before object is completely destroyed.
	 *
	 * Called upon object destruction, which should be when PHP ends.
	 *
	 * @since 2.0.8
	 *
	 * @return true Always returns true.
=======
	 * Will save the object cache before object is completely destroyed.
	 *
	 * Called upon object destruction, which should be when PHP ends.
	 *
	 * @since  2.0.8
	 *
	 * @return bool True value. Won't be used by PHP
>>>>>>> origin/master
	 */
	public function __destruct() {
		return true;
	}
}
