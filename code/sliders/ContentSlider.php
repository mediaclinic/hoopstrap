<?php
/**
 * Defines the ContentSlider page type
 */
class ContentSlider extends Page {

	static $singular_name = 'ContentSlider';
	static $plural_name = 'ContentSlider';
	static $description = 'Page type that wraps contentpages as slider.';

	static $db = array(
	);
	static $has_one = array(
	);
	
	static $allowed_children = array('HeroAndColumns','HeroContent','FullPage','TwoColumns','ThreeColumns','FourColumns','SixColumns','OneWideTwoColumns','OneSidestory','LeftCenterRight','StaffHolder','SliderHolder','CarouselHolder','Jumbotron','Frontpage');

	function GetChildrenLimit($Limit = 1){
		$Children = $this->Children();
		return $Children->getRange(0, $Limit);
	}	

}
 
  
class ContentSlider_Controller extends Page_Controller {
 
	 
}
  
?>