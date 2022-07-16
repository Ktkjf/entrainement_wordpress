'use strict';

var woogeneral;

(
	function() {

		woogeneral = (
		function() {

				return {

					init: function() {

						this.general();
					}
				}
			}()
		);
	}
)( jQuery );

jQuery( document ).ready( function() {
	if (!jQuery( 'body' ).hasClass("elementor-editor-active")) {
		woogeneral.init();
	}
} );

// Make sure you run this code under Elementor.
jQuery( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/global', function() {
		if (jQuery( 'body' ).hasClass("elementor-editor-active")) {
			woogeneral.init();
		}
	});
} );
	
// General
(
	function( $ ) {

		var $body = $( 'body' );
						
		woogeneral.general = function() {
			
			var wooCart = function() {
				
				// Product Add to cart pass php variables
				if( typeof passed_object != 'undefined' && passed_object) {		
					var icon_type = passed_object.icon_type;
					var type_classes = passed_object.type_classes;

				} else {
					var qty = $(".woo-cart-quantity").text();	
					var icon_type = $('.woo-header-cart').data('icon');
					var type_classes = $('.woo-header-cart').data('type');				
				}
						
				$('.bew-menu-cart .woo-header-cart a' ).addClass(type_classes);
				$('.bew-menu-cart .woo-header-cart a i' ).addClass(icon_type);
				$('.bew-menu-cart .woo-header-cart a span' ).addClass(type_classes);
				
			};
			
			var woomenuCanvas = function() {
				
				var $menucart = $( '.woo-header-cart ' ),
				$minicart = $( '.bew-mini-cart-canvas' ),
				$closeBtn    = $( '.drawer__btn-close' );			
			    
				var MenuCanvasEvents = function() {

					$menucart.on( 'click', '> .woo-menucart', function( e ) {
						e.preventDefault();
						openMenucart();
					} );
					
					$closeBtn.on( 'click', function() {
						closeMenucart();
					} );					
					
					$minicart.on('click', function (event) {
						if ($minicart.hasClass('menucart--open') && $minicart[0] === event.target) {
							closeMenucart();
						}
					});

					$(document).keyup(function (event) {
						var ESC_KEY = 27;

						if (ESC_KEY === event.keyCode) {
							if ($minicart.hasClass('menucart--open')) {
								closeMenucart();
							}
						}
					});

				};

				MenuCanvasEvents();

				var openMenucart = function() {

					$body.addClass( 'menu-canvas-enabled' );
					$minicart.addClass( 'menucart--open' );
					$closeBtn.removeClass( 'btn--hidden' );

				};

				var closeMenucart = function() {

					$body.removeClass( 'menu-canvas-enabled' );
					$minicart.removeClass( 'menucart--open' );
					$closeBtn.addClass( 'btn--hidden' );

				};
				
			};
			
			var wooSearch = function() {
				
				var $search      = $( '.header-search' ),
					$formWrapper = $( '.search-form-wrapper' ),
					$closeBtn    = $( '.btn-search-close' ),
					$form        = $( 'form.ajax-search-form' ),
					$select      = $form.find( 'select.search-select' ),
					$input       = $form.find( 'input.search-input' ),
					$ajaxNotice  = $( '.ajax-search-notice' ),
					noticeText   = $ajaxNotice.text(),
					found        = false;
				
				// add unique id
				$('.bew-woo-search-container').each(function(i){
				  this.id= 'bew-search-' + i;
				  $(this).find('.search-results-wrapper').addClass('bew-search-' + i)
				});
					
				
				if ( document.querySelector( '.bew-woo-search' ) === null ) {
				$body.addClass( 'hide-bew-woo-search' );
				return;
				}
				
				if ( ! $search.length ) {
					return;
				}

				var categoriesSelectBox = function() {

					if ( $select.find( '>option' ).length ) {
						$select.select2( {
							templateResult: function( str ) {

								if ( ! str.id ) {
									return str.text;
								}

								return $( '<span>' + str.text + '</span>' );
							},
						} ).on( 'change', function() {

							var text = $( this )
								.find( 'option[value="' + $( this ).val() + '"]' )
								.text()
								.trim();

							$( '#select2-product_cat-container' ).text( text );
							$( '#select2-cat-container' ).text( text );

							setTimeout( function() {
								$input.focus();
							}, 500 );
							
							$( ".autocomplete-suggestion" ).remove();
							ajaxSearch();
						} );

						$select.next( '.select2' ).on( 'mousedown', function() {
							$( '#select2-product_cat-results' ).perfectScrollbar();
						} );
					}
				};

				var woosearchEvents = function() {

					$search.on( 'click', '> .toggle', function( e ) {

						e.preventDefault();

						openSearch();
					} );

					$search.on( 'focus', 'input.fake-input', function( e ) {

						e.preventDefault();

						openSearch();
					} );

					$closeBtn.on( 'click', function() {
						closeSearch();
					} );

					$input.on( 'keyup', function( event ) {

						if ( event.altKey || event.ctrlKey || event.shiftKey || event.metaKey ) {
							return;
						}
						var keys = [9, 16, 17, 18, 19, 20, 33, 34, 35, 36, 37, 39, 45, 46];

						if ( keys.indexOf( event.keyCode ) != - 1 ) {
							return;
						}

						switch ( event.which ) {
							case 8: // backspace
								if ( $( this ).val().length < woosearchConfigs.search_min_chars ) {
									$( '.autocomplete-suggestion' ).remove();
									$( '.search-view-all' ).remove();
									$ajaxNotice.fadeIn( 200 ).text( noticeText ).removeClass('has-notice');
								}
								break;
							case 27:// escape

								// close search
								if ( $( this ).val() == '' ) {
									closeSearch();
								}

								// remove result
								$( '.autocomplete-suggestion' ).remove();
								$( '.search-view-all' ).remove();
								$( this ).val( '' );

								$ajaxNotice.fadeIn( 200 ).text( noticeText ).addClass('has-notice');

								break;
							default:
								break;
						}
					} );
				};

				var ajaxSearch = function() {
					
					if( typeof woosearchConfigs == 'undefined') {	
						return; 
					}

					var productCat = '0',
						cat        = '0',					
						symbol     = woosearchConfigs.ajax_url.split( '?' )[1] ? '&' : '?',
						postType   = $form.find( 'input[name="post_type"]' ).val(),
						url        = woosearchConfigs.ajax_url + symbol + 'action=bew_ajax_search';
										
					if ( $select.find( 'option' ).length ) {
						productCat = cat = $select.val();
					}

					if ( postType == 'product' ) {
						url += '&product_cat=' + productCat;
					} else {
						url += '&cat=' + cat;
					}

					url += '&limit=' + woosearchConfigs.search_limit;
					url += '&search_by=' + woosearchConfigs.search_by;
					
					$('.bew-woo-search-container').each(function(i){
						
						var append = $('.search-results-wrapper.bew-search-' + i);
						var $input2 = $(this).find( 'input.search-input' );
						
						$input2.devbridgeAutocomplete( {
							serviceUrl      : url,
							minChars        : woosearchConfigs.search_min_chars,
							appendTo        : append,
							deferRequestBy  : 300,
							beforeRender    : function( container ) {
								container.perfectScrollbar();
							},
							onSelect        : function( suggestion ) {
								if ( suggestion.url.length ) {
									window.location.href = suggestion.url;
								}

								if ( suggestion.id == - 2 ) {
									return;
								}
							},
							onSearchStart   : function() {
								$formWrapper.addClass( 'search-loading' );
							},
							onSearchComplete: function( query, suggestions ) {

								$formWrapper.removeClass( 'search-loading' );						

								if ( found && suggestions[0].id != - 1 ) {
									$ajaxNotice.fadeOut( 200 ).removeClass('has-notice');
								} else {
									$ajaxNotice.fadeIn( 200 ).addClass('has-notice');
								}

								if ( suggestions.length > 1 && suggestions[suggestions.length - 1].id == - 2 ) {

									// append View All link (always is the last element of suggestions array)
									var viewAll = suggestions[suggestions.length - 1];

									$formWrapper.find( '.autocomplete-suggestions' )
												.append( '<a class="search-view-all" href="' + viewAll.url + '"' + 'target="' + viewAll.target + '">' + viewAll.value + '</a>' );
								}

								$( '.autocomplete-suggestion' ).each( function() {
									if ( ! $( this ).html() ) {
										$( this ).remove();
									}
								} );
							},
							formatResult    : function( suggestion, currentValue ) {
								return generateHTML( suggestion, currentValue );				
								
							},
						} );
					
					});
				};

				var generateHTML = function( suggestion, currentValue ) {

					var postType    = $form.find( 'input[name="post_type"]' ).val(),
						pattern     = '(' + escapeRegExChars( currentValue ) + ')',
						returnValue = '';

					// not found
					if ( suggestion.id == - 1 ) {

						$ajaxNotice.text( suggestion.value ).fadeIn( 200 ).addClass('has-notice');

						return returnValue;
					}

					if ( suggestion.id == - 2 ) {
						return returnValue;
					}

					found = true;
					
					if ( suggestion.thumbnail ) {
						returnValue += ' <div class="suggestion-thumb">' + suggestion.thumbnail + '</div>';
					}

					if ( suggestion.id != - 2 ) {
						returnValue += '<div class="suggestion-details">';
					}

					var title = suggestion.value.replace( new RegExp( pattern, 'gi' ), '<ins>$1<\/ins>' )
										  .replace( /&/g, '&amp;' )
										  .replace( /</g, '&lt;' )
										  .replace( />/g, '&gt;' )
										  .replace( /"/g, '&quot;' )
										  .replace( /&lt;(\/?ins)&gt;/g, '<$1>' ) + '</a>';

					if ( suggestion.url.length ) {
						returnValue += '<a href="' + suggestion.url + '" class="suggestion-title">' + title + '</a>';
					} else {
						returnValue += '<h5 class="suggestion-title">' + title + '</h5>';
					}

					if ( postType === 'product' ) {

						var sku = suggestion.sku;

						if ( woosearchConfigs.search_by == 'sku' || woosearchConfigs.search_by == 'both' ) {

							sku = suggestion.sku.replace( new RegExp( pattern, 'gi' ), '<ins>$1<\/ins>' )
											.replace( /&/g, '&amp;' )
											.replace( /</g, '&lt;' )
											.replace( />/g, '&gt;' )
											.replace( /"/g, '&quot;' )
											.replace( /&lt;(\/?ins)&gt;/g, '<$1>' ) + '</a>';
						}

						if ( suggestion.sku ) {
							returnValue += '<span class="suggestion-sku">SKU: ' + sku + '</span>';
						}

						if ( suggestion.price ) {
							returnValue += '<span class="suggestion-price">' + suggestion.price + '</span>';
						}
					}

					if ( postType === 'post' ) {
						if ( suggestion.date ) {
							returnValue += '<span class="suggestion-date">' + suggestion.date + '</span>';
						}
					}

					if ( suggestion.excerpt && woosearchConfigs.search_excerpt_on ) {
						returnValue += '<p class="suggestion-excerpt">' + suggestion.excerpt + '</p>';
					}

					if ( suggestion.id != - 2 ) {
						returnValue += '</div>';
					}

					return returnValue;
				};

				var escapeRegExChars = function( value ) {
					return value.replace( /[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, '\\$&' );
				};
				
				var resultFullwidth = function() {
					
					$('.elementor-widget-bew-woo-search').each(function(i){
						var position =	$('#bew-search-' + i + ' .search-results-wrapper', this).offset(),
							marginleft = -position.left,				
							windowWidth   = $( window ).width();
							
						if ( windowWidth <= 767 ) {	
							$('#bew-search-' + i, this).removeClass( 'fullwidth'); 
						} else{
							if($('#bew-search-' + i, this ).hasClass( 'fullwidth' ) && $(this).hasClass( 'search-style--input' )){
							 console.log('hola2');
							 $('#bew-search-' + i + ' .search-results-wrapper').css('margin-left', marginleft);
							}	
						}
					});
				};

				categoriesSelectBox();
				woosearchEvents();
				ajaxSearch();
				resultFullwidth();

				var openSearch = function() {

					$body.addClass( 'search-opened' );
					$formWrapper.addClass( 'search--open' );
					$closeBtn.removeClass( 'btn--hidden' );

					setTimeout( function() {
						$input.focus();
					}, 500 );
				};

				var closeSearch = function() {

					$body.removeClass( 'search-opened' );
					$formWrapper.removeClass( 'search--open' );
					$closeBtn.addClass( 'btn--hidden' );

					setTimeout( function() {
						$input.blur();
					}, 500 );
				};

			};
			
			// Bew Mini cart
			var bewminicart = function() {
				
				// Qty minus & plus
				$('body').
				  on('click touch', '.bewwoo-item-qty-plus, .bewwoo-item-qty-minus',
					  function() {
						// get values
						var $number = $(this).closest('.bewwoo-item-qty').find('.qty'),
							number_val = parseFloat($number.val()),
							max = parseFloat($number.attr('max')),
							min = parseFloat($number.attr('min')),
							step = $number.attr('step');

						// format values
						if (!number_val || number_val === '' || number_val === 'NaN') {
						  number_val = 0;
						}

						if (max === '' || max === 'NaN') {
						  max = '';
						}

						if (min === '' || min === 'NaN') {
						  min = 0;
						}

						if (step === 'any' || step === '' || step === undefined ||
							parseFloat(step) === 'NaN') {
						  step = 1;
						}

						// change the value
						if ($(this).is('.bewwoo-item-qty-plus')) {
						  if (max && (
							  max == number_val || number_val > max
						  )) {
							$number.val(max);
						  } else {
							if (bewwoo_is_int(step)) {
							  $number.val(number_val + parseFloat(step));
							} else {
							  $number.val((
								  number_val + parseFloat(step)
							  ).toFixed(1));
							}
						  }
						} else {
						  if (min && (
							  min == number_val || number_val < min
						  )) {
							$number.val(min);
						  } else if (number_val > 0) {
							if (bewwoo_is_int(step)) {
							  $number.val(number_val - parseFloat(step));
							} else {
							  $number.val((
								  number_val - parseFloat(step)
							  ).toFixed(1));
							}
						  }
						}

						// trigger change event
						$number.trigger('change');
					  });
					  
					  // Qty on change
					  $('body').on('change', '.bew-woo-mini-cart input.qty, .bew-mini-cart .bewwoo-item-qty input.qty', function() {
						var item_key = $(this).attr('name');
						var item_qty = $(this).val();
						bewwoo_update_qty(item_key, item_qty);
					  });
					  
					  // Qty validate
					  var t = false;
					  $('body').on('focus', '.bew-woo-mini-cart input.qty, .bew-mini-cart .bewwoo-item-qty input.qty', function() {
						var thisQty = $(this);
						var thisQtyMin = thisQty.attr('min');
						var thisQtyMax = thisQty.attr('max');

						if ((
							thisQtyMin == null
						) || (
							thisQtyMin == ''
						)) {
						  thisQtyMin = 1;
						}

						if ((
							thisQtyMax == null
						) || (
							thisQtyMax == ''
						)) {
						  thisQtyMax = 1000;
						}

						t = setInterval(
							function() {
							  if ((
								  thisQty.val() < thisQtyMin
							  ) || (
								  thisQty.val().length == 0
							  )) {
								thisQty.val(thisQtyMin);
							  }
							  if (thisQty.val() > thisQtyMax) {
								thisQty.val(thisQtyMax);
							  }
							}, 500);
					  });
					  
					  $('body').on('blur', '.bew-woo-mini-cart input.qty, .bew-mini-cart .bewwoo-item-qty input.qty', function() {
						if (t != false) {
						  window.clearInterval(t);
						  t = false;
						}

						var item_key = $(this).attr('name');
						var item_qty = $(this).val();
						bewwoo_update_qty(item_key, item_qty);
					  });
					  
					  
					function bewwoo_update_qty(cart_item_key, cart_item_qty) {
						
					  if( typeof bewwoo_vars == 'undefined') {	
						return; 
					  }
					  
					  var data = {
						action: 'bewwoo_update_qty',
						cart_item_key: cart_item_key,
						cart_item_qty: cart_item_qty,
						security: bewwoo_vars.nonce,
					  };

					  jQuery.post(bewwoo_vars.ajaxurl, data, function(response) {
						  
						$('.ct-cart-content').wrapInner( "<div class='widget_shopping_cart_content'></div>");
						
						bewwoo_cart_reload();
						
						var cartcount = jQuery.parseJSON(response);						
						$('.ct-cart-item').attr('data-count', cartcount.count);
						
						
					  });
					}
					
					function bewwoo_cart_reload() {				
					  jQuery(document.body).trigger('wc_fragment_refresh');	
					  jQuery(document.body).trigger('update_checkout');
					}
					
					function bewwoo_is_int(n) {
					  return n % 1 === 0;
					}
								
			};
			
			// Bew Mini cart One page checkout
			var bewminicartOpc = function() {
					
					if( typeof bewwoo_vars == 'undefined') {	
						return; 
					}
					
					var wc_session = bewwoo_vars.wc_session;
					
						$(document.body ).on('added_to_cart',function() {
							
							console.log(wc_session);
							
							if( wc_session == 'no-session') {
								update_submit_nonce();
							}
							
							wc_session = "yes-session";
							
						});
						  
						function update_submit_nonce() {
						
						  var data = {
							action: 'update_submit_nonce',
						  };

						  jQuery.post(bewwoo_vars.ajaxurl, data, function(response) {
												
							var nonce_submit = response;
							
							var value = $(nonce_submit).val(); 
							
							$('#woocommerce-process-checkout-nonce').val(value);
							console.log(value);
							
						  });
						}
					
													
			};
						
			// Bew Mini cart mobile canvas
			var bewminicartCanvas = function() {
										
					var $WooOrderscart = $( '.woo-orders-header-cart ' ),
					$bewminicart = $( '.bew-woo-mini-cart' ),
					$WooOrderscloseBtn    = $( '.woo-orders-btn-close' );			
					
					var WooOrdersCanvasEvents = function() {

						$WooOrderscart.on( 'click', '> .woo-orders-menucart', function( e ) {
							e.preventDefault();
							openWooOrderscart();
						} );
						
						$WooOrderscloseBtn.on( 'click', function() {
							closeWooOrderscart();
						} );					
						
						$bewminicart.on('click', function (event) {
							if ($bewminicart.hasClass('mini-cart--open') && $bewminicart[0] === event.target) {
								closeWooOrderscart();
							}
						});

						$(document).keyup(function (event) {
							var ESC_KEY = 27;

							if (ESC_KEY === event.keyCode) {
								if ($bewminicart.hasClass('mini-cart--open')) {
									closeWooOrderscart();
								}
							}
						});

					};

					WooOrdersCanvasEvents();

					var openWooOrderscart = function() {

						$body.addClass( 'woo-orders-cart-canvas-enabled' );
						$bewminicart.addClass( 'mini-cart--open' );
						$WooOrderscloseBtn.removeClass( 'btn--hidden' );

					};

					var closeWooOrderscart = function() {

						$body.removeClass( 'woo-orders-cart-canvas-enabled' );
						$bewminicart.removeClass( 'mini-cart--open' );
						$WooOrderscloseBtn.addClass( 'btn--hidden' );

					};
					
			};
			
			
			// Bew Mini cart Add to cart events
			var bewminicartAdd = function() {
				
				if( typeof bewwoo_vars == 'undefined') {	
					return;
				}
				
				if ( bewwoo_vars.is_mini_cart != "active" ) {				
					return;				
				}
				
				if ( bewwoo_vars.is_mini_cart == "active" ) {				
					$( 'body' ).addClass( 'bew-mini-cart-active woocommerce woocommerce-page' );				
				}
				
				/**
				 * AddToCartHandler class.
				 */
				var bmcAddToCartHandler = function() {
					$( document.body )
					.on( 'added_to_cart', this.bmcupdateButton )
					.on( 'click', '.remove_from_cart_button', { bmcaddToCartHandler: this }, this.bmconRemoveFromCart );
				};
				
				/**
				 * Update cart page elements after add to cart events.
				 */
				bmcAddToCartHandler.prototype.bmcupdateButton = function( e, fragments, cart_hash, $button ) {
					$button = typeof $button === 'undefined' ? false : $button;

					if ( $button ) {

						// New View cart text.
						if ( ! bew_woo_view_cart.is_cart && $button.parent().find( '.bmc_added_to_cart' ).length === 0 ) {
							$button.after( ' <a href="' + bew_woo_view_cart.view_cart_link_url + '" class="bmc_added_to_cart added_to_cart wc-forward" title="' +
								bew_woo_view_cart.view_cart + '">' + '<i class="' + bew_woo_view_cart.view_cart_icon + '" aria-hidden="true"></i> ' + bew_woo_view_cart.view_cart + '</a>' );
						}
						
						$button.parent().find( '.added_to_cart' ).removeClass( 'hide' );
						
					}
					
				};
				
				/**
				 * Update fragments after remove from cart event in mini-cart.
				 */
				bmcAddToCartHandler.prototype.bmconRemoveFromCart = function( e ) {
					var $thisbutton  = $( this ),						
						$product_id  = $thisbutton.attr( 'data-product_id' );

					e.preventDefault();
					
					$('#bew-cart.bew-product-' + $product_id + ' .add_to_cart_button'  ).removeClass( 'hidde added' );
					$('#bew-cart.bew-product-' + $product_id + ' .added_to_cart'  ).addClass( 'hide' );
					
					console.log($product_id);
				
				};
				
				/**
				 * Init owpAddToCartHandler.
				 */
				new bmcAddToCartHandler();	

								
			};
					
			var events = function() {					
				  wooCart();
				  woomenuCanvas();
				  wooSearch();				  
				  bewminicart();
				  bewminicartOpc();
				  bewminicartCanvas();
				  bewminicartAdd();
			};
				
			events();		
		};
	
})( jQuery );

