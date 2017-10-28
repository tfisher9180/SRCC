(function( $ ) {

	// jQuery matchHeight
	$( '.archive-view .post' ).matchHeight();

	// Move post navigation based on screen size (before/after sidebar)
	$( window ).on( 'resize load', function() {

		var currentWidth = $( window ).width();
		var postNav = $( '.single .post-navigation' );

		// iPad
		if ( currentWidth < 769 ) {

			// Move post navigation above sidebar on small screens
			if ( $( '#comments' ).length ) {

				$( postNav ).insertAfter( '#comments' );

			} else {

				$( postNav ).insertAfter( '.entry-footer' );
				
			}
			
		} else {

			// Move post navigation below sidebar on large screens
			$( postNav ).insertAfter( '.post' );

		}

	} );

})(jQuery);