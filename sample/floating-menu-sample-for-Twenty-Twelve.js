// Sample for Twenty Twelve
// User Settings
var name = "#site-navigation"; // Div ID which you want to set up Floating Menu. 
var page = "#page";	// Div ID of the page top for getting page top margin.
var adminbar = "#wpadminbar";  // Div ID for Admin Bar for fixing login user.

var menuYloc = null;
var name_screenTop = null;

jQuery(document).ready(function(){
	name_screenTop = parseInt(jQuery(name).offset().top);
	var page_marginTop = parseInt(jQuery(page).css("margin-top"));
	var adminbar_height = parseInt(jQuery(adminbar).css("height"));
	if(isNaN(adminbar_height)) adminbar_height = 0; // If not signed in the WordPress or hide admin bar,
	jQuery(name).css('position', 'absolute');  // Forcibly change DIV position which you want to set up Floating Menu
	var flag = 0; // The following code is run when the Floating menu is hidden by scrolling the window.

	jQuery(window).scroll(function () { 
		offset2 = jQuery(window).scrollTop()-page_marginTop;
		if(name_screenTop < offset2){
			var offset_num = parseInt(jQuery(window).scrollTop())-page_marginTop;
			offset = offset_num +"px";
			jQuery(name).animate({top:offset},{duration:500,queue:false});
			if(flag == 0) flag = 1;
		}else{
			if(flag == 1){
				var offset_num = name_screenTop-page_marginTop-adminbar_height;
				offset = offset_num +"px";
				jQuery(name).animate({top:offset},{duration:500,queue:false});
				flag = 0;
			}
		}
	});
}); 
