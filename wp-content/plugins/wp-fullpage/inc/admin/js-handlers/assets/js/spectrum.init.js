
( function( $ ) {

	$( function() {

		$( wpfpSpectrumParams.selectors ).spectrum( {
			allowEmpty:true,
			showInput: true,
			containerClassName: "full-spectrum",
			showInitial: true,
			showPalette: false,
			showSelectionPalette: true,
			cancelText: wpfpSpectrumParams.cancelText,
			chooseText: wpfpSpectrumParams.chooseText,
    		showAlpha: true,
			maxPaletteSize: 10,
			preferredFormat: "rgb",
			localStorageKey: "spectrum",
			move: function ( color ) {
				// updateBorders( color );
			},
			show: function () {

			},
			beforeShow: function () {

			},
			hide: function ( color ) {
				// updateBorders( color );
			}
		} );

		$( wpfpSpectrumParams.selectors ).on( 'change', function() {
			$( this ).spectrum( 'set', $( this ).val() );
		} );

	} );

} )( jQuery );
