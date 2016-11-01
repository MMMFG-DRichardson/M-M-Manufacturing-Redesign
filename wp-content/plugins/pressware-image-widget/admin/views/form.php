<?php
/**
 * The Image Widget dashboard
 *
 * This represents the user interface for the form for the widget.
 *
 * @package   Pressware_Image_Widget/admin/views
 * @author    Pressware, LLC
 * @license   GPL-2.0+
 * @link      http://shop.pressware.co/image-widget/
 * @copyright 2014 Pressware, LLC
 */
?>
<div class="pressware-image-widget-container">

	<div class="pressware-image-uploaded">
	</div><!-- .pressware-image-uploaded -->

	<div class="pressware-image-options">
		<input type="text" id="<?php echo $this->get_field_id( 'pressware-image-anchor' ); ?>" name="<?php echo $this->get_field_name( 'pressware-image-anchor' ); ?>" value="<?php echo esc_attr( $anchor ); ?>" placeholder="<?php _e( 'Link URL', $this->get_widget_slug() ) ?>" />
	</div><!-- .pressware-image-options -->

	<div class="pressware-image-data">
		<input type="text" id="<?php echo $this->get_field_id( 'pressware-image-id' ); ?>" name="<?php echo $this->get_field_name( 'pressware-image-id' ); ?>" value="<?php echo esc_attr( $id ); ?>" />
		<input type="text" id="<?php echo $this->get_field_id( 'pressware-image-title' ); ?>" name="<?php echo $this->get_field_name( 'pressware-image-title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
		<input type="text" id="<?php echo $this->get_field_id( 'pressware-image-url' ); ?>" name="<?php echo $this->get_field_name( 'pressware-image-url' ); ?>" value="<?php echo esc_attr( $url ); ?>" />
		<input type="text" id="<?php echo $this->get_field_id( 'pressware-image-alt' ); ?>" name="<?php echo $this->get_field_name( 'pressware-image-alt' ); ?>" value="<?php echo esc_attr( $alt ); ?>" />
		<input type="text" id="<?php echo $this->get_field_id( 'pressware-image-caption' ); ?>" name="<?php echo $this->get_field_name( 'pressware-image-caption' ); ?>" value="<?php echo esc_attr( $caption ); ?>" />
		<input type="text" id="<?php echo $this->get_field_id( 'pressware-image-description' ); ?>" name="<?php echo $this->get_field_name( 'pressware-image-description' ); ?>" value="<?php echo esc_attr( $description ); ?>" />
		<input type="text" id="<?php echo $this->get_field_id( 'pressware-image-width' ); ?>" name="<?php echo $this->get_field_name( 'pressware-image-width' ); ?>" value="<?php echo esc_attr( $width ); ?>" />
		<input type="text" id="<?php echo $this->get_field_id( 'pressware-image-height' ); ?>" name="<?php echo $this->get_field_name( 'pressware-image-height' ); ?>" value="<?php echo esc_attr( $height ); ?>" />
        
	</div><!-- .pressware-image-data -->

	<div class="pressware-image-upload-container">
		<a class="button media-button button-large pressware-image-upload" id="<?php echo $this->get_field_id( 'pressware-image-upload' ); ?>">
			<?php _e( 'Upload Image', $this->get_widget_slug() ); ?>
		</a><!-- .pressware-image-upload -->
        
        <br><br>
        <input type="text" style="width: 100%;" id="<?php echo $this->get_field_id( 'pressware-title' ); ?>" name="<?php echo $this->get_field_name( 'pressware-title' ); ?>" value="<?php echo esc_attr( $title ); ?>" placeholder="Title" />
        <br>
        <textarea style="width: 100%; margin: 1px;" id="<?php echo $this->get_field_id( 'pressware-description' ); ?>" name="<?php echo $this->get_field_name( 'pressware-description' ); ?>" placeholder="Description"><?php echo esc_attr( $description ); ?></textarea>
        
        <br><br>
        <label>Select Page for Link:</label>
        <?php
        $args = array(
          'id' => $this->get_field_id('pressare-page'),
          'name' => $this->get_field_name('pressare-page'),
          'show_option_none' =>  __('None', 'int_link_wdg'),
          'option_none_value' => '-1',
          'selected' => $instance['pressware-page']
        );
    wp_dropdown_pages( $args );
    ?>
        
	</div><!-- .pressware-image-upload-container -->

	<div class="pressware-image-widget-upgrade">
		
	</div><!-- .pressware-image-widget-upgrade -->

</div><!-- .pressware-image-widget-container -->