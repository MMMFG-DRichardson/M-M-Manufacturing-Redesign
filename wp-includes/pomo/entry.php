<?php
/**
 * Contains Translation_Entry class
 *
<<<<<<< HEAD
 * @version $Id: entry.php 1157 2015-11-20 04:30:11Z dd32 $
=======
 * @version $Id: entry.php 718 2012-10-31 00:32:02Z nbachiyski $
>>>>>>> origin/master
 * @package pomo
 * @subpackage entry
 */

<<<<<<< HEAD
if ( ! class_exists( 'Translation_Entry', false ) ):
=======
if ( !class_exists( 'Translation_Entry' ) ):
>>>>>>> origin/master
/**
 * Translation_Entry class encapsulates a translatable string
 */
class Translation_Entry {

	/**
	 * Whether the entry contains a string and its plural form, default is false
	 *
	 * @var boolean
	 */
	var $is_plural = false;

	var $context = null;
	var $singular = null;
	var $plural = null;
	var $translations = array();
	var $translator_comments = '';
	var $extracted_comments = '';
	var $references = array();
	var $flags = array();

	/**
	 * @param array $args associative array, support following keys:
	 * 	- singular (string) -- the string to translate, if omitted and empty entry will be created
	 * 	- plural (string) -- the plural form of the string, setting this will set {@link $is_plural} to true
	 * 	- translations (array) -- translations of the string and possibly -- its plural forms
	 * 	- context (string) -- a string differentiating two equal strings used in different contexts
	 * 	- translator_comments (string) -- comments left by translators
	 * 	- extracted_comments (string) -- comments left by developers
	 * 	- references (array) -- places in the code this strings is used, in relative_to_root_path/file.php:linenum form
	 * 	- flags (array) -- flags like php-format
	 */
<<<<<<< HEAD
	function __construct( $args = array() ) {
=======
	function Translation_Entry($args=array()) {
>>>>>>> origin/master
		// if no singular -- empty object
		if (!isset($args['singular'])) {
			return;
		}
		// get member variable values from args hash
		foreach ($args as $varname => $value) {
			$this->$varname = $value;
		}
<<<<<<< HEAD
		if (isset($args['plural']) && $args['plural']) $this->is_plural = true;
=======
		if (isset($args['plural'])) $this->is_plural = true;
>>>>>>> origin/master
		if (!is_array($this->translations)) $this->translations = array();
		if (!is_array($this->references)) $this->references = array();
		if (!is_array($this->flags)) $this->flags = array();
	}

	/**
<<<<<<< HEAD
	 * PHP4 constructor.
	 */
	public function Translation_Entry( $args = array() ) {
		self::__construct( $args );
	}

	/**
=======
>>>>>>> origin/master
	 * Generates a unique key for this entry
	 *
	 * @return string|bool the key or false if the entry is empty
	 */
	function key() {
<<<<<<< HEAD
		if ( null === $this->singular || '' === $this->singular ) return false;

		// Prepend context and EOT, like in MO files
		$key = !$this->context? $this->singular : $this->context.chr(4).$this->singular;
		// Standardize on \n line endings
		$key = str_replace( array( "\r\n", "\r" ), "\n", $key );

		return $key;
	}

	/**
	 * @param object $other
	 */
=======
		if (is_null($this->singular)) return false;
		// prepend context and EOT, like in MO files
		return is_null($this->context)? $this->singular : $this->context.chr(4).$this->singular;
	}

>>>>>>> origin/master
	function merge_with(&$other) {
		$this->flags = array_unique( array_merge( $this->flags, $other->flags ) );
		$this->references = array_unique( array_merge( $this->references, $other->references ) );
		if ( $this->extracted_comments != $other->extracted_comments ) {
			$this->extracted_comments .= $other->extracted_comments;
		}

	}
}
endif;