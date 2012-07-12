<?php
/**
 * Defines the CarouselHolder page type
 */
class CarouselHolder extends Page {
	static $db = array(
	);
	static $has_one = array(
	);
	
	static $allowed_children = array('CarouselImage');

	function GetChildrenLimit($Limit = 1){
		$Children = $this->Children();
		return $Children->getRange(0, $Limit);
	}	

}
 
  
class CarouselHolder_Controller extends Page_Controller {
 
	 
}
  
?>