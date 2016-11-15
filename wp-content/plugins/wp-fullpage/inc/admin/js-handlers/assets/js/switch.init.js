
( function( $ ) {

	$( function() {

		$( '.switch input' ).on( 'change', function() {
			if( $( this ).attr( 'checked' ) === 'checked'  ) {
				if( $( this ).val() === 'yes' ) {
					$( this ).parent( '.switch' ).addClass( 'active' );
				}
				else {
					$( this ).parent( '.switch' ).removeClass( 'active' );
				}
			}
		} ).trigger('change');

	} );

} )( jQuery )