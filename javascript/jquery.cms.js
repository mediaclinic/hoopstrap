	function setSitetreeHolderMarginTop() { 
    	jQuery("#sitetree_holder").css("margin-top",
    	jQuery("#TreeTools").height()+"px");
    	fixHeight_left();
    }
	jQuery('#TreeActions button').live('click', function() {
		setSitetreeHolderMarginTop();
	});
	
	jQuery(document).ready(function() {
		setTimeout('setSitetreeHolderMarginTop()', 1000);
	});