
( function( $ ) {

	$( function(  ) {

		var includedPostsOfTermLauncherEl = $( '.' + wpfpFPOParams.includedPostsOfTermLauncherClass ),
			excludedPostsOfTermLauncherEl = $( '.' + wpfpFPOParams.excludedPostsOfTermLauncherClass ),
			includedPostsOfTypeLauncherEl = $( '.' + wpfpFPOParams.includedPostsOfTypeLauncherClass ),
			excludedPostsOfTypeLauncherEl = $( '.' + wpfpFPOParams.excludedPostsOfTypeLauncherClass ),
			taxonomyEl            = $( '#taxonomy' ),
			postTypeEl            = $( '#postType' ),
			globalIncludedPostsEl = $( '#' + wpfpFPOParams.includedPostsID ), 
			globalExcludedPostsEl = $( '#' + wpfpFPOParams.excludedPostsID ),
			toggleTaxonomyLaunchers,
			togglePostTypeLaunchers,
			taxonomyElChange,
			termChange,
			postTypeElChange,
			sectionsTypeChange,
			orderByChange,
			teaserDisplayChange,
			accordionToggler,
			pageOptions = $( '#fullpage-page-options' ),
			isItFullPageChange,
			settingsbox = $( '#wpfp-settingsbox' ).parents( '.wpfp-wrap' ),
			selectFirst;

		toggleTaxonomyLaunchers = function () {

			var selectedTaxonomy, selectedTermID, includedPostsEl, excludedPostsEl;
			
			selectedTaxonomy = $( 'select.taxonomy' ).val();
			selectedTermID   = $( '#' + selectedTaxonomy + '-term' ).val();
			includedPostsEl  = $( '#' + wpfpFPOParams.includedPostsID + '-' + selectedTaxonomy + '-' + selectedTermID );
			excludedPostsEl  = $( '#' + wpfpFPOParams.excludedPostsID + '-' + selectedTaxonomy + '-' + selectedTermID );

			includedPostsOfTermLauncherEl.hide();
			excludedPostsOfTermLauncherEl.hide();
			$( '#' + wpfpFPOParams.includedPostsOfTermLauncherClass + '-' + selectedTaxonomy + '-' + selectedTermID ).show();
			$( '#' + wpfpFPOParams.excludedPostsOfTermLauncherClass + '-' + selectedTaxonomy + '-' + selectedTermID ).show();

			globalIncludedPostsEl.data( 'correspondingEl', includedPostsEl.selector )
				.val( includedPostsEl.val() )
				.trigger( 'change' );
			globalExcludedPostsEl.data( 'correspondingEl', excludedPostsEl.selector )
				.val( excludedPostsEl.val() )
				.trigger( 'change' );

		}

		togglePostTypeLaunchers = function () {

			var selectedPostType, includedPostsEl, excludedPostsEl;
			
			selectedPostType = $( 'select.postType' ).val();
			includedPostsEl  = $( '#' + wpfpFPOParams.includedPostsID + '-' + selectedPostType );
			excludedPostsEl  = $( '#' + wpfpFPOParams.excludedPostsID + '-' + selectedPostType );

			includedPostsOfTypeLauncherEl.hide();
			excludedPostsOfTypeLauncherEl.hide();
			$( '#' + wpfpFPOParams.includedPostsOfTypeLauncherClass + '-' + selectedPostType ).show();
			$( '#' + wpfpFPOParams.excludedPostsOfTypeLauncherClass + '-' + selectedPostType ).show();

			globalIncludedPostsEl.data( 'correspondingEl', includedPostsEl.selector )
				.val( includedPostsEl.val() )
				.trigger( 'change' );
			globalExcludedPostsEl.data( 'correspondingEl', excludedPostsEl.selector )
				.val( excludedPostsEl.val() )
				.trigger( 'change' );

		}

		taxonomyElChange = function( e ) {

			e.preventDefault();

			$( '.term' ).hide();
			
			$( '#' + $( this ).val() + '-term' ).parent().show();

			toggleTaxonomyLaunchers();

		}

		termChange = function( e ) {

			$( '#term' ).val( $( this ).val() );

			toggleTaxonomyLaunchers();

		}

		postTypeElChange = function( e ) {

			togglePostTypeLaunchers();

		}

		sectionsTypeChange = function( e ) {

			e.preventDefault();

			var sectionWrapperEl        = $( '.wpfp-section-wrapper' ),
				postTaxonomiesWrapperEl = $( '.post-taxonomies-wrapper' ),
				postTypesWrapperEl      = $( '.post-types-wrapper' );

			switch( $( this ).val() ) {

				case 'sections':
					sectionWrapperEl.not( '#sections-wrapper' ).slideUp( 'fast' )
					$( '#sections-wrapper' ).slideDown();
					break;

				case 'post-taxonomies':
					sectionWrapperEl.not( '#post-taxonomies-or-types-wrapper' ).slideUp( 'fast' )
					$( '#post-taxonomies-or-types-wrapper' ).slideDown();
					postTaxonomiesWrapperEl.show();
					postTypesWrapperEl.hide();
					taxonomyEl.trigger( 'change' );
					$( '#' + taxonomyEl.val() + '-term' ).trigger( 'change' );
					break;

				case 'post-types':
					sectionWrapperEl.not( '#post-taxonomies-or-types-wrapper' ).slideUp( 'fast' )
					$( '#post-taxonomies-or-types-wrapper' ).slideDown();
					postTypesWrapperEl.show();
					postTaxonomiesWrapperEl.hide();
					postTypeEl.trigger( 'change' );
					break;

			}

		}

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

			if( $( this ).is( ':checked' ) )
				teaserLengthContainerEl.slideDown();
			else
				teaserLengthContainerEl.slideUp();

		}

		isItFullPageChange = function( e ) {

			e.preventDefault();
			
			if( $( this ).is( ':checked' ) ) {
				if( 'yes' === $( this ).val() )
					settingsbox.slideDown( 'slow' );
				else
					settingsbox.slideUp( 'fast' );
			}
		
		}

		accordionToggler = function( e ) {

			$( this ).toggleClass( 'active' )
				.next()
				.find( '.accordion-container' )
				.slideToggle( 'slow' );

		}
		
		$( 'div.term' ).hide();

		taxonomyEl.on( 'change', taxonomyElChange );

		$( 'select.term' ).on( 'change', termChange )

		postTypeEl.on( 'change', postTypeElChange );

		$( '.wpfp-section-wrapper' ).hide();

		$( '#sectionsType' ).on( 'change', sectionsTypeChange )
			.trigger( 'change' )
		;

		$( '#orderBy' ).on( 'change', orderByChange )
			.trigger( 'change' )
		;

		$( '#teaserDisplay' ).on( 'change', teaserDisplayChange )
			.trigger( 'change' )
		;

		// Page Options
		if( 0 < pageOptions.length )
			pageOptions.find( 'input' ).on( 'change', isItFullPageChange )
				.trigger( 'change' )
			;

	} );

} )( jQuery );
