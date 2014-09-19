// Sample for Twenty Eleven
// @Kimiya Kitani (kimipooh) 17/09/2014

// User Settings
var name = "#access"; // Div/Nav ID which you want to set up Floating Menu. 
var page = "#page";	// Div/Nav  ID of the page top for getting page top margin.
var next_name = "#main";  // Next Div/Nav ID of the Floating Menu (optional). In case that there is the content below the floating menu, please set up it. Because the floating menu is "position:absolute", so it needs to adjust the height position of the Div/Nav ID below the Floating menu.
var adminbar = "#wpadminbar";  // Div/Nav ID for Admin Bar for fixing login user.

// Special Adjustment for Twenty Eleven
var other_adjustment_name_space = "#branding";  // reset Div ID="blending": border-top: 2px... 

// When "name" and "page" values are not empty, the JS code will be run.
if (name && page){

var menuYloc = null;
var name_screenTop = null;

jQuery(document).ready(function(){
	// Begin of Special Adjustment for Twenty Eleven
	if(other_adjustment_name_space){
		other_adjustment_name_spaceTop = jQuery(other_adjustment_name_space).css('border-top');
		if(other_adjustment_name_spaceTop) jQuery(other_adjustment_name_space).css('border-top', 0); 
	}
	// End of Special Adjustment for Twenty Eleven
	
	name_screenTop = parseInt(jQuery(name).offset().top);
	var name_height = parseInt(jQuery(name).css("height"));
	var page_marginTop = parseInt(jQuery(page).css("margin-top"));
	var adminbar_height = parseInt(jQuery(adminbar).css("height"));
	if(isNaN(adminbar_height)) adminbar_height = 0; // If not signed in the WordPress or hide admin bar,
	jQuery(name).css('position', 'absolute');  // Forcibly change DIV position which you want to set up Floating Menu

	if(next_name){
		var next_name_marginTop = parseInt(jQuery(next_name).css("margin-top"));
		next_name_marginTop = next_name_marginTop + page_marginTop;
		if(next_name_marginTop) jQuery(next_name).css('margin-top', next_name_marginTop+'px');
	}

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
				var offset_num = name_screenTop-adminbar_height-page_marginTop;
				offset = offset_num +"px";
				jQuery(name).animate({top:offset},{duration:500,queue:false});
				flag = 0;
			}
		}
	});
}); 

}