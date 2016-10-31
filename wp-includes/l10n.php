<?php
/**
<<<<<<< HEAD
 * Core Translation API
 *
 * @package WordPress
 * @subpackage i18n
 * @since 1.2.0
 */

/**
 * Retrieves the current locale.
 *
 * If the locale is set, then it will filter the locale in the {@see 'locale'}
 * filter hook and return the value.
 *
 * If the locale is not set already, then the WPLANG constant is used if it is
 * defined. Then it is filtered through the {@see 'locale'} filter hook and
 * the value for the locale global set and the locale is returned.
 *
 * The process to get the locale should only be done once, but the locale will
 * always be filtered using the {@see 'locale'} hook.
 *
 * @since 1.5.0
 *
 * @global string $locale
 * @global string $wp_local_package
 *
 * @return string The locale of the blog or from the {@see 'locale'} hook.
=======
 * WordPress Translation API
 *
 * @package WordPress
 * @subpackage i18n
 */

/**
 * Get the current locale.
 *
 * If the locale is set, then it will filter the locale in the 'locale' filter
 * hook and return the value.
 *
 * If the locale is not set already, then the WPLANG constant is used if it is
 * defined. Then it is filtered through the 'locale' filter hook and the value
 * for the locale global set and the locale is returned.
 *
 * The process to get the locale should only be done once, but the locale will
 * always be filtered using the 'locale' hook.
 *
 * @since 1.5.0
 *
 * @return string The locale of the blog or from the 'locale' hook.
>>>>>>> origin/master
 */
function get_locale() {
	global $locale, $wp_local_package;

	if ( isset( $locale ) ) {
		/**
<<<<<<< HEAD
		 * Filters WordPress install's locale ID.
=======
		 * Filter WordPress install's locale ID.
>>>>>>> origin/master
		 *
		 * @since 1.5.0
		 *
		 * @param string $locale The locale ID.
		 */
		return apply_filters( 'locale', $locale );
	}

	if ( isset( $wp_local_package ) ) {
		$locale = $wp_local_package;
	}

	// WPLANG was defined in wp-config.
	if ( defined( 'WPLANG' ) ) {
		$locale = WPLANG;
	}

	// If multisite, check options.
	if ( is_multisite() ) {
		// Don't check blog option when installing.
<<<<<<< HEAD
		if ( wp_installing() || ( false === $ms_locale = get_option( 'WPLANG' ) ) ) {
=======
		if ( defined( 'WP_INSTALLING' ) || ( false === $ms_locale = get_option( 'WPLANG' ) ) ) {
>>>>>>> origin/master
			$ms_locale = get_site_option( 'WPLANG' );
		}

		if ( $ms_locale !== false ) {
			$locale = $ms_locale;
		}
	} else {
		$db_locale = get_option( 'WPLANG' );
		if ( $db_locale !== false ) {
			$locale = $db_locale;
		}
	}

	if ( empty( $locale ) ) {
		$locale = 'en_US';
	}

	/** This filter is documented in wp-includes/l10n.php */
	return apply_filters( 'locale', $locale );
}

/**
 * Retrieve the translation of $text.
 *
 * If there is no translation, or the text domain isn't loaded, the original text is returned.
 *
<<<<<<< HEAD
 * *Note:* Don't use translate() directly, use __() or related functions.
=======
 * *Note:* Don't use {@see translate()} directly, use `{@see __()} or related functions.
>>>>>>> origin/master
 *
 * @since 2.2.0
 *
 * @param string $text   Text to translate.
 * @param string $domain Optional. Text domain. Unique identifier for retrieving translated strings.
<<<<<<< HEAD
 *                       Default 'default'.
=======
>>>>>>> origin/master
 * @return string Translated text
 */
function translate( $text, $domain = 'default' ) {
	$translations = get_translations_for_domain( $domain );
	$translations = $translations->translate( $text );

	/**
<<<<<<< HEAD
	 * Filters text with its translation.
=======
	 * Filter text with its translation.
>>>>>>> origin/master
	 *
	 * @since 2.0.11
	 *
	 * @param string $translations Translated text.
	 * @param string $text         Text to translate.
	 * @param string $domain       Text domain. Unique identifier for retrieving translated strings.
	 */
	return apply_filters( 'gettext', $translations, $text, $domain );
}

/**
 * Remove last item on a pipe-delimited string.
 *
 * Meant for removing the last item in a string, such as 'Role name|User role'. The original
 * string will be returned if no pipe '|' characters are found in the string.
 *
 * @since 2.8.0
 *
 * @param string $string A pipe-delimited string.
 * @return string Either $string or everything before the last pipe.
 */
function before_last_bar( $string ) {
	$last_bar = strrpos( $string, '|' );
<<<<<<< HEAD
	if ( false === $last_bar ) {
		return $string;
	} else {
		return substr( $string, 0, $last_bar );
	}
=======
	if ( false == $last_bar )
		return $string;
	else
		return substr( $string, 0, $last_bar );
>>>>>>> origin/master
}

/**
 * Retrieve the translation of $text in the context defined in $context.
 *
 * If there is no translation, or the text domain isn't loaded the original
 * text is returned.
 *
<<<<<<< HEAD
 * *Note:* Don't use translate_with_gettext_context() directly, use _x() or related functions.
 *
=======
>>>>>>> origin/master
 * @since 2.8.0
 *
 * @param string $text    Text to translate.
 * @param string $context Context information for the translators.
 * @param string $domain  Optional. Text domain. Unique identifier for retrieving translated strings.
<<<<<<< HEAD
 *                        Default 'default'.
=======
>>>>>>> origin/master
 * @return string Translated text on success, original text on failure.
 */
function translate_with_gettext_context( $text, $context, $domain = 'default' ) {
	$translations = get_translations_for_domain( $domain );
	$translations = $translations->translate( $text, $context );
	/**
<<<<<<< HEAD
	 * Filters text with its translation based on context information.
=======
	 * Filter text with its translation based on context information.
>>>>>>> origin/master
	 *
	 * @since 2.8.0
	 *
	 * @param string $translations Translated text.
	 * @param string $text         Text to translate.
	 * @param string $context      Context information for the translators.
	 * @param string $domain       Text domain. Unique identifier for retrieving translated strings.
	 */
	return apply_filters( 'gettext_with_context', $translations, $text, $context, $domain );
}

/**
<<<<<<< HEAD
 * Retrieve the translation of $text.
 *
 * If there is no translation, or the text domain isn't loaded, the original text is returned.
=======
 * Retrieve the translation of $text. If there is no translation,
 * or the text domain isn't loaded, the original text is returned.
>>>>>>> origin/master
 *
 * @since 2.1.0
 *
 * @param string $text   Text to translate.
 * @param string $domain Optional. Text domain. Unique identifier for retrieving translated strings.
<<<<<<< HEAD
 *                       Default 'default'.
=======
>>>>>>> origin/master
 * @return string Translated text.
 */
function __( $text, $domain = 'default' ) {
	return translate( $text, $domain );
}

/**
 * Retrieve the translation of $text and escapes it for safe use in an attribute.
 *
 * If there is no translation, or the text domain isn't loaded, the original text is returned.
 *
 * @since 2.8.0
 *
 * @param string $text   Text to translate.
 * @param string $domain Optional. Text domain. Unique identifier for retrieving translated strings.
<<<<<<< HEAD
 *                       Default 'default'.
=======
>>>>>>> origin/master
 * @return string Translated text on success, original text on failure.
 */
function esc_attr__( $text, $domain = 'default' ) {
	return esc_attr( translate( $text, $domain ) );
}

/**
 * Retrieve the translation of $text and escapes it for safe use in HTML output.
 *
 * If there is no translation, or the text domain isn't loaded, the original text is returned.
 *
 * @since 2.8.0
 *
 * @param string $text   Text to translate.
 * @param string $domain Optional. Text domain. Unique identifier for retrieving translated strings.
<<<<<<< HEAD
 *                       Default 'default'.
=======
>>>>>>> origin/master
 * @return string Translated text
 */
function esc_html__( $text, $domain = 'default' ) {
	return esc_html( translate( $text, $domain ) );
}

/**
 * Display translated text.
 *
 * @since 1.2.0
 *
 * @param string $text   Text to translate.
 * @param string $domain Optional. Text domain. Unique identifier for retrieving translated strings.
<<<<<<< HEAD
 *                       Default 'default'.
=======
>>>>>>> origin/master
 */
function _e( $text, $domain = 'default' ) {
	echo translate( $text, $domain );
}

/**
 * Display translated text that has been escaped for safe use in an attribute.
 *
 * @since 2.8.0
 *
 * @param string $text   Text to translate.
 * @param string $domain Optional. Text domain. Unique identifier for retrieving translated strings.
<<<<<<< HEAD
 *                       Default 'default'.
=======
>>>>>>> origin/master
 */
function esc_attr_e( $text, $domain = 'default' ) {
	echo esc_attr( translate( $text, $domain ) );
}

/**
 * Display translated text that has been escaped for safe use in HTML output.
 *
 * @since 2.8.0
 *
 * @param string $text   Text to translate.
 * @param string $domain Optional. Text domain. Unique identifier for retrieving translated strings.
<<<<<<< HEAD
 *                       Default 'default'.
=======
>>>>>>> origin/master
 */
function esc_html_e( $text, $domain = 'default' ) {
	echo esc_html( translate( $text, $domain ) );
}

/**
 * Retrieve translated string with gettext context.
 *
 * Quite a few times, there will be collisions with similar translatable text
 * found in more than two places, but with different translated context.
 *
 * By including the context in the pot file, translators can translate the two
 * strings differently.
 *
 * @since 2.8.0
 *
 * @param string $text    Text to translate.
 * @param string $context Context information for the translators.
 * @param string $domain  Optional. Text domain. Unique identifier for retrieving translated strings.
<<<<<<< HEAD
 *                        Default 'default'.
=======
>>>>>>> origin/master
 * @return string Translated context string without pipe.
 */
function _x( $text, $context, $domain = 'default' ) {
	return translate_with_gettext_context( $text, $context, $domain );
}

/**
 * Display translated string with gettext context.
 *
 * @since 3.0.0
 *
 * @param string $text    Text to translate.
 * @param string $context Context information for the translators.
 * @param string $domain  Optional. Text domain. Unique identifier for retrieving translated strings.
<<<<<<< HEAD
 *                        Default 'default'.
=======
>>>>>>> origin/master
 * @return string Translated context string without pipe.
 */
function _ex( $text, $context, $domain = 'default' ) {
	echo _x( $text, $context, $domain );
}

/**
 * Translate string with gettext context, and escapes it for safe use in an attribute.
 *
 * @since 2.8.0
 *
 * @param string $text    Text to translate.
 * @param string $context Context information for the translators.
 * @param string $domain  Optional. Text domain. Unique identifier for retrieving translated strings.
<<<<<<< HEAD
 *                        Default 'default'.
=======
>>>>>>> origin/master
 * @return string Translated text
 */
function esc_attr_x( $text, $context, $domain = 'default' ) {
	return esc_attr( translate_with_gettext_context( $text, $context, $domain ) );
}

/**
 * Translate string with gettext context, and escapes it for safe use in HTML output.
 *
 * @since 2.9.0
 *
 * @param string $text    Text to translate.
 * @param string $context Context information for the translators.
 * @param string $domain  Optional. Text domain. Unique identifier for retrieving translated strings.
<<<<<<< HEAD
 *                        Default 'default'.
=======
>>>>>>> origin/master
 * @return string Translated text.
 */
function esc_html_x( $text, $context, $domain = 'default' ) {
	return esc_html( translate_with_gettext_context( $text, $context, $domain ) );
}

/**
<<<<<<< HEAD
 * Translates and retrieves the singular or plural form based on the supplied number.
 *
 * Used when you want to use the appropriate form of a string based on whether a
 * number is singular or plural.
 *
 * Example:
 *
 *     $people = sprintf( _n( '%s person', '%s people', $count, 'text-domain' ), number_format_i18n( $count ) );
 *
 * @since 2.8.0
 *
 * @param string $single The text to be used if the number is singular.
 * @param string $plural The text to be used if the number is plural.
 * @param int    $number The number to compare against to use either the singular or plural form.
 * @param string $domain Optional. Text domain. Unique identifier for retrieving translated strings.
 *                       Default 'default'.
 * @return string The translated singular or plural form.
=======
 * Retrieve the plural or single form based on the supplied amount.
 *
 * If the text domain is not set in the $l10n list, then a comparison will be made
 * and either $plural or $single parameters returned.
 *
 * If the text domain does exist, then the parameters $single, $plural, and $number
 * will first be passed to the text domain's ngettext method. Then it will be passed
 * to the 'ngettext' filter hook along with the same parameters. The expected
 * type will be a string.
 *
 * @since 2.8.0
 *
 * @param string $single The text that will be used if $number is 1.
 * @param string $plural The text that will be used if $number is not 1.
 * @param int    $number The number to compare against to use either $single or $plural.
 * @param string $domain Optional. Text domain. Unique identifier for retrieving translated strings.
 * @return string Either $single or $plural translated text.
>>>>>>> origin/master
 */
function _n( $single, $plural, $number, $domain = 'default' ) {
	$translations = get_translations_for_domain( $domain );
	$translation = $translations->translate_plural( $single, $plural, $number );
<<<<<<< HEAD

	/**
	 * Filters the singular or plural form of a string.
=======
	/**
	 * Filter text with its translation when plural option is available.
>>>>>>> origin/master
	 *
	 * @since 2.2.0
	 *
	 * @param string $translation Translated text.
<<<<<<< HEAD
	 * @param string $single      The text to be used if the number is singular.
	 * @param string $plural      The text to be used if the number is plural.
	 * @param string $number      The number to compare against to use either the singular or plural form.
=======
	 * @param string $single      The text that will be used if $number is 1.
	 * @param string $plural      The text that will be used if $number is not 1.
	 * @param string $number      The number to compare against to use either $single or $plural.
>>>>>>> origin/master
	 * @param string $domain      Text domain. Unique identifier for retrieving translated strings.
	 */
	return apply_filters( 'ngettext', $translation, $single, $plural, $number, $domain );
}

/**
<<<<<<< HEAD
 * Translates and retrieves the singular or plural form based on the supplied number, with gettext context.
 *
 * This is a hybrid of _n() and _x(). It supports context and plurals.
 *
 * Used when you want to use the appropriate form of a string with context based on whether a
 * number is singular or plural.
 *
 * Example:
 *
 *     $people = sprintf( _n( '%s person', '%s people', $count, 'context', 'text-domain' ), number_format_i18n( $count ) );
 *
 * @since 2.8.0
 *
 * @param string $single  The text to be used if the number is singular.
 * @param string $plural  The text to be used if the number is plural.
 * @param int    $number  The number to compare against to use either the singular or plural form.
 * @param string $context Context information for the translators.
 * @param string $domain  Optional. Text domain. Unique identifier for retrieving translated strings.
 *                        Default 'default'.
 * @return string The translated singular or plural form.
=======
 * Retrieve the plural or single form based on the supplied amount with gettext context.
 *
 * This is a hybrid of _n() and _x(). It supports contexts and plurals.
 *
 * @since 2.8.0
 *
 * @param string $single  The text that will be used if $number is 1.
 * @param string $plural  The text that will be used if $number is not 1.
 * @param int    $number  The number to compare against to use either $single or $plural.
 * @param string $context Context information for the translators.
 * @param string $domain  Optional. Text domain. Unique identifier for retrieving translated strings.
 * @return string Either $single or $plural translated text with context.
>>>>>>> origin/master
 */
function _nx($single, $plural, $number, $context, $domain = 'default') {
	$translations = get_translations_for_domain( $domain );
	$translation = $translations->translate_plural( $single, $plural, $number, $context );
<<<<<<< HEAD

	/**
	 * Filters the singular or plural form of a string with gettext context.
=======
	/**
	 * Filter text with its translation while plural option and context are available.
>>>>>>> origin/master
	 *
	 * @since 2.8.0
	 *
	 * @param string $translation Translated text.
<<<<<<< HEAD
	 * @param string $single      The text to be used if the number is singular.
	 * @param string $plural      The text to be used if the number is plural.
	 * @param string $number      The number to compare against to use either the singular or plural form.
=======
	 * @param string $single      The text that will be used if $number is 1.
	 * @param string $plural      The text that will be used if $number is not 1.
	 * @param string $number      The number to compare against to use either $single or $plural.
>>>>>>> origin/master
	 * @param string $context     Context information for the translators.
	 * @param string $domain      Text domain. Unique identifier for retrieving translated strings.
	 */
	return apply_filters( 'ngettext_with_context', $translation, $single, $plural, $number, $context, $domain );
}

/**
<<<<<<< HEAD
 * Registers plural strings in POT file, but does not translate them.
 *
 * Used when you want to keep structures with translatable plural
 * strings and use them later when the number is known.
=======
 * Register plural strings in POT file, but don't translate them.
 *
 * Used when you want to keep structures with translatable plural
 * strings and use them later.
>>>>>>> origin/master
 *
 * Example:
 *
 *     $messages = array(
<<<<<<< HEAD
 *      	'post' => _n_noop( '%s post', '%s posts', 'text-domain' ),
 *      	'page' => _n_noop( '%s pages', '%s pages', 'text-domain' ),
 *     );
 *     ...
 *     $message = $messages[ $type ];
 *     $usable_text = sprintf( translate_nooped_plural( $message, $count, 'text-domain' ), number_format_i18n( $count ) );
 *
 * @since 2.5.0
 *
 * @param string $singular Singular form to be localized.
 * @param string $plural   Plural form to be localized.
 * @param string $domain   Optional. Text domain. Unique identifier for retrieving translated strings.
 *                         Default null.
 * @return array {
 *     Array of translation information for the strings.
 *
 *     @type string $0        Singular form to be localized. No longer used.
 *     @type string $1        Plural form to be localized. No longer used.
 *     @type string $singular Singular form to be localized.
 *     @type string $plural   Plural form to be localized.
 *     @type null   $context  Context information for the translators.
 *     @type string $domain   Text domain.
 * }
=======
 *      	'post' => _n_noop( '%s post', '%s posts' ),
 *      	'page' => _n_noop( '%s pages', '%s pages' ),
 *     );
 *     ...
 *     $message = $messages[ $type ];
 *     $usable_text = sprintf( translate_nooped_plural( $message, $count ), $count );
 *
 * @since 2.5.0
 *
 * @param string $singular Single form to be i18ned.
 * @param string $plural   Plural form to be i18ned.
 * @param string $domain   Optional. Text domain. Unique identifier for retrieving translated strings.
 * @return array array($singular, $plural)
>>>>>>> origin/master
 */
function _n_noop( $singular, $plural, $domain = null ) {
	return array( 0 => $singular, 1 => $plural, 'singular' => $singular, 'plural' => $plural, 'context' => null, 'domain' => $domain );
}

/**
<<<<<<< HEAD
 * Registers plural strings with gettext context in POT file, but does not translate them.
 *
 * Used when you want to keep structures with translatable plural
 * strings and use them later when the number is known.
 *
 * Example:
 *
 *     $messages = array(
 *      	'post' => _n_noop( '%s post', '%s posts', 'context', 'text-domain' ),
 *      	'page' => _n_noop( '%s pages', '%s pages', 'context', 'text-domain' ),
 *     );
 *     ...
 *     $message = $messages[ $type ];
 *     $usable_text = sprintf( translate_nooped_plural( $message, $count, 'text-domain' ), number_format_i18n( $count ) );
 *
 * @since 2.8.0
 *
 * @param string $singular Singular form to be localized.
 * @param string $plural   Plural form to be localized.
 * @param string $context  Context information for the translators.
 * @param string $domain   Optional. Text domain. Unique identifier for retrieving translated strings.
 *                         Default null.
 * @return array {
 *     Array of translation information for the strings.
 *
 *     @type string $0        Singular form to be localized. No longer used.
 *     @type string $1        Plural form to be localized. No longer used.
 *     @type string $2        Context information for the translators. No longer used.
 *     @type string $singular Singular form to be localized.
 *     @type string $plural   Plural form to be localized.
 *     @type string $context  Context information for the translators.
 *     @type string $domain   Text domain.
 * }
=======
 * Register plural strings with context in POT file, but don't translate them.
 *
 * @since 2.8.0
 * @param string $singular
 * @param string $plural
 * @param string $context
 * @param string|null $domain
 * @return array
>>>>>>> origin/master
 */
function _nx_noop( $singular, $plural, $context, $domain = null ) {
	return array( 0 => $singular, 1 => $plural, 2 => $context, 'singular' => $singular, 'plural' => $plural, 'context' => $context, 'domain' => $domain );
}

/**
<<<<<<< HEAD
 * Translates and retrieves the singular or plural form of a string that's been registered
 * with _n_noop() or _nx_noop().
 *
 * Used when you want to use a translatable plural string once the number is known.
 *
 * Example:
 *
 *     $messages = array(
 *      	'post' => _n_noop( '%s post', '%s posts', 'text-domain' ),
 *      	'page' => _n_noop( '%s pages', '%s pages', 'text-domain' ),
 *     );
 *     ...
 *     $message = $messages[ $type ];
 *     $usable_text = sprintf( translate_nooped_plural( $message, $count, 'text-domain' ), number_format_i18n( $count ) );
 *
 * @since 3.1.0
 *
 * @param array  $nooped_plural Array with singular, plural, and context keys, usually the result of _n_noop() or _nx_noop().
 * @param int    $count         Number of objects.
 * @param string $domain        Optional. Text domain. Unique identifier for retrieving translated strings. If $nooped_plural contains
 *                              a text domain passed to _n_noop() or _nx_noop(), it will override this value. Default 'default'.
=======
 * Translate the result of _n_noop() or _nx_noop().
 *
 * @since 3.1.0
 *
 * @param array  $nooped_plural Array with singular, plural and context keys, usually the result of _n_noop() or _nx_noop()
 * @param int    $count         Number of objects
 * @param string $domain        Optional. Text domain. Unique identifier for retrieving translated strings. If $nooped_plural contains
 *                              a text domain passed to _n_noop() or _nx_noop(), it will override this value.
>>>>>>> origin/master
 * @return string Either $single or $plural translated text.
 */
function translate_nooped_plural( $nooped_plural, $count, $domain = 'default' ) {
	if ( $nooped_plural['domain'] )
		$domain = $nooped_plural['domain'];

	if ( $nooped_plural['context'] )
		return _nx( $nooped_plural['singular'], $nooped_plural['plural'], $count, $nooped_plural['context'], $domain );
	else
		return _n( $nooped_plural['singular'], $nooped_plural['plural'], $count, $domain );
}

/**
 * Load a .mo file into the text domain $domain.
 *
 * If the text domain already exists, the translations will be merged. If both
 * sets have the same string, the translation from the original value will be taken.
 *
 * On success, the .mo file will be placed in the $l10n global by $domain
 * and will be a MO object.
 *
 * @since 1.5.0
 *
<<<<<<< HEAD
 * @global array $l10n          An array of all currently loaded text domains.
 * @global array $l10n_unloaded An array of all text domains that have been unloaded again.
 *
=======
>>>>>>> origin/master
 * @param string $domain Text domain. Unique identifier for retrieving translated strings.
 * @param string $mofile Path to the .mo file.
 * @return bool True on success, false on failure.
 */
function load_textdomain( $domain, $mofile ) {
<<<<<<< HEAD
	global $l10n, $l10n_unloaded;

	$l10n_unloaded = (array) $l10n_unloaded;

	/**
	 * Filters whether to override the .mo file loading.
	 *
	 * @since 2.9.0
	 *
	 * @param bool   $override Whether to override the .mo file loading. Default false.
=======
	global $l10n;

	/**
	 * Filter text domain and/or MO file path for loading translations.
	 *
	 * @since 2.9.0
	 *
	 * @param bool   $override Whether to override the text domain. Default false.
>>>>>>> origin/master
	 * @param string $domain   Text domain. Unique identifier for retrieving translated strings.
	 * @param string $mofile   Path to the MO file.
	 */
	$plugin_override = apply_filters( 'override_load_textdomain', false, $domain, $mofile );

	if ( true == $plugin_override ) {
<<<<<<< HEAD
		unset( $l10n_unloaded[ $domain ] );

=======
>>>>>>> origin/master
		return true;
	}

	/**
	 * Fires before the MO translation file is loaded.
	 *
	 * @since 2.9.0
	 *
	 * @param string $domain Text domain. Unique identifier for retrieving translated strings.
	 * @param string $mofile Path to the .mo file.
	 */
	do_action( 'load_textdomain', $domain, $mofile );

	/**
<<<<<<< HEAD
	 * Filters MO file path for loading translations for a specific text domain.
=======
	 * Filter MO file path for loading translations for a specific text domain.
>>>>>>> origin/master
	 *
	 * @since 2.9.0
	 *
	 * @param string $mofile Path to the MO file.
	 * @param string $domain Text domain. Unique identifier for retrieving translated strings.
	 */
	$mofile = apply_filters( 'load_textdomain_mofile', $mofile, $domain );

	if ( !is_readable( $mofile ) ) return false;

	$mo = new MO();
	if ( !$mo->import_from_file( $mofile ) ) return false;

	if ( isset( $l10n[$domain] ) )
		$mo->merge_with( $l10n[$domain] );

<<<<<<< HEAD
	unset( $l10n_unloaded[ $domain ] );

=======
>>>>>>> origin/master
	$l10n[$domain] = &$mo;

	return true;
}

/**
 * Unload translations for a text domain.
 *
 * @since 3.0.0
 *
<<<<<<< HEAD
 * @global array $l10n          An array of all currently loaded text domains.
 * @global array $l10n_unloaded An array of all text domains that have been unloaded again.
 *
=======
>>>>>>> origin/master
 * @param string $domain Text domain. Unique identifier for retrieving translated strings.
 * @return bool Whether textdomain was unloaded.
 */
function unload_textdomain( $domain ) {
<<<<<<< HEAD
	global $l10n, $l10n_unloaded;

	$l10n_unloaded = (array) $l10n_unloaded;

	/**
	 * Filters whether to override the text domain unloading.
	 *
	 * @since 3.0.0
	 *
	 * @param bool   $override Whether to override the text domain unloading. Default false.
=======
	global $l10n;

	/**
	 * Filter the text domain for loading translation.
	 *
	 * @since 3.0.0
	 *
	 * @param bool   $override Whether to override unloading the text domain. Default false.
>>>>>>> origin/master
	 * @param string $domain   Text domain. Unique identifier for retrieving translated strings.
	 */
	$plugin_override = apply_filters( 'override_unload_textdomain', false, $domain );

<<<<<<< HEAD
	if ( $plugin_override ) {
		$l10n_unloaded[ $domain ] = true;

		return true;
	}
=======
	if ( $plugin_override )
		return true;
>>>>>>> origin/master

	/**
	 * Fires before the text domain is unloaded.
	 *
	 * @since 3.0.0
	 *
	 * @param string $domain Text domain. Unique identifier for retrieving translated strings.
	 */
	do_action( 'unload_textdomain', $domain );

	if ( isset( $l10n[$domain] ) ) {
		unset( $l10n[$domain] );
<<<<<<< HEAD

		$l10n_unloaded[ $domain ] = true;

=======
>>>>>>> origin/master
		return true;
	}

	return false;
}

/**
 * Load default translated strings based on locale.
 *
 * Loads the .mo file in WP_LANG_DIR constant path from WordPress root.
 * The translated (.mo) file is named based on the locale.
 *
 * @see load_textdomain()
 *
 * @since 1.5.0
 *
<<<<<<< HEAD
 * @param string $locale Optional. Locale to load. Default is the value of get_locale().
=======
 * @param string $locale Optional. Locale to load. Default is the value of {@see get_locale()}.
>>>>>>> origin/master
 * @return bool Whether the textdomain was loaded.
 */
function load_default_textdomain( $locale = null ) {
	if ( null === $locale ) {
		$locale = get_locale();
	}

	// Unload previously loaded strings so we can switch translations.
	unload_textdomain( 'default' );

	$return = load_textdomain( 'default', WP_LANG_DIR . "/$locale.mo" );

	if ( ( is_multisite() || ( defined( 'WP_INSTALLING_NETWORK' ) && WP_INSTALLING_NETWORK ) ) && ! file_exists(  WP_LANG_DIR . "/admin-$locale.mo" ) ) {
		load_textdomain( 'default', WP_LANG_DIR . "/ms-$locale.mo" );
		return $return;
	}

<<<<<<< HEAD
	if ( is_admin() || wp_installing() || ( defined( 'WP_REPAIRING' ) && WP_REPAIRING ) ) {
=======
	if ( is_admin() || defined( 'WP_INSTALLING' ) || ( defined( 'WP_REPAIRING' ) && WP_REPAIRING ) ) {
>>>>>>> origin/master
		load_textdomain( 'default', WP_LANG_DIR . "/admin-$locale.mo" );
	}

	if ( is_network_admin() || ( defined( 'WP_INSTALLING_NETWORK' ) && WP_INSTALLING_NETWORK ) )
		load_textdomain( 'default', WP_LANG_DIR . "/admin-network-$locale.mo" );

	return $return;
}

/**
<<<<<<< HEAD
 * Loads a plugin's translated strings.
=======
 * Load a plugin's translated strings.
>>>>>>> origin/master
 *
 * If the path is not given then it will be the root of the plugin directory.
 *
 * The .mo file should be named based on the text domain with a dash, and then the locale exactly.
 *
 * @since 1.5.0
<<<<<<< HEAD
 * @since 4.6.0 The function now tries to load the .mo file from the languages directory first.
 *
 * @param string $domain          Unique identifier for retrieving translated strings
 * @param string $deprecated      Optional. Use the $plugin_rel_path parameter instead. Defaukt false.
=======
 *
 * @param string $domain          Unique identifier for retrieving translated strings
 * @param string $deprecated      Use the $plugin_rel_path parameter instead.
>>>>>>> origin/master
 * @param string $plugin_rel_path Optional. Relative path to WP_PLUGIN_DIR where the .mo file resides.
 *                                Default false.
 * @return bool True when textdomain is successfully loaded, false otherwise.
 */
function load_plugin_textdomain( $domain, $deprecated = false, $plugin_rel_path = false ) {
<<<<<<< HEAD
	/**
	 * Filters a plugin's locale.
=======
	$locale = get_locale();
	/**
	 * Filter a plugin's locale.
>>>>>>> origin/master
	 *
	 * @since 3.0.0
	 *
	 * @param string $locale The plugin's current locale.
	 * @param string $domain Text domain. Unique identifier for retrieving translated strings.
	 */
<<<<<<< HEAD
	$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

	$mofile = $domain . '-' . $locale . '.mo';

	// Try to load from the languages directory first.
	if ( load_textdomain( $domain, WP_LANG_DIR . '/plugins/' . $mofile ) ) {
		return true;
	}

	if ( false !== $plugin_rel_path ) {
		$path = WP_PLUGIN_DIR . '/' . trim( $plugin_rel_path, '/' );
	} elseif ( false !== $deprecated ) {
		_deprecated_argument( __FUNCTION__, '2.7.0' );
=======
	$locale = apply_filters( 'plugin_locale', $locale, $domain );

	if ( false !== $plugin_rel_path	) {
		$path = WP_PLUGIN_DIR . '/' . trim( $plugin_rel_path, '/' );
	} elseif ( false !== $deprecated ) {
		_deprecated_argument( __FUNCTION__, '2.7' );
>>>>>>> origin/master
		$path = ABSPATH . trim( $deprecated, '/' );
	} else {
		$path = WP_PLUGIN_DIR;
	}

<<<<<<< HEAD
	return load_textdomain( $domain, $path . '/' . $mofile );
=======
	// Load the textdomain according to the plugin first
	$mofile = $domain . '-' . $locale . '.mo';
	if ( $loaded = load_textdomain( $domain, $path . '/'. $mofile ) )
		return $loaded;

	// Otherwise, load from the languages directory
	$mofile = WP_LANG_DIR . '/plugins/' . $mofile;
	return load_textdomain( $domain, $mofile );
>>>>>>> origin/master
}

/**
 * Load the translated strings for a plugin residing in the mu-plugins directory.
 *
 * @since 3.0.0
<<<<<<< HEAD
 * @since 4.6.0 The function now tries to load the .mo file from the languages directory first.
 *
 * @param string $domain             Text domain. Unique identifier for retrieving translated strings.
 * @param string $mu_plugin_rel_path Optional. Relative to `WPMU_PLUGIN_DIR` directory in which the .mo
 *                                   file resides. Default empty string.
=======
 *
 * @param string $domain             Text domain. Unique identifier for retrieving translated strings.
 * @param string $mu_plugin_rel_path Relative to WPMU_PLUGIN_DIR directory in which the .mo file resides.
 *                                   Default empty string.
>>>>>>> origin/master
 * @return bool True when textdomain is successfully loaded, false otherwise.
 */
function load_muplugin_textdomain( $domain, $mu_plugin_rel_path = '' ) {
	/** This filter is documented in wp-includes/l10n.php */
	$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
<<<<<<< HEAD

	$mofile = $domain . '-' . $locale . '.mo';

	// Try to load from the languages directory first.
	if ( load_textdomain( $domain, WP_LANG_DIR . '/plugins/' . $mofile ) ) {
		return true;
	}

	$path = trailingslashit( WPMU_PLUGIN_DIR . '/' . ltrim( $mu_plugin_rel_path, '/' ) );

	return load_textdomain( $domain, $path . '/' . $mofile );
=======
	$path = trailingslashit( WPMU_PLUGIN_DIR . '/' . ltrim( $mu_plugin_rel_path, '/' ) );

	// Load the textdomain according to the plugin first
	$mofile = $domain . '-' . $locale . '.mo';
	if ( $loaded = load_textdomain( $domain, $path . $mofile ) )
		return $loaded;

	// Otherwise, load from the languages directory
	$mofile = WP_LANG_DIR . '/plugins/' . $mofile;
	return load_textdomain( $domain, $mofile );
>>>>>>> origin/master
}

/**
 * Load the theme's translated strings.
 *
 * If the current locale exists as a .mo file in the theme's root directory, it
 * will be included in the translated strings by the $domain.
 *
 * The .mo files must be named based on the locale exactly.
 *
 * @since 1.5.0
<<<<<<< HEAD
 * @since 4.6.0 The function now tries to load the .mo file from the languages directory first.
=======
>>>>>>> origin/master
 *
 * @param string $domain Text domain. Unique identifier for retrieving translated strings.
 * @param string $path   Optional. Path to the directory containing the .mo file.
 *                       Default false.
 * @return bool True when textdomain is successfully loaded, false otherwise.
 */
function load_theme_textdomain( $domain, $path = false ) {
<<<<<<< HEAD
	/**
	 * Filters a theme's locale.
=======
	$locale = get_locale();
	/**
	 * Filter a theme's locale.
>>>>>>> origin/master
	 *
	 * @since 3.0.0
	 *
	 * @param string $locale The theme's current locale.
	 * @param string $domain Text domain. Unique identifier for retrieving translated strings.
	 */
<<<<<<< HEAD
	$locale = apply_filters( 'theme_locale', get_locale(), $domain );

	$mofile = $domain . '-' . $locale . '.mo';

	// Try to load from the languages directory first.
	if ( load_textdomain( $domain, WP_LANG_DIR . '/themes/' . $mofile ) ) {
		return true;
	}

	if ( ! $path ) {
		$path = get_template_directory();
	}

	return load_textdomain( $domain, $path . '/' . $locale . '.mo' );
=======
	$locale = apply_filters( 'theme_locale', $locale, $domain );

	if ( ! $path )
		$path = get_template_directory();

	// Load the textdomain according to the theme
	$mofile = untrailingslashit( $path ) . "/{$locale}.mo";
	if ( $loaded = load_textdomain( $domain, $mofile ) )
		return $loaded;

	// Otherwise, load from the languages directory
	$mofile = WP_LANG_DIR . "/themes/{$domain}-{$locale}.mo";
	return load_textdomain( $domain, $mofile );
>>>>>>> origin/master
}

/**
 * Load the child themes translated strings.
 *
 * If the current locale exists as a .mo file in the child themes
 * root directory, it will be included in the translated strings by the $domain.
 *
 * The .mo files must be named based on the locale exactly.
 *
 * @since 2.9.0
 *
 * @param string $domain Text domain. Unique identifier for retrieving translated strings.
 * @param string $path   Optional. Path to the directory containing the .mo file.
 *                       Default false.
 * @return bool True when the theme textdomain is successfully loaded, false otherwise.
 */
function load_child_theme_textdomain( $domain, $path = false ) {
	if ( ! $path )
		$path = get_stylesheet_directory();
	return load_theme_textdomain( $domain, $path );
}

/**
<<<<<<< HEAD
 * Loads plugin and theme textdomains just-in-time.
 *
 * When a textdomain is encountered for the first time, we try to load
 * the translation file from `wp-content/languages`, removing the need
 * to call load_plugin_texdomain() or load_theme_texdomain().
 *
 * Holds a cached list of available .mo files to improve performance.
 *
 * @since 4.6.0
 * @access private
 *
 * @see get_translations_for_domain()
 * @global array $l10n_unloaded An array of all text domains that have been unloaded again.
 *
 * @param string $domain Text domain. Unique identifier for retrieving translated strings.
 * @return bool True when the textdomain is successfully loaded, false otherwise.
 */
function _load_textdomain_just_in_time( $domain ) {
	global $l10n_unloaded;

	$l10n_unloaded = (array) $l10n_unloaded;

	static $cached_mofiles = null;

	// Short-circuit if domain is 'default' which is reserved for core.
	if ( 'default' === $domain || isset( $l10n_unloaded[ $domain ] ) ) {
		return false;
	}

	if ( null === $cached_mofiles ) {
		$cached_mofiles = array();

		$locations = array(
			WP_LANG_DIR . '/plugins',
			WP_LANG_DIR . '/themes',
		);

		foreach ( $locations as $location ) {
			foreach ( get_available_languages( $location ) as $file ) {
				$cached_mofiles[] = "{$location}/{$file}.mo";
			}
		}
	}

	$locale = get_locale();
	$mofile = "{$domain}-{$locale}.mo";

	if ( in_array( WP_LANG_DIR . '/plugins/' . $mofile, $cached_mofiles ) ) {
		return load_textdomain( $domain, WP_LANG_DIR . '/plugins/' . $mofile );
	}

	if ( in_array( WP_LANG_DIR . '/themes/' . $mofile, $cached_mofiles ) ) {
		return load_textdomain( $domain, WP_LANG_DIR . '/themes/' . $mofile );
	}

	return false;
}

/**
=======
>>>>>>> origin/master
 * Return the Translations instance for a text domain.
 *
 * If there isn't one, returns empty Translations instance.
 *
 * @since 2.8.0
 *
<<<<<<< HEAD
 * @global array $l10n
 *
=======
>>>>>>> origin/master
 * @param string $domain Text domain. Unique identifier for retrieving translated strings.
 * @return NOOP_Translations A Translations instance.
 */
function get_translations_for_domain( $domain ) {
	global $l10n;
<<<<<<< HEAD
	if ( isset( $l10n[ $domain ] ) || ( _load_textdomain_just_in_time( $domain ) && isset( $l10n[ $domain ] ) ) ) {
		return $l10n[ $domain ];
	}

	static $noop_translations = null;
	if ( null === $noop_translations ) {
		$noop_translations = new NOOP_Translations;
	}

	return $noop_translations;
=======
	if ( !isset( $l10n[$domain] ) ) {
		$l10n[$domain] = new NOOP_Translations;
	}
	return $l10n[$domain];
>>>>>>> origin/master
}

/**
 * Whether there are translations for the text domain.
 *
 * @since 3.0.0
 *
<<<<<<< HEAD
 * @global array $l10n
 *
=======
>>>>>>> origin/master
 * @param string $domain Text domain. Unique identifier for retrieving translated strings.
 * @return bool Whether there are translations.
 */
function is_textdomain_loaded( $domain ) {
	global $l10n;
<<<<<<< HEAD
	return isset( $l10n[ $domain ] );
=======
	return isset( $l10n[$domain] );
>>>>>>> origin/master
}

/**
 * Translates role name.
 *
 * Since the role names are in the database and not in the source there
 * are dummy gettext calls to get them into the POT file and this function
 * properly translates them back.
 *
 * The before_last_bar() call is needed, because older installs keep the roles
 * using the old context format: 'Role name|User role' and just skipping the
 * content after the last bar is easier than fixing them in the DB. New installs
 * won't suffer from that problem.
 *
 * @since 2.8.0
 *
 * @param string $name The role name.
 * @return string Translated role name on success, original name on failure.
 */
function translate_user_role( $name ) {
	return translate_with_gettext_context( before_last_bar($name), 'User role' );
}

/**
 * Get all available languages based on the presence of *.mo files in a given directory.
 *
 * The default directory is WP_LANG_DIR.
 *
 * @since 3.0.0
 *
 * @param string $dir A directory to search for language files.
 *                    Default WP_LANG_DIR.
 * @return array An array of language codes or an empty array if no languages are present. Language codes are formed by stripping the .mo extension from the language file names.
 */
function get_available_languages( $dir = null ) {
	$languages = array();

<<<<<<< HEAD
	$lang_files = glob( ( is_null( $dir) ? WP_LANG_DIR : $dir ) . '/*.mo' );
	if ( $lang_files ) {
		foreach ( $lang_files as $lang_file ) {
			$lang_file = basename( $lang_file, '.mo' );
			if ( 0 !== strpos( $lang_file, 'continents-cities' ) && 0 !== strpos( $lang_file, 'ms-' ) &&
				0 !== strpos( $lang_file, 'admin-' ) ) {
				$languages[] = $lang_file;
			}
		}
=======
	foreach( (array)glob( ( is_null( $dir) ? WP_LANG_DIR : $dir ) . '/*.mo' ) as $lang_file ) {
		$lang_file = basename($lang_file, '.mo');
		if ( 0 !== strpos( $lang_file, 'continents-cities' ) && 0 !== strpos( $lang_file, 'ms-' ) &&
			0 !== strpos( $lang_file, 'admin-' ))
			$languages[] = $lang_file;
>>>>>>> origin/master
	}

	return $languages;
}

/**
 * Get installed translations.
 *
 * Looks in the wp-content/languages directory for translations of
 * plugins or themes.
 *
 * @since 3.7.0
 *
 * @param string $type What to search for. Accepts 'plugins', 'themes', 'core'.
 * @return array Array of language data.
 */
function wp_get_installed_translations( $type ) {
	if ( $type !== 'themes' && $type !== 'plugins' && $type !== 'core' )
		return array();

	$dir = 'core' === $type ? '' : "/$type";

	if ( ! is_dir( WP_LANG_DIR ) )
		return array();

	if ( $dir && ! is_dir( WP_LANG_DIR . $dir ) )
		return array();

	$files = scandir( WP_LANG_DIR . $dir );
	if ( ! $files )
		return array();

	$language_data = array();

	foreach ( $files as $file ) {
<<<<<<< HEAD
		if ( '.' === $file[0] || is_dir( WP_LANG_DIR . "$dir/$file" ) ) {
=======
		if ( '.' === $file[0] || is_dir( $file ) ) {
>>>>>>> origin/master
			continue;
		}
		if ( substr( $file, -3 ) !== '.po' ) {
			continue;
		}
<<<<<<< HEAD
		if ( ! preg_match( '/(?:(.+)-)?([a-z]{2,3}(?:_[A-Z]{2})?(?:_[a-z0-9]+)?).po/', $file, $match ) ) {
=======
		if ( ! preg_match( '/(?:(.+)-)?([A-Za-z_]{2,6}).po/', $file, $match ) ) {
>>>>>>> origin/master
			continue;
		}
		if ( ! in_array( substr( $file, 0, -3 ) . '.mo', $files ) )  {
			continue;
		}

		list( , $textdomain, $language ) = $match;
		if ( '' === $textdomain ) {
			$textdomain = 'default';
		}
		$language_data[ $textdomain ][ $language ] = wp_get_pomo_file_data( WP_LANG_DIR . "$dir/$file" );
	}
	return $language_data;
}

/**
 * Extract headers from a PO file.
 *
 * @since 3.7.0
 *
 * @param string $po_file Path to PO file.
 * @return array PO file headers.
 */
function wp_get_pomo_file_data( $po_file ) {
	$headers = get_file_data( $po_file, array(
		'POT-Creation-Date'  => '"POT-Creation-Date',
		'PO-Revision-Date'   => '"PO-Revision-Date',
		'Project-Id-Version' => '"Project-Id-Version',
		'X-Generator'        => '"X-Generator',
	) );
	foreach ( $headers as $header => $value ) {
		// Remove possible contextual '\n' and closing double quote.
		$headers[ $header ] = preg_replace( '~(\\\n)?"$~', '', $value );
	}
	return $headers;
}

/**
 * Language selector.
 *
 * @since 4.0.0
<<<<<<< HEAD
 * @since 4.3.0 Introduced the `echo` argument.
=======
>>>>>>> origin/master
 *
 * @see get_available_languages()
 * @see wp_get_available_translations()
 *
 * @param string|array $args {
 *     Optional. Array or string of arguments for outputting the language selector.
 *
<<<<<<< HEAD
 *     @type string   $id                           ID attribute of the select element. Default empty.
 *     @type string   $name                         Name attribute of the select element. Default empty.
 *     @type array    $languages                    List of installed languages, contain only the locales.
 *                                                  Default empty array.
 *     @type array    $translations                 List of available translations. Default result of
 *                                                  wp_get_available_translations().
 *     @type string   $selected                     Language which should be selected. Default empty.
 *     @type bool|int $echo                         Whether to echo the generated markup. Accepts 0, 1, or their
 *                                                  boolean equivalents. Default 1.
 *     @type bool     $show_available_translations  Whether to show available translations. Default true.
 * }
 * @return string HTML content
=======
 *     @type string  $id                           ID attribute of the select element. Default empty.
 *     @type string  $name                         Name attribute of the select element. Default empty.
 *     @type array   $languages                    List of installed languages, contain only the locales.
 *                                                 Default empty array.
 *     @type array   $translations                 List of available translations. Default result of
 *                                                 {@see wp_get_available_translations()}.
 *     @type string  $selected                     Language which should be selected. Default empty.
 *     @type bool    $show_available_translations  Whether to show available translations. Default true.
 * }
>>>>>>> origin/master
 */
function wp_dropdown_languages( $args = array() ) {

	$args = wp_parse_args( $args, array(
		'id'           => '',
		'name'         => '',
		'languages'    => array(),
		'translations' => array(),
		'selected'     => '',
<<<<<<< HEAD
		'echo'         => 1,
=======
>>>>>>> origin/master
		'show_available_translations' => true,
	) );

	$translations = $args['translations'];
	if ( empty( $translations ) ) {
		require_once( ABSPATH . 'wp-admin/includes/translation-install.php' );
		$translations = wp_get_available_translations();
	}

	/*
	 * $args['languages'] should only contain the locales. Find the locale in
	 * $translations to get the native name. Fall back to locale.
	 */
	$languages = array();
	foreach ( $args['languages'] as $locale ) {
		if ( isset( $translations[ $locale ] ) ) {
			$translation = $translations[ $locale ];
			$languages[] = array(
				'language'    => $translation['language'],
				'native_name' => $translation['native_name'],
				'lang'        => current( $translation['iso'] ),
			);

			// Remove installed language from available translations.
			unset( $translations[ $locale ] );
		} else {
			$languages[] = array(
				'language'    => $locale,
				'native_name' => $locale,
				'lang'        => '',
			);
		}
	}

	$translations_available = ( ! empty( $translations ) && $args['show_available_translations'] );

<<<<<<< HEAD
	$output = sprintf( '<select name="%s" id="%s">', esc_attr( $args['name'] ), esc_attr( $args['id'] ) );
=======
	printf( '<select name="%s" id="%s">', esc_attr( $args['name'] ), esc_attr( $args['id'] ) );
>>>>>>> origin/master

	// Holds the HTML markup.
	$structure = array();

	// List installed languages.
	if ( $translations_available ) {
		$structure[] = '<optgroup label="' . esc_attr_x( 'Installed', 'translations' ) . '">';
	}
	$structure[] = '<option value="" lang="en" data-installed="1">English (United States)</option>';
	foreach ( $languages as $language ) {
		$structure[] = sprintf(
			'<option value="%s" lang="%s"%s data-installed="1">%s</option>',
			esc_attr( $language['language'] ),
			esc_attr( $language['lang'] ),
			selected( $language['language'], $args['selected'], false ),
			esc_html( $language['native_name'] )
		);
	}
	if ( $translations_available ) {
		$structure[] = '</optgroup>';
	}

	// List available translations.
	if ( $translations_available ) {
		$structure[] = '<optgroup label="' . esc_attr_x( 'Available', 'translations' ) . '">';
		foreach ( $translations as $translation ) {
			$structure[] = sprintf(
				'<option value="%s" lang="%s"%s>%s</option>',
				esc_attr( $translation['language'] ),
				esc_attr( current( $translation['iso'] ) ),
				selected( $translation['language'], $args['selected'], false ),
				esc_html( $translation['native_name'] )
			);
		}
		$structure[] = '</optgroup>';
	}

<<<<<<< HEAD
	$output .= join( "\n", $structure );

	$output .= '</select>';

	if ( $args['echo'] ) {
		echo $output;
	}

	return $output;
=======
	echo join( "\n", $structure );

	echo '</select>';
>>>>>>> origin/master
}
