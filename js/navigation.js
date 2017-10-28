/* global srccScreenReaderText */
/**
 * Theme functions file.
 *
 * Contains handlers for navigation and widget area.
 */

(function( $ ) {
	var masthead, menuToggle, siteNavigation, dropdownToggle;

	function initMainNavigation( container ) {

		// Add dropdown toggle that displays child menu items.
		dropdownToggle = $( '<button />', { 'class': 'dropdown-toggle', 'aria-expanded': false })
			.append( $( '<i />', { 'class': 'fa fa-angle-down' }) )
			.append( $( '<span />', { 'class': 'screen-reader-text', text: srccScreenReaderText.expand }) );
		container.find( '.menu-item-has-children > a, .page_item_has_children > a' ).after( dropdownToggle );

		container.find( '.dropdown-toggle' ).click( function( e ) {
			var _this = $( this ),
				screenReaderSpan = _this.find( '.screen-reader-text' );

			e.preventDefault();
			_this.toggleClass( 'toggled-on' );
			_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );

			_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );

			screenReaderSpan.text( screenReaderSpan.text() === srccScreenReaderText.expand ? srccScreenReaderText.collapse : srccScreenReaderText.expand );
		});
	}

	initMainNavigation( $( '.mobile-navigation' ) );

	masthead       = $( '#masthead' );
	menuToggle     = masthead.find( '.menu-toggle' );
	siteNavigation = masthead.find( '.navigation .menu' );

	(function() {

		if ( ! menuToggle.length ) {
			return;
		}

		// Add initial value
		menuToggle.add( siteNavigation ).attr( 'aria-expanded', 'false' );

		menuToggle.on( 'click.srcc', function() {
			$( siteNavigation.closest( '.navigation' ), this ).toggleClass( 'toggled-on' );

			$( this )
				.add( siteNavigation )
				.attr( 'aria-expanded', $( this ).add( siteNavigation ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
		} );

	})();

	// Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
	(function() {

		masthead.find( '.main-navigation .menu-item-has-children > a, .main-navigation .page_item_has_children > a, .topbar-left .menu-item-has-children > a, .topbar-left .page_item_has_children > a' ).on( 'click.srcc', function( e ) {
			e.preventDefault();
		} );

		if ( ! siteNavigation.length || ! siteNavigation.children().length ) {
			return;
		}

		// Toggle `focus` class to allow submenu access on tablets.
		function toggleFocusClassTouchScreen() {
			if ( 'none' === $( '.menu-toggle' ).css( 'display' ) ) {

				$( document.body ).on( 'touchstart.srcc', function( e ) {
					if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
						$( '.main-navigation li' ).removeClass( 'focus' );
					}
				});

				siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' )
					.on( 'touchstart.srcc', function( e ) {
						var el = $( this ).parent( 'li' );

						if ( ! el.hasClass( 'focus' ) ) {
							e.preventDefault();
							el.toggleClass( 'focus' );
							el.siblings( '.focus' ).removeClass( 'focus' );
						}
					});

			} else {
				siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' ).unbind( 'touchstart.srcc' );
			}
		}

		/*if ( 'ontouchstart' in window ) {
			$( window ).on( 'resize.srcc', toggleFocusClassTouchScreen );
			toggleFocusClassTouchScreen();
		}

		siteNavigation.find( 'a' ).on( 'focus.srcc blur.srcc', function() {
			$( this ).parents( '.menu-item, .page_item' ).toggleClass( 'focus' );
		});*/
	})();
})( jQuery );
