// layout when carousel is enabled or disabled
if (jQuery(".carouselrow").length) {
	jQuery(".contactrow").css("top", "-230" + "px");
	jQuery(".doctorsrow").css("top", "-170" + "px");
	jQuery(".aboutrow, .testimonialsrow").css("top", "-100" + "px");
	jQuery(".servicesrow").css("top", "-60" + "px");
}else{
	jQuery(".logorow").css({
		paddingBottom: 0,
		marginBottom: 50 + "px"
	});
}

// search button
jQuery("#search_enable, #close_search").on("click", function() {
	jQuery(".searchrow").fadeToggle(300);
});

// hover effects to hot responsive lightbox
var galleryPlus = function() {
	var thumbMove = (jQuery("#responsivelightboxgallery li").innerWidth()) / 2 - 31;
	jQuery("img.gallery_hover_plus").css({
		marginTop: thumbMove + "px",
		marginLeft: thumbMove + "px"
	});
};
jQuery( document ).ready(function() {
	galleryPlus();
});
jQuery( window ).resize(function() {
	galleryPlus();
});

// published time
jQuery(".items-row .item .published time").each(function(){
	jQuery(this).insertBefore(jQuery(this).parents(".teeth_blog_item_container"));
});
jQuery(".teeth_blog_item_container").each(function(){
	var blogItemHeight = jQuery(this).innerHeight();
	jQuery(this).siblings("time").height(blogItemHeight);
});

// add padding if there's no article-info
if (jQuery(".article-info").length == 0) {
	jQuery(".page-header h2").css("margin-bottom", "45px");

}