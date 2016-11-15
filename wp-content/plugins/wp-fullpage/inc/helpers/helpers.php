<?php

/**
 * The Fullpage Helpers Class
 * 
 * @package 	WP_Fullpage\Includes\Helpers
 * @subpackage 	WP_Fullpage\Includes\Absctract\Classes
 */
class WP_Fullpage_Helpers {

	/**
	 * @var  WP_Fullpage_Helpers The single instance of the class
	 */
	protected static $_instance = null;
	
	/**
	 * The Output Buffering Stack
	 *
	 * @var  array
	 */
	public $ob_stack = array();
	
	/**
	 * The Dynamic CSS
	 *
	 * @var  string
	 */
	public $dynamic_css = '';

	/**
	 * Main WP_Fullpage_Helpers Instance
	 *
	 * Ensures only one instance of WP_Fullpage_Helpers is loaded or can be loaded.
	 *
	 * @see 	WPFP_Helpers()
	 * 
	 * @return  WP_Fullpage_Helpers - Main instance
	 */
	public static function instance() {
		
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;

	} // END public static function instance

	/**
	 * Output Buffering Handler
	 *
	 * @param   string  $str  
	 *
	 * @return  string       
	 */
	public function ob_handler( $str ) {
		
		end( $this->ob_stack );
		$this->ob_stack[ key( $this->ob_stack ) ] .= $str;

		return '';

	} // END public function ob_handler

	/**
	 * Output buffering Start
	 *
	 * @return  void
	 */
	public function ob_start() {
		
		array_push( $this->ob_stack, '' );
		ob_start( array( &$this, 'ob_handler' ) );

	} // END public function ob_start

	/**
	 * Output buffering Clean
	 *
	 * 		WPFP_Helpers()->ob_start();
	 * 			?>
	 * 				<some HTML>
	 *   	 	<?php
	 *      return WPFP_Helpers()->ob_get_clean()
	 *
	 * @return  string  the content
	 */
	public function ob_get_clean() {
		
		ob_end_flush();

		return array_pop( $this->ob_stack );

	} // END public function ob_get_clean

	/**
	 * Define Properties of a Class
	 *
	 * 		WPFP_Helpers()->define_properties( $this, __DIR__, __FILE__ );
	 * 		
	 *   	Define the assets url of the Class : $this->assets_url
	 *    	Define the relative path to the Class : $this->rel_path
	 *
	 * 		$assets_url and $rel_path must be difined in the Class as 'public'
	 *
	 * @param   object  $class   the class 
	 * @param   string  $dir   	 the name of directory of the Class file
	 * @param   string  $file    the relative Path to the Class file
	 *
	 * @return  void             
	 */
	public function define_properties( &$class, $dir, $file ) {
		
		$class_url         = plugins_url( trailingslashit( basename( $dir ) ), dirname( $file ) );
		$class->assets_url = $class_url . 'assets/';
		$class->rel_path   = plugin_dir_path( $file );

	} // END public function define_properties

	/**
	 * Outputs the html checked attribute and define the default settings value.
	 *
	 * 		WPFP_Helpers()->checked( $theDataValue, $theSettingsValue, 'yes' );
	 *
	 * @param   string  $data_value    		the data value 
	 * @param   string  $settings_value   	the settings default value of the data
	 * @param   string  $current      		the current value to check for
	 *
	 * @return  void             
	 */
	public function checked( $data_value, $settings_value, $current ) {
		
		$checked         = checked( $data_value, $current, false );
		$default_setting = $this->default_setting( $settings_value );

		printf( '%1s %2s', $checked, $default_setting );

	} // END public function checked

	/**
	 * Outputs the html value attribute and define the default settings value.
	 *
	 * 		WPFP_Helpers()->value( $theDataValue, $theSettingsValue );
	 *
	 * @param   string  $data_value    		the name of the value 
	 * @param   string  $settings_value   	the settings default value of the data
	 *
	 * @return  void             
	 */
	public function value( $data_value, $settings_value ) {
		
		$this->ob_start();

		?>value='<?php print esc_attr( $data_value ); ?>'<?php
		
		$value           = $this->ob_get_clean();
		$default_setting = $this->default_setting( $settings_value );

		printf( '%1s %2s', $value, $default_setting );

	} // END public function checked

	/**
	 * Outputs an html radio button.
	 *
	 * 		WPFP_Helpers()->radio( $option_group, $option_name, $values, $current_value, $settings_value );
	 *
	 * @param   string  $option_group   	the option group 
	 * @param   string  $option_name   		the option name
	 * @param   array   $values   			the values for the input
	 * @param   string  $current_value   	the current value
	 * @param   string  $settings_value   	the settings value
	 *
	 * @return  void             
	 */
	public function radio( $option_group, $option_name, $values, $current_value, $settings_value ) {
		
		$this->ob_start();

		?>

			<div class="radio">

		<?php

		foreach( $values as $key => $value ) :
			
			?>
				<input type="radio" id="<?php print $option_name; ?>-<?php print $key; ?>" name="<?php print $option_group; ?>[<?php print $option_name; ?>]" value="<?php print $key; ?>" <?php WPFP_Helpers()->checked( $key, $settings_value, $current_value ); ?> />
				<label for="<?php print $option_name; ?>-<?php print $key; ?>">
				 	<?php print $value; ?>
				</label>

			<?php

		endforeach;

		?>

			</div>

		<?php

		print $this->ob_get_clean();

	} // END public function radio

	/**
	 * Outputs an html switch.
	 *
	 * 		WPFP_Helpers()->switch_button( $option_group, $option_name, $values, $current_value, $settings_value );
	 *
	 * @param   string  $option_group   	the option group 
	 * @param   string  $option_name   		the option name
	 * @param   array   $values   			the values for the input
	 * @param   string  $current_value   	the current value
	 * @param   string  $settings_value   	the settings value
	 *
	 * @return  void             
	 */
	public function switch_button( $option_group, $option_name, $values, $current_value, $settings_value ) {
		
		$this->ob_start();

		?>

			<div class="switch">

		<?php

		foreach( array_reverse( $values ) as $key => $value ) :
			
			?>
				<input type="radio" id="<?php print $option_name; ?>-<?php print $key; ?>" name="<?php print $option_group; ?>[<?php print $option_name; ?>]" value="<?php print $key; ?>" <?php WPFP_Helpers()->checked( $key, $settings_value, $current_value ); ?> />
			<?php

		endforeach;

		?>

				<span class="switch-button"></span>
				<span class="switch-label switch-on-label"><?php _e( 'on', WPFP_DOMAIN ) ?></span>
				<span class="switch-label switch-off-label"><?php _e( 'off', WPFP_DOMAIN ) ?></span>

			</div>

		<?php

		print $this->ob_get_clean();

	} // END public function switch_button

	/**
	 * Outputs an html select box.
	 *
	 * 		WPFP_Helpers()->select( $option_group, $option_name, $values, $current_value, $settings_value, $class );
	 *
	 * @param   string  $option_group   	the option group 
	 * @param   string  $option_name   		the option name
	 * @param   array   $values   			the values for the input
	 * @param   string  $current_value   	the current value
	 * @param   string  $settings_value   	the settings value
	 * @param   string  $class   			the class of the input
	 *
	 * @return  void             
	 */
	public function select( $option_group, $option_name, $values, $current_value, $settings_value, $class = '' ) {
		
		$this->ob_start();

		?>
			<select class="<?php print $class; ?>" id="<?php print $option_name; ?>" name="<?php print $option_group; ?>[<?php print $option_name; ?>]" <?php WPFP_Helpers()->default_setting( $settings_value, true ); ?>>

				<?php

				foreach( $values as $key => $value ) :
					
					?>
							
						<option value="<?php print $key; ?>" <?php selected( $current_value , $key ); ?>><?php print $value; ?></option>

					<?php

				endforeach;

				?>

			</select>
		<?php
		
		print $this->ob_get_clean();

	} // END public function select

	/**
	 * Outputs an html input text.
	 *
	 * 		WPFP_Helpers()->text( $option_group, $option_name, $current_value, $settings_value, $class );
	 *
	 * @param   string  $option_group   	the option group 
	 * @param   string  $option_name   		the option name
	 * @param   string  $current_value   	the current value
	 * @param   string  $settings_value   	the settings value
	 * @param   string  $placeholder   		the placeholder
	 * @param   string  $class   			the class of the input
	 *
	 * @return  void             
	 */
	public function text( $option_group, $option_name, $current_value, $settings_value, $placeholder = '', $class = '' ) {
		
		$this->ob_start();

		?>
			
			<div class="input-field">
			
				<input placeholder='<?php print $placeholder; ?>' class="<?php print $class; ?>" type="text" id="<?php print $option_name; ?>" name="<?php print $option_group; ?>[<?php print $option_name; ?>]" <?php WPFP_Helpers()->value( $current_value, $settings_value ); ?> />

			</div>

		<?php
		
		print $this->ob_get_clean();

	} // END public function text

	/**
	 * Outputs an html input hidden.
	 *
	 * 		WPFP_Helpers()->hidden( $option_name, $id, $current_value, $class );
	 *
	 * @param   string  $option_name   		the option name
	 * @param   string  $id   				the input id
	 * @param   string  $current_value   	the current value
	 * @param   string  $class   			the class of the input
	 *
	 * @return  void             
	 */
	public function hidden( $option_name, $id, $current_value, $class = '' ) {
		
		$this->ob_start();

		?>
							
			<input class="<?php print $class; ?>" type="hidden" id="<?php print $id; ?>" name="<?php print $option_name; ?>" value="<?php print esc_attr( $current_value ); ?>" />

		<?php
		
		print $this->ob_get_clean();

	} // END public function hidden

	/**
	 * Outputs an html input button.
	 *
	 * 		WPFP_Helpers()->button( $id, $current_value, $datas, $class );
	 *
	 * @param   string  $id   				the input id
	 * @param   string  $current_value   	the current value
	 * @param   array  	$datas   			the datas
	 * @param   string  $class   			the class of the input
	 *
	 * @return  void             
	 */
	public function button( $id, $current_value, $datas, $class = '' ) {
		
		$this->ob_start();

		?>		
		
		<a href="#!" id="<?php print $id; ?>" class="<?php print $class; ?> btn-large teal-text text-lighten-1 grey lighten-4 waves-effect" data-datas='<?php print json_encode( $datas ); ?>'><i class="material-icons medium yellow-text text-accent-2 left">library_add</i><?php print $current_value; ?></a>

		<?php
		
		print $this->ob_get_clean();

	} // END public function button

	/**
	 * Outputs an html input number.
	 *
	 * 		WPFP_Helpers()->number( $option_name, $id, $current_value, $settings_value, $min, $max, $step, $class );
	 *
	 * @param   string  $option_name   		the option name
	 * @param   string  $id   				the input id
	 * @param   string  $current_value   	the current value
	 * @param   string  $settings_value   	the settings value
	 * @param   int  	$min   				the input min
	 * @param   int  	$max   				the input max
	 * @param   int  	$step  				the input step
	 * @param   string  $class   			the class of the input
	 *
	 * @return  void             
	 */
	public function number( $option_name, $id, $current_value, $settings_value, $min, $max, $step, $class = '' ) {
		
		$this->ob_start();

		?>		
									
			<div class="range-field">
				<a data-position="left" data-delay="50" data-tooltip='<?php _e( 'Reset', WPFP_DOMAIN ); ?>' class="wpfp-reset-property tooltipped"><i class="material-icons tiny red-text text-lighten-2">replay</i></a>
				<input type="range" id="<?php print $id; ?>" name="<?php print $option_name; ?>[<?php print $id; ?>]" class="<?php print $class; ?>" step="<?php print $step; ?>" min="<?php print $min; ?>" max="<?php print $max; ?>" <?php WPFP_Helpers()->value( $current_value, $settings_value ); ?> />
			</div>

		<?php
		
		print $this->ob_get_clean();

	} // END public function number

	/**
	 * Outputs an html textarea.
	 *
	 * 		WPFP_Helpers()->textarea( $option_name, $id, $current_value, $settings_value, $class );
	 *
	 * @param   string  $option_name   		the option name
	 * @param   string  $id   				the input id
	 * @param   string  $current_value   	the current value
	 * @param   string  $settings_value   	the settings value
	 * @param   string  $placeholder   		the placeholder of the textarea
	 * @param   string  $class   			the class of the textarea
	 *
	 * @return  void             
	 */
	public function textarea( $option_name, $id, $current_value, $settings_value, $placeholder = '', $class = '' ) {
		
		$this->ob_start();

		?>		
									
			<textarea id="<?php print $option_name; ?>-<?php print $id; ?>" class="materialize-textarea <?php print $class; ?>" name="<?php print $option_name; ?>[<?php print $id; ?>]" <?php WPFP_Helpers()->default_setting( $settings_value, true ); ?> placeholder="<?php print $placeholder; ?>"><?php print $current_value; ?></textarea>

		<?php
		
		print $this->ob_get_clean();

	} // END public function textarea

	/**
	 * Outputs an html ace editor with his textarea.
	 *
	 * 		WPFP_Helpers()->ace_textarea( $option_name, $id, $current_value, $settings_value, $class );
	 *
	 * @param   string  $option_name   		the option name
	 * @param   string  $id   				the input id
	 * @param   string  $current_value   	the current value
	 * @param   string  $settings_value   	the settings value
	 * @param   string  $placeholder   		the placeholder of the textarea
	 * @param   string  $class   			the class of the textarea
	 *
	 * @return  void             
	 */
	public function ace_textarea( $option_name, $id, $current_value, $settings_value, $placeholder = '', $class = '' ) {
		
		$this->ob_start();

		?>		
									
			<textarea id="<?php print $option_name; ?>-<?php print $id; ?>" class="hidden ace-textarea <?php print $class; ?>" name="<?php print $option_name; ?>[<?php print $id; ?>]" <?php WPFP_Helpers()->default_setting( $settings_value, true ); ?> placeholder="<?php print $placeholder; ?>"><?php print $current_value; ?></textarea>
			<div id="ace-editor-container-<?php print $option_name; ?>-<?php print $id; ?>">
				<div id="ace-<?php print $option_name; ?>-<?php print $id; ?>" class="ace-editor"><?php print $current_value; ?></div>
			</div>
			<a href="#modal-ace-<?php print $option_name; ?>-<?php print $id; ?>" id="wide-screen-btn-<?php print $option_name; ?>-<?php print $id; ?>" class="ace-modal-launcher wide-screen-btn btn-floating right teal lighten-1 waves-effect tooltipped" data-position="top" data-delay="50" data-tooltip='<?php _e( 'Full width editing', WPFP_DOMAIN ); ?>'>
				<i class="material-icons medium grey-text text-lighten-4">open_with</i>
			</a>
			<div id="modal-ace-<?php print $option_name; ?>-<?php print $id; ?>" class="m_modal m_modal-fixed-footer grey-text text-lighten-4">
				<div id="m_modal-content-ace-<?php print $option_name; ?>-<?php print $id; ?>" class="m_modal-content"></div>
				<div class="m_modal-footer">
					<a href="#!" class="ace-validate-btn m_modal-action m_modal-close waves-effect waves-teal btn grey-text text-lighten-3"><i class="material-icons small yellow-text text-accent-2 left">done_all</i><?php _e( 'Ok', WPFP_DOMAIN ); ?></a>
				</div>
			</div>
		
		<?php
		
		print $this->ob_get_clean();

	} // END public function ace_textarea

	/**
	 * Outputs an html tooltip.
	 *
	 * 		WPFP_Helpers()->tooltip( $tip, $class );
	 *
	 * @param   string  $tip   		the tip
	 * @param   string  $class   	the class of the tip
	 *
	 * @return  void             
	 */
	public function tooltip( $tip, $class ) {
		
		$this->ob_start();

		?>		
									
			<a class="<?php print $class; ?> tooltipped" data-position="right" data-delay="50" data-tooltip='<?php print $tip; ?>'><i class="material-icons tiny red-text text-lighten-3">info</i></a>

		<?php
		
		print $this->ob_get_clean();

	} // END public function tooltip

	/**
	 * Outputs an html goto.
	 *
	 * 		WPFP_Helpers()->goto_tip( $tip, $url, $class );
	 *
	 * @param   string  $tip   		the tip
	 * @param   string  $url   		the goto url
	 * @param   string  $class   	the class of the tip
	 *
	 * @return  void             
	 */
	public function goto_tip( $tip, $url, $class ) {
		
		$this->ob_start();

		?>		
									
			<a class="<?php print $class; ?> tooltipped" data-position="right" data-delay="50" data-tooltip='<?php print $tip; ?>' target="_blank" href="<?php print $url; ?>"><i class="material-icons tiny red-text text-lighten-3">language</i></a>
		
		<?php
		
		print $this->ob_get_clean();

	} // END public function goto

	/**
	 * Outputs an html label.
	 *
	 * 		WPFP_Helpers()->label( $label, $for );
	 *
	 * @param   string  $label   	the label
	 * @param   string  $for   		the for attribute
	 *
	 * @return  void             
	 */
	public function label( $label, $for = '' ) {
		
		$this->ob_start();

		?>		
									
			<label for="<?php print $for ?>">
			 	
			 	<?php print $label ?>
			
			</label>
		
		<?php
		
		print $this->ob_get_clean();

	} // END public function label

	/**
	 * Outputs an html span label.
	 *
	 * 		WPFP_Helpers()->span_label( $label );
	 *
	 * @param   string  $label   	the label
	 *
	 * @return  void             
	 */
	public function span_label( $label ) {
		
		$this->ob_start();

		?>		
									
			<span class="label"><?php print $label; ?></span>
		
		<?php
		
		print $this->ob_get_clean();

	} // END public function span_label

	/**
	 * Outputs an html div helper.
	 *
	 * 		WPFP_Helpers()->div_helper( $text );
	 *
	 * @param   string  $text   	the text
	 *
	 * @return  void             
	 */
	public function div_helper( $text ) {
		
		$this->ob_start();

		?>		
									
			<div class="helper"><?php print $text; ?></div>
		
		<?php
		
		print $this->ob_get_clean();

	} // END public function div_helper

	/**
	 * Outputs a submit button.
	 *
	 * 		WPFP_Helpers()->submit();
	 *
	 * @return  void             
	 */
	public function submit() {
		
		$this->ob_start();

		?>		
										
			<button class="waves-effect waves-light btn-large right" type="submit">
				<?php _e( 'Save settings', WPFP_DOMAIN ); ?><i class="material-icons yellow-text text-accent-2 right">send</i>
			</button>
		
		<?php
		
		print $this->ob_get_clean();

	} // END public function submit

	/**
	 * Outputs an opening input field label.
	 *
	 * 		WPFP_Helpers()->input_field_label_start();
	 *
	 * @return  void             
	 */
	public function input_field_label_start() {
		
		$this->ob_start();

		?>		
									
			<div class="col s4 input-field-label">
		
		<?php
		
		print $this->ob_get_clean();

	} // END public function input_field_label_start

	/**
	 * Outputs an closing input field label.
	 *
	 * 		WPFP_Helpers()->input_field_label_end();
	 *
	 * @return  void             
	 */
	public function input_field_label_end() {
		
		$this->ob_start();

		?>		
									
			</div><!-- .input-field-label -->
		
		<?php
		
		print $this->ob_get_clean();

	} // END public function input_field_label_end

	/**
	 * Outputs an opening input field.
	 *
	 * 		WPFP_Helpers()->input_field_start();
	 *
	 * @return  void             
	 */
	public function input_field_start() {
		
		$this->ob_start();

		?>		
									
			<div class="col s8 input-field">
		
		<?php
		
		print $this->ob_get_clean();

	} // END public function input_field_start

	/**
	 * Outputs an closing input field.
	 *
	 * 		WPFP_Helpers()->input_field_end();
	 *
	 * @return  void             
	 */
	public function input_field_end() {
		
		$this->ob_start();

		?>		
									
			</div><!-- .input-field -->
		
		<?php
		
		print $this->ob_get_clean();

	} // END public function input_field_end

	/**
	 * Outputs a modal reset button.
	 *
	 * 		WPFP_Helpers()->modal_reset();
	 *
	 * @return  void             
	 */
	public function modal_reset() {
		
		static $modal_reset = 1;

		$this->ob_start();

		?>		
									
			<a href="#modal-reset-<?php print $modal_reset; ?>" class="reset-modal-launcher waves-effect waves-teal btn-large teal-text text-lighten-1 grey lighten-4 left"><i class="material-icons medium yellow-text text-accent-2 left">replay</i><?php _e( 'Reset datas to default', WPFP_DOMAIN ); ?></a>
			<div id="modal-reset-<?php print $modal_reset++; ?>" class="m_modal m_modal-fixed-footer grey-text text-lighten-4">
				<div class="m_modal-content teal darken-2">
					<h4><i class="material-icons medium yellow-text text-accent-2 left">report_problem</i><?php _e( 'Reset datas to default?', WPFP_DOMAIN ); ?></h4>
					<p class="flow-text"><?php _e( 'You are about to reset your settings to default. Are you sure you want to continue?', WPFP_DOMAIN ) ?></p>
				</div>
				<div class="m_modal-footer">
					<a href="#!" class="wpfp-reset m_modal-action m_modal-close waves-effect waves-teal btn grey-text text-lighten-3"><i class="material-icons small yellow-text text-accent-2 left">replay</i><?php _e( 'Reset', WPFP_DOMAIN ); ?></a>
					<a href="#!" class="m_modal-action m_modal-close waves-effect waves-teal btn teal-text text-lighten-1 grey lighten-2"><?php _e( 'No', WPFP_DOMAIN ); ?></a>
				</div>
			</div>
		
		<?php
		
		print $this->ob_get_clean();

	} // END public function modal_reset

	/**
	 * Define the default settings value.
	 *
	 * @param   string  $settings_value   	the settings default value 
	 * @param   bool    $echo   			echo the data-default html, default to false
	 *
	 * @return  string               		the data-default html
	 */
	public function default_setting( $settings_value, $echo = false ) {

		$this->ob_start();

		?>data-default='<?php print esc_attr( $settings_value ) ?>'<?php
		
		$data_default = $this->ob_get_clean();

		if( $echo )
			print $data_default;

		return $data_default;

	} // END public function default_setting

	/**
	 * Add some Dynamic CSS
	 *
	 * @param   string  $css   	the css to add 
	 *
	 * @return  void
	 */
	public function add_dynamic_css( $css ) {

		$this->dynamic_css .= str_replace( array( "\n", "\t", "\r" ), '', $css );

	} // END public function add_dynamic_css

	/**
	 * Get the Dynamic CSS
	 *
	 * @return  string
	 */
	public function get_dynamic_css() {

		return $this->dynamic_css;

	} // END public function set_dynamic_css

} // END class WP_Fullpage_Helpers

/**
 * Returns the main instance of WP_Fullpage_Helpers to prevent the need to use globals.
 * 
 * @package 	WP_Fullpage\Includes\Helpers
 *
 * @return 		WP_Fullpage_Helpers
 */
function WPFP_Helpers() {

	return WP_Fullpage_Helpers::instance();

}

