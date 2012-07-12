<?php
/**
 * Defines the SliderHolder page type
 */
class SliderHolder extends Page {
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