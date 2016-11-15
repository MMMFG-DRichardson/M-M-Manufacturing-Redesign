<?php

/**
 * Event Backcompat
 *
 * @param   array   $options
 *
 * @return  void
 */
function wpfp_event_backcompat( &$options ) {
	
	// Backcompat 
	$search = array(
		'/fullpageOnLeave\([^\)]*\);/',
		'/fullpageAfterLoad\([^\)]*\);/',
		'/fullpageAfterRender\([^\)]*\);/',
		'/fullpageAfterResize\([^\)]*\);/',
		'/fullpageAfterSlideLoad\([^\)]*\);/',
		'/fullpageSlideLeave\([^\)]*\);/',
	);
	
	if( ! empty( $options['onLeave'] ) )
		$options['onLeave']         = preg_replace( $search , '', $options['onLeave'] );

	if( ! empty( $options['afterLoad'] ) )
		$options['afterLoad']       = preg_replace( $search , '', $options['afterLoad'] );

	if( ! empty( $options['afterRender'] ) )
		$options['afterRender']     = preg_replace( $search , '', $options['afterRender'] );

	if( ! empty( $options['afterResize'] ) )
		$options['afterResize']     = preg_replace( $search , '', $options['afterResize'] );

	if( ! empty( $options['afterSlideLoad'] ) )
		$options['afterSlideLoad']  = preg_replace( $search , '', $options['afterSlideLoad'] );

	if( ! empty( $options['onSlideLeave'] ) )
		$options['onSlideLeave']    = preg_replace( $search , '', $options['onSlideLeave'] );

} // END function wpfp_event_backcompat
