
( function( $ ) {

	$( function(  ) {

		var initEditor = function( textarea, prefix ) {
			
			var editor = ace.edit( prefix + textarea.attr( 'id' ) )
			;

			editor.setTheme( 'ace/theme/monokai-light' );
			
			if( textarea.hasClass( 'ace-css' ) ) {
				editor.getSession().setMode( 'ace/mode/less' );	
			}
			else {
				editor.getSession().setMode( 'ace/mode/javascript' );
			}

			editor.getSession().on( 'change', function () {
				textarea.val( editor.getSession().getValue() );
			} );

			$( document ).on( 'wpfp:reset-form', function() {
				editor.getSession().setValue( textarea.val() );
			} );

			return editor;

		} 

		// Ace editor
		$( '.ace-textarea' ).each( function() {

			var textarea   = $( this ),
				editor     = initEditor( textarea, 'ace-' ),
				textareaId = textarea.attr( 'id' )
			;

			$( '#wide-screen-btn-' + textareaId ).on( 'click', function() {
				$( '#ace-' + textareaId ).detach().appendTo( '#m_modal-content-ace-' + textareaId );
				editor.setOptions( {
					maxLines: Infinity
				} );
			} );

			$( '#modal-ace-' + textareaId ).on( 'click', '.ace-validate-btn', function() {
				$( '#ace-' + textareaId ).detach().appendTo( '#ace-editor-container-' + textareaId );
				editor.setOptions( {
					maxLines: 15
				} );
			} );

		} );

		$('.ace-modal-launcher').leanModal( {
			dismissible: false
		} );

	} );

} )( jQuery );