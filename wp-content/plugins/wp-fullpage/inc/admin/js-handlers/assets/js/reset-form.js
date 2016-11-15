
( function( $ ) {

	$( function() {

		var resetForm,
			resetProperty
		;

		resetForm = function( e ) {

			e.preventDefault();

			var $form = $( this ).parents( '.wpfp-wrap' );

			$form.find( 'input, textarea' ).not( '.select-dropdown, .no-reset, [type="radio"], [type="checkbox"], [type="submit"], [type="button"], [type="image"], [type="hidden"]' ).each( function() {

				var _this = $( this ),
					dataDefault = _this.data( 'default' );

				if( typeof( dataDefault ) != 'undefined' )
					_this.val( dataDefault );

				_this.trigger( 'change' );

			} );

			$form.find( 'select' ).not( '.no-reset' ).each( function() {

				var _this = $( this ),
					dataDefault = _this.data( 'default' );

				if( typeof( dataDefault ) != 'undefined' )
					_this.val( dataDefault );

				_this.trigger( 'change' );
				_this.material_select();

			} );

			$form.find( 'input[type="radio"], input[type="checkbox"]' ).not( '.no-reset' ).each( function() {

				var _this = $( this ),
					dataDefault = _this.data( 'default' );

				if( dataDefault == _this.val() )
					_this.attr( 'checked', 'checked' );
				else if( typeof( dataDefault ) != 'undefined' )
					_this.removeAttr( 'checked' );

				_this.trigger( 'change' );

			} );

			$( document ).trigger( 'wpfp:reset-form' );

		}

		resetProperty = function( e ) {

			e.preventDefault();

			var $input = $( this ).parent().find( 'input' ),
				dataDefault = $input.data( 'default' );
			;

			if( typeof( dataDefault ) != 'undefined' )
				$input.val( dataDefault );

			$input.trigger( 'change' );

		}

		$( document ).on( 'click', '.wpfp-reset', resetForm );

		$( document ).on( 'click', '.wpfp-reset-property', resetProperty );

		$('.reset-modal-launcher').leanModal( {
			dismissible: false
		} );

	} );

} )( jQuery );
