jQuery(document).ready(function($) {  
    //mini cartpopup
    var minicart_popup = $('#ocwatcp-minicart-popup');
    minicart_popupsize = minicart_popup.find('.ocwatcp-minicart-popupsize');
    minicart_popupsize_w   = minicart_popupsize.width();
    minicart_popupsize_h   = minicart_popupsize.height();
    //main popup
    var popup = $('#ocwatcp-popup');
    popupsizes     = popup.find( '.ocwatcp-popupsize');
    ocwatcp_close = popup.find( 'a.ocwatcp_close');
    popup_w   = popupsizes.width();
    popup_h   = popupsizes.height();
        ocwatcp_centerpopup = function (popupsize_w ,popupsize_h ,popupsize) {
            var window_w = $(window).width(),
                window_h = $(window).height(),
                width    = ( ( window_w - 60 ) > popupsize_w ) ? popupsize_w : ( window_w - 60 ),
                height   = ( ( window_h - 120 ) > popupsize_h ) ? popupsize_h : ( window_h - 120 );

            popupsize.css({
                'left' : (( window_w/2 ) - ( width/2 )),
                'top' : (( window_h/2 ) - ( height/2 )),
                'width'     : width + 'px',
                'height'    : height + 'px'
            });
        };

        ocwatcp_closepopup = function(){
            popup.removeClass( 'open' );
            setTimeout(function () {
                popup.find('.ocwatcp-main-block').html('');
            }, 1000);
        };

        ocwatcp_close_cartpopup = function(){
            minicart_popup.removeClass( 'open' );
            setTimeout(function () {
                minicart_popup.find(".product_cartdata_main").hide();
            }, 1000);
        };

    $('body').on( 'added_to_cart', function( ev, fragmentsJSON, cart_hash, button ){

        if( typeof fragmentsJSON == 'undefined' )
            fragmentsJSON = $.parseJSON( sessionStorage.getItem( wc_cart_fragments_params.fragment_name ) );

        $.each( fragmentsJSON, function( key, value ) {

            if ( key == 'ocwatcp_message' ) {

                popup.find('.ocwatcp-main-block').html( value );

                popup.addClass('open');
                
                $( window ).on( 'resize', ocwatcp_centerpopup(popup_w,popup_h,popupsizes) );

                popup.find( 'a.button.contshop' ).on( 'click', function (e) {
                    e.preventDefault();
                    ocwatcp_closepopup();
                });

                return false;
            }
            if ( key == 'ocwatcp_carttotal' ) {
                $("span.ocwatcp_countc").html(value);
            }
        });
    });

    // Close popup by click close button
    $('body').on('click','a.ocwatcp_close',function(ev){
        ev.preventDefault();
        ocwatcp_closepopup();
    });

    // Close cart popup by click close button
    $('body').on('click','a.ocwatcp_mincart_close',function(ev){
        ev.preventDefault();
        ocwatcp_close_cartpopup();
    });

    //mini cart
    $('body').on('click','#ocwatcp-mini-cart',function(ev, fragmentsJSON, cart_hash, button ){

        minicart_popup.find(".product_cartdata_main").show();

        minicart_popup.addClass('open');

        $( window ).on( 'resize', ocwatcp_centerpopup(minicart_popupsize_w,minicart_popupsize_h,minicart_popupsize) );

        minicart_popup.find( 'a.button.contshop1' ).on( 'click', function (e) {
            e.preventDefault();
            ocwatcp_close_cartpopup();
        });

        return false;

        // if( typeof fragmentsJSON == 'undefined' )
        // fragmentsJSON = $.parseJSON( sessionStorage.getItem( wc_cart_fragments_params.fragment_name ) );
        // $.each( fragmentsJSON, function( key, value ) {
        //     console.log(key);
        //     if ( key == 'ocwatcp_minicart' ) {
        //         console.log('1');
        //         jQuery(".product_cartdata_main.custfooterbox").html('');
        //         minicart_popup.find('.ocwatcp-minicart-main-block').html( value );

        //         minicart_popup.addClass('open');

        //         $( window ).on( 'resize', ocwatcp_centerpopup(minicart_popupsize_w,minicart_popupsize_h,minicart_popupsize) );

        //         minicart_popup.find( 'a.button.contshop1' ).on( 'click', function (e) {
        //             e.preventDefault();
        //             ocwatcp_close_cartpopup();
        //         });
                
        //         return false;
        //     } 
                       
        // });    
    });

    //Remove item from cart
    $(document).on('click','.remove_itemcartkey',function(e){
        $('body').append('<div class="ocwatcp_loading"><img src="'+ ocwatcp_cp_localize.template_url +'/assets/images/loader.gif" class="ocwatcp_loader"></div>');
        $('body').addClass('ocwatcp_cartloader_bg');
        var loading = jQuery('.ocwatcp_loading');
        loading.show();
        e.preventDefault();
        var custcartkey = $(this).parents('tr').data('custcartkey');
            $.ajax({
                type: "POST",
                url: ocwatcp_cp_localize.adminurl,
                dataType: 'json',
                data: {action : 'remove_item_from_cart','custcartkey' : custcartkey},
                success: function (response) {
                    if (response) {
                        $('tr[data-custcartkey="'+response['cartkey']+'"]').remove();
                        $('span.ocwatcp_countc').html(response['cartcount']);
                        $('span.cart-totalcost').html(response['carttotal']);
                        $( document.body ).trigger( 'wc_fragment_refresh' );
                        $('body').removeClass( 'ocwatcp_cartloader_bg' );
                        loading.remove(); 
                    }
                }
            });
    })
    
    var popup_modal = document.getElementsByClassName("ocwatcp-overpage")[0];
    var minicart_popup_modal = document.getElementsByClassName("ocwatcp-minicart-overpage")[0];
    window.onclick = function(event) {

      if (event.target == popup_modal) {
        event.preventDefault();
        ocwatcp_closepopup();
      }

      if (event.target == minicart_popup_modal) {
        event.preventDefault();
        ocwatcp_close_cartpopup();
      }
    }

});