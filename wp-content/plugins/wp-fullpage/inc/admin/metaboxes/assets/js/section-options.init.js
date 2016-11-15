
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
			slidesTypeChange,
			orderByChange,
			accordionToggler,
			teaserDisplayChange,
			selectFirst;

		toggleTaxonomyLaunchers = function () {

			var selectedTaxonomy, selectedTermEl, selectedTermID, includedPostsEl, excludedPostsEl;
			
			selectedTaxonomy = $( 'select.taxonomy' ).val();
			selectedTermEl   = $( '#' + selectedTaxonomy + '-term' );
			selectedTermID   = selectedTermEl.val();
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

		slidesTypeChange = function( e ) {

			e.preventDefault();

			var slideWrapperEl          = $( '.wpfp-slide-wrapper' ),
				postTaxonomiesWrapperEl = $( '.post-taxonomies-wrapper' ),
				postTypesWrapperEl      = $( '.post-types-wrapper' );

			switch( $( this ).val() ) {

				case 'section':
					slideWrapperEl.slideUp( 'fast' )
					break;

				case 'slides':
					slideWrapperEl.not( '#slides-wrapper' ).slideUp( 'fast' )
					$( '#slides-wrapper' ).slideDown();
					break;

				case 'post-taxonomies':
					slideWrapperEl.not( '#post-taxonomies-or-types-wrapper' ).slideUp( 'fast' )
					$( '#post-taxonomies-or-types-wrapper' ).slideDown();
					postTaxonomiesWrapperEl.show();
					postTypesWrapperEl.hide();
					taxonomyEl.trigger( 'change' );
					$( '#' + taxonomyEl.val() + '-term' ).trigger( 'change' );
					break;

				case 'post-types':
					slideWrapperEl.not( '#post-taxonomies-or-types-wrapper' ).slideUp( 'fast' )
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

			if( $( this ).val() === 'yes' )
				teaserLengthContainerEl.slideDown();
			else
				teaserLengthContainerEl.slideUp();

		}

		accordionToggler = function( e ) {

			$( this ).toggleClass( 'active' )
				.next()
				.find( '.accordion-container' )
				.slideToggle( 'slow' );

		}

		$( 'div.term' ).hide();

		taxonomyEl.on( 'change', taxonomyElChange );

		$( 'select.term' ).on( 'change', termChange );

		postTypeEl.on( 'change', postTypeElChange )
			.trigger( 'change' )
		;

		$( '.wpfp-slide-wrapper' ).hide();

		$( '#slidesType' ).on( 'change', slidesTypeChange )
			.trigger( 'change' )
		;

		$( '#orderBy' ).on( 'change', orderByChange )
			.trigger( 'change' )
		;

		$( '[name*="teaserDisplay"]' ).on( 'change', teaserDisplayChange )
			.trigger( 'change' )
		;

	} );

} )( jQuery );