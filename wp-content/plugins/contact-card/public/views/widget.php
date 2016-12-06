<?php
/**
 * The Image Widget
 *
 * This represents the frontend of the widget.
 *
 * @package   Contact_Card_Widget/admin/views
 * @author    Pressware, LLC
 * @license   GPL-2.0+
 * @link      http://shop.pressware.co/image-widget/
 * @copyright 2014 Pressware, LLC
 */
?>
<div class="Contact" style="background-image:url(<?php echo $instance['pressware-image-url']; ?>)">
	<div class="InfoBox">
		<h1 class="InfoBoxName"><?php echo $instance['contact-name'] ?></h1>
		<h1 class="InfoBoxTitle"><?php echo $instance['contact-position'] ?></h1>
		<ul>
			<li>Phone: <span class="InfoBoxData"><?php echo $instance['contact-phone'] ?></span></li>
			<li>Fax: <span class="InfoBoxData"><?php echo $instance['contact-fax'] ?></span></li>
			<li><a href="mailto:<?php echo $instance['contact-email'] ?>">Send E-Mail</a></li>
		</ul>
	</div>
</div>