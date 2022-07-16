jQuery( document ).ready( function ( $ ) {
	'use strict';
	
	var ajaxResult=[];

	/**
	 * Handle filter
	 */
	 $('.bew-products-grid-filter.filterable .filter li').each(function( ){
		

		var $this = $( this ),
			$grid = $this.closest( '.bew-woo-grid-tabs' ),
			$products = $grid.find( '.bew-products' );

		if ( $grid.hasClass( 'filter-type-isotope' ) ) {
			$products.isotope( {filter: $this.data( 'filter' )} );
		} else {
			var filter = $this.attr( 'data-filter' ),
				$container = $grid.find( '.bew-woo-grid-tabs-products' );

			filter = filter.replace( /\./g, '' );
			filter = filter.replace( /product_cat-/g, '' );

			var data = {
				template_id : $grid.data( 'id' ),
				columns  	: $grid.data( 'columns' ),
				per_page 	: $grid.data( 'per_page' ),
				load_more	: $grid.data( 'load_more' ),
				type     	: '',
				nonce    	: $grid.data( 'nonce' )
			};

			if ( $grid.hasClass( 'filter-by-group' ) ) {
				data.type = filter;
			} else {
				data.category = filter;
			}

			$grid.addClass( 'loading' );

			wp.ajax.send( 'bew_load_products', {
				data   : data,
				success: function ( response ) {
					var $_products = $( response );
					var filter_name = data.category;
					
					$grid.removeClass( 'loading' );										
					ajaxResult.push({filter_name, $_products});					
					$this.addClass( 'cached' );

					// Support Jetpack lazy loads.
					$( document.body ).trigger( 'jetpack-lazy-images-load' );
				}
			} );
		}
	} );
	
	
	$( '.bew-products-grid-filter.filterable' ).on( 'click', '.filter li', function ( e ) {
		
		e.preventDefault();
		
		var $this = $( this ),
			$grid = $this.closest( '.bew-woo-grid-tabs' ),
			$products = $grid.find( '.bew-products' );
			
			if ( $this.hasClass( 'active' ) ) {
				return;
			}
				
			$this.addClass( 'active' ).siblings( '.active' ).removeClass( 'active' );
			
		if ( $grid.hasClass( 'filter-type-isotope' ) ) {
				$products.isotope( {filter: $this.data( 'filter' )} );
		} else {
		
			var filter = $this.attr( 'data-filter' ),
				$container = $grid.find( '.bew-woo-grid-tabs-products' );

				filter = filter.replace( /\./g, '' );
				filter = filter.replace( /product_cat-/g, '' );
			
				
			if ( $this.hasClass( 'cached' ) ) {
				
				$.each(ajaxResult, function() { 
					 if(this.filter_name === filter){ 
						$container.children( 'div.woocommerce, .load-more' ).remove();
						$container.append( this.$_products ).hide().fadeIn();
					 } 
				});
				
			}else {

					var data = {
						template_id : $grid.data( 'id' ),
						columns  	: $grid.data( 'columns' ),
						per_page 	: $grid.data( 'per_page' ),
						load_more	: $grid.data( 'load_more' ),
						type     	: '',
						nonce    	: $grid.data( 'nonce' )
					};

					if ( $grid.hasClass( 'filter-by-group' ) ) {
						data.type = filter;
					} else {
						data.category = filter;
					}

					$grid.addClass( 'loading' );

					wp.ajax.send( 'bew_load_products', {
						data   : data,
						success: function ( response ) {
							var $_products = $( response );

							$grid.removeClass( 'loading' );

							$_products.find( 'ul.products > li' ).addClass( 'product soberFadeIn soberAnimation' );

							$container.children( 'div.woocommerce, .load-more' ).remove();
							$container.append( $_products ).hide().fadeIn();
							console.log("from individual ajax");

							// Support Jetpack lazy loads.
							$( document.body ).trigger( 'jetpack-lazy-images-load' );
						}
					} );
			}
		}
		
	} );
	

	/**
	 * Ajax load more products
	 */
	$( document.body ).on( 'click', '.ajax-load-products', function ( e ) {
		e.preventDefault();

		var $el = $( this ),
			page = $el.data( 'page' );

		if ( $el.hasClass( 'loading' ) ) {
			return;
		}

		$el.addClass( 'loading' );

		wp.ajax.send( 'bew_load_products', {
			data   : {
				page    : page,
				columns : $el.data( 'columns' ),
				per_page: $el.data( 'per_page' ),
				category: $el.data( 'category' ),
				type    : $el.data( 'type' ),
				nonce   : $el.data( 'nonce' )
			},
			success: function ( data ) {
				$el.data( 'page', page + 1 ).attr( 'page', page + 1 );
				$el.removeClass( 'loading' );

				var $data = $( data ),
					$products = $data.find( 'ul.products > li' ),
					$button = $data.find( '.ajax-load-products' ),
					$container = $el.closest( '.bew-products' ),
					$grid = $container.find( 'ul.products' );

				// If has products
				if ( $products.length ) {
					// Add classes before append products to grid
					$products.addClass( 'product' );

					// Support Jetpack lazy loads.
					$( document.body ).trigger( 'jetpack-lazy-images-load' );

					$( '.product-thumbnail-zoom', $products ).each( function () {
						var $el = $( this );

						$el.zoom( {
							url: $el.attr( 'data-zoom_image' )
						} );
					} );

					$( '.product-images__slider', $products ).owlCarousel( {
						items: 1,
						lazyLoad: true,
						dots: false,
						nav: true,
						rtl: !!( soberData && soberData.isRTL && soberData.isRTL === "1" ),
						navText: ['<svg viewBox="0 0 14 20"><use xlink:href="#left"></use></svg>', '<svg viewBox="0 0 14 20"><use xlink:href="#right"></use></svg>']
					} ).on( 'resize.owl.carousel initialized.owl.carousel', function() {
						if ( $container.hasClass( 'filter-type-isotope' ) ) {
							$grid.isotope( 'layout' );
						}
					} );

					if ( $container.hasClass( 'filter-type-isotope' ) ) {
						var index = 0;
						$products.each( function() {
							var $product = $( this );

							setTimeout( function() {
								$grid.isotope( 'insert', $product );
							}, index * 100 );

							index++;
						} );

						setTimeout(function() {
							$grid.isotope( 'layout' );
						}, index * 100 );
					} else {
						for ( var index = 0; index < $products.length; index++ ) {
							$( $products[index] ).css( 'animation-delay', index * 100 + 100 + 'ms' );
						}
						$products.addClass( 'soberFadeInUp soberAnimation' );
						$grid.append( $products );
					}

					if ( $button.length ) {
						$el.replaceWith( $button );
					} else {
						$el.slideUp();
					}
				}
			}
		} );
	} );

} );
