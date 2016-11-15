
( function( $ ) {

	$( function() {

		var orderByChange,
			accordionToggler,
			teaserDisplayChange
		;

		orderByChange = function( e ) {

			e.preventDefault();

			var orderByMetaValueKeyContainerEl = $( '#orderByMetaValueKey-container' );

			if( $( this ).val() == 'meta_value' )
				orderByMetaValueKeyContainerEl.slideDown();
			else
				orderByMetaValueKeyContainerEl.slideUp();

		}

		teaserDisplayChange = function( e ) {

			e.preventDefault();

			var teaserLengthContainerEl = $( '#teaserLength-container' );

			if( $( this ).val() === 'yes' )
				teaserLengthContainerEl.slideDown();
			else
				teaserLengthContainerEl.slideUp();

		}

		$( '#orderBy' ).on( 'change', orderByChange )
			.trigger( 'change' );

		$( '[name*="teaserDisplay"]' ).on( 'change', teaserDisplayChange )
			.trigger( 'change' );

	} );

} )( jQuery );
