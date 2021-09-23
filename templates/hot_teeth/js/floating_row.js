jQuery(document).ready(function() {
    jQuery(window).scroll(function() {
        var stopScrollHeight = 300;
        var currentScrollLevel = jQuery(window).scrollTop();
        if ( currentScrollLevel >= stopScrollHeight ) {
            jQuery("div.floating").addClass("fix_menu topmenushow");
        }else{
            jQuery("div.floating").removeClass("fix_menu topmenushow");
        }
    });
});
