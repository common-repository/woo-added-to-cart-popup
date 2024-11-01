jQuery(document).ready(function(){
    //slider setting options by tabbing
    jQuery('.ocwatcp-inner-block ul.tabs li').click(function(){
        var tab_id = jQuery(this).attr('data-tab');
        jQuery('.ocwatcp-inner-block ul.tabs li').removeClass('current');
        jQuery('.ocwatcp-inner-block .tab-content').removeClass('current');
        jQuery(this).addClass('current');
        jQuery("#"+tab_id).addClass('current');
    })

})
