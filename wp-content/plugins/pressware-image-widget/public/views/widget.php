<?php
/**
 * The Image Widget
 *
 * This represents the frontend of the widget.
 *
 * @package   Pressware_Image_Widget/admin/views
 * @author    Pressware, LLC
 * @license   GPL-2.0+
 * @link      http://shop.pressware.co/image-widget/
 * @copyright 2014 Pressware, LLC
 */
?>
<div class="ProductImageBox" style="background-image:url(<?php echo $instance['pressware-image-url']; ?>)">

	<?php if ( $this->has_image_anchor( $instance['pressware-image-anchor'] ) ) { ?>

		<a href="<?php echo $instance['pressware-image-anchor'] ?>">
            <div class="ProductTextBox ProductTextBoxLeft">
                <a class="DivLink" href="#"></a>
                <h1 class="ProductTextBox"><?php echo $instance['pressware-title']; ?></h1>
                <p class="ProductTextBox"><?php echo $instance['pressware-description']; ?></p>
                <a href="#">Read More >></a>
            </div>	
		</a>

	<?php } else { ?>

	<div class="ProductTextBox ProductTextBoxLeft">
        <a class="DivLink" href="<?php get_permalink( $instance['pressware-page'] ) ?>"></a>
        <h1 class="ProductTextBox"><?php echo $instance['pressware-title']; ?></h1>
        <p class="ProductTextBox"><?php echo $instance['pressware-description']; ?></p>
        <a href="<?php echo get_permalink( $instance['pressware-page'] ) ?>">Read More >></a>
    </div>	

	<?php } ?>

</div><!-- .pressware-image-container -->