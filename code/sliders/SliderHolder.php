<?php
/**
 * Defines the SliderHolder page type
 */
class SliderHolder extends Page {

	static $singular_name = 'SliderHolder';
	static $plural_name = 'SliderHolders';
	static $description = 'Page type that wraps slides together.';

	static $db = array(
	);
	static $has_one = array(
	);
	
	static $allowed_children = array('Slide');

	function GetChildrenLimit($Limit = 1){
		$Children = $this->Children();
		return $Children->getRange(0, $Limit);
	}	

}
 
  
class SliderHolder_Controller extends Page_Controller {
 
	 
}
  
?>