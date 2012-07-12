<?php
/**
 * Defines the LayoutHolder page type
 */
class LayoutHolder extends Page {
    static $db = array(
    );
    static $has_one = array(
    );
    
   static $allowed_children = array('HeroAndColumns','FullPage','TwoColumns','ThreeColumns','FourColumns','SixColumns','OneWideTwoColumns','OneSidestory','LeftCenterRight','StaffHolder','SliderHolder','CarouselHolder');
	

}
	
  
class LayoutHolder_Controller extends Page_Controller {
 
	 
}
  
?>